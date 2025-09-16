<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AltClaims extends Model
{
    protected $fillable=[
        'name',
        'amount',
        'date',
        'description',
    ];
    use HasFactory;
}
