<?php 

$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

if($conn -> connect_error){
  die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}

session_start();
$customer = "SELECT * FROM tigerfoods.CUSTOMER";
$customer_result1 = $conn -> query($customer);
$customer_result2 = $conn -> query($customer);

$location = "SELECT * FROM tigerfoods.LOCATION";
$location_result1 = $conn -> query($location);
$location_result2 = $conn -> query($location);
$conn -> close();
?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Window Interface</title>
    <link href="end-user.css" rel="stylesheet" type="text/css" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.2.0/css/all.min.css" rel="stylesheet" />
  </head>
  <body>
    <main class="end-user-container">
      <?php if(isset($_SESSION['alert'])) { ?>
        <div class='warn-box'>
          <?php 
            echo $_SESSION['alert'];
            session_destroy(); 
          ?>
        </div>
      <?php } ?>

      <?php if(isset($_SESSION['confirmed'])) { ?>
        <div class='goods-box'>
          <?php 
            echo $_SESSION['confirmed'];
            session_destroy(); 
          ?>
        </div>
      <?php } ?>
      <div class="end-user-flex">
        <div class="form-header"><ion-icon name="fast-food-outline"></ion-icon>TigerFoods</div>
        <form action="edituserUpdate.php" action="POST">
          <div class="cur-customer">
            <div class="section-header">Current Customer Info</div>
            <div class="info">
              <div class="cus-header">Customer Credentials:</div>
              <label for="CUS_FNAME_ORG">First Name: </label>
              <input type="text" name="CUS_FNAME_ORG" placeholder="Enter your first name" />
              <label for="CUS_LNAME">Last Name: </label>
              <input type="text" name="CUS_LNAME_ORG" placeholder="Enter your last name" />
              <label for="CUS_CONTACT_NUMBER_ORG">Contact Number: </label>
              <input type="number" name="CUS_CONTACT_NUMBER_ORG" placeholder="Enter your contact number" />
            </div>
          </div>
          <div class="new-customer">
            <div class="section-header">New Customer Info</div>
            <div class="info">
              <div class="cus-header">Customer Credentials:</div>
              <label for="CUS_FNAME">First Name: </label>
              <input type="text" name="CUS_FNAME" placeholder="Enter your first name" />
              <label for="CUS_LNAME">Last Name: </label>
              <input type="text" name="CUS_LNAME" placeholder="Enter your last name" />
              <label for="CUS_CONTACT_NUMBER">Contact Number: </label>
              <input type="number" name="CUS_CONTACT_NUMBER" placeholder="Enter your contact number" />
            </div>
            <div class="loc">
              <div class="loc-header">Customer Location:</div>
              <div class="city">
                <label for="LOC_CITY">City: </label>
                <select name="LOC_CITY" id="city">
                  <option value="" selected disabled hidden>Select a city</option>
                  <option value="Manila">Manila</option>
                  <option value="Makati">Makati</option>
                  <option value="Pasay">Pasay</option>
                  <option value="Caloocan">Caloocan</option>
                  <option value="Taguig">Taguig</option>
                  <option value="Mandaluyong">Mandaluyong</option>
                  <option value="Navotas">Navotas</option>
                  <option value="Pasig">Pasig</option>
                  <option value="Malabon">Malabon</option>
                  <option value="San Juan">San Juan</option>
                  <option value="Quezon City">Quezon City</option>
                  <option value="Valenzuela">Valenzuela</option>
                  <option value="Las_Pinas">Las Pinas</option>
                  <option value="Muntinlupa">Muntinlupa</option>
                  <option value="Marikina">Marikina</option>
                  <option value="Pateros">Pateros</option>
                  <option value="BGC">BGC</option>
                  <option value="Sta Ana">Sta Ana</option>
                </select> 
              </div>
              <label for="LOC_STREET">Street: </label>
              <input type="text" name="LOC_STREET" placeholder="Street" />
              <label for="LOC_BNUM">House Number: </label>
              <input type="number" name="LOC_BNUM" placeholder="House Number" />
            </div>
          </div>
        <div class="update-btn">
          <input class="update" type="submit" name="UPDATE" value="Update Info" />
        </div>
        </form>
      </div>
    </main>

    <!--Import icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>