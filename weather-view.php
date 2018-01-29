<?php

include('db.php');

function farentocel($celsius){
	return $farenhit = number_format($celsius * 1.8 + 32,2);
}

$string = file_get_contents('http://api.openweathermap.org/data/2.5/weather?q=Dhaka,bd&units=metric&appid=b768f859692b8aa95f4812cb78383615');
$json = json_decode($string,true);



$present_temp = $json['main']['temp'];
$present_tempf = farentocel($present_temp);

$high_temp = $json['main']['temp_min'];
$high_tempf = farentocel($high_temp);

$low_temp = $json['main']['temp_max'];
$low_tempf = farentocel($low_temp);

$type = $json['weather']['0']['main'];
$humidity = $json['main']['humidity'];
$wind = $json['wind']['speed'];
$time = date('d-M-Y h:i:sa');

echo 'Pesent Temperature: '.$present_temp.'<sup>o</sup> C / '.$present_tempf.'<sup>o</sup> F<br>';
echo 'Low Temperature: '.$high_temp.'<sup>o</sup> C / '.$high_tempf.'<sup>o</sup> F<br>';
echo 'High Temperature: '.$low_temp.'<sup>o</sup> C / '.$low_tempf.'<sup>o</sup> F<br>';
echo 'Weather Type: '.$type.'<br>';
echo 'Humidity: '.$humidity.'<br>';
echo 'Time: '.$time.' GMT<br><br><br>';

$sql = "SELECT * FROM winfo ORDER BY id DESC LIMIT 5";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // output data of each row
    while($row = mysqli_fetch_assoc($result)) {
    	echo 'Time: '.date('d-M-Y h:i:sa',strtotime($row['wtime'])).' GMT<br>';
		echo 'Temperature: '.$row['present_temp'].'<sup>o</sup> C / '.farentocel($row['present_temp']).'<sup>o</sup> F<br>';
		echo 'Humidity: '.$row['humidity'].'<br><hr>';
    }
} else {
    echo "0 results";
}

mysqli_close($conn);

?>