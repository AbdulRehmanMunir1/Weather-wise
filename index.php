<?php
error_reporting(E_ALL);

$weather = null;
$celcius = null;
$error_message = null;

if (isset($_POST["submit"])) {
    if (empty($_POST["city"])) {
        $error_message = "Enter city name";
    } else {
        $city = htmlspecialchars($_POST["city"]);
        $api_key = "0ab399b5b7c11745a27a4fe66731808f";
        $api = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key";

        $api_data = file_get_contents($api);

        if ($api_data === FALSE) {
            $error_message = "Failed to retrieve data";
        } else {
            $weather = json_decode($api_data, true);

            if ($weather["cod"] != 200) {
                $error_message = "City not found";
            } else {
                $celcius = $weather["main"]["temp"] - 273.15;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WeatherWise</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
</head>

<body>
    <div class="container main animate__animated animate__backInUp">
        <div class="row inner text-center">
            <h1 class="animate__animated animate__backInDown animate__rubberBand animate__delay-1s">WeatherWise</h1>
            <div class="col-12">
                <form class="d-flex justify-content-center gap-2 mb-4" action="index.php" method="post">
                    <input type="text" name="city" placeholder="Enter City Name" class="form col-6 text-center">
                    <input class="btn btn-primary" name="submit" type="submit" value="Search">
                </form>
                <?php if ($error_message) : ?>
                    <p class="error"><?php echo $error_message; ?></p>
                <?php endif; ?>
                <?php if ($weather) : ?>
                    <div class="weather-info">
                        <h3><?php echo htmlspecialchars($weather["name"] . ", " . $weather["sys"]["country"]); ?></h3>
                        <p><?php echo date('d-m-Y'); ?></p>
                        <img src="./sources/clouds.png" alt="Weather icon">
                        <h3><?php echo round($celcius, 2) . "°C"; ?></h3>
                        <p>
                            <?php
                            echo htmlspecialchars($weather["weather"][0]["description"]) . "<br>";
                            echo "Min: " . round($weather["main"]["temp_min"] - 273.15, 2) . " °C<br>";
                            echo "Max: " . round($weather["main"]["temp_max"] - 273.15, 2) . " °C";
                            ?>
                        </p>
                    </div>
                <?php endif; ?>
                <?php if ($weather) : ?>
                    <div class="row endd text-center">
                        <div class="col-4">
                            <img src="./sources/sunsets.png" alt="Sunset icon">
                            <p><?php echo htmlspecialchars($weather["weather"][0]["description"]); ?></p>
                        </div>
                        <div class="col-4">
                            <img src="./sources/temprature.png" alt="Temperature icon">
                            <p>Humidity: <?php echo htmlspecialchars($weather["main"]["humidity"]); ?>%</p>
                        </div>
                        <div class="col-4">
                            <img src="./sources/Air.png" alt="Wind icon">
                            <p><?php echo htmlspecialchars($weather["wind"]["speed"]); ?> km/h</p>
                        </div>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</body>

</html>