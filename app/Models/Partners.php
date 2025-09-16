<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Partners extends Model
{
    protected $fillable=[
        'name',
        'last_name',
        'phone_number',
        'email',
        'address',
        'date',
        'description',
    ];
    use HasFactory;
}
