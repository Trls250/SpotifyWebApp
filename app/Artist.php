<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Artist extends Model
{
    public $timestamps = false;
    protected $casts = ['id' => 'string'];
    public function store(Request $request){
        $this->id = $request->id;
        $this->name = $request->name;
        $this->followers = $request->followers;
        $this->popularity = $request->popularity;
        $this->save();
    }

    public function user()
    {
        $this->belongsToMany('App/User');
    }
}
