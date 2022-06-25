<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use ZipArchive;
use File;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class FileBody implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $execu;
    protected $idn;
    protected $execuimg;
    protected $execumet;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($execu, $idn, $execuimg, $execumet)
    {
        $this->execu = $execu;
        $this->idn = $idn;
        $this->execuimg = $execuimg;
        $this->execumet = $execumet;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        //
        //sleep(5);
/*
        echo "<script>";
        echo "console.log('Please wait ".$this->execuimg."');";
        echo "</script>";
*/
        exec($this->execu, $out, $err);
        
        exec("cd ".public_path()."/NFT".$this->idn." && node sendipfsimage.js 2>&1", $out, $err);
        exec("cd ".public_path()."/NFT".$this->idn." && node sendipfsmeta.js 2>&1", $out, $err);
        exec("cd ".public_path()."/NFT".$this->idn." && node createinputfile.js 2>&1", $out, $err);

        //exec("cd ".public_path()."/NFT".$this->idn." && node sendipfsmeta.js 2>&1", $out, $err);
/*
        $zip = new ZipArchive;
  
        if ($zip->open(public_path().'/NFT'.$this->idn.'/output/NFTGenerator.zip', ZipArchive::CREATE) === TRUE)
        {
            
            $files = File::files(public_path().'/NFT'.$this->idn.'/output');
            
            foreach ($files as $key => $value) {
                $relativeNameInZipFile = basename($value);
                $zip->addFile($value, $relativeNameInZipFile);
            }
            
            $zip->close();
        }
*/
        $actualtime = Carbon::now('Australia/Brisbane');
        $actualtime->toDateTimeString();
        DB::connection('mysql')
        ->update("UPDATE dashboards SET status = 'Available', updated_at = '$actualtime'
                    WHERE id_generator = ?", [$this->idn] );

    }
}
