<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Carts extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'sku', 'qty'
    ];
    
}
