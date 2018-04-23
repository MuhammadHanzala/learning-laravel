<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $fillable = ['title', 'description', 'price', 'availability', 'user_id'];

    public function user () {
        return $this->belongsTo('App\User', 'user_id');
    }
}
