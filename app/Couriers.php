<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Couriers extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'nickname', 'price', 'coverage', 'status'
    ];
}