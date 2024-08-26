<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\CourseRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, CourseRelationship;

    protected $fillable = [
        'title',
        'description',
        'cover_path',
        'status',
        'instructor_id',
        'course_price'
    ];
}
