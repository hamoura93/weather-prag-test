<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Result</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}"> 

</head>
<body>
   <!-- Display weather information here -->
<div>

        <!-- 7-Day Forecast Card -->
   
            
                @if(count($dailyForecasts) > 0)
                    <!-- Display today's day -->
                    <div class="container-fluid mx-auto">  
        <div class="row">
                <h2>Get Today's Weather and 7 Day Forecast</h2>
            </div>
                    
            <div class="row">
                    @foreach($dailyForecasts as $index => $day)
                    <div class="card">
                    <div class="card-header">
                    <p class="card-text">Date: {{ \Carbon\Carbon::createFromTimestamp($day['dt'])->format('l, Y-m-d') }}</p>
                        </div>
            <div class="card-body">
            <div class="row px-3">
                        <p class="light-text">Weather Mostly: </p>
                        <p class="ml-auto">{{ $day['weather'][0]['main'] }} </p>
                    </div>
                        <div class="row px-3">
                            <div class="weatherimg">
                    <img src="https://openweathermap.org/img/wn/{{  $day['weather'][0]['icon']  }}.png" alt="Weather Icon"></div>
                    </div>
        
                <div class="row px-3">
                        <p class="light-text">Weather Description: </p>
                        <p class="ml-auto">{{  $day['weather'][0]['description'] }} </p>
                    </div>
            </div>
                    <div class="card-footer">
                <p class="card-text">Max Temperature: {{round($day['temp']['max'] - 273.15)}}&deg;C</p>
                <p class="card-text">Min Temperature: {{round($day['temp']['min'] - 273.15)}}&deg;C</p>
                
                </div>
                    

</div>
                    @endforeach
</div>
                    @else
                    <p>No forecast data available.</p>
                @endif
            </div>
        </div>


</body>
</html>
