<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Faculty extends Model
{
    protected $guarded =['faculty_id'];
    protected $primaryKey = 'faculty_id';

    public function departments(){
        return $this->hasMany('App\Department','faculties_faculty_id');
    }
}
