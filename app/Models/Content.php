<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\ContentRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory, ContentRelationship;

    protected $fillable = [
        'title',
        'description',
        'cover_path',
        'status',
        'instructor_id',
        'video_path',
        'course_id',
        'content_type_id',
        'dead_line'
    ];
}
