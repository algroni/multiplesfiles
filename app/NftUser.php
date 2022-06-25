<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class NftUser extends Model
{
    protected $fillable = ['name', 'password','email','referrer','country','mobile','username','membership_id'];

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
