<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Traits\checkAttribute;
//use App\Traits\checkAttributekey;
//use App\Traits\unsetAttribute;

class City extends Model
    {
        use HasFactory;
        //,checkAttribute,checkAttributekey,unsetAttribute;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'cities';
    public $timestamps = false;
        /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'city_id',
        'city_name',
        'latitude',
        'longitude'
  
        
    ];
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Default values
        $this->setDefaultValues();
    }

    

    // Custom method to set default values
    protected function setDefaultValues()
    {
        $this->attributes['city_id'] = $this->attributes['city_id'] ?? 2643743;
        $this->attributes['city_name'] = $this->attributes['city_name'] ?? 'London';
        $this->attributes['latitude'] = $this->attributes['latitude'] ?? -0.1257  ;
        $this->attributes['longitude'] = $this->attributes['longitude'] ?? 51.5085;
    }


        // Define an accessor (getter)
        public function getCityName($value)
        {
            return ucfirst($value);
        }
    
        // Define a mutator (setter)
        public function setCityName($value)
        {
            $this->attributes['city_name'] = strtolower($value);
        }
        
        // Define an accessor (getter) for the city_id
        public function getCityLatitude($value)
        {
            return intval($value);
        }
        
        // Define a mutator (setter) for the city_id
        public function setCityLatitude($value)
        {
            $this->attributes['latitude'] = intval($value);
        }
        
        // Define an accessor (getter) for the city_id
        public function getCityLongitude($value)
        {
            return intval($value);
        }
        
        // Define a mutator (setter) for the city_id
        public function setCityLongitude($value)
        {
            $this->attributes['longitude'] = intval($value);
        }

           // Validate if city_name is set
        public function isCityNameSet()
        {
            return isset($this->attributes['city_name']);
        }
         // Validate if latitude is set
        public function isLatitudeSet() 
        { 
            return isset($this->attributes['latitude']); 
        }
        // Validate if longitude is set
        public function isLongitudeSet() 
        { 
            return isset($this->attributes['longitude']); 
        }
        
}
