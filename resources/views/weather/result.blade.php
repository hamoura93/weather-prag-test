<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Weather Result</title>
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">
</head>
<body>

    <div class="container-fluid mx-auto">  
        <div class="row">
        <div class="card1 col-lg-6 col-md-6">
                <div class="row px-3 mt-3 mb-3">
                    <h1 class="large-font mr-3">{{round($temperature - 273.15)}} °C</h1>  
                    <div class="card-header">
                <h3 class="card-title">Current City: {{ $city_name}}</h3>
            </div>
            <div class="line mt-3"></div>
            <div class="card-body">
            <div class="row px-3">
                        <p class="light-text">Weather Mostly: </p>
                        <p class="ml-auto">{{ $weather_name}} </p>
                    </div>
                        <div class="row px-3">
                    <img src="https://openweathermap.org/img/wn/{{  $weather_icon }}.png" alt="Weather Icon">
                    </div>
        
                <div class="row px-3">
                        <p class="light-text">Weather Description: </p>
                        <p class="ml-auto">{{ $weather_description }} </p>
                    </div>
            </div>
                    <div class="card-footer">
                <p class="card-text">Temperature: {{round($temperature - 273.15)}}&deg;C</p>
                <p class="card-text">Min Temperature: {{round($temperature_min - 273.15)}}&deg;C</p>
                <p class="card-text">Max Temperature: {{round($temperature_max - 273.15)}}&deg;C</p>
            </div>
                    </div>
                </div>
                <div class="card2 col-lg-6 col-md-6">

                <div class="mr-5">


                    <div class="line my-5"></div>

                    <h3>Weather Details</h3>
                    <div class="row px-3">
                        <p class="light-text">Cloudiness</p>
                        <p class="ml-auto">{{$cloudiness}} %</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Humidity</p>
                        <p class="ml-auto">{{$humidity}} %</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Wind Speed</p>
                        <p class="ml-auto">{{ $wind_speed }} mph</p>
                    </div>
                    <div class="row px-3">
                        <p class="light-text">Pressure</p>
                        <p class="ml-auto">{{  $pressure }} hPa</p>
                    </div>

                    <div class="line mt-3"></div>
                   
                </div>
          
        </div>
     </div>
        </div>
    </div>

</body>

    
</body>
</html>
