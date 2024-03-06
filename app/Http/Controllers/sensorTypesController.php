<?php

namespace App\Http\Controllers;
use \App\Models\SensorType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;

class sensorTypesController extends Controller
{

    public function store(array $data) 
    {
    // Validate the incoming request data
    $validator = Validator::make($data, [
 
        'city_id' => 'numeric',
        'temperature' => 'numeric',
        'temperature_min' => 'numeric',
        'temperature_max' => 'numeric', 
        'wind_speed' => 'numeric',
        'wind_direction' => 'numeric',
        'pressure' => 'numeric',
        'humidity' => 'numeric',
        'cloudiness' => 'numeric'
    ]);

        // Check for validation errors
        if ($validator->fails()) {
            // Handle validation failure, return an error response or redirect
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Check if a record with the same type_id and city_id already exists
        $existingSensorType = SensorType::where('city_id', $data['city_id'])
            ->first();

        if ($existingSensorType) {
            // If the record exists, you can choose to update it or handle it accordingly
            $existingSensorType->update([
                'temperature' => $data['temperature'],
                'temperature_min' => $data['temperature_min'],
                'temperature_max' => $data['temperature_max'],
                'wind_speed' => $data['wind_speed'],
                'wind_direction' => $data['wind_direction'],
                'pressure' => $data['pressure'],
                'humidity' => $data['humidity'],
                'cloudiness' => $data['cloudiness']
                // Update other fields as needed
            ]);

            // Optionally, you can return a response indicating that the record was updated
            return response()->json(['message' => 'Record updated successfully'], 200);
        }
    // Create a new SensorRange record with values from the request
    $SensorType = new SensorType([
        'city_id' => $data['city_id'],
        'temperature' => $data['temperature'],
        'temperature_min' => $data['temperature_min'],
        'temperature_max' => $data['temperature_max'],
        'wind_speed' => $data['wind_speed'],
        'wind_direction' => $data['wind_direction'],
        'pressure' => $data['pressure'],
        'humidity' => $data['humidity'],
        'cloudiness' => $data['cloudiness']
    ]);

        $SensorType->save();

        return response()->json( $SensorType);
    }
}
