<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Dashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use ZipArchive;

use App\Jobs\FileBody;
use Illuminate\Console\Scheduling\Schedule;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

use Illuminate\Support\Facades\Artisan;

class ParameterController extends Controller
{
    public function uploadFiles()
    {
      $id = request()->session()->get('id');
      $quapa = request()->session()->get('quapa');
      $gnnb = request()->session()->get('gnnb');
      $userid= request()->session()->get('userid');
      $databack =[];
      $membertotal = 0;
      $quantotal = 0;
      for($i=1;$i<=$quapa;$i++) {
        $pab = '/NFT'.$id.'/input/parameter'.$i.'/';
        $data = DB::connection('mysql')
        ->select("SELECT id, path, name, rarity, trait FROM files 
        where id_generator = '$id' AND path='$pab' ");
        array_push($databack,$data);
      }

      $userdata = DB::connection('mysql')
      ->select("SELECT membership_id FROM nft_users where id = '$userid'");

      foreach ($userdata as $got){
        $membid = $got->membership_id;
      }

      $memberdata = DB::connection('mysql')
      ->select("SELECT generate_number, preview_number FROM memberships
      where id = '$membid'");

      foreach ($memberdata as $got){
        $gnnb = $got->generate_number;
        $prnb = $got->preview_number;
      }

      $membertot = DB::connection('mysql')
      ->select("SELECT sum(NFT_quantity) as total FROM dashboards
      where user_id = '$userid' ");

      foreach ($membertot as $got){
        $membertotal = $got->total;
      }

      $quantot = DB::connection('mysql')
      ->select("SELECT max_NFT FROM nft_users
      where id = '$userid' ");

      foreach ($quantot as $got){
        $quantotal = $got->max_NFT;
      }


      //return redirect('parameters', 302, ['databack' => $databack,'quapa' => $quapa,'gnnb' => $gnnb]);
      return view('parameters', ['databack' => $databack,'quapa' => $quapa,'gnnb' => $gnnb,'membertotal' => $membertotal,'quantotal' => $quantotal]);

    }

    public function runFile(Request $request)
    {
      $id = request()->session()->get('id');
      $quapa = request()->session()->get('quapa');
      $gnnb = request()->session()->get('gnnb');
      $webUrl = env('APP_NFT_URL').'NFT'.$id.'/output';
      $userid= request()->session()->get('userid');
      $memberid= request()->session()->get('membid');
      $i = 0;
      $backper = 0;
      $k = 0;

      for($j=1;$j<=$quapa;$j++) {
        $pab = '/NFT'.$id.'/input/parameter'.$j.'/';
        $databackr = DB::connection('mysql')
        ->select("SELECT id, path, name, rarity, trait FROM files 
        where id_generator = '$id' AND path='$pab' ");

        foreach ($databackr as $got){
          $backper = $backper + $request->input($got->id);
        }
        
        if ($backper != 100 && $databackr != null){
          return back()->with(['errorbackper'.$k => 'The total rarity percentage should be 100%', 'bodybackper'.$k => 'The total rarity percentage should be 100%']);
        }
        $k = $j;
        $backper = 0;
      }

      $royal = $request->input('fee')*100;

      $config = '
      
      const fs = require("fs");
      const width = 4000;
      const height = 4000;
      const dir = __dirname;
      const name = "'.$request->input('cname').'";
      const description = "'.$request->input('about').'";
      const wallet = "'.$request->input('waddress').'";
      const hash = "'.$id.'";
      const royalty = '.$royal.';
      const baseImageUri = "'.$webUrl.'";
      const startEditionFrom = 1;
      const endEditionAt ='.$request->input('qua').';
      const editionSize ='.$request->input('qua').';
      const raceWeights = [
        {
          value: "skull",
          from: 1,
          to: editionSize,
        },
      ];

      const races = {
        skull: {
          name: "Skull",
          layers: [';
          
          for($p=1;$p<=$quapa;$p++){

            $pab = '/NFT'.$id.'/input/parameter'.$p.'/';
            $databackr = DB::connection('mysql')
            ->select("SELECT id, path, name, rarity, trait FROM files 
            where id_generator = '$id' AND path='$pab' ");

            if (!empty($databackr)){
              $config = $config.'
              { 
                name: "';
                foreach ($databackr as $got){
                  if ($got == reset($databackr)){
                    $config = $config.$got->trait;
                  }
                }
                $config = $config.'",
                elements: [
                  ';
            }

            foreach ($databackr as $got){
                  $config = $config.
                  '{
                    id: '.$i.',
                    name: "'.substr($got->name, 0, -4).'",
                    path: `${dir}'.substr($got->path,23).$got->name.'`,
                    weight: '.$request->input($got->id).',
                  },';
                  $i++;
            }
            $i = 0;
            if (!empty($databackr)){
                  $config = $config.
                  '
                    ],
                    position: { x: 0, y: 0 },
                    size: { width: width, height: height },
                  },
                  ';
            }

          }

                $config = $config.
                '
          ],
        },
      };

      module.exports = {
        width,
        height,
        name,
        description,
        wallet,
        royalty,
        hash,
        baseImageUri,
        editionSize,
        startEditionFrom,
        endEditionAt,
        races,
        raceWeights,
      };

      ';


      Dashboard::create([
        'id_generator' => $id,
        'collection_name' => $request->input('cname'),
        'NFT_quantity' => $request->input('qua'),
        'status' => 'Pending',
        'user_id' => $userid 
      ]);

      File::put(public_path().'/NFT'.$id.'/input/config.js', $config);

      $execu = "cd ".public_path()."/NFT".$id." && node index.js 2>&1";

      $execuimg = "cd ".public_path()."/NFT".$id." && node sendipfsimage.js 2>&1";
      $execumet = "cd ".public_path()."/NFT".$id." && node sendipfsmeta.js 2>&1";

/*
      exec("cd NFT".$id." && node index.js 2>&1", $out, $err);

      exec("cd NFT".$id." && node sendipfsimage.js 2>&1", $out, $err);

      exec("cd NFT".$id." && node sendipfsmeta.js 2>&1", $out, $err);
*/
      //$schedule = new Schedule();
      //FileBody::dispatch($execu);
      //Artisan::call('queue:listen');



      //MART
      dispatch(new FileBody($execu, $id, $execuimg, $execumet));





      //$schedule->job(new FileBody($execu, $id))->everyMinute();

      //exec('php artisan queue:work');

      //Artisan::call('queue:work', ['--stop-when-empty' => true]);

      //$this->dispatch((new FileBody($execu))->onQueue('queue1'));
      //die("stop");
      //$schedule->job(new FileBody($execu))->everyMinute(); 
      //$process = new FileBody($execu, $id);
      //$process->run();
      //run(new FileBody($execu, $id));



      //return view('home');





      //shell_exec("cd NFT".$id." && node index.js >/dev/null 2>&1 &");

      //$handle = popen("cd NFT".$id." && node index.js 2>&1", 'r');
      /*echo "'$handle'; " . gettype($handle) . "\n";
      $read = fread($handle, 2096);
      echo $read;*/
      //pclose($handle);

     /* exec("cd NFT".$id, $out, $err);
      $process = new Process(['node index.js']); //"cd NFT".$id,'node index.js']);
      $process->run();
      
      // executes after the command finishes
      if (!$process->isSuccessful()) {
          throw new ProcessFailedException($process);
      }
      echo $process->getOutput();
*/
      //print_r($out);
      //print_r($err);   rtrim($got->name, ".png")

      //print_r('<h1>Thanks for using our NFT Generator</a></h1>');
      //print_r('<h1>You receive an url to download the images</a></h1>');












/* zip part

      $zip = new ZipArchive;
      //$fileName = 'NFTGenerator.zip';

      if ($zip->open(public_path().'/NFT'.$id.'/output/NFTGenerator.zip', ZipArchive::CREATE) === TRUE)
      {
          $files = File::files(public_path().'/NFT'.$id.'/output');
          foreach ($files as $key => $value) {
              $relativeNameInZipFile = basename($value);
              $zip->addFile($value, $relativeNameInZipFile);
          }
          $zip->close();
      }

*/




      //print_r('<a href="{{Storage::url('.public_path().'\NFT'.$id.'\output\NFTGenerator.zip)}}" >Download NFT Generator</a>');



      return redirect('dashboard', 302, ['membid' => $memberid, 'userid' => $userid ]);

      //return \Response::download( public_path().'\NFT'.$id.'\output\NFTGenerator.zip');






      //return response()->download(public_path().'/NFT'.$id.'/output/NFTGenerator.zip');

      //$download_link = link_to_asset(public_path().'\NFT'.$id.'\output\NFTGenerator.zip');

      //print_r($download_link);

     // print_r($_GET['qua']);
      //print_r($out);
      //print_r($err);
    }

}