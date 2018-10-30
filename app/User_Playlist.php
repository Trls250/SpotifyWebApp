<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Playlist extends Model
{
    public $timestamp = false;
    protected $table = "playlist_user";
}
