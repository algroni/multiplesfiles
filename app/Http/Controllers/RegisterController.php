<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\NFTUser;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use ZipArchive;
use Illuminate\Support\Facades\Hash;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class RegisterController extends Controller
{
    public function uploadFiles()
    {
      return view('register');
    }

    public function save(Request $request)
    {
      $vouc= $request->input('voucher');
      $voucher = 0;
      $datavoucher = DB::connection('mysql')
      ->select("SELECT id FROM nft_vouchers 
      where code = '$vouc' ");

      //$voucher = $datavoucher;
      if (count($datavoucher) > 0){
        $voucher = $voucher + count($datavoucher);
      }

      if($voucher == 0){
        return back()->with(['errorvoucher' => 'The voucher code is not correct', 'bodyvocuher' => 'The voucher code is not correct']);
      }else{
        NftUser::create([
          'name' => $request->input('name'),
          'password' => Hash::make($request->input('pass')),
          'email' => $request->input('email'),
          'referrer' => $request->input('referrer'),
          'country' => $request->input('country'),
          'mobile' => $request->input('mobile'),
          'username' => $request->input('username') 
        ]);

        return redirect('login', 302, ['successuser' => 'User created successfully']);
        //return view('login', ['successuser' => 'User created successfully']);
        //return back()->with(['successuser' => 'User created successfully', 'userbody' => 'User created successfully']);
      }
    }


}