<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Documents extends Model
{
    protected $fillable = [
        'agency_id',
        'subject',
        'date',
        'category',
        'document',
        'description',
    ];



    use HasFactory;
    function agency(){
        return $this->belongsTo(Agency::class);
    }
}
