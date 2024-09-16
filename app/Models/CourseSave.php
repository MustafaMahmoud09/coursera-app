<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\CourseSaveRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseSave extends Model
{
    use HasFactory, CourseSaveRelationship;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'course_id',
        'student_id'
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
