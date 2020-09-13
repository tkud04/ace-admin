<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Catalogs extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id', 'sku', 'status'
    ];
}
