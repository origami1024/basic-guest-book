<?php

	$con = mysqli_connect('localhost', 'id8287912_origami1024', 'qwe123', 'id8287912_msgsbase');
	//$json=json_decode(stripslashes($_POST['data']), true);

	//echo '"'.$_GET['cIndex'] .'"';
	$cIndex = $_GET['cIndex'];
	$sql = 'select * from log where id>'.$cIndex.';';
	//echo 'erf'.$sql;

	$result = mysqli_query($con, $sql);
	
	echo '{"lines": "';
	if ($result->num_rows > 0) {
		// output data of each row

		while($row = $result->fetch_assoc()) {
		  $cIndex = $row["id"];
		  echo "<div class='container d-flex border p-2 flex-column m-1 animated lightSpeedIn'><div class='row'><div class='col-6 border-right'>" . $row["name"] . "</div><div class='col-6 text-right text-secondary'>" . $row["mail"]. "</div></div><div class='row py-1 '><div class='col-12 text-primary text-justify'>" . $row["text"] . "</div></div><div class='row mt-1'><div class='col-12 text-right text-secondary'>" . $row["date"] . "</div></div></div>";
			}
	} else {
		echo "";
	}
	echo '",';
	echo '"cIndex":'.$cIndex.'}';
	//echo 'represh v0';
	mysqli_close($con);
?>