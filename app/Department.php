<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    protected $guarded = ['department_id'];
    protected $primaryKey = 'department_id';

    public function faculties() {
        return $this->belongsTo('App\Faculty');
    }

    public function options(){
        return $this->hasMany('App\Option','departments_department_id');
    }

    public function thesis(){
        return $this->hasMany('App\Thesis','departments_department_id');
    }
}
