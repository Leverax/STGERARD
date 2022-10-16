<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Recipe extends Model
{
    use HasFactory;

    protected $table    = 'recipes';
    protected $guarded  = ['id'];

    /**
     * Relationships
     */

    public function academic_years(){
        return $this->belongsTo(AcademicYear::class, 'academic_years_id');
    }

    public function users(){
        return $this->belongsTo(User::class, 'users_id'); 
    }
}
