<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $guarded = 'category_id';
    protected $primaryKey = 'category_id';

    public function theses() {
        return $this->hasMany('App\Thesis');
    }
}
