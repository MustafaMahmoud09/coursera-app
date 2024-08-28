<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\BuyingRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buying extends Model
{
    use HasFactory, BuyingRelationship;

    protected $fillable = [
        'course_id',
        'student_id',
        'course_price'
    ];

}
