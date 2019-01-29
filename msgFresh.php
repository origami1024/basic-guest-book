<?php

	$con = mysqli_connect('localhost', 'id8287912_origami1024', 'qwe123', 'id8287912_msgsbase');
	//$json=json_decode(stripslashes($_POST['data']), true);

	//echo '"'.$_GET['cIndex'] .'"';
	$cIndex = $_GET['cIndex'];
	$sql = 'select * from log where id>'.$cIndex.';';
	//echo 'erf'.$sql;

	$result = mysqli_query($con, $sql);
	
	if ($cIndex == 0) {
		$animated = '';
	} else {
		$animated = ' animated lightSpeedIn';
	}
	echo '{"lines": "';
	if ($result->num_rows > 0) {
		//testing the double request bug
		//$random_token = rand(); $random_token . 
		while($row = $result->fetch_assoc()) {
		  $cIndex = $row["id"];
		  echo  "<div class='shadow container d-flex border p-2 flex-column m-1" . $animated . "'><div class='row'><div class='col-6 border-right'>" . $row["name"] . "</div><div class='col-6 text-right text-secondary'>" . $row["mail"]. "</div></div><div class='row py-1 '><div class='col-12 text-primary text-justify'>" . $row["text"] . "</div></div><div class='row mt-1'><div class='col-md-3 col-5 text-secondary'><button class='likeBtn btn btn-secondary btn-sm py-0 border' id='likeBtn" . $row["id"] . "'><i class='fa fa-thumbs-up' aria-hidden='true'></i> Like <span class='badge badge-dark'>" . $row["likes"] . "</span>
  <span class='sr-only'>number of likes</span></button></div><div class='col-md-9 col-7 text-right text-secondary py-2'>" . $row["date"] . "</div></div></div>";
			}
	};
	echo '","cIndex":'.$cIndex.'}';
	//echo 'represh v0';
	mysqli_close($con);
?>