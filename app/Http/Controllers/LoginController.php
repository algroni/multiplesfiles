<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Dashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use ZipArchive;
use Illuminate\Support\Facades\Hash;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class LoginController extends Controller
{
    public function uploadFiles()
    {
      return view('login');
    }

    public function start(Request $request)
    {
      $memberid = 0;
      $paramn = 0;
      $userid = 0;
      $name = '';
      $email = $request->input('email');
      $password = $request->input('pass');
      $dashboardata = [];

      $datauser = DB::connection('mysql')
      ->select("SELECT name, membership_id, password,id FROM nft_users 
      where email = '$email'");

      foreach ($datauser as $got){
        if (Hash::check($password , $got->password)){
          $memberid = $got->membership_id;
          $userid = $got->id;
          $name = $got->name;
        }
      }

      if($memberid == 0 && $memberid != null){
        return back()->with(['erroruser' => 'The user or password is not correct'.$userid.$memberid, 'bodyuser' => 'The user or password is not correct'.$userid.$memberid]);
      }else{
        
        $memberdata = DB::connection('mysql')
        ->select("SELECT parameter_number FROM memberships
        where id = '$memberid'");
  
        foreach ($memberdata as $got){
          $paramn = $got->parameter_number;
        }
        session(['userid' => $userid]);
        session(['name' => $name]);
        session(['membid' => $memberid]);
        session(['paramn' => $paramn]);
        session(['msgvouchers' => '']);

        $dashboardata = DB::connection('mysql')
        ->select("SELECT * FROM dashboards
        where user_id = '$userid'");
        foreach ($dashboardata as $got){
          $dashboards = $got->collection_name;
        }

        return redirect('dashboard', 302, ['membid' => $memberid, 'paramn' => $paramn, 'userid' => $userid, 'msgvouchers' => '' ]);
        //return redirect('layers', 302, ['membid' => $memberid, 'paramn' => $paramn, 'userid' => $userid, 'msgvouchers' => '' ]);
        //return view('files', ['membid' => $memberid, 'paramn' => $paramn, 'userid' => $userid, 'msgvouchers' => '' ]);
        //return back()->with(['successuser' => 'User created successfully', 'userbody' => 'User created successfully']);
      }
    }

}