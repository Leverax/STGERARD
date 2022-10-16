<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Students extends Model
{
    use HasFactory;

    protected $table    = 'students';
    protected $guarded  = ['id'];

    /**
     * Relationships
     */

    public function users(){
        return $this->belongsTo(User::class, 'users_id'); 
    }

    public function schooling(){
        return $this->hasMany(Schooling::class, 'students_id' , 'id'); 
    }

}
