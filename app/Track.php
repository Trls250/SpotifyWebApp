<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Track extends Model
{
    public function store(Request $request){
        $this->id = $request->id;
        $this->name = $request->name;
        $this->preview = $request->preview;
        $this->save();
    }

    public function user()
    {
        $this->belongsToMany('App/User');
    }
}
