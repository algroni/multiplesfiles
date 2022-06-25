<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use File;
use App\Dashboard;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Input;
use ZipArchive;
use Illuminate\Support\Facades\Hash;

use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class DashboardController extends Controller
{
    public function uploadFiles()
    {
      $userid= request()->session()->get('userid');
      $name= request()->session()->get('name');
      $totcrea = '';
      $maxnft = '';

      $dashboardata = DB::connection('mysql')
      ->select("SELECT * FROM dashboards
      where user_id = '$userid'");

      $dashboartot = DB::connection('mysql')
      ->select("SELECT Sum(NFT_quantity) as totcrea FROM dashboards
      where user_id = '$userid'");

      foreach ($dashboartot as $got){
        $totcrea = $got->totcrea;
      }

      $usermax = DB::connection('mysql')
      ->select("SELECT max_NFT FROM nft_users
      where id = '$userid'");

      foreach ($usermax as $got){
        $maxnft = $got->max_NFT;
      }

      return view('dashboard',['dashboards' => $dashboardata, 
      'name' => $name, 'totcrea' => $totcrea, 'maxnft' => $maxnft]);
    }

    public function create(Request $request)
    {
      $memberid = 0;
      $paramn = 0;
      $userid = 0;
      $membuser = null;
      $membertotal = 0;
      $quantotal = 0;

      $email = $request->input('email');
      $password = $request->input('pass');
      $dashboardata = [];
      $userid= request()->session()->get('userid');
      $memberid= request()->session()->get('membid');
/*
      $datauser = DB::connection('mysql')
      ->select("SELECT membership_id, password,id FROM nft_users 
      where email = '$email'");

      foreach ($datauser as $got){
        if (Hash::check($password , $got->password)){
          $memberid = $got->membership_id;
          $userid = $got->id;
        }
      }
*/

      //return back()->with(['erroruser' => $request->submit, 'bodyuser' => $request->submit]);

      if($request->submit == "Generate"){

        if($memberid == 0 and $memberid != null){
          return back()->with(['erroruser' => 'The user or password is not correct', 'bodyuser' => 'The user or password is not correct']);
        }else{
          
          $memberdate = DB::connection('mysql')
          ->select("SELECT id FROM dashboards
          where user_id = '$userid' and 
          created_at between DATE_ADD(CURDATE(), INTERVAL - WEEKDAY(CURDATE()) DAY) 
          and date(now() + INTERVAL 6 - weekday(now()) DAY)  ");

          $memberdate = null;

          if ($memberdate == null){

            $membertot = DB::connection('mysql')
            ->select("SELECT sum(NFT_quantity) as total FROM dashboards
            where user_id = '$userid' ");

            foreach ($membertot as $got){
              $membertotal = $got->total;
            }

            $quantot = DB::connection('mysql')
            ->select("SELECT max_NFT FROM NFT_users
            where id = '$userid' ");

            foreach ($quantot as $got){
              $quantotal = $got->max_NFT;
            }

            if ($membertotal < $quantotal){

              $memberdata = DB::connection('mysql')
              ->select("SELECT parameter_number FROM memberships
              where id = '$memberid'");
        
              foreach ($memberdata as $got){
                $paramn = $got->parameter_number;
              }
    
              //return redirect('dashboard', 302, ['dashboards' => $dashboards, 'membid' => $memberid, 'paramn' => $paramn, 'userid' => $userid, 'msgvouchers' => '' ]);
              return redirect('layers', 302, ['membid' => $memberid, 'paramn' => $paramn, 'userid' => $userid, 'msgvouchers' => '' ]);
              //return view('files', ['membid' => $memberid, 'paramn' => $paramn, 'userid' => $userid, 'msgvouchers' => '' ]);
              //return back()->with(['successuser' => 'User created successfully', 'userbody' => 'User created successfully']);
      
            }else{
              return back()->with(['errorqua' => 'You only can create maximun '.$quantotal.' NFTs', 'bodyqua' => 'You only can create maximun '.$quantotal.' NFTs']);
            }

          }else{

            //$memberdata = DB::connection('mysql')
            //->select("SELECT parameter_number FROM memberships
            //where id = '$memberid'");

            //echo "<script>";
            //echo "alert('You only can create one Collection per week');";
            //echo "alert('You have created a Collection this week');";
            //echo "</script>";
            return back()->with(['errorqua' => 'You only can create one Collection per week', 'bodyqua' => 'You only can create one Collection per week']);
          }

        }

      }else{
        $dashboardata = DB::connection('mysql')
        ->select("SELECT id_generator FROM dashboards
        where user_id = '$userid'");
        foreach ($dashboardata as $got){
          $id = $got->id_generator;
        }

        return \Response::download( public_path().'\NFT'.$request->submit.'\output\input.txt');

      }
    }

}