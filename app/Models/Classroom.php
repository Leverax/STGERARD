<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classroom extends Model
{
    use HasFactory;

    protected $table    = 'classrooms';
    protected $guarded  = ['id'];

    /**
     * Relationships
     */

    public function users(){
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function schooling(){
        return $this->hasMany(Schooling::class, 'classrooms_id' , 'id');
    }
}
