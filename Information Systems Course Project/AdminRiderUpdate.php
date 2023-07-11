<?php
	session_start();
	$conn = new mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	$alert = "<h1 class='warn'>Warning: </h1>";
	$confirm = "<h1 class='warn'>Confirmed: </h1>";
	if(isset($_POST['ADD'])){
		$RIDER_FNAME = $_REQUEST['RIDER_FNAME'];
		$RIDER_LNAME = $_REQUEST['RIDER_LNAME']; 
		$RIDER_CONTACT_NUMBER = $_REQUEST['RIDER_CONTACT_NUMBER'];
		if((is_numeric($RIDER_LNAME)) or (is_numeric($RIDER_FNAME))){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRider.php');
			return;
		}
	if($RIDER_FNAME == ""){
		$alert = "<h1 class='warn'>Warning : </h1>";
		$alert .= "<p class='warn-msg'>Please input rider first name</p>";
		$_SESSION['alert'] = $alert;
		header('Location:AdminRider.php');
		return;
	}

	if($RIDER_LNAME == ""){
		$alert = "<h1 class='warn'>Warning : </h1>";
		$alert .= "<p class='warn-msg'>Please input rider last name</p>";
		$_SESSION['alert'] = $alert;
		header('Location:AdminRider.php');
		return;
	}

	if($RIDER_CONTACT_NUMBER == ""){
		$alert = "<h1 class='warn'>Warning : </h1>";
		$alert .= "<p class='warn-msg'>Please rider contact number</p>";
		$_SESSION['alert'] = $alert;
		header('Location:AdminRider.php');
		return;
	} 
	$search = "SELECT * FROM RIDER";
	$result = $conn -> query($search);
	while($rows = $result -> fetch_assoc()){
		$RIDER_FNAME_CHECK = $rows['RIDER_FNAME'];
		$RIDER_LNAME_CHECK = $rows['RIDER_LNAME'];
		$RIDER_CONTACT_NUMBER_CHECK = $rows['RIDER_CONTACT_NUMBER'];
		if($RIDER_FNAME_CHECK == $RIDER_FNAME and $RIDER_LNAME_CHECK == $RIDER_LNAME and $RIDER_CONTACT_NUMBER_CHECK == $RIDER_CONTACT_NUMBER){
			$alert .= "<p class='warn-msg'>Rider already existed</p>";
	  		$_SESSION['alert'] = $alert;
	  		header('Location:AdminRider.php');
	  		return;
		}	
	}
		$sql = "INSERT INTO RIDER (RIDER_FNAME, RIDER_LNAME, RIDER_CONTACT_NUMBER) VALUES('$RIDER_FNAME', '$RIDER_LNAME', '$RIDER_CONTACT_NUMBER')";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminRider.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input Rider details</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRider.php');
			return;
		}
		
	}
	elseif(isset($_POST['UPDATE'])){
		$RIDER_LNAME = $_REQUEST['RIDER_LNAME']; 
		$RIDER_FNAME = $_REQUEST['RIDER_FNAME'];
		$RIDER_CONTACT_NUMBER = $_REQUEST['RIDER_CONTACT_NUMBER'];
		$RIDER_ID = $_REQUEST['RIDER_ID'];
		/*echo $RIDER_LNAME;
		echo $RIDER_FNAME;
		echo $RIDER_CONTACT_NUMBER;
		*/

		if((is_numeric($RIDER_LNAME)) or (is_numeric($RIDER_FNAME))){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRider.php');
			return;
		}
		$search = "SELECT * FROM RIDER";
		$result = $conn -> query($search);
		while($rows = $result -> fetch_assoc()){
			$RIDER_FNAME_CHECK = $rows['RIDER_FNAME'];
			$RIDER_LNAME_CHECK = $rows['RIDER_LNAME'];
			$RIDER_CONTACT_NUMBER_CHECK = $rows['RIDER_CONTACT_NUMBER'];
			if($RIDER_FNAME_CHECK == $RIDER_FNAME and $RIDER_LNAME_CHECK == $RIDER_LNAME and $RIDER_CONTACT_NUMBER_CHECK == $RIDER_CONTACT_NUMBER){
				$alert .= "<p class='warn-msg'>Rider already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminRider.php');
		  		return;
			}	
		}
		if($RIDER_ID == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a Rider</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRider.php');
			return;
		}
		$origin = "SELECT * FROM RIDER WHERE RIDER_ID = $RIDER_ID";
		$result = $conn -> query($origin);
		$rows = $result -> fetch_assoc();

		if($RIDER_LNAME != "" AND $RIDER_LNAME != $rows['RIDER_LNAME']){
			$RIDER_LNAME = $RIDER_LNAME;
		}
		else{
			$RIDER_LNAME = $rows['RIDER_LNAME'];
		}

		if($RIDER_FNAME != "" AND $RIDER_FNAME != $rows['RIDER_FNAME']){
			$RIDER_FNAME = $RIDER_FNAME;
		}
		else{
			$RIDER_FNAME = $rows['RIDER_FNAME'];
		}

		if($RIDER_CONTACT_NUMBER != "" AND $RIDER_CONTACT_NUMBER != $rows['RIDER_CONTACT_NUMBER']){
			$RIDER_CONTACT_NUMBER = $RIDER_CONTACT_NUMBER;
		}
		else{
			$RIDER_CONTACT_NUMBER = $rows['RIDER_CONTACT_NUMBER'];
		}

		$sql = "UPDATE RIDER SET RIDER_FNAME = '$RIDER_FNAME', RIDER_LNAME = '$RIDER_LNAME', RIDER_CONTACT_NUMBER = '$RIDER_CONTACT_NUMBER' WHERE RIDER_ID = '$RIDER_ID'";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminRider.php');
		}
		else{
			echo mysql_error($conn);
		}
	}

	elseif(isset($_POST['DELETE'])){
		if(  $_REQUEST['RIDER_ID'] == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a Rider</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminRider.php');
			return;
		}
		$RIDER_ID = $_REQUEST['RIDER_ID'];
		$sql = "DELETE FROM RIDER WHERE RIDER_ID = $RIDER_ID";
		if(mysqli_query($conn,$sql)){
			header('Location:AdminRider.php');
		}
		else{
			echo mysqli_error($conn);
		}
	}
?>
