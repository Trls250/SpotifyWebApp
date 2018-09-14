<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Genre extends Model
{
    public function store(Request $request){
        $this->id = $request->id;
        $this->name = $request->name;
        $this->save();
    }

    public function user()
    {
        $this->belongsToMany('App/User');
    }
}
