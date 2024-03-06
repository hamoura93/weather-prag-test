<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

//use App\Traits\checkAttribute;
//use App\Traits\checkAttributekey;
//use App\Traits\unsetAttribute;


class Weather extends Model
{
    use HasFactory;
    //checkAttribute,checkAttributekey,unsetAttribute;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'weatherconditions';
    public $timestamps = false;
            /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'weather_id',
        'weather_name',
        'weather_description',
        'weather_icon'
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
        $this->attributes['weather_id'] = $this->attributes['weather_id'] ?? 804;
        $this->attributes['weather_name'] = $this->attributes['weather_name'] ?? 'Clouds';
        $this->attributes['weather_description'] = $this->attributes['weather_description'] ?? 'overcast clouds';
        $this->attributes['weather_icon'] = $this->attributes['weather_icon'] ?? '04d';
        // ... set default values for other attributes
    }

    /**
     * Getter for weather_name attribute
     */
    public function getWeatherName($value)
    {
        return ucfirst($value);
    }

    /**
     * Setter for weather_name attribute
     */
    public function setWeatherName($value)
    {
        $this->attributes['weather_name'] = strtolower($value);
    }


    /**
     * Check if weather_name is set
     */
    public function isWeatherNameSet()
    {
        return isset($this->attributes['weather_name']);
    }
/**
 * Getter for weather_description attribute
 */
public function getWeatherDescription($value)
{
    // Customize the getter logic if needed
    return $value;
}

/**
 * Setter for weather_description attribute
 */
public function setWeatherDescription($value)
{
    // Customize the setter logic if needed
    $this->attributes['weather_description'] = $value;
}

/**
 * Check if weather_description is set
 */
public function isWeatherDescriptionSet()
{
    return isset($this->attributes['weather_description']);
}

/**
 * Getter for weather_icon attribute
 */
public function getWeatherIcon($value)
{
    // Customize the getter logic if needed
    return $value;
}

/**
 * Setter for weather_icon attribute
 */
public function setWeatherIcon($value)
{
    // Customize the setter logic if needed
    $this->attributes['weather_icon'] = $value;
}

/**
 * Check if weather_icon is set
 */
public function isWeatherIconSet()
{
    return isset($this->attributes['weather_icon']);
}


}
