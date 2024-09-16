<?php

namespace App\Models;

use App\Traits\Models\Relationships\base\ReactRelationship;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class React extends Model
{
    use HasFactory, ReactRelationship;

    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = [
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
