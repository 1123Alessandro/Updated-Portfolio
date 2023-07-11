<?php
	session_start();
	$conn = new mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	
	$alert = "<h1 class='warn'>Warning: </h1>";
	$confirm = "<h1 class='warn'>Confirmed: </h1>";
	if(isset($_POST['ADD'])){
		$LOC_CITY = $_REQUEST['LOC_CITY'];
		$LOC_STREET = $_REQUEST['LOC_STREET'];
		$LOC_BNUM = $_REQUEST['LOC_BNUM'];

		if((is_numeric($LOC_CITY))){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}

		if($LOC_CITY == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a city name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}

		if($LOC_STREET == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input a street name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}

		if($LOC_BNUM == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input a building number</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}
		$search = "SELECT * FROM LOCATION";
		$result = $conn -> query($search);
		while($rows = $result -> fetch_assoc()){
			$LOC_CITY_CHECK = $rows['LOC_CITY'];
			$LOC_STREET_CHECK = $rows['LOC_STREET'];
			$LOC_BNUM_CHECK = $rows['LOC_BNUM'];
			if($LOC_CITY_CHECK == $LOC_CITY and $LOC_STREET_CHECK == $LOC_STREET and $LOC_BNUM_CHECK == $LOC_BNUM){
				$alert .= "<p class='warn-msg'>Location already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminLocation.php');
		  		return;
			}	
		}
		$sql = "INSERT INTO LOCATION(LOC_CITY, LOC_STREET, LOC_BNUM) VALUES ('$LOC_CITY', '$LOC_STREET', '$LOC_BNUM')";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminLocation.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input item details</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}
	}
	elseif(isset($_POST['UPDATE'])){
		$LOC_ID = $_REQUEST['LOC_ID'];
		$LOC_CITY = $_REQUEST['LOC_CITY'];
		$LOC_STREET = $_REQUEST['LOC_STREET'];
		$LOC_BNUM = $_REQUEST['LOC_BNUM'];

		if((is_numeric($LOC_CITY))){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}
		$search = "SELECT * FROM LOCATION";
		$result = $conn -> query($search);
		while($rows = $result -> fetch_assoc()){
			$LOC_CITY_CHECK = $rows['LOC_CITY'];
			$LOC_STREET_CHECK = $rows['LOC_STREET'];
			$LOC_BNUM_CHECK = $rows['LOC_BNUM'];
			if($LOC_CITY_CHECK == $LOC_CITY and $LOC_STREET_CHECK == $LOC_STREET and $LOC_BNUM_CHECK == $LOC_BNUM){
				$alert .= "<p class='warn-msg'>Location already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminLocation.php');
		  		return;
			}	
		}
		if($LOC_ID == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a location</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}
		$origin = "SELECT * FROM LOCATION WHERE LOC_ID = $LOC_ID";
		$result = $conn -> query($origin);
		$rows = $result -> fetch_assoc();

		if($LOC_CITY != "" AND $LOC_CITY != $rows['LOC_CITY']){
			$LOC_CITY = $LOC_CITY;
			}
		else{
			$LOC_CITY = $rows['LOC_CITY'];
		}

		if($LOC_STREET != "" AND $LOC_STREET!= $rows['LOC_STREET']){
			$LOC_STREET = $LOC_STREET;
			}
		else{
			$LOC_STREET = $rows['LOC_STREET'];
		}

		if($LOC_BNUM != "" AND $LOC_BNUM!= $rows['LOC_BNUM']){
			$LOC_BNUM = $LOC_BNUM;
			}
		else{
			$LOC_BNUM = $rows['LOC_BNUM'];
		}
		$sql = "UPDATE LOCATION SET LOC_CITY = '$LOC_CITY', LOC_STREET = '$LOC_STREET', LOC_BNUM = '$LOC_BNUM' WHERE LOC_ID = '$LOC_ID'";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminLocation.php');
		}
		else{
			echo mysql_error($conn);
		}

	}
	elseif(isset($_POST['DELETE'])){
		if( $_REQUEST['LOC_ID'] == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a location</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}
		$LOC_ID = $_REQUEST['LOC_ID'];
		$sql = "DELETE FROM LOCATION WHERE LOC_ID = $LOC_ID"; 
		if(mysqli_query($conn,$sql)){
			header('Location:AdminLocation.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select Location</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminLocation.php');
			return;
		}
	}
?>

