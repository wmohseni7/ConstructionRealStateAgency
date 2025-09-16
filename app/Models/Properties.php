<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Properties extends Model
{
    use HasFactory;
    protected $fillable = [
        'agency_id'     ,
        'name'          ,
        'address'       ,
        'floor'         ,
        'apartment'     ,
        
    ];
    function agency(){
        return $this->belongsTo(Agency::class);
    }
}
