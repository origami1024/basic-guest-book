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
		  echo "<div class='col-12 p-0'>".$row["date"] . " : " . $row["name"]. " / " . $row["mail"]. " : <span class='text-primary'>" . $row["text"] . '</span></div>';
			}
	} else {
		echo "";
	}
	echo '",';
	echo '"cIndex":'.$cIndex.'}';
	//echo 'represh v0';
	mysqli_close($con);
?>