<?php

namespace App\Traits\Models\Relationships\base;

use App\Models\ContentType;
use App\Traits\Models\Relationships\childs\BelognsToCourse;
use App\Traits\Models\Relationships\childs\BelognsToInstructor;
use App\Traits\Models\Relationships\childs\HasManyComment;
use App\Traits\Models\Relationships\childs\HasManyReact;
use App\Traits\Models\Relationships\childs\HasManySolution;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait ContentRelationship
{
    use HasManyComment, HasManyReact, BelognsToInstructor, BelognsToCourse, HasManySolution;


    /**
     * function for provide content type
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function type(): BelongsTo
    {
        return $this->belongsTo(ContentType::class, 'content_type_id');
    } //end type

}//end ContentRelationship
