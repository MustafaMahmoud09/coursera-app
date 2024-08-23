<?php

namespace App\Traits\Models\Relationships\base;

use App\Traits\Models\Relationships\childs\BelognsToContent;
use App\Traits\Models\Relationships\childs\BelognsToStudent;

trait CommentRelationship
{
    use BelognsToContent, BelognsToStudent;
}//end CommentRelationship
