<?php
	session_start();
	$conn = new mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	$alert = "<h1 class='warn'>Warning: </h1>";
	$confirm = "<h1 class='warn'>Confirmed: </h1>";
	if(isset($_POST['ADD'])){
		$RES_NAME = $_REQUEST['RES_NAME'];
		$LOC_NUMBER = $_REQUEST['LOC_NUMBER'];

		if(is_numeric($RES_NAME)){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRestaurant.php');
			return;
		}

		if($RES_NAME == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input Restaurant name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRestaurant.php');
			return;
		}

		if($LOC_NUMBER == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input a Location</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRestaurant.php');
			return;
		}
		$search = "SELECT * FROM RESTAURANT";
		$result = $conn -> query($search);
		while($rows = $result -> fetch_assoc()){
			$RES_NAME_CHECK = $rows['RES_NAME'];
			$LOC_NUMBER_CHECK = $rows['LOC_NUMBER'];
			if($RES_NAME_CHECK == $RES_NAME and $LOC_NUMBER_CHECK == $LOC_NUMBER){
				$alert .= "<p class='warn-msg'>restaurant already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminRestaurant.php');
		  		return;
			}	
		}
		$sql = "INSERT INTO RESTAURANT(RES_NAME, LOC_NUMBER) VALUES('$RES_NAME', '$LOC_NUMBER')";

		if(mysqli_query($conn, $sql)){
			header('Location:AdminRestaurant.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input restaurant details</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRestaurant.php');
			return;
		}
	}
	elseif(isset($_POST['UPDATE'])){
		$RES_ID = $_REQUEST['RES_ID'];
		$RES_NAME = $_REQUEST['RES_NAME'];
		$LOC_NUMBER = $_REQUEST['LOC_NUMBER'];

		$search = "SELECT * FROM RESTAURANT";
		$result = $conn -> query($search);

		if(is_numeric($RES_NAME)){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRestaurant.php');
			return;
		}
		while($rows = $result -> fetch_assoc()){
			$RES_ID_CHECK = $rows['RES_ID'];
			$RES_NAME_CHECK = $rows['RES_NAME'];
			$LOC_NUMBER_CHECK = $rows['LOC_NUMBER'];
			if($RES_NAME_CHECK == $RES_NAME and $LOC_NUMBER_CHECK == $LOC_NUMBER){
				$alert .= "<p class='warn-msg'>Restaurant already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminRestaurant.php');
		  		return;
			}	
		}

		if($RES_ID == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a restaurant</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRestaurant.php');
			return;
		}

		$origin = "SELECT * FROM RESTAURANT WHERE RES_ID = $RES_ID";
		$result = $conn -> query($origin);
		$rows = $result -> fetch_assoc(); 
		if($RES_NAME != "" AND $RES_NAME != $rows['RES_NAME']){
			$RES_NAME = $RES_NAME;
		}

		else{
			$RES_NAME = $rows['RES_NAME'];
		}

		if($LOC_NUMBER != "" AND $LOC_NUMBER != $rows['LOC_NUMBER']){
			$LOC_NUMBER = $LOC_NUMBER;
		}
		else{
			$LOC_NUMBER = $rows['LOC_NUMBER'];
		}
		$sql = "UPDATE RESTAURANT SET RES_NAME = '$RES_NAME', LOC_NUMBER = '$LOC_NUMBER' WHERE RES_ID = '$RES_ID'";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminRestaurant.php');
		}
		else{
			echo mysql_error($conn);
		}
	}
	elseif(isset($_POST['DELETE'])){
		if( $_REQUEST['RES_ID'] == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a restaurant</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRestaurant.php');
			return;
		}
		$RES_ID = $_REQUEST['RES_ID'];
		$sql = "DELETE FROM RESTAURANT WHERE RES_ID = $RES_ID";
		if(mysqli_query($conn,$sql)){
			header('Location:AdminRestaurant.php');
		}
		else{
			echo mysqli_error($conn);
		}
	}
?>