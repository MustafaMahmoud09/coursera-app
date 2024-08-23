<?php

namespace App\Traits\Models\Relationships\childs;

use App\Models\Buying;
use Illuminate\Database\Eloquent\Relations\HasMany;

trait HasManyBuying
{

    /**
     * function for provide student buyings
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    function buyings(): HasMany
    {
        return $this->hasMany(Buying::class);
    } //end buyings

}//end HasManyBuying
