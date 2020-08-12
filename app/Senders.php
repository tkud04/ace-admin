<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Senders extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'ss', 'sp', 'sec', 'sa', 'su', 'spp', 'sn', 'se', 'status'
    ];
    
}