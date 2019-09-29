<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $fillable = [
        'user_id',
        'title',
        'value'
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function getUserNameAttribute(){
        return $this->user->name;;
    }


}
