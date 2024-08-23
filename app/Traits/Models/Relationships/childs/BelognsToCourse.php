<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Course;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelognsToCourse
{

    /**
     * function for provide instructor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function course(): BelongsTo
    {
        return $this->belongsTo(Course::class);
    } //end instructor

}//end BelognsToCourse
