<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\CommentRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, CommentRelationship;

    protected $fillable = [
        'comment',
        'content_id',
        'student_id'
    ];
    
}
