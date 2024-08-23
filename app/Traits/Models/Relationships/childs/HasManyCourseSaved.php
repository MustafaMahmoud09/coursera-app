<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\CourseSave;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyCourseSaved{


    /**
     * function for provide student courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function coursesSaved(): HasMany
    {
        return $this->hasMany(CourseSave::class);
    } //end coursesSaved


}//end HasManyCourseSaved
