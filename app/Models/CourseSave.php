<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\CourseSaveRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSave extends Model
{
    use HasFactory, CourseSaveRelationship;

    protected $fillable = [
        'course_id',
        'student_id'
    ];

}
