<?php 
	$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");
	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	session_start();
	if(isset($_REQUEST['UPDATE'])){
		$alert = "<h1 class='warn'>Warning: </h1>";
		$confirm = "<h1 class='warn'>Confirmed: </h1>";
		$RIDER_FNAME_ORG = $_REQUEST['RIDER_FNAME_ORG'];
		$RIDER_LNAME_ORG = $_REQUEST['RIDER_LNAME_ORG'];
		$RIDER_CONTACT_NUMBER_ORG = $_REQUEST['RIDER_CONTACT_NUMBER_ORG'];
		$RIDER_FNAME = $_REQUEST['RIDER_FNAME'];
		$RIDER_LNAME = $_REQUEST['RIDER_LNAME'];
		$RIDER_CONTACT_NUMBER = $_REQUEST['RIDER_CONTACT_NUMBER'];

		if($RIDER_FNAME_ORG == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input Rider First name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:editrider.php');
		}

		if($RIDER_LNAME_ORG == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input Rider Last name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:editrider.php');
		}

		if($RIDER_CONTACT_NUMBER_ORG == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input Rider Contact number</p>";
			$_SESSION['alert'] = $alert;
			header('Location:editrider.php');
		}

		if(($RIDER_FNAME == "") and ($RIDER_LNAME == "") and ($RIDER_CONTACT_NUMBER == "")){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input one detail to change</p>";
			$_SESSION['alert'] = $alert;
			header('Location:editrider.php');
			return;
		}
		/*echo $RIDER_FNAME_ORG."<br>";
		echo $RIDER_LNAME_ORG."<br>";
		echo $RIDER_CONTACT_NUMBER_ORG."<br>";
		echo $RIDER_FNAME."<br>";
		echo $RIDER_LNAME."<br>";
		echo $RIDER_CONTACT_NUMBER."<br>";*/

		$ID_query = "SELECT RIDER_ID FROM RIDER WHERE RIDER_FNAME = '$RIDER_FNAME_ORG' AND RIDER_LNAME = '$RIDER_LNAME_ORG' AND RIDER_CONTACT_NUMBER = '$RIDER_CONTACT_NUMBER_ORG'";
		$result = $conn -> query($ID_query);
		if(mysqli_num_rows($result) <= 0){
	  		$alert .= "<p class='warn-msg'>Invalid rider details</p>";
	  		$_SESSION['alert'] = $alert;
	  		header('Location:editrider.php');
  		}

		$RIDER_rows = $result -> fetch_assoc();

		//echo $RIDER_rows['RIDER_ID'];

		$RIDER_ID = $RIDER_rows['RIDER_ID'];

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
			$confirm .= "Rider is now updated";
			$_SESSION['confirmed'] .= $confirm;
			header('Location:editrider.php');
		}
		else{
	  		echo mysql_error($conn);
		}
	}
?>