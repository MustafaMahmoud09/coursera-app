<?php

namespace App\Traits\Models\Relationships\base;

use App\Traits\Models\Relationships\childs\HasManyBuying;
use App\Traits\Models\Relationships\childs\HasManyComment;
use App\Traits\Models\Relationships\childs\HasManyCourseSaved;
use App\Traits\Models\Relationships\childs\HasManyReact;
use App\Traits\Models\Relationships\childs\HasManySolution;

trait StudentRelationship
{
    use HasManyCourseSaved, HasManyComment, HasManyReact, HasManySolution, HasManyBuying;
}//end StudentRelationship
