<?php
	$conn = new  mysqli("localhost:3310", "root", "D0NotHackMySyst3mY0", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}

    session_start();

    $order_code = $_REQUEST['order'];
    $item_code = $_REQUEST['item'];

    $conn -> query("DELETE FROM TICKET WHERE ORDER_CODE = $order_code AND ITEM_CODE = $item_code");
    $items_left = $conn -> query("SELECT * FROM TICKET WHERE ORDER_CODE = $order_code");
    if (mysqli_num_rows($items_left) <= 0) {
        header('Location:DeleteOrder.php');
        exit();
    }

    $total = 0;
    $tickets = $conn -> query("SELECT * FROM TICKET WHERE ORDER_CODE = $order_code");
    while ($row = $tickets -> fetch_assoc()) {
        $price = ($conn -> query("SELECT ITEM_PRICE FROM ITEM WHERE ITEM_CODE =".$row['ITEM_CODE']) -> fetch_assoc())['ITEM_PRICE'];
        $total += $price * $row['TICKET_QUAN'];
    }
    $conn -> query("UPDATE ORD SET PAY_AMOUNT = $total WHERE ORDER_CODE = $order_code");
    header('Location:review.php');
?>