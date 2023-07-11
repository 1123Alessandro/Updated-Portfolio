<?php
	session_start();
	$conn = new mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	$alert = "<h1 class='warn'>Warning: </h1>";
	$confirm = "<h1 class='warn'>Confirmed: </h1>";
	if(isset($_POST['ADD'])){
		$ITEM_NAME = $_REQUEST['ITEM_NAME'];
		$ITEM_PRICE = $_REQUEST['ITEM_PRICE'];
		$ITEM_RES = $_REQUEST['ITEM_RES'];

		if(is_int((int)$ITEM_NAME) or is_int((int)$CUS_FNAME)){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}
		if($ITEM_NAME == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input an Item name</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminItem.php');
			return;
		}

		if($ITEM_PRICE == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input Item Price</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminItem.php');
			return;
		}

		if($ITEM_RES == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please specify a restaurant</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminItem.php');
			return;
		} 

		$search = "SELECT * FROM ITEM";
		$result = $conn -> query($search);
		while($rows = $result -> fetch_assoc()){
			$ITEM_NAME_CHECK = $rows['ITEM_NAME'];
			$ITEM_PRICE_CHECK = $rows['ITEM_PRICE'];
			$ITEM_RES_CHECK = $rows['ITEM_RES'];
			if($ITEM_NAME_CHECK == $ITEM_NAME and $ITEM_PRICE_CHECK == $ITEM_PRICE and $ITEM_RES_CHECK == $ITEM_RES){
				$alert .= "<p class='warn-msg'>Item already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminItem.php');
		  		return;
			}	
		}
		$sql = "INSERT INTO ITEM(ITEM_NAME, ITEM_PRICE, ITEM_RES) VALUES ('$ITEM_NAME', '$ITEM_PRICE', '$ITEM_RES')";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminItem.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please input item details</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminItem.php');
			return;
		}
	}

	elseif(isset($_POST['UPDATE'])){
		$ITEM_CODE = $_REQUEST['ITEM_CODE'];
		$ITEM_NAME = $_REQUEST['ITEM_NAME'];
		$ITEM_PRICE = $_REQUEST['ITEM_PRICE'];
		$ITEM_RES = $_REQUEST['ITEM_RES'];


		$search = "SELECT * FROM ITEM";
		$result = $conn -> query($search);

		if(is_int((int)$ITEM_NAME) or is_int((int)$CUS_FNAME)){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>A name is not an integer</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminCustomer.php');
			return;
		}
		while($rows = $result -> fetch_assoc()){
			$ITEM_NAME_CHECK = $rows['ITEM_NAME'];
			$ITEM_PRICE_CHECK = $rows['ITEM_PRICE'];
			$ITEM_RES_CHECK = $rows['ITEM_RES'];
			if($ITEM_NAME_CHECK == $ITEM_NAME and $ITEM_PRICE_CHECK == $ITEM_PRICE and $ITEM_RES_CHECK == $ITEM_RES){
				$alert .= "<p class='warn-msg'>Item already existed</p>";
		  		$_SESSION['alert'] = $alert;
		  		header('Location:AdminItem.php');
		  		return;
			}	
		}

		if($ITEM_CODE == ""){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select an item</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminItem.php');
			return;
		}
		$origin = "SELECT * FROM ITEM WHERE ITEM_CODE = $ITEM_CODE";
		$result = $conn -> query($origin);
		$rows = $result -> fetch_assoc();
		
		if($ITEM_NAME != "" AND $ITEM_NAME != $rows['ITEM_NAME']){
			$ITEM_NAME = $ITEM_NAME;
		}
		else{
			$ITEM_NAME = $rows['ITEM_NAME'];
		}

		if($ITEM_PRICE != "" AND $ITEM_PRICE != $rows['ITEM_PRICE']){
			$ITEM_PRICE = $ITEM_PRICE;
		}
		else{
			$ITEM_PRICE = $rows['ITEM_PRICE'];
		}

		if($ITEM_RES != "" AND $ITEM_RES != $rows['ITEM_RES']){
			$ITEM_RES = $ITEM_RES;
		}
		else{
			$ITEM_RES = $rows['ITEM_RES'];
		}

		$sql = "UPDATE ITEM SET ITEM_NAME = '$ITEM_NAME', ITEM_PRICE = '$ITEM_PRICE', ITEM_RES = '$ITEM_RES' WHERE ITEM_CODE = '$ITEM_CODE'";
		if(mysqli_query($conn, $sql)){
			header('Location:AdminItem.php');
		}
		else{
			echo mysql_error($conn);
		}
	}

	elseif(isset($_POST['DELETE'])){
		if( $_REQUEST['ITEM_CODE'] == null){
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select an item</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminItem.php');
			return;
		}
		$ITEM_CODE = $_REQUEST['ITEM_CODE'];
		$sql = "DELETE FROM ITEM WHERE ITEM_CODE = $ITEM_CODE";
		if(mysqli_query($conn,$sql)){
			header('Location:AdminItem.php');
		}
		else{
			$alert = "<h1 class='warn'>Warning : </h1>";
			$alert .= "<p class='warn-msg'>Please select an Item</p>";
			$_SESSION['alert'] = $alert;
			header('Location:AdminItem.php');
			return;
		}
	}

?>