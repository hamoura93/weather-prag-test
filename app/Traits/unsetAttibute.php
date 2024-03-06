<?php

namespace App\Traits\unsetAttribute;

trait unsetAttribute
{
       // Unset an attribute
       public function __unset($key)
       {
           if ($this->isFillable($key)) {
               unset($this->attributes[$key], $this->relations[$key]);
           }
       }
}
