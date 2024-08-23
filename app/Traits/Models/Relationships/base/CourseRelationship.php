<?php

namespace App\Traits\Models\Relationships\base;

use App\Traits\Models\Relationships\childs\BelognsToInstructor;
use App\Traits\Models\Relationships\childs\HasManyBuying;
use App\Traits\Models\Relationships\childs\HasManyContents;
use App\Traits\Models\Relationships\childs\HasManyCourseSaved;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

trait CourseRelationship
{
    use HasManyContents, BelognsToInstructor, HasManyCourseSaved, HasManyBuying;
}//end CourseRelationship
