<?php

namespace App\Http\Controllers;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Http\Request;
use App\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades;

class FileController extends Controller
{
    
    public function uploadFiles(Request $request)
    {
      $userid= $request->session()->get('userid');
      //$membid = 0;
      $paramn = 0;
      $userdata = DB::connection('mysql')
      ->select("SELECT membership_id FROM nft_users 
      where id = '$userid'");

      foreach ($userdata as $got){
        $membid = $got->membership_id;
      }

      if($membid != null){

        $memdata = DB::connection('mysql')
        ->select("SELECT membership_id FROM nft_users 
        where id = '$userid' and now() between member_start and member_end");

        if ($memdata == null){
          $membid = null;
        }

      }

      $memberdata = DB::connection('mysql')
      ->select("SELECT parameter_number FROM memberships
      where id = '$membid'");

      foreach ($memberdata as $got){
        $paramn = $got->parameter_number;
      }

      //return redirect('layers', 302, ['membid' => $membid, 'paramn' => $paramn, 'msgvouchers' => '']);
      return view('files', ['membid' => $membid, 'paramn' => $paramn, 'msgvouchers' => '']);    
    }

    public function storeFiles(Request $request)
    {
      $gnnb = 0;
      $prnb = 0;
      $membid = request()->session()->get('membid');
      $code = $request->input('voucher');
      $userid= $request->session()->get('userid');
      $paramn = 0;

      if($code != null){
        
        session(['code' => $code]);

        $voucherdata = DB::connection('mysql')
        ->select("SELECT membership_id FROM nft_vouchers 
        where code = '$code'");

        if ($voucherdata == null){
          $paramn = 0;
        }else{
          foreach ($voucherdata as $got){
            $membid = $got->membership_id;
          }

          $memberdata = DB::connection('mysql')
          ->select("SELECT parameter_number FROM memberships
          where id = '$membid'");

          foreach ($memberdata as $got){
            $paramn = $got->parameter_number;
          }
        }


        if($paramn == 0){
          //return redirect('layers', 302, ['membid' => $membid, 'paramn' => $paramn, 'msgvouchers' => 'The voucher code is not correct', 'userid' => $userid]);
          return view('files', ['membid' => $membid, 'paramn' => $paramn, 'msgvouchers' => 'The voucher code is not correct', 'userid' => $userid]);
        }else{
          //return redirect('layers', 302, ['membid' => $membid, 'paramn' => $paramn, 'msgvouchers' => '', 'userid' => $userid]);
          return view('files', ['membid' => $membid, 'paramn' => $paramn, 'msgvouchers' => '', 'userid' => $userid]);  
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

      $param = $request->input("quapa");
      $rules = [];

      for($i=1;$i<=$param;$i++) {
        
        $rules["parameter".$i] = 'required|min:4|max:10';
        $rules["par".$i] = 'required';
        
      }
      $request->validate($rules);

      $id = uniqid();
      session(['id' => $id]);
      session(['quapa' => $request->input("quapa")]);

      $pathnft = public_path().'/NFT'.$id;
      File::makeDirectory($pathnft);
      $file = new Filesystem();

      $file->copyDirectory(public_path().'/NFT', public_path().'/NFT'.$id);      
      
      for($i=1;$i<=$param;$i++) {
        if ($request->hasfile('parameter'.$i)) {
          $files = $request->file('parameter'.$i);
          $paramname = $request->input("par".$i);
          foreach($files as $file) {
              $name = $file->getClientOriginalName();
              $path = '/NFT'.$id.'/input'.''.'/parameter'.$i.'/'; // $file->storeAs('input', $name, 'public');
              $file->move(public_path().$path, $name); 
  
              File::create([
                  'id_generator' => $id,
                  'name' => $name,
                  'path' => $path,
                  'rarity' => 25,
                  'trait' => $paramname,
                  'user_id' => 1 
                ]);
          }
        }  
      }

      return back()->with(['success' => 'Files uploaded successfully', 'body' => 'Files uploaded successfully', 'paramn' => $param]);
    }

}