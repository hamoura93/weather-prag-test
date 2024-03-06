<body>
<h3>Get Detailed Weather By City Name</h3>
    <form action="/weatheres" method="post">
        @csrf
        <label for="city">City:</label>
        <input type="search" name="city" id="city" placeholder="Enter City Here">
        <button class="btn btn-info" type="submit">Get Weather</button>
    </form>

</body>
