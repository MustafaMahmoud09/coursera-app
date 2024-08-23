<?php

namespace App\Traits\Models\Relationships\base;

use App\Traits\Models\Relationships\childs\BelognsToCourse;
use App\Traits\Models\Relationships\childs\BelognsToStudent;

trait BuyingRelationship
{
    use BelognsToStudent, BelognsToCourse;
}//end BuyingRelationship
