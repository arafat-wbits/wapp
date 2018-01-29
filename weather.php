<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "weather";

// Create connection
$conn = mysqli_connect($servername, $username, $password, $dbname);
// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}


$string = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Dhaka,bd&appid=b768f859692b8aa95f4812cb78383615');
$json = json_decode($string,true);


$present_temp = $json['main']['temp'];
$high_temp = $json['main']['temp_min'];
$low_temp = $json['main']['temp_max'];
$type = $json['weather']['0']['main'];
$humidity = $json['main']['humidity'];
$wind = $json['wind']['speed'];
$time = date('d-M-Y h:i:sa');

echo 'Pesent Temperature: '.$present_temp.'<br>';
echo 'Low Temperature: '.$high_temp.'<br>';
echo 'High Temperature: '.$low_temp.'<br>';
echo 'Weather Type: '.$type.'<br>';
echo 'Humidity: '.$humidity.'<br>';
echo 'Time: '.$time.' GMT<br>';



$sql = "INSERT INTO winfo (present_temp, high_temp, low_temp, type, humidity, wtime)
VALUES ('$present_temp','$high_temp','$low_temp','$type','$humidity', '$time')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

?>