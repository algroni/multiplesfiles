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

class EbookController extends Controller
{
    public function uploadFiles()
    {
      return view('ebook');
    }

}