 <?php 
  $conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

  if($conn -> connect_error){
    die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
  }

  session_start();

  $orders = "SELECT * FROM tigerfoods.ORD";
  $order_result = $conn -> query($orders);
  $order_result_NoRider = $conn -> query($orders);

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rider's Queue Window Interface</title>
    <link href="rider.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />
  </head>
  <body>
    <main class="rider-container">
      <?php if(isset($_SESSION['alert'])) { ?>
        <div class='warn-box'>
          <?php 
            echo $_SESSION['alert'];
            session_destroy(); 
          ?>
        </div>
      <?php } ?>
      <div class="rider-flex">
        <div class="rider-header"><ion-icon name="fast-food-outline"></ion-icon>TigerFoods</div>
        <form action="queueUpdate.php" action="POST">
          <div class="rider">
            <div class="section-header">Rider Info</div>
            <label for="CUS_CONTACT_NUMBER">Contact Number:</label>
            <input type="text" name="RIDER_CONTACT_NUMBER" placeholder="Enter your contact number" />
          </div>
          <div class="edit-btn">
            <a href="editrider.php"><input class="edit" type="button" value="Edit Info" /></a>
          </div>
          <div class="service-queue">
            <div class="section-header">Service Queue</div>
            <div class="queue">
              <!-- <div class="queue-card">
                  <div class="order-info">
                    <div class="order-info-left">
                      <div><span>Customer Name:</span> Lucio dos Santos</div>
                      <div><span>Store:</span> Chowking</div>
                      <div><span>Location:</span> Quezon City</div>
                    </div>
                    <div class="order-items">
                      <div>Pork Chao Fan P97 x1</div>
                    </div>
                  </div>
                  <div class="status">Pending</div>
                  <div class="rider-btn">
                    <button class="cancel" type="button">Cancel Order</button>
                    <button class="complete" type="button">Complete Order</button>
                  </div>
                </div>
              </div>-->
              <?php
                while($order = $order_result->fetch_assoc()) {
                  if($order['RIDER_ID'] != null) {
                    $ORD_CODE = $order['ORDER_CODE'];
                    $ticket = "SELECT * FROM TICKET WHERE ORDER_CODE = $ORD_CODE";
                    $ticket_result = $conn -> query($ticket); 

                    $CUS_CODE = $order['CUS_CODE'];
                    $customer = "SELECT * FROM CUSTOMER WHERE CUS_CODE = $CUS_CODE";
                    $customer_result = $conn -> query($customer);
                    $cus_row = $customer_result -> fetch_assoc();

                    $RES_ID = $order['RES_ID'];
                    $restaurant = "SELECT * FROM RESTAURANT WHERE RES_ID = $RES_ID";
                    $restaurant_result = $conn -> query($restaurant);
                    $res_row = $restaurant_result -> fetch_assoc();

                    $LOC_ID = $cus_row['LOC_NUMBER'];
                    $location = "SELECT * FROM LOCATION WHERE LOC_ID = $LOC_ID";
                    $location_result = $conn -> query($location);
                    $loc_row = $location_result -> fetch_assoc();

                    $RIDER_ID = $order['RIDER_ID'];
                    $rider = "SELECT * FROM RIDER WHERE RIDER_ID = $RIDER_ID";
                    $rider_result = $conn -> query($rider);
                    $rid_row = $rider_result -> fetch_assoc();
              ?>

              <!--<input type="hidden" name="delete_order" value = "<?php //echo $order['ORDER_CODE']?>">-->
              <div class="queue-card">
                <div class="order-info">
                  <div class="order-info-left">
                    <div><span>Customer Name:</span><?php echo " " . $cus_row['CUS_FNAME'] . " " . $cus_row['CUS_LNAME']?></div>
                    <div><span>Store:</span><?php echo " " .$res_row['RES_NAME']?></div>
                    <div><span>Location:</span><?php echo " " .$loc_row['LOC_BNUM']. " " . $loc_row['LOC_STREET'] . " " . $loc_row['LOC_CITY']?></div>
                  </div>
                  <div class="order-items">
                    <?php
                      while($ticket = $ticket_result -> fetch_assoc()) {
                        $ITEM_CODE = $ticket['ITEM_CODE'];
                        $item = "SELECT * FROM ITEM WHERE ITEM_CODE = '$ITEM_CODE'";
                        $item_result = $conn -> query($item);
                        $item_row = $item_result -> fetch_assoc();
                    ?>
                    <div><?php echo $item_row['ITEM_NAME'] . " P" . $item_row['ITEM_PRICE']. " x" . $ticket['TICKET_QUAN']?></div>
                    <?php
                      }
                    ?>
                  </div>
                </div>
                <div class="status">Rider Name: <div><?php echo $rid_row['RIDER_FNAME'] . " " . $rid_row['RIDER_LNAME']?></div></div>
                <div class="rider-btn">
                  <button class="cancel" name = "DELETE" type="submit" value=<?php echo $order['ORDER_CODE']?>>Cancel Order</button>
                  <button class="complete" name = "DELETE" type="submit" value=<?php echo $order['ORDER_CODE']?>>Complete Order</button>
                </div>
              </div>
              <?php
                  }
                }
              ?>
            </div>
          </div>

          <div class="open-queue">
            <div class="section-header">Open Queue</div>
            <div class="queue">
              <!--<div class="queue-card">
                <div class="order-info">
                  <div class="order-info-left">
                    <div><span>Customer Name:</span> Andy Araza</div>
                    <div><span>Store:</span> Jollibee</div>
                    <div><span>Location:</span> San Juan City</div>
                  </div>
                  <div class="order-items">
                    <div>Chickenjoy P75 x1</div>
                  </div>
                </div>
                <div class="status">No Rider ID</div>
                <div class="rider-btn">
                  <button class="accept" type="button">Accept Order</button>
                </div>
              </div>-->
              <?php 
                while($order = $order_result_NoRider->fetch_assoc()) {
                  if($order['RIDER_ID'] == null) {
                    $ORD_CODE = $order['ORDER_CODE'];
                    $ticket = "SELECT * FROM TICKET WHERE ORDER_CODE = $ORD_CODE";
                    $ticket_result = $conn -> query($ticket); 

                    $CUS_CODE = $order['CUS_CODE'];
                    $customer = "SELECT * FROM CUSTOMER WHERE CUS_CODE = $CUS_CODE";
                    $customer_result = $conn -> query($customer);
                    $cus_row = $customer_result -> fetch_assoc();

                    $RES_ID = $order['RES_ID'];
                    $restaurant = "SELECT * FROM RESTAURANT WHERE RES_ID = $RES_ID";
                    $restaurant_result = $conn -> query($restaurant);
                    $res_row = $restaurant_result -> fetch_assoc();

                    $LOC_ID = $cus_row['LOC_NUMBER'];
                    $location = "SELECT * FROM LOCATION WHERE LOC_ID = $LOC_ID";
                    $location_result = $conn -> query($location);
                    $loc_row = $location_result -> fetch_assoc();
              ?>
              <input type="hidden" name="update_order" value = <?php echo $order['ORDER_CODE']?>>
              <div class="queue-card">
                <div class="order-info">
                  <div class="order-info-left">
                    <div><span>Customer Name: </span><?php echo $cus_row['CUS_FNAME'] . " " . $cus_row['CUS_LNAME']?></div>
                    <div><span>Store: </span><?php echo $res_row['RES_NAME']?></div>
                    <div><span>Location: </span><?php echo " " .$loc_row['LOC_BNUM']. " " . $loc_row['LOC_STREET'] . " " . $loc_row['LOC_CITY']?></div>
                  </div>
                  <div class="order-items">
                    <?php
                      while($ticket = $ticket_result -> fetch_assoc()) {
                        $ITEM_CODE = $ticket['ITEM_CODE'];
                        $item = "SELECT * FROM ITEM WHERE ITEM_CODE = '$ITEM_CODE'";
                        $item_result = $conn -> query($item);
                        $item_row = $item_result -> fetch_assoc();
                    ?>
                    <div><?php echo $item_row['ITEM_NAME'] . " P" . $item_row['ITEM_PRICE']. " x" . $ticket['TICKET_QUAN']?></div>
                    <?php
                      }
                    ?>
                  </div>
                </div>
                <div class="status">No Rider</div>
                <div class="rider-btn">
                  <button class="accept" name="UPDATE" type="submit" value=<?php echo $order['ORDER_CODE']?>>Accept Order</button>
                </div>
              </div>
              <?php
                  }
                }
                $conn -> close();
              ?>
            </div>
          </div>
        </form>
      </div>
    </main>

    <!--Import icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>


