<?php
	$conn = new  mysqli("localhost:3310", "root", "D0NotHackMySyst3mY0", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}

	session_start();
	$alert = "<h1 class='warn'>Warning: </h1>";

	// INPUT VERIFICATION
	$customer = $conn -> query("SELECT * FROM CUSTOMER WHERE CUS_CONTACT_NUMBER = '". $_REQUEST['CUS_CONTACT_NUMBER'] ."';");
	if (!isset($_REQUEST['item_list']) or $_REQUEST['CUS_CONTACT_NUMBER'] == NULL) {
		$_SESSION['invalid_input'] = "true";
		$alert .= (!isset($_REQUEST['item_list'])) ? "<p class='warn-msg'>No selected items </p>" : "";
		$alert .= ($_REQUEST['CUS_CONTACT_NUMBER'] == NULL) ? "<p class='warn-msg'>Invalid contact number </p>" : "";
		// $_SESSION['alert'] = $alert;
		// header('Location:order.php');
	}
	elseif (mysqli_num_rows($customer) <= 0) {
		$_SESSION['invalid_input'] = "true";
		$alert .= "<p class='warn-msg'>Customer contact number does not exist </p>";
	}

	foreach($_REQUEST['item_list'] as $itemID) {
		$itemQuantity = $itemID."qty";
		if (!($_REQUEST[$itemQuantity] > 0)) {
			$_SESSION['invalid_input'] = "true";
			$alert .= "<p class='warn-msg'>Some chosen item/s do not have an amount </p>";
			break;
		}
	}

	$_SESSION['alert'] = $alert."</p>";
	if (isset($_SESSION['invalid_input'])) {
		header('Location:order.php');
	}

	// CREATING THE ORD ENTITY

	// FETCH THE VALUES
	$CUS_CONTACT_NUMBER = $_REQUEST['CUS_CONTACT_NUMBER'];
	$CUS_CODE = ($conn -> query("SELECT CUS_CODE FROM CUSTOMER WHERE CUS_CONTACT_NUMBER = $CUS_CONTACT_NUMBER") -> fetch_assoc())["CUS_CODE"];
	$timestamp = ($conn -> query("SELECT CURRENT_TIMESTAMP as 'Time'") -> fetch_assoc())["Time"];
	$RES_ID = $_REQUEST['RES_ID'];
	$ITEM_LIST = $_REQUEST['item_list'];
	$PAY_TYPE = $_REQUEST['PAY_TYPE'];
	$PAY_AMOUNT = 0;

	// COMPUTE PRICE
	foreach($_REQUEST['item_list'] as $item) {
		$price = ($conn -> query("SELECT ITEM_PRICE FROM ITEM WHERE ITEM_CODE = $item") -> fetch_assoc())["ITEM_PRICE"];
		$quantity = $_REQUEST[$item."qty"];
		$PAY_AMOUNT += $price * $quantity;
	}

	echo "Contact number: ".$CUS_CONTACT_NUMBER."<br>";
	echo "Customer code: ".$CUS_CODE."<br>";
	echo "Timestamp: ".$timestamp."<br>";
	echo "Restaurant ID: ".$RES_ID."<br>";
	echo "Payment type: ".$PAY_TYPE."<br>";
	echo "Payment Amount: Php ".$PAY_AMOUNT."<br>";

	$conn -> query("INSERT INTO ORD(ORDER_TIME, PAY_TYPE, PAY_AMOUNT, CUS_CODE, RES_ID) VALUES ('$timestamp', '$PAY_TYPE', $PAY_AMOUNT, $CUS_CODE, $RES_ID)");

	// ADD TICKET RECORDS
	$current_order = ($conn -> query("SELECT ORDER_CODE FROM ORD WHERE ORDER_TIME = '$timestamp'") -> fetch_assoc())['ORDER_CODE'];
	$_SESSION['order'] = $current_order;
	foreach($_REQUEST['item_list'] as $item) {
		$quantity = $_REQUEST[$item."qty"];
		$conn -> query("INSERT INTO ticket(order_code, item_code, ticket_quan) VALUES ($current_order, $item, $quantity)");
	}

	if (isset($_SESSION['order']) and !isset($_SESSION['invalid_input'])) {
		header('Location:review.php');
	}
	else {
		$conn -> query("DELETE FROM ORD WHERE ORDER_CODE = $current_order");
		$conn -> query("DELETE FROM TICKET WHERE ORDER_CODE = $current_order");
	}

	// echo "00000000000000000000000000 <br>";
	// foreach($_REQUEST as $r => $r_value){
	// 	echo "$r --- $r_value <br>";
	// }

	// if(!empty($_REQUEST['item_list'])){
	// 	foreach($_REQUEST['item_list'] as $selected){
	// 		echo "Item id: ".$selected."<br>";
	// 		$quantity = $selected."qty";
	// 		echo "Item Quantity: ".$_REQUEST[$quantity]."<br>";
	// 	}
	// }
?>