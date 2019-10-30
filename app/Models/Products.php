<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{
    //
    //
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'content',
        'quantity',
        'price',
        'user_id',
    ];

    //
    public function user() {
        return $this->belongsTo('App\User');
    }
}
