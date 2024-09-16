<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\CourseRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory, CourseRelationship;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'title',
        'description',
        'cover_path',
        'status',
        'instructor_id',
        'course_price'
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
    
}
