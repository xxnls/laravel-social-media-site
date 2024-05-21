$(document).ready(function() {
    function fetchWeatherData() {
        $.ajax({
            url: `/weather`,
            method: 'GET',
            success: function(response) {
                if (response.error) {
                    $('#weather-data').html(`<p>${response.error}</p>`);
                } else {
                    $('#weather-data').html(`
                    <div class="row gx-0">
                        <div class="col-auto"><strong>
                            <i class="bi bi-buildings-fill"></i>
                            ${response.location.name}
                            ${response.current.temp_c} °C
                            <img src="${response.current.condition.icon}" alt="Weather icon" width="40" height="40">
                        </strong></div>
                    </div>`);
                }
            },
            error: function() {
                //$('#weather-data').html('<p>Error fetching weather data</p>');
                fetchWeatherData("Warsaw");
            }
        });
    }

    fetchWeatherData();
});
