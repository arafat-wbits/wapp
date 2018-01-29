<?php
include('db.php');

if(isset($_GET['type'])){

	$type = $_GET['type'];
	$sql = "UPDATE winfo SET type='$type' WHERE id=(SELECT id FROM winfo ORDER BY id DESC LIMIT 1)";
	if (mysqli_query($conn, $sql)) {
	    echo "Updated successfully";
	} else {
	    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
}



mysqli_close($conn);

?>