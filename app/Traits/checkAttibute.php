<?php

namespace App\Traits\checkAttribute;

trait checkAttribute
{
    // Check if an attribute exists
    public function __isset($key)
    {
        return $this->isFillableAttribute($key) && (isset($this->attributes[$key]) || isset($this->relations[$key]));
    }
}