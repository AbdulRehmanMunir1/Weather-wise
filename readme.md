 <!-- <?php
    if (isset($_POST["submit"])) {
        if (empty("city")) {
            echo "enter city name";
        } else {
            $city = $_POST["city"];
            $api_key = "0ab399b5b7c11745a27a4fe66731808f";
            $api = "https://api.openweathermap.org/data/2.5/weather?q=$city&appid=$api_key";
            $api_data = file_get_contents($api);

            // ya data json ma hai is lia is ko hum php ma decode kary ga by using json_decode function ..
            //    print_r($api_data);   
            $weather = json_decode($api_data, true);

            // echo "<pre>";
            // print_r($weather);
            // echo "</pre>";

            $celcius =  $weather["main"]["temp"] - 273;
            // echo $weather["weather"][0]["description"];
        }
    }
    error_reporting(0);

    ?>


 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>WeatherWise</title>
     <link rel="stylesheet" href="style.css">
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
 </head>

 <body>
     <div class="container-fluid main d-flex justify-content-center align-items-center">
         <div class="row bg-dark inner m-2">
             <h1 class="text-center">Weather Wise</h1>
             <div class="container d-flex flex-column justify-content-around align-items-center text-center gap-5">
                 <div class="row text-center ">
                     <div class="col pt-3">
                         <form class=" col d-flex justify-content-center gap-2 pb-3" action="index.php" method="post">
                             <input type="text" name="city" placeholder="Enter City Name" class="form col-12 text-center">
                             <input class="btn btn-primary" name="submit" type="submit" value="Search">
                         </form>
                         <h3>
                             <?php
                                echo $weather["name"] . "," . $weather["sys"]["country"];
                                ?>
                         </h3>
                         <p><?php $currentDate = date('d-m-Y');
                            echo $currentDate; ?></p>
                         <img class="w-60" src="./sources/cloud.png" alt="">
                         <h3> <?php echo $celcius . "°C" ?></h3>
                         <p>
                             <?php
                                echo $weather["weather"][0]["description"] . "<br>";
                                echo "min : " . $weather["main"]["temp_min"] - 273;
                                echo "<br>" . "max : " . $weather["main"]["temp_max"] - 273;
                                ?>
                         </p>
                     </div>
                 </div>
                 <div class="col endd d-flex justify-content-evenly gap-5 pb-3">
                     <div class="col-3 ">
                         <img src="./sources/sunset.png" alt="">
                         <p class="col pt-1"><?php echo $weather["weather"][0]["description"]; ?></p>
                     </div>
                     <div class="col-3 ">
                         <img src="./sources/temperatures.png" alt="">
                         <p class="col pt-1"><?php echo "humidity :" . $weather["main"]["humidity"]; ?></p>
                     </div>
                     <div class="col-3 ">
                         <img src="./sources/air.png" alt="">
                         <p class="col pt-1"><?php echo $weather["wind"]["speed"] . "km/h"; ?></p>
                     </div>
                 </div>

             </div>
         </div>
     </div>
 </body>

 </html> -->