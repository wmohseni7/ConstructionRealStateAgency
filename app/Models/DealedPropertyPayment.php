<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DealedPropertyPayment extends Model
{
    use HasFactory;
    protected $fillable=[
        'dealership_id',
        'name',
        'total',
        'date',
        'paid',
        'remain',
    ];
    function dealership(){
        return $this->belongsTo(Dealership::class);
    }
}
