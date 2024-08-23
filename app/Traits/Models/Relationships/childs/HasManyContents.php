<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Content;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyContents
{


    /**
     * function for provide contents
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function contents(): HasMany
    {
        return $this->hasMany(Content::class);
    } //end courses


}//end HasManyContents
