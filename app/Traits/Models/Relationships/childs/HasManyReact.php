<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\React;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyReact
{

    /**
     * function for provide student reacts
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function reacts(): HasMany
    {
        return $this->hasMany(React::class);
    } //end comments

}//end HasManyReact
