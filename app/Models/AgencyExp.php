<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AgencyExp extends Model
{
    use HasFactory;
    protected $fillable=[
        'agency_id',
        'amount',
        'date',
        'description',
    ];
    
    function agency(){
        return $this->belongsTo(Agency::class);
    }
}
