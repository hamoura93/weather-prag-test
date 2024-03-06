<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\WeatherService;
use App\Models\Weather;
use GuzzleHttp\Client; // Import Guzzle Client
use Illuminate\Support\Facades\Http; // Import Http class
use Illuminate\Support\Facades\DB;
use App\Models\City; // Import City model
use App\Models\SensorType; // Import SensorType model
use App\Http\Controllers\CityController;
use App\Http\Controllers\SensorTypesController;
use App\Http\Controllers\Forecasts;

class weatherController extends Controller
{
    private $apiKey = 'c815e7e6f6adf63781437395939c7e9d';

    protected $weatherService;
    protected $cityController;
    protected $sensorTypesController;

    public function __construct(
        WeatherService $weatherService,
        CityController $cityController,
        SensorTypesController $sensorTypesController, Forecasts $Forecasts
    ) {
        $this->weatherService = $weatherService;
        $this->cityController = $cityController;
        $this->sensorTypesController = $sensorTypesController;
        $this->Forecasts = $Forecasts;
    }

    public function getWeatherForm()
    {
        return view('weather.form');
    }

    public function getWeatherFormLangLong()
    {
        return view('weather.formlanglong');
    }

    public function getCurrentWeather()
    {
        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q=London&appid={$this->apiKey}");
        $data = $response->json();

        $temperature= $data['main']['temp'];

        $city_name = $data['name'];
        $latitude = $data['coord']['lat'];
        $longitude = $data['coord']['lon'];

        $temperature = $data['main']['temp'];

        $wind_speed = $data['wind']['speed'];
        $wind_direction = $data['wind']['deg'];
        $pressure =  $data['main']['pressure'];
        $humidity = $data['main']['humidity'];
        $cloudiness = $data['clouds']['all'];
        $temperature_min= $data['main']['temp_min'];
        $temperature_max = $data['main']['temp_max'];

        $weather_name =  $data['weather'][0]['main'];
        $weather_description = $data['weather'][0]['description'];
        $weather_icon = $data['weather'][0]['icon'];

        return view('weather.show', [
            'weather_name' =>  $data['weather'][0]['main'],
            'weather_description' => $data['weather'][0]['description'],
            'weather_icon' => $data['weather'][0]['icon'],
            'city_name' =>  $data['name'],
            'latitude' => $data['coord']['lat'],
            'longitude' => $data['coord']['lon'],
            'temperature' =>   $data['main']['temp'],
            'wind_speed' => $data['wind']['speed'],
            'wind_direction' => $data['wind']['deg'],
            'pressure' =>  $data['main']['pressure'],
            'humidity' => $data['main']['humidity'],
            'cloudiness' => $data['clouds']['all'],
            'temperature_min' => $data['main']['temp_min'],
            'temperature_max' => $data['main']['temp_max'],
            'data' => $data
        ]);
    }



    public function getForecast(Request $request)
    {
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $response = Http::get("https://api.openweathermap.org/data/2.5/onecall?lat={$latitude}&lon={$longitude}&exclude={current,minutely,hourly,alerts}&appid={$this->apiKey}");
        $data = $response->json();

        $dailyForecasts = $data['daily'];

        if (count($dailyForecasts) > 7) {
            try {
                DB::beginTransaction();

                foreach ($dailyForecasts as $index => $day) {
                    if ($index > 6) {
                        $weather = $day['weather'][0]['main'];
                        $icon = $day['weather'][0]['icon'];
                        $description = $day['weather'][0]['description'];
                        $temperature_min = $day['temp']['min'];
                        $temperature_max = $day['temp']['max'];

                        DB::transaction(function () use ($weather, $icon, $description, $temperature_min, $temperature_max) {
                            $this->Forecasts->store([
                                'weather' => $weather,
                                'icon' => $icon,
                                'description' => $description,
                                'temperature_min' => $temperature_min,
                                'temperature_max' => $temperature_max
                            ]);
                        });
                    }
                }

                DB::commit();
            } catch (\Exception $e) {
                DB::rollBack();
                return response()->json(['error' => $e->getMessage()], 500);
            }
        }

        //var_dump($dailyForecasts);
        return view('weather.resultlanglong', ['dailyForecasts' => $dailyForecasts]);
    }


    public function getWeather(Request $request)
    {
        $this->validate($request, [
            'city' => 'required|string',
        ]);

        $city = $request->input('city');

        $response = Http::get("https://api.openweathermap.org/data/2.5/weather?q={$city}&appid={$this->apiKey}");
        $data = $response->json();
       
        $city_name = $data['name'];
        $city_id = $data['id'];
        $latitude = $data['coord']['lat'];
        $longitude = $data['coord']['lon'];
        $temperature =   $data['main']['temp'];
        $wind_speed = $data['wind']['speed'];
                    $wind_direction = $data['wind']['deg']; // Adjust as needed
                    $pressure =  $data['main']['pressure'];
                    $humidity = $data['main']['humidity'];
                    $cloudiness = $data['clouds']['all'];  
                    $temperature_min = $data['main']['temp_min'];
                    $temperature_max = $data['main']['temp_max'];
                   $weather_id = $data['id'];
                    $weather_name =  $data['weather'][0]['main'];
                    $weather_description = $data['weather'][0]['description'];
                    $weather_icon = $data['weather'][0]['icon'];
        
                  
        // Use transactions for each table
        DB::transaction(function () use ($city_id, $city_name, $latitude, $longitude) {
            $this->cityController->store([
                'city_id' => $city_id,
                'city_name' => $city_name,
                'latitude' => $latitude,
                'longitude' => $longitude
            ]);
        });

        DB::transaction(function () use ( $city_id, $temperature, $temperature_min, $temperature_max, $wind_speed, $wind_direction, $pressure, $humidity, $cloudiness) {
            $this->sensorTypesController->store([
                'city_id' => $city_id,
                'temperature' => $temperature,
                'temperature_min' => $temperature_min,
                'temperature_max' => $temperature_max,
                'wind_speed' => $wind_speed,
                'wind_direction' => $wind_direction,
                'pressure' => $pressure,
                'humidity' => $humidity,
                'cloudiness' => $cloudiness
            ]);
        });

        DB::transaction(function () use ($weather_id, $weather_name, $weather_description, $weather_icon) {
            $weatherData = new Weather([
                'weather_id' => $weather_id,
                'weather_name' => $weather_name,
                'weather_description' => $weather_description,
                'weather_icon' => $weather_icon
                // Add other relevant data you want to store
            ]);

     
        });


        return view('weather.result', [
            'weather_id' => $data['id'],
            'weather_name' =>  $data['weather'][0]['main'],
            'weather_description' => $data['weather'][0]['description'],
            'weather_icon' => $data['weather'][0]['icon'],

            'city_name' =>  $data['name'],
            'latitude' => $data['coord']['lat'],
            'longitude' => $data['coord']['lon'] ,
       
       
            'temperature' =>   $data['main']['temp'],
            'wind_speed' => $data['wind']['speed'],
            'wind_direction' => $data['wind']['deg']  , // Adjust as needed
            'pressure' =>  $data['main']['pressure'],
            'humidity' => $data['main']['humidity'],
            'cloudiness' => $data['clouds']['all']  ,
            'temperature_min' => $data['main']['temp_min'],
            'temperature_max' => $data['main']['temp_max'] 

            ,'data' => $data]);
    }

    public function storeWeather(array $data) 
    {
        // Validate the incoming request data
        $validator = Validator::make($data, [
            'weather_id' => 'numeric',
            'weather_name' => 'string',
            'weather_description' => 'string',
            'weather_icon' => 'string',
            // Add validation rules for other fields as needed
        ]);
    
        // Check for validation errors
        if ($validator->fails()) {
            // Handle validation failure, return an error response or redirect
            return response()->json(['error' => $validator->errors()], 400);
        }
    
        // Check if a record with the same weather_id already exists in WeatherCondition model
        $existingWeatherCondition = WeatherCondition::where('weather_id', $data['weather_id'])->first();
    
        if ($existingWeatherCondition) {
            // If the record exists, you can choose to update it or handle it accordingly
            $existingWeatherCondition->update([
                'weather_name' => $data['weather_name'],
                'weather_description' => $data['weather_description'],
                'weather_icon' => $data['weather_icon'],
                // Update other fields as needed
            ]);
    
            // Optionally, you can return a response indicating that the record was updated
            return response()->json(['message' => 'Record updated successfully'], 200);
        }
    
        // Create a new WeatherCondition record with values from the request
        $weatherCondition = new WeatherCondition([
            'weather_id' => $data['weather_id'],
            'weather_name' => $data['weather_name'],
            'weather_description' => $data['weather_description'],
            'weather_icon' => $data['weather_icon'],
            // Add other fields here based on your requirements
        ]);
    
        $weatherCondition->save();
    
        // Additional logic or redirect here...
    
        return response()->json($weatherCondition);
    }
}
