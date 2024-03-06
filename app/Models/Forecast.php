<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SensorRange;
use App\Models\City;
use App\Models\Weather;
use App\Models\SensorType;

//use App\Traits\checkAttribute;
//use App\Traits\checkAttributekey;
//use App\Traits\unsetAttribute;

class Forecast extends Model
{
    
    use HasFactory;
    //checkAttribute,checkAttributekey,unsetAttribute;
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'forecasts';
    public $timestamps = false;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'forecast_id',
        'date',
        'time',
        'range_id',
        'city_id',
        'weather_id',
        'type_id'
    ];

    /**
     * Get the sensor range associated with the forecast.
     */
    public function SensorRange()
    {
        return $this->belongsTo(SensorRange::class, 'range_id');
    }

    /**
     * Get the city associated with the forecast.
     */
    public function City()
    {
        return $this->belongsTo(City::class, 'city_id');
    }

    /**
     * Get the weather condition associated with the forecast.
     */
    public function Weather()
    {
        return $this->belongsTo(Weather::class, 'weather_id');
    }

    /**
     * Get the sensor type associated with the forecast.
     */
    public function SensorType()
    {
        return $this->belongsTo(SensorType::class, 'type_id');
    }

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // Default values
        //$this->setDefaultValues();
    }

   

    // Custom method to set default values
    /**protected function setDefaultValues()
    {
        $this->attributes['forcast_id'] = $this->attributes['forcast_id'] ?? null;
        $this->attributes['date'] = $this->attributes['date'] ?? now()->toDateString(); 
        $this->attributes['time'] = $this->attributes['time'] ?? now()->toTimeString(); 
        $this->attributes['range_id'] = $this->attributes['range_id'] ?? null;
        $this->attributes['city_id'] = $this->attributes['city_id'] ?? 2643743;
        $this->attributes['weather_id'] = $this->attributes['weather_id'] ?? null;
        $this->attributes['type_id'] = $this->attributes['type_id'] ?? null;

    }**/

    public function getDate($value)
    {
        // Customize the date format if needed
        return $this->formatDateTime($value, 'Y-m-d');
    }
    
    public function setDate($value)
    {
        // Convert incoming date to the desired format
        $this->attributes['date'] = $this->parseDateTime($value)->toDateString();
    }

    public function getTime($value)
    {
        // Customize the time format if needed
        return $this->formatDateTime($value, 'H:i:s');
    }

    public function setTime($value)
    {
        // Convert incoming time to the desired format
        $this->attributes['time'] = $this->parseDateTime($value)->toTimeString();
    }
        // Check if date is set
        public function isDateSet()
        {
            return isset($this->attributes['date']);
        }
    
        // Check if time is set
        public function isTimeSet()
        {
            return isset($this->attributes['time']);
        }

    //Helper methods for date and time
    protected function formatDateTime($value, $format)
    {
        return \Carbon\Carbon::parse($value)->format($format);
    }

    protected function parseDateTime($value)
    {
        return \Carbon\Carbon::parse($value);
    }
           

}
