<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\SolutionRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Solution extends Model
{
    use HasFactory, SolutionRelationship;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'content_id',
        'student_id',
        'file_path',
    ];

    protected static function boot()
    {
        parent::boot();

        // توليد UUID عند إنشاء نموذج جديد
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) \Illuminate\Support\Str::uuid();
            }
        });
    }
}//end Solution
