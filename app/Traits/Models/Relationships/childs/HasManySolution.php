<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Solution;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManySolution
{

    /**
     * function for provide solutions
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function solutions(): HasMany
    {
        return $this->hasMany(Solution::class);
    } //end comments

}//end HasManySolution
