<?php
namespace App\Http\Controllers;

use \App\Models\City;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
class cityController extends Controller
{
     
    public function store(array $data) 
    {
               // Validate the incoming request data
               $validator = Validator::make($data, [
                'city_id' => 'numeric',
                'city_name' => 'string',
                'latitude' => 'numeric',
                'longitude' => 'numeric',
                // Add validation rules for other fields as needed
            ]);
    
            // Check for validation errors
            if ($validator->fails()) {
                // Handle validation failure, return an error response or redirect
                return response()->json(['error' => $validator->errors()], 400);
            }

                    // Check if a record with the same city_id already exists
        $existingCity = City::where('city_id', $data['city_id'])->first();

        if ($existingCity) {
            // If the record exists, you can choose to update it or handle it accordingly
            $existingCity->update([
                'city_name' => $data['city_name'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                // Update other fields as needed
            ]);

            // Optionally, you can return a response indicating that the record was updated
            return response()->json(['message' => 'Record updated successfully'], 200);
        }

    
            // Create a new City record with values from the array
            $city = new City([
                'city_id' => $data['city_id'],
                'city_name' => $data['city_name'],
                'latitude' => $data['latitude'],
                'longitude' => $data['longitude'],
                // Add other fields here based on your requirements
            ]);

        $city->save();

        // You can also retrieve the newly created record if needed
        //$newCity = City::find($city->id);

        // Additional logic or redirect here...

        return response()->json($city);
    }
}