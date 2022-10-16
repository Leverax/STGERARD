<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcademicYear extends Model
{
    use HasFactory;

    protected $table    = 'academic_years';
    protected $guarded  = ['id'];

    /**
     * Relationships
     */

    public function users(){
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function schooling(){
        return $this->hasMany(Schooling::class, 'academic_years_id' , 'id');
    }

    public function expenses(){
        return $this->hasMany(Expense::class, 'academic_years_id' , 'id');
    }

    public function recipes(){
        return $this->hasMany(Recipe::class, 'academic_years_id' , 'id');
    }
}
