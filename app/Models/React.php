<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\ReactRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory, ReactRelationship;

    protected $fillable = [
        'content_id',
        'student_id'
    ];

}
