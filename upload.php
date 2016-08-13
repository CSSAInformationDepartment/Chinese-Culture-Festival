<html>
<head>
		<meta http-equiv="Content-Type" content="text/html;charset=utf-8">
		<meta name="description" content="PikaPara - find your way to your Pokémon">
		<title>PikaPara alpha - Uploading your finding</title>
		
		<!-- Latest compiled and minified CSS -->
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap.min.css" integrity="sha384-1q8mTJOASx8j1Au+a5WDVnPi2lkFfwwEAa8hDDdjZlpLegxhjVME1fgjWPGmkzs7" crossorigin="anonymous">

		<!-- Optional theme -->
		<link href="simple-sidebar.css" rel="stylesheet">
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.6/css/bootstrap-theme.min.css" integrity="sha384-fLW2N01lMqjakBkx3l/M9EahuwpSfeNvV63J5ezn3uZzapT0u7EYsXMjQV+0En5r" crossorigin="anonymous">
		<link rel="stylesheet" href="/main.css">

	</head>
<body>
<!--Database connection -->
<?php
date_default_timezone_set("Australia/Melbourne");
//Variables Transfer
$Pokename = $_POST['idPokemon'];
$lag = $_POST['plag'];
$lng = $_POST['plng'];
$Date = date("Y-m-d");
$Time = date("H:i:s"); 
if(isset($_POST['g-recaptcha-response'])){
          $captcha=$_POST['g-recaptcha-response'];
        }

if(!$captcha){
          echo '<h2>Please check the the captcha form.</h2>';
          echo "<meta http-equiv='refresh' content= '2;url=/Report.php'>";
          exit;
        }
// reCaptcha Secret Key. REPLACE with new one
$secretKey = "6LcfCSUTAAAAAF059qZ8987pVR_PSBto74ug2bu0";
        $ip = $_SERVER['REMOTE_ADDR'];
        $response=file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret=".$secretKey."&response=".$captcha."&remoteip=".$ip);
        $responseKeys = json_decode($response,true);
        //reCaptcha verifying
        if(intval($responseKeys["success"]) !== 1) {
          echo '<h2>Fail to pass. Please check again~</h2>';
          echo "<meta http-equiv='refresh' content= '2;url=/Report.php'>";
        } else {
        //MySQL Connection parameters
        $conn = mysqli_connect("localhost", "root","","mydb");
        if (mysqli_connect_errno()) {
             echo "Could not connect: " . mysqli_connect_error();
            }

        $sql = "INSERT INTO `Record`(`Lat`, `Lng`, `Date`, `Time`, `PokemonInfo_Name`) VALUES ('$lag', '$lng' , '$Date', '$Time', '$Pokename')";

        if (mysqli_query($conn, $sql)) {
            echo "New record created successfully. Return to homepage in 3 seconds ^_^";
            echo "<meta http-equiv='refresh' content= '3;url=/index.php'>";
        } else {
            echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }
        mysqli_close($conn);
    }
?>
<!--Database connection -->
</body>
</html>