<?php
    if(array_key_exists('submit', $_GET)){
      if (!$_GET['city']) {
        $error = "Bạn đã nhập sai";
      }
      if ($_GET['city']) {
        $apiData = file_get_contents("http://api.openweathermap.org/data/2.5/weather?q=".
        $_GET['city']."&appid=277d0cb9b5067fdbbb774ec7a7433d7e&lang=vi");
           $weatherArray = json_decode($apiData, true);
           if ($weatherArray['cod'] == 200){
            $tempCelsius = $weatherArray['main']['temp'] -273;
            $weather ="<b>".$tempCelsius."</b> <br>";
            $weather ="<b>".$weatherArray['name']."".$weatherArray['sys']['county'].":        ".intval($tempCelsius)."&deg;C</b> <br>"; 
            $tempCelsius.="&deg;C</b> <br>";
            //Điều kiện thời tiết
            $weather .="<b>Điều kiện thời tiết : </b>" .$weatherArray['weather']['0']['description']."<br>";
            //Áp suất không khí
            $weather .="<b> áp suất không khí : </b>" .$weatherArray['main']['pressure']."hPa<br>";
            //Tốc độ gió
            $weather .="<b>Tốc độ gió : </b>" .$weatherArray['wind']['speed']."meter/sec<br>";
            //Mây mù
            $weather .="<b> Mây mù : </b>" .$weatherArray['clouds']['all']." % <br>";
            //Thời điểm hiện tại
            date_default_timezone_set("Asia/Ho_Chi_Minh")."<br>";
            $sunrise = $weatherArray['sys']['sunrise'];
            $weather .="<b>Bình minh : </b>" .date("g:i a", $sunrise)."<br>";
            $weather .="<b>Thời điểm hiện tại : </b>" .date("F j, Y, g:i a")."<br>";
           }else{
              $error = "Bạn đã nhập sai tên thành phố";
           }
      }
    }
?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-F3w7mX95PdgyTmZZMECAngseQB83DfGTowi0iMjiWaeVhAn4FJkqJByhZMI3AhiU" crossorigin="anonymous">

    <title>dự báo thời tiết</title>

    <style type="text/css">
      body{
        margin: 0px;
        padding: 0px;
        box-sizing: border-box;
        background-image: url(weather-img.jpg);
        color: white;
        font-family: poppin, 'Times New Roman', Times, serif;
        font-size: large;
        background-size: cover;
        /* cho ảnh full */
        background-attachment: fixed;
      }
      .container{
        text-align: center;
        justify-content: center;
        align-items: center;
        width: 440px;
      }
      h1{
        font-weight: 700;
        margin-top: 150px;
      } 
      .input{
        width: 350px;
        padding: 5px;
      } 
    </style>
  </head> 
  <body> 
      <div class="container">
        <h1>Dự báo thời tiết </h1>
        <form action="" method="GET">
          <p><label for="city">Nhập tên thành phố</label></p>
          <p><input type="text" name="city" id="city" placeholder="Tên Thành Phố "></p>
          <button type="submit" name="submit" class="btn btn-success">Đăng ký ngay</button>
          <div class="output mt-3">
                
                <?php 
                   if ($weather) {
                      echo '<div class="alert alert-success" role="alert">
                         '.$weather.'
                       </div>';
                   } 
                   if ($error) {
                    echo '<div class="alert alert-success" role="alert">
                      '.$error.'
                    </div>';
                   }
                  
                   
                ?>
          </div>
        </form>

      </div>
      

    <!-- Optional JavaScript; choose one of the two! -->

    <!-- Option 1: Bootstrap Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js" integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ" crossorigin="anonymous"></script>

    <!-- Option 2: Separate Popper and Bootstrap JS -->
    <!--
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.3/dist/umd/popper.min.js" integrity="sha384-W8fXfP3gkOKtndU4JGtKDvXbO53Wy8SZCQHczT5FMiiqmQfUpWbYdTil/SxwZgAN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.min.js" integrity="sha384-skAcpIdS7UcVUC05LJ9Dxay8AXcDYfBJqt1CJ85S/CFujBsIzCIv+l9liuYLaMQ/" crossorigin="anonymous"></script>
    -->
  </body>
</html>