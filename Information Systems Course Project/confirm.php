<?php

	$conn = new  mysqli("localhost:3310", "root", "D0NotHackMySyst3mY0", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}

  session_start();
  $order_code = $_SESSION['order'];
  $order = ($conn -> query("SELECT * FROM ORD WHERE ORDER_CODE = $order_code") -> fetch_assoc());
  $customer = ($conn -> query("SELECT * FROM CUSTOMER WHERE CUS_CODE = (SELECT CUS_CODE FROM ORD WHERE ORDER_CODE = $order_code)") -> fetch_assoc());
  $location = ($conn -> query("SELECT * FROM LOCATION WHERE LOC_ID = ".$customer['LOC_NUMBER']) -> fetch_assoc());
  $tickets = ($conn -> query("SELECT * FROM TICKET WHERE ORDER_CODE = $order_code"));
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Confirm Order Window Interface</title>
    <link href="end-user.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />
  </head>
  <body>
    <main class="end-user-container">
      <div class="end-user-flex">
        <div class="form-header"><ion-icon name="fast-food-outline"></ion-icon>TigerFoods</div>
        <div class="order-review">
          <div class="section-header">Your Receipt:</div>
          <div class="receipt-customer">
            <div><span>User:</span> <?php echo $customer['CUS_FNAME']." ".$customer['CUS_LNAME']; ?></div>
            <div><span>Contact Number:</span> <?php echo $customer['CUS_CONTACT_NUMBER']; ?></div>
          </div>
          <div class="address">
            <div><span>City:</span> <?php echo $location['LOC_CITY']; ?></div>
            <div><span>Street:</span> <?php echo $location['LOC_STREET']; ?></div>
            <div><span>Building No.:</span> <?php echo $location['LOC_BNUM']; ?></div>
          </div>
          <div class="order-title">Order:</div>
          <div class="order">
            <?php 
              while ($row = $tickets -> fetch_assoc()) {
                $item_code = $row['ITEM_CODE'];
                $name = ($conn -> query("SELECT ITEM_NAME FROM ITEM WHERE ITEM_CODE = $item_code") -> fetch_assoc())['ITEM_NAME'];
                $price = ($conn -> query("SELECT ITEM_PRICE FROM ITEM WHERE ITEM_CODE = $item_code") -> fetch_assoc())['ITEM_PRICE'];
                $qty = $row['TICKET_QUAN'];
            ?>
            <div class="order-card">
              <div class="item-left">
                <h4><?php echo $name; ?></h4>
              </div>
              <div class="item-right">
                <div class="show-qty">Qty: <?php echo $qty; ?></div>
                <h4>P<?php echo $price * $qty; ?></h4>
              </div>
            </div>
            <?php } ?>
          </div>
          <div class="total">
            <h2>Total:</h2>
            <div class="total-price">P<?php echo $order['PAY_AMOUNT']; ?></div>
          </div>
          <div class="order-info">
            <div><span>Payment Method:</span> <?php echo $order['PAY_TYPE']; ?></div>
            <div><span>Order Code:</span> <?php echo $order_code; ?></div>
            <div><span>Order Time:</span> <?php echo $order['ORDER_TIME']; ?></div>
          </div>
          <div class="confirm-btn">
            <a href="DeleteOrder.php"><input class="cancel" type="button" value="Cancel Order" /></a>
            <a href="ConfirmPayment.php"><input class="pay" type="button" value="Proceed to Pay" /></a>
          </div>
        </div>
      </div>
    </main>

    <!--Import icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>