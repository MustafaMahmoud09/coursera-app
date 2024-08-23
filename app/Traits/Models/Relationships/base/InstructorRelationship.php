<?php

namespace App\Traits\Models\Relationships\base;

use App\Models\Content;
use App\Models\Course;
use App\Models\Profession;
use App\Traits\Models\Relationships\childs\HasManyContents;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;


trait InstructorRelationship
{

    use HasManyContents;

    /**
     * function for provide instructor courses
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function courses(): HasMany
    {
        return $this->hasMany(Course::class);
    } //end courses


    /**
     * function for provide instructor profession
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    function profession(): BelongsTo
    {
        return $this->belongsTo(Profession::class);
    } //end courses


}//end InstructorRelationship
