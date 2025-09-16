<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Properties;

class Dealership extends Model
{
    use HasFactory;
    protected $fillable = [ 
        'properties_id',
        'name',
        'floor',
        'apartment',
        'customer',
        'phone_number',
        'floorNum',
        'apartmentNum',
        'deal',
        'amount',
        'photo',
        'date',
        'description',
    ];
    function properties(){
        return $this->belongsTo(Properties::class);
    }
}
