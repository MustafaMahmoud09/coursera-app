<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Comment;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyComment
{

    /**
     * function for provide student comments
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    } //end comments

}//end HasManyComment
