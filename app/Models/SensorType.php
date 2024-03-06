<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\City;

//use App\Traits\checkAttribute;
//use App\Traits\checkAttributekey;
//use App\Traits\unsetAttribute;


class SensorType extends Model
{
    use HasFactory;
    //,checkAttribute,checkAttributekey,unsetAttribute;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'sensor_types';
    public $timestamps = false;
    protected $primaryKey = 'city_id';
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'city_id',
        'temperature',
        'temperature_min',
        'temperature_max',
        'wind_speed',
        'wind_direction',
        'pressure',
        'humidity',
        'cloudiness'
        
    ];
    
      /**
     * Constructor to set default values
     */
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Default values
        $this->setDefaultValues();
    }

    /**
     * Custom method to set default values
     */
    protected function setDefaultValues()
    {
        $this->attributes['city_id'] = $this->attributes['city_id'] ?? 2643743;
        $this->attributes['temperature'] = $this->attributes['temperature'] ?? 282.05;
        $this->attributes['temperature_min'] = $this->attributes['temperature_min'] ?? 281.01;
        $this->attributes['temperature_max'] = $this->attributes['temperature_max'] ?? 282.67;
        $this->attributes['wind_speed'] = $this->attributes['wind_speed'] ?? 3.09;
        $this->attributes['wind_direction'] = $this->attributes['wind_direction'] ?? 320;
        $this->attributes['pressure'] = $this->attributes['pressure'] ?? 1012;
        $this->attributes['humidity'] = $this->attributes['humidity'] ?? 81;
        $this->attributes['cloudiness'] = $this->attributes['cloudiness'] ?? 75;
   
    }
    public function city()
    {
        return $this->belongsTo(City::class);
    }
    /**
     * Getter for temperature attribute
     */
    public function getTemperature($value)
    {
        // Customize the getter logic if needed
        return $value;
    }

    /**
     * Setter for temperature attribute
     */
    public function setTemperature($value)
    {
        // Customize the setter logic if needed
        $this->attributes['temperature'] = $value;
    }

    /**
     * Getter for wind_speed attribute
     */
    public function getWindSpeed($value)
    {
        // Customize the getter logic if needed
        return $value;
    }

    /**
     * Setter for wind_speed attribute
     */
    public function setWindSpeed($value)
    {
        // Customize the setter logic if needed
        $this->attributes['wind_speed'] = $value;
    }

    /**
     * Getter for wind_direction attribute
     */
    public function getWindDirection($value)
    {
        // Customize the getter logic if needed
        return $value;
    }

    /**
     * Setter for wind_direction attribute
     */
    public function setWindDirection($value)
    {
        // Customize the setter logic if needed
        $this->attributes['wind_direction'] = $value;
    }

    /**
     * Getter for pressure attribute
     */
    public function getPressure($value)
    {
        // Customize the getter logic if needed
        return $value;
    }

    /**
     * Setter for pressure attribute
     */
    public function setPressure($value)
    {
        // Customize the setter logic if needed
        $this->attributes['pressure'] = $value;
    }

    /**
     * Getter for humidity attribute
     */
    public function getHumidity($value)
    {
        // Customize the getter logic if needed
        return $value;
    }

    /**
     * Setter for humidity attribute
     */
    public function setHumidity($value)
    {
        // Customize the setter logic if needed
        $this->attributes['humidity'] = $value;
    }

    /**
     * Getter for cloudiness attribute
     */
    public function getCloudiness($value)
    {
        // Customize the getter logic if needed
        return $value;
    }

    /**
     * Setter for cloudiness attribute
     */
    public function setCloudiness($value)
    {
        // Customize the setter logic if needed
        $this->attributes['cloudiness'] = $value;
    }


    /**
     * Check if temperature is set
     */
    public function isTemperatureSet()
    {
        return isset($this->attributes['temperature']);
    }

    /**
     * Check if wind_speed is set
     */
    public function isWindSpeedSet()
    {
        return isset($this->attributes['wind_speed']);
    }

    /**
     * Check if wind_direction is set
     */
    public function isWindDirectionSet()
    {
        return isset($this->attributes['wind_direction']);
    }

    /**
     * Check if pressure is set
     */
    public function isPressureSet()
    {
        return isset($this->attributes['pressure']);
   
    }
        // Getters and Setters for temperature_min
        public function getTemperatureMin($value)
        {
            // Customize the getter logic if needed
            return $value;
        }
    
        public function setTemperatureMin($value)
        {
            // Customize the setter logic if needed
            $this->attributes['temperature_min'] = $value;
        }
    
        // Getters and Setters for temperature_max
        public function getTemperatureMax($value)
        {
            // Customize the getter logic if needed
            return $value;
        }
    
        public function setTemperatureMax($value)
        {
            // Customize the setter logic if needed
            $this->attributes['temperature_max'] = $value;
        }
        /**
         ** Check if temperature_min is set
        */
        public function isTemperatureMinSet()
        {
            return isset($this->attributes['temperature_min']);
        }
    
        /**
        * Check if temperature_max is set
        */
        public function isTemperatureMaxSet()
        {
            return isset($this->attributes['temperature_max']);
        }
    
}
