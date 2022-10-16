<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schooling extends Model
{
    use HasFactory;

    protected $table    = 'schoolings';
    protected $guarded  = ['id'];

    /**
     * Relationships
     */

    public function users(){
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function students(){
        return $this->belongsTo(Students::class, 'students_id');
    }

    public function classrooms(){
        return $this->belongsTo(Classroom::class, 'classrooms_id');
    }
    
    public function academic_years(){
        return $this->belongsTo(AcademicYear::class, 'academic_years_id');
    }

    public function schooling_details(){
        return $this->hasMany(SchoolingDetails::class, 'schoolings_id' , 'id');
    }
}
