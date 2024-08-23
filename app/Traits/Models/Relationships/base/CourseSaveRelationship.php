<?php

namespace App\Traits\Models\Relationships\base;

use App\Traits\Models\Relationships\childs\BelognsToCourse;
use App\Traits\Models\Relationships\childs\BelognsToStudent;

trait CourseSaveRelationship
{
    use BelognsToStudent, BelognsToCourse;
}//end CourseSaveRelationship
