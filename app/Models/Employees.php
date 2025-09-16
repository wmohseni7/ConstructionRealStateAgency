<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employees extends Model
{
    protected $fillable=[
        'agency_id',
        'project_id',
        'name',
        'phone_number',
        'address',
        'title',
        'total',
        'paid',
        'remain',
        'date',
    ];
    use HasFactory;
    function agency(){
        return $this->belongsTo(Agency::class);
    }
    function project(){
        return $this->belongsTo(Project::class);
    }
}
