<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyIncome extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id',
        'amount',
        'duration',	
        'date',	
        'description',
    ];
    function agency(){
        return $this->belongsTo(Agency::class);
    }
}
