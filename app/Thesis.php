<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Thesis extends Model
{
    protected $guarded = 'thesis_id';
    protected $primaryKey = 'thesis_id';

    public function getCreatedAtAttribute($date)
    {
        return Thesis::createFromFormat('Y-m-d H:i:s', $date)->format('Y-m-d');
    }

    public function option() {
        return $this->belongsTo('App\Option');
    }

    public function depatments(){
        return $this->belongsTo('App\Department');
    }

    public function category() {
        return $this->belongsTo('App\Category');
    }
}
