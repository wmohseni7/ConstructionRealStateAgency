<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Companies extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'name',
        'phone_number',
        'address',
        'owner',
    ];
    function agency(){
        return $this->belongsTo(Agency::class);
    }
}

