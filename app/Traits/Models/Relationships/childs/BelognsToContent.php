<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Content;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait BelognsToContent
{

    /**
     * function for provide instructor
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function content(): BelongsTo
    {
        return $this->belongsTo(Content::class);
    } //end instructor

}//end BelognsToCourse
