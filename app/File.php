<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = ['name', 'path','id_generator','rarity','trait','user_id'];

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
