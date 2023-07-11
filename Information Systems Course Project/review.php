<?php
	$conn = new  mysqli("localhost:3310", "root", "D0NotHackMySyst3mY0", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}

	session_start();
	$order_code = $_SESSION['order'];
	$tickets = $conn -> query("SELECT * FROM TICKET WHERE ORDER_CODE = $order_code");
?>

<!DOCTYPE html>
<html lang="en">
	<head>
	    <meta charset="utf-8">
	    <meta name="viewport" content="width=device-width, initial-scale=1.0">
	    <title>Review Order Window Interface</title>
	    <link href="end-user.css" rel="stylesheet" type="text/css" />
	    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />
	</head>
	<body>
    <main class="end-user-container">
    <div class="end-user-flex">
      <div class="form-header"><ion-icon name="fast-food-outline"></ion-icon>TigerFoods</div>
      <div class="order-review">
        <div class="section-header">Review Order</div>
        <div class="order">
          <?php
            while ($row = $tickets -> fetch_assoc()) {
              $item_code = $row['ITEM_CODE'];
              $name = ($conn -> query("SELECT ITEM_NAME FROM ITEM WHERE ITEM_CODE = $item_code") -> fetch_assoc())['ITEM_NAME'];
              $price = ($conn -> query("SELECT ITEM_PRICE FROM ITEM WHERE ITEM_CODE = $item_code") -> fetch_assoc())['ITEM_PRICE'];
              $qty = $row['TICKET_QUAN'];
          ?>
          <form action="reviewRemoveItem.php" method="POST" class="order-card">
            <div class="item-left">
              <h4><?php echo $name; ?></h4>
            </div>
            <div class="item-right">
              <div class="show-qty">Qty: <?php echo $qty ?></div>
              <h4>P<?php echo $price*$qty; ?></h4>
              <input type="hidden" name='order' value='<?php echo $order_code; ?>'>
              <input type="hidden" name='item' value='<?php echo $item_code; ?>'>
              <button class="remove" type="submit">
                <ion-icon name="close-outline"></ion-icon>
              </button>
            </div>
          </form>
          <?php } ?>
        </div>
        <div class="total">
          <h2>Total:</h2>
          <div class="total-price">P<?php echo ($conn -> query("SELECT PAY_AMOUNT FROM ORD WHERE ORDER_CODE = $order_code") -> fetch_assoc())['PAY_AMOUNT']; ?></div>
        </div>
      </div>
      <div class="review-btn">
        <a href="DeleteOrder.php"><input class="delete" type="button" value="Delete Order" /></a>
        <a href="confirm.php"><input class="place" type="button" value="Place Order" /></a>
      </div>
    </div>
    </main>
    
    <!-- Import icons -->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg/com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
	</body>
</html>