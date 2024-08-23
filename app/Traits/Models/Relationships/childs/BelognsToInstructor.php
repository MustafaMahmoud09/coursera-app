<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Instructor;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelognsToInstructor
{

    /**
     * function for provide instructor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function instructor(): BelongsTo
    {
        return $this->belongsTo(Instructor::class);
    } //end instructor

}//end BelognsToInstructor
