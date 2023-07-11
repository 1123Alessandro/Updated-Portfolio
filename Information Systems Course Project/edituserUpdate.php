<?php
	header('Location:edituser.php');
	$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	session_start();
	if(isset($_REQUEST['UPDATE'])){
		$alert = "<h1 class='warn'>Warning: </h1>";
		$confirm = "<h1 class='warn'>Confirmed: </h1>";
		$CUS_FNAME_ORG = $_REQUEST['CUS_FNAME_ORG'];
		$CUS_FNAME = $_REQUEST['CUS_FNAME'];
		$CUS_LNAME_ORG = $_REQUEST['CUS_LNAME_ORG'];
		$CUS_LNAME = $_REQUEST['CUS_LNAME'];
		$CUS_CONTACT_NUMBER_ORG = $_REQUEST['CUS_CONTACT_NUMBER_ORG'];
		$CUS_CONTACT_NUMBER = $_REQUEST['CUS_CONTACT_NUMBER'];
		
		$LOC_CITY = $_REQUEST['LOC_CITY'];
		
		$LOC_STREET = $_REQUEST['LOC_STREET'];
		
		$LOC_BNUM = $_REQUEST['LOC_BNUM'];

		if($CUS_FNAME_ORG == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input customer First name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:edituser.php');
			return;
		}

		if($CUS_LNAME_ORG == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input customer Last name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:edituser.php');
			return;
		}

		if($CUS_CONTACT_NUMBER_ORG == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input customer Contact number</p>";
			$_SESSION['alert'] = $alert;
			header('Location:edituser.php');
			return;
		}
		
		/*echo $CUS_FNAME_ORG."<br>";
		echo $CUS_FNAME."<br>";
		echo $CUS_LNAME_ORG."<br>";
		echo $CUS_LNAME."<br>";
		echo $CUS_CONTACT_NUMBER_ORG."<br>";
		echo $CUS_CONTACT_NUMBER."<br>";
		
		echo $LOC_CITY."<br>";
		
		echo $LOC_STREET."<br>";
		
		echo $LOC_BNUM."<br>";*/

		if(($CUS_FNAME == "") and ($CUS_LNAME == "") and ($CUS_CONTACT_NUMBER == "") and ($LOC_CITY == "") and ($LOC_STREET == "") and ($LOC_BNUM == "")){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input one detail to change</p>";
			$_SESSION['alert'] = $alert;
			header('Location:edituser.php');
			return;
		}

		$ID_query = "SELECT CUS_CODE FROM CUSTOMER WHERE CUS_FNAME = '$CUS_FNAME_ORG' AND CUS_LNAME = '$CUS_LNAME_ORG' AND CUS_CONTACT_NUMBER = '$CUS_CONTACT_NUMBER_ORG'";
		$ID_result = $conn -> query($ID_query);

		if(mysqli_num_rows($ID_result) <= 0){
	  		$alert .= "<p class='warn-msg'>Invalid Customer details</p>";
	  		$_SESSION['alert'] = $alert;
	  		header('Location:edituser.php');
	  		return;
  		}
  		if((is_numeric($CUS_LNAME)) or (is_numeric($CUS_FNAME))){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:edituser.php');
			return;
		}
		$ID_row = $ID_result->fetch_assoc();
    	echo $ID_row['CUS_CODE']."<br>";
    	$CUS_CODE = $ID_row['CUS_CODE'];
    	
    	$origin = "SELECT * FROM CUSTOMER WHERE CUS_CODE = $CUS_CODE";
		$result = $conn -> query($origin);
		$CUS_rows = $result -> fetch_assoc();

		/*echo $CUS_rows['CUS_CODE'];
		echo $CUS_rows['CUS_FNAME'];
		echo $CUS_rows['CUS_LNAME'];
		echo $CUS_rows['CUS_CONTACT_NUMBER'];*/

		if($CUS_LNAME != "" AND $CUS_LNAME != $CUS_rows['CUS_LNAME']){
			$CUS_LNAME = $CUS_LNAME;
		}
		else{
			$CUS_LNAME = $CUS_rows['CUS_LNAME'];
		}

		if($CUS_FNAME != "" AND $CUS_FNAME != $CUS_rows['CUS_FNAME']){
			$CUS_FNAME = $CUS_FNAME;
		}
		else{
			$CUS_FNAME = $CUS_rows['CUS_FNAME'];
		}

		if($CUS_CONTACT_NUMBER != "" AND $CUS_CONTACT_NUMBER != $CUS_rows['CUS_CONTACT_NUMBER']){
			$CUS_CONTACT_NUMBER = $CUS_CONTACT_NUMBER;
		}
		else{
			$CUS_CONTACT_NUMBER = $CUS_rows['CUS_CONTACT_NUMBER'];
		}
		$sql = "UPDATE CUSTOMER SET CUS_FNAME = '$CUS_FNAME', CUS_LNAME = '$CUS_LNAME', CUS_CONTACT_NUMBER = '$CUS_CONTACT_NUMBER'WHERE CUS_CODE = '$CUS_CODE'";
		if(mysqli_query($conn, $sql)){
			echo "Data is now updated";
		}
		else{
			echo mysql_error($conn);
		}
		$LOC_ID = $CUS_rows['LOC_NUMBER'];
		$origin = "SELECT * FROM LOCATION WHERE LOC_ID = $LOC_ID";
		$result = $conn -> query($origin);
		$rows = $result -> fetch_assoc();

		echo $rows['LOC_ID'];
		echo $rows['LOC_CITY'];
		echo $rows['LOC_STREET'];
		echo $rows['LOC_BNUM'];

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
			$confirm .= "Customer is now updated";
			$_SESSION['confirmed'] .= $confirm;
			header('Location:edituser.php');
		}
		else{
	  		echo mysql_error($conn);
		}
	};

?>
