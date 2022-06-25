<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    protected $fillable = ['id_generator', 'collection_name','NFT_quantity','status','user_id'];

/**
 * Create a directory.
 *
 * @param  string  $path
 * @param  int     $mode
 * @param  bool    $recursive
 * @param  bool    $force
 * @return bool
 */
public static function makeDirectory($path, $mode = 0777, $recursive = false, $force = false)
{
    if ($force)
    {
        return @mkdir($path, $mode, $recursive);
    }
    else
    {
        return @mkdir($path, $mode, $recursive);
    }
}



}
