<?php

namespace App\Traits\checkAttributekey;

trait checkAttributekey
{
    //checks whether a given attribute key is included in the $fillable array
    protected function isFillable($key)
    {
        return in_array($key, $this->fillable);
    }
}
