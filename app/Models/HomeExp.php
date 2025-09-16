<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HomeExp extends Model
{
    use HasFactory;
    protected $fillable=[ 
        'agency_id',
        'sender',
        'receiver',
        'date',
        'amount',
        'description',
    ];
    function agency(){
        return $this->belongsTo(Agency::class);
    }
}
