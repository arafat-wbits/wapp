<?php

include('db.php');

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

include('header.php');
$sql = "SELECT * FROM winfo ORDER BY id DESC LIMIT 1";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_assoc($result);
echo 'Pesent Temperature: '.$row['present_temp'].'<sup>o</sup> C / '.farentocel($row['present_temp']).'<sup>o</sup> F<br>';
echo 'Low Temperature: '.$row['high_temp'].'<sup>o</sup> C / '.farentocel($row['high_temp']).'<sup>o</sup> F<br>';
echo 'High Temperature: '.$row['low_temp'].'<sup>o</sup> C / '.farentocel($row['low_temp']).'<sup>o</sup> F<br>';
echo 'Weather Type: '.$row['type'].'<br>';
echo 'Humidity: '.$row['humidity'].'<br>';
echo 'Time: '.date('d-M-Y h:i:sa',strtotime($row['wtime'])).' GMT<br><br><br>';


?>


			<div id="mainHeader" class=" row header">
				<div class="col-md-12">
					<p> C | F </p>
				</div>
			</div>
			<div id="mainContent" class="row main_content">
				<div class="col-md-4">
					<div id="statusIcon" class="status_icon">
						<img src="img/cloud.png">
					</div>
				</div>

				<div id="currentTempAmound" class="col-md-4">
					<div class="current_temp_amount">
						<p><?php echo $row['present_temp'].'<sup>o</sup> C / '.farentocel($row['present_temp']).'<sup>o</sup> F';?></p>
					</div>
				</div>
				<div id="lowHigh" class="col-md-4">
					<div class="low_high">
						<p id="mainLow">Low: <?php echo $row['high_temp'].'<sup>o</sup> C / '.farentocel($row['high_temp']).'<sup>o</sup> F<br>';?></p>
						<p id="mainHigh">High: <?php echo $row['low_temp'].'<sup>o</sup> C / '.farentocel($row['low_temp']).'<sup>o</sup> F<br>';?></p>
					</div>
				</div>
			</div>
			<div id="mainStatus" class="row">
				<div class="col-md-6 current_status">
					<p class=""><?php echo 'Weather Type: '.$row['type'].'<br>'; ?></p>
				</div>
				<div class="col-md-6 current_humidity">
					<p><?php echo 'Humidity: '.$row['humidity']; ?></p>
				</div>
			</div>
			<div class="row">
				<div class="col-md-1"></div>

			<?php

			$sql = "SELECT * FROM winfo ORDER BY id DESC LIMIT 5 OFFSET 1";
			$result = mysqli_query($conn, $sql);
			if (mysqli_num_rows($result) > 0) {
			    // output data of each row

			    while($row = mysqli_fetch_assoc($result)) {
?>


				<div id="secondaryTempHumidity" class="col-md-2">
					<div id="" class="well">
						<div id="secondaryTemp1" class="">
							<p><?php echo 'Temperature: '.$row['present_temp'].'<sup>o</sup> C / '.farentocel($row['present_temp']).'<sup>o</sup> F'; ?></p>
						</div>
						<div id="secondaryHumidity1" class="">
							<p><?php echo 'Humidity: '.$row['humidity']; ?></p>
						</div>
					</div>
				</div>


<?php


			    }
			} else {
			    echo "0 results";
			}

			?>


				<div class="col-md-1"></div>
			</div>	

<?php




mysqli_close($conn);

include('footer.php');

?>