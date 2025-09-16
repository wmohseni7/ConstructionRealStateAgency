<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'name',
        'address',
        'type',
        'area',
        'unit',
        'floor',
        'apartment',
        'unitPrice',
        'total',
        'paid',
        'remain',
        'date',
        'description',
    ];

    function agency(){
        return $this->belongsTo(Agency::class);
    }
}
