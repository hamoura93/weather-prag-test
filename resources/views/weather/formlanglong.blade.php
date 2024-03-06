<body>
<h3>Enter Longitude and Latitude to get weather forecast for today and next 7 Days</h3>
    <form action="/weatherforecast" method="post">
        @csrf
        <label for="longitude">Longitude:</label>
            <input type="text" name="longitude" id="longitude" placeholder="Enter longitude">

            <label for="latitude">Latitude:</label>
            <input type="text" name="latitude" id="latitude" placeholder="Enter latitude">

            <button class="btn btn-info" type="submit">Search</button>
    </form>
</body>