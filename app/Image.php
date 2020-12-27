<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $table = 'images';

    //relación one to may / de uno a muchos 

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    //relación one to may / de uno a muchos 
    public function likes(){
        return $this->hasMany('App\Like');
    }

    //relación de muchos a uno / many to one 

    public function user(){
        return $this->belongsTo('App\User','user_id');
    }

    
}
