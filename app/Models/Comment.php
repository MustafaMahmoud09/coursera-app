<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\CommentRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory, CommentRelationship;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
        'comment',
        'content_id',
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
