<?php

namespace App\Http\Controllers;

use App\Models\Forecast;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
 

class Forecasts extends Controller
{
    public function store(array $data)
    {
        // Validate the incoming request data
        $validator = Validator::make($data, [
            'date' => 'date',
            'weather' => 'string',
            'icon' => 'string',
            'description' => 'string',
            'temperature_min' => 'integer',
            'temperature_max' => 'integer',
            
        ]);

        // Check for validation errors
        if ($validator->fails()) {
            // Handle validation failure, return an error response or redirect
            return response()->json(['error' => $validator->errors()], 400);
        }

        // Check if a record with the same date already exists
        $existingForecast = Forecast::where('date', $data['date'])->first();

        if ($existingForecast) {
            // If the record exists, you can choose to update it or handle it accordingly
            $existingForecast->update([
                'weather' => $data['weather'],
                'icon' => $data['icon'],
                'description' => $data['description'],
                'temperature_min' => $data['temperature_min'],
                'temperature_max' => $data['temperature_max']
            ]);

            // Optionally, you can return a response indicating that the record was updated
            return response()->json(['message' => 'Record updated successfully'], 200);
        }

        // Create a new Forecast record with values from the array
        $forecast = new Forecast([
            'date' => $data['date'],
            'weather' => $data['weather'],
            'icon' => $data['icon'],
            'description' => $data['description'],
            'temperature_min' => $data['temperature_min'],
            'temperature_max' => $data['temperature_max'],
        ]);

        $forecast->save();

        return response()->json($forecast);
    }
}
