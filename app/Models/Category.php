<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
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
        'parent_id',
        'user_id',
    ];

    //
    public function parent()
    {
        return $this->belongsTo('App\Models\Category');
    }

    //
    public function user(){
        return $this->belongsTo('App\User');
    }

}
