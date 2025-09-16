<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProjectExpenses extends Model
{
    protected $fillable =[
        'project_id',
        'floor',
        'apartment',
        'bedroom',
        'bathroom',
        'toilet',
        'kitchen',
        'salon',
    ];
    use HasFactory;
    function project(){
        return $this->belongsTo(Project::class);
    }
}
