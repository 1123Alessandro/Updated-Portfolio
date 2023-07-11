<?php

	$conn = new  mysqli("localhost:3310", "root", "D0NotHackMySyst3mY0", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}

    session_start();
    $order_code = $_SESSION['order'];

    $conn -> query("DELETE FROM ORD WHERE ORDER_CODE = $order_code");
    header('Location:order.php');

?>