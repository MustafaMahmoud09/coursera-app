<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\ContentRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory, ContentRelationship;

    protected $keyType = 'string';
    public $incrementing = false;

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
