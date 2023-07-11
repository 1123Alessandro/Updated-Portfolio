<?php 
  $conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

  if($conn -> connect_error){
    die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
  }

  	session_start();
  if(isset($_REQUEST['UPDATE'])){
  	$alert = "<h1 class='warn'>Warning: </h1>";
  	$RIDER_CONTACT_NUMBER = $_REQUEST['RIDER_CONTACT_NUMBER'];
  	$ORDER_CODE = $_REQUEST['UPDATE'];
  	if($RIDER_CONTACT_NUMBER == null){
  		$alert .= "<p class='warn-msg'>Please input rider contact number</p>";
  		$_SESSION['alert'] = $alert;
  		header('Location:queue.php');
  	}
  	$RIDER_SQL = "SELECT * FROM RIDER WHERE RIDER_CONTACT_NUMBER = $RIDER_CONTACT_NUMBER";
  	$rider_result = $conn -> query($RIDER_SQL);
  	if(mysqli_num_rows($rider_result) <= 0){
  		$alert .= "<p class='warn-msg'>Missing contact number</p>";
  		$_SESSION['alert'] = $alert;
  		header('Location:queue.php');
  	}
	$rider_row = $rider_result->fetch_assoc();
  	$RIDER_ID = $rider_row['RIDER_ID'];

  	$order_sql = "UPDATE ORD SET RIDER_ID = $RIDER_ID WHERE ORDER_CODE = $ORDER_CODE";
  	if(mysqli_query($conn, $order_sql)){
			header('Location:queue.php');
	}
	else{
		echo mysql_error($conn);
	}
  }

  elseif(isset($_REQUEST['DELETE'])){
  	$ORDER_CODE = $_REQUEST['DELETE'];
  	echo "DELETE";
	$ticket_sql = "SELECT * FROM TICKET WHERE ORDER_CODE = $ORDER_CODE";
	$result = $conn -> query($ticket_sql);
	

	$del_ticket = "DELETE FROM TICKET WHERE ORDER_CODE = $ORDER_CODE";
  	if(mysqli_query($conn, $del_ticket)){
		echo "Data is now Deleted";
	}
	else{
		echo mysql_error($conn);
	}
  	$order_sql = "DELETE FROM ORD WHERE ORDER_CODE = $ORDER_CODE";
  	if(mysqli_query($conn, $order_sql)){
		echo "Data is now Deleted";
	}
	else{
		echo mysql_error($conn);
	}

  }
header('Location:queue.php');

?>