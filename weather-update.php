<?php
include('db.php');

if(isset($_GET['type'])){

	$type = $_GET['type'];

	$sql = "SELECT id FROM winfo ORDER BY id DESC LIMIT 1";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_assoc($result);
	$id = $row['id'];
	$sql = "UPDATE winfo SET type='$type' WHERE id='$id'";

	if (mysqli_query($conn, $sql)) {
	    echo "Updated successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}


mysqli_close($conn);

?>