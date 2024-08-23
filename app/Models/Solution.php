<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\SolutionRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory, SolutionRelationship;

    protected $fillable = [
        'content_id',
        'student_id',
        'file_path',
    ];


}//end Solution
