<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolingDetails extends Model
{
    use HasFactory;

    protected $table    = 'schooling_details';
    protected $guarded  = ['id'];

    /**
     * Relationships
     */
    public function schooling(){
        return $this->belongsTo(Schooling::class, 'schoolings_id');
    }
}
