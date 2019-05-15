<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Option extends Model
{
    protected $guarded = 'option_id';
    protected $primaryKey = 'option_id';

    public function department(){
        return $this->belongsTo('App\Department');
    }

    public function thesis() {
        return $this->hasMany('App\Thesis','options_option_id');
    }
}
