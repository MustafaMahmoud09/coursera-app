<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Student;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelognsToStudent
{

    /**
     * function for provide instructor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function student(): BelongsTo
    {
        return $this->belongsTo(Student::class);
    } //end instructor

}//end BelognsToCourse
