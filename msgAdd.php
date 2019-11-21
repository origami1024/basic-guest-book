<?php
	echo 'success v1';

	$con = mysqli_connect('localhost', 'id8287912_origami1024', 'qwe123', 'id8287912_msgsbase');
	//$json=json_decode(stripslashes($_POST['data']), true);

	
	$_GET['text'] = str_replace(array("'", '"', "<", ">","\t", "\\","//"), "*", $_GET['text']);
	$_GET['name'] = str_replace(array("'", '"', "<", ">","\t", "\\","//"), "*", $_GET['name']);
	$_GET['mail'] = str_replace(array("'", '"', "<", ">","\t", "\\","//"), "*", $_GET['mail']);
	$sql="insert into log (name, text, mail) values ('" . $_GET['name'] . "', '" . $_GET['text'] . "', '" . $_GET['mail'] . "');";
	mysqli_query($con, $sql);
	mysqli_close($con);
?>