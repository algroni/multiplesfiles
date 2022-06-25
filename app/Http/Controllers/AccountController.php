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
use Carbon\Carbon;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class AccountController extends Controller
{
    public function uploadFiles()
    {

      $userid= request()->session()->get('userid');

      $name = '';
      $username = '';
      $password = '';
      $email = '';
      $country = '';
      $referrer = '';
      $mobile = '';
      $successupdate = '';

      $userdata = DB::connection('mysql')
      ->select("SELECT * FROM nft_users
      where id = '$userid'");

      foreach ($userdata as $got){
        $name = $got->name;
        $username = $got->username;
        $password = $got->password;
        $email = $got->email;
        $country = $got->country;
        $referrer = $got->referrer;
        $mobile = $got->mobile;
      }

      return view('account',['name' => $name, 'username' => $username,
      'email' => $email, 'country' => $country, 'successupdate' => $successupdate,
      'referrer' => $referrer, 'mobile' => $mobile]);
    }

    public function save(Request $request)
    {
      $userid= request()->session()->get('userid');
      $username = $request->input('username');
      $email = $request->input('email');
      $name = $request->input('name');
      $country = $request->input('country');
      $mobile = $request->input('mobile');
      $referrer = $request->input('referrer');
      $password = $request->input('password');

      $actualtime = Carbon::now('Australia/Brisbane');
      $actualtime->toDateTimeString();

      if($request->submit == "Update"){

        if ($password == ''){
          DB::connection('mysql')
          ->update("UPDATE nft_users SET name = '$name', 
          country = '$country', mobile = '$mobile', 
          referrer = '$referrer', updated_at = '$actualtime'  
          WHERE id = ?", [$userid] );
        }else{

          $password = Hash::make($password);

          DB::connection('mysql')
          ->update("UPDATE nft_users SET name = '$name', 
          country = '$country', mobile = '$mobile', 
          referrer = '$referrer', password = '$password',
          updated_at = '$actualtime' 
          WHERE id = ?", [$userid] );
        }

        return view('account', ['successupdate' => 'User was updated successfully',
        'name' => $name, 'username' => $username,
        'email' => $email, 'country' => $country, 
        'referrer' => $referrer, 'mobile' => $mobile]);
          //return view('login', ['successuser' => 'User created successfully']);
          //return back()->with(['successuser' => 'User created successfully', 'userbody' => 'User created successfully']);
      }else{
        return redirect('dashboard', 302, ['userid' => $userid ]);
      }
    }


}