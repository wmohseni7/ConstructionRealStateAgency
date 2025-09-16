<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class projectConstruction extends Model
{
    use HasFactory;
    protected $fillable=[
        'project_id',
        'category',
        'name',
        'amount',
        'type',
        'price',
        'company_id',
        'total',
        'paid',
        'remain',
        'date',
        'bill',
        'currency',
        'description',
    ];
    function project(){
        return $this->belongsTo(Project::class);
    }
    function company(){
        return $this->belongsTo(Companies::class);
    }
}
