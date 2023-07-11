<?php
	session_start();
	$conn = new mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	$alert = "<h1 class='warn'>Warning: </h1>";
	$confirm = "<h1 class='warn'>Confirmed: </h1>";
	if(isset($_POST['ADD'])){
		$CUS_LNAME = $_REQUEST['CUS_LNAME']; 
		$CUS_FNAME = $_REQUEST['CUS_FNAME'];

		if((is_numeric($CUS_LNAME)) or (is_numeric($CUS_FNAME))){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}

		$CUS_CONTACT_NUMBER = $_REQUEST['CUS_CNUMBER'];
		$LOC_NUMBER = $_REQUEST['CUS_LOCATION'];

		if($CUS_FNAME == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input customer First name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}

		if($CUS_LNAME == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input customer Last name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}

		if($CUS_CONTACT_NUMBER == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input customer Contact number</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}

		if($LOC_NUMBER == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a location</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}


		$search = "SELECT * FROM CUSTOMER";
		$result = $conn -> query($search);
		while($rows = $result -> fetch_assoc()){
			$CUS_LNAME_CHECK = $rows['CUS_LNAME'];
			$CUS_FNAME_CHECK = $rows['CUS_FNAME'];
			$CUS_CONTACT_NUMBER_CHECK = $CUS_CONTACT_NUMBER;
			$LOC_NUMBER_CHECK = $rows['LOC_NUMBER'];
			if($CUS_LNAME_CHECK == $CUS_LNAME and $CUS_FNAME_CHECK == $CUS_FNAME and $CUS_CONTACT_NUMBER_CHECK == $CUS_CONTACT_NUMBER and $LOC_NUMBER_CHECK == $LOC_NUMBER){
				$alert .= "<p class='warn-msg'>Customer has already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminCustomer.php');
		  		return;
			}	
		}
		/*echo $CUS_LNAME;
		echo $CUS_FNAME;
		echo $CUS_CONTACT_NUMBER;
		echo $LOC_NUMBER;*/
		$sql = "INSERT INTO CUSTOMER(CUS_LNAME, CUS_FNAME, CUS_CONTACT_NUMBER, LOC_NUMBER) VALUES('$CUS_LNAME', '$CUS_FNAME', '$CUS_CONTACT_NUMBER', '$LOC_NUMBER')";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminCustomer.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input customer credentials </p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}

		
		/*while($rows = $result -> fetch_assoc()){
			if(($rows['CUS_LNAME'] == $CUS_LNAME) and ($rows['CUS_FNAME'] == $CUS_FNAME) and ($rows['CUS_CONTACT_NUMBER'] == $CUS_CONTACT_NUMBER) and ($rows['LOC_NUMBER'] == $CUS_LNAME)){
				$alert .= "<p class='warn-msg'>Customer has already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:edituser.php');
		  		return;
			}
		}*/

		
	}
	elseif(isset($_POST['UPDATE'])){
		$CUS_LNAME = $_REQUEST['CUS_LNAME']; 
		$CUS_FNAME = $_REQUEST['CUS_FNAME'];
		$CUS_CONTACT_NUMBER = $_REQUEST['CUS_CNUMBER'];
		$LOC_NUMBER = $_REQUEST['CUS_LOCATION'];
		$CUS_CODE = $_REQUEST['CUS_CODE'];
		
		/*echo $CUS_LNAME;
		echo $CUS_FNAME;
		echo $CUS_CONTACT_NUMBER;
		echo $LOC_NUMBER;*/
		if((is_numeric($CUS_LNAME)) or (is_numeric($CUS_FNAME))){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}
		$search = "SELECT * FROM CUSTOMER";
		$result = $conn -> query($search);
		while($rows = $result -> fetch_assoc()){
			$CUS_LNAME_CHECK = $rows['CUS_LNAME'];
			$CUS_FNAME_CHECK = $rows['CUS_FNAME'];
			$CUS_CONTACT_NUMBER_CHECK = $rows['CUS_CONTACT_NUMBER'];
			$LOC_NUMBER_CHECK = $rows['LOC_NUMBER'];
			if($CUS_LNAME_CHECK == $CUS_LNAME and $CUS_FNAME_CHECK == $CUS_FNAME and $CUS_CONTACT_NUMBER_CHECK == $rows['CUS_CONTACT_NUMBER'] and $LOC_NUMBER_CHECK == $rows['LOC_NUMBER']){
				$alert .= "<p class='warn-msg'>Customer has already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminCustomer.php');
		  		return;
			}	
		}
		
		if($CUS_CODE == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a customer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}

		$origin = "SELECT * FROM CUSTOMER WHERE CUS_CODE = $CUS_CODE";
		$result = $conn -> query($origin);
		$rows = $result -> fetch_assoc();

		if($CUS_LNAME != "" AND $CUS_LNAME != $rows['CUS_LNAME']){
			$CUS_LNAME = $CUS_LNAME;
		}
		else{
			$CUS_LNAME = $rows['CUS_LNAME'];
		}

		if($CUS_FNAME != "" AND $CUS_FNAME != $rows['CUS_FNAME']){
			$CUS_FNAME = $CUS_FNAME;
		}
		else{
			$CUS_FNAME = $rows['CUS_FNAME'];
		}

		if($CUS_CONTACT_NUMBER != "" AND $CUS_CONTACT_NUMBER != $rows['CUS_CONTACT_NUMBER']){
			$CUS_CONTACT_NUMBER = $CUS_CONTACT_NUMBER;
		}
		else{
			$CUS_CONTACT_NUMBER = $rows['CUS_CONTACT_NUMBER'];
		}


		if($LOC_NUMBER != "" AND $LOC_NUMBER != $rows['LOC_NUMBER']){
			$LOC_NUMBER = $LOC_NUMBER;
		}
		else{
			$LOC_NUMBER = $rows['LOC_NUMBER'];
		}
		$sql = "UPDATE CUSTOMER SET CUS_FNAME = '$CUS_FNAME', CUS_LNAME = '$CUS_LNAME', CUS_CONTACT_NUMBER = '$CUS_CONTACT_NUMBER', LOC_NUMBER = '$LOC_NUMBER' WHERE CUS_CODE = '$CUS_CODE'";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminCustomer.php');
		}
		else{
			echo mysql_error($conn);
		}
	}

	elseif(isset($_POST['DELETE'])){
		if( $_REQUEST['CUS_CODE'] == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a customer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}
		$CUS_CODE = $_REQUEST['CUS_CODE'];
		$sql = "DELETE FROM CUSTOMER WHERE CUS_CODE = $CUS_CODE";
		if(mysqli_query($conn,$sql)){
			header('Location:AdminCustomer.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select a customer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}
	}
?>
