<?php
	echo 'success v1';

	$con = mysqli_connect('localhost', 'id8287912_origami1024', 'qwe123', 'id8287912_msgsbase');
	//$json=json_decode(stripslashes($_POST['data']), true);

	
	//$_GET['text'] = str_replace(array("'", '"', "<", ">"), "^", $_GET['text']);
	//$sql="insert into log (name, text, mail) values ('" . $_GET['name'] . "', '" . $_GET['text'] . "', '" . $_GET['mail'] . "');";
	$sql = "update log set likes = likes + 1 where id=" . $_GET['id']; //id should equal smth else
	mysqli_query($con, $sql);
	mysqli_close($con);
?>