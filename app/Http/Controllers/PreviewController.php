<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use ZipArchive;

class PreviewController extends Controller
{
    public function uploadFiles()
    {
      $gnnb = 0;
      $prnb = 0;
      $id = request()->session()->get('id');
      $quapa = request()->session()->get('quapa');
      $userid = request()->session()->get('userid');
      $code = request()->session()->get('code');

      $userdata = DB::connection('mysql')
      ->select("SELECT membership_id FROM nft_users 
      where id = '$userid'");

      foreach ($userdata as $got){
        $membid = $got->membership_id;
      }

      if($membid == null){
        $userdata = DB::connection('mysql')
        ->select("SELECT membership_id FROM nft_vouchers 
        where code = '$code'");
        foreach ($userdata as $got){
          $membid = $got->membership_id;
        }
      }

      $memberdata = DB::connection('mysql')
      ->select("SELECT generate_number, preview_number FROM memberships
      where id = '$membid'");

      foreach ($memberdata as $got){
        $gnnb = $got->generate_number;
        $prnb = $got->preview_number;
      }
      
      session(['gnnb' => $gnnb]);
      session(['prnb' => $prnb]);

      $webUrl = env('APP_NFT_URL').'NFT'.$id.'/output';
      $i = 0;
      $backper = 0;
      $k = 0;

      $config = '
      
      const fs = require("fs");
      const width = 3000;
      const height = 3000;
      const dir = __dirname;
      const description = "NFT Collection";
      const baseImageUri = "'.$webUrl.'";
      const startEditionFrom = 1;
      const endEditionAt ='.$prnb.';
      const editionSize ='.$prnb.';
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
                    weight: 25,
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
        description,
        baseImageUri,
        editionSize,
        startEditionFrom,
        endEditionAt,
        races,
        raceWeights,
      };

      ';

      File::put(public_path().'/NFT'.$id.'/input/config.js', $config);
      /*
      echo "<script>";
      echo "alert('Loading the preview images, Please wait');";
      echo "</script>";
      */
      exec("cd NFT".$id." && node preview.js 2>&1", $out, $err);

      //return redirect('preview', 302, ['prnb' => $prnb, 'gnnb' => $gnnb,'id' => $id]);
      return view('preview', ['prnb' => $prnb, 'gnnb' => $gnnb,'id' => $id]);

    }

}