<?php
$conn = new  mysqli("localhost:3310", "root", "D0NotHackMySyst3mY0", "tigerfoods");

if($conn -> connect_error){
	die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}

$restaurant = "SELECT * FROM tigerfoods.RESTAURANT";
$restaurant_result = $conn -> query($restaurant);

conn -> close();
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
      <div class="end-user-flex">
        <div class="form-header">TigerFoods</div>
        <form action=".php" method="POST" class="form-box">
          <div class="customer">
            <div class="section-header">Customer Info</div>
            <label for="CUS_CONTACT_NUMBER">Contact Number:</label>
    			  <input type="text" name="CUS_CONTACT_NUMBER" placeholder="Enter your contact number" />
          </div>
          <div class="edit-btn">
            <input class="edit" type="button" value="Edit Info" />
          </div>
  
          <div class="restaurant">
            <div class="section-header">Pick a Restaurant</div>
            <div class="restaurant-flex">
              <div class="shop">
                <label for="RES_NAME">Restaurants near you: </label>
                <select name="RES_NAME" class="resto" onchange="showDiv(this)">
                  <option value="0" selected disabled hidden>Select one</option>
                  <option value="chowking">Chowking</option>
                  <option value="dominos">Dominos</option>
                  <option value="jollibee">Jollibee</option>
                  <option value="starbucks">Starbucks</option>
                  <option value="--">--</option>
                </select>
              </div>
        
              <div class="menu" id="show-items">
              </div>
            </div>
          </div>
  
          <div class="payment">
            <div class="section-header">Payment Details</div>
            <div class="pay-tab">
              <div class="pay-type">
                <div>Pay Type</div>
                <div class="method">
                  <div><input type="radio" name="PAY_TYPE" id="gcash">
                  <label class="type" for="gcash">GCash</label></div>
                  <div><input type="radio" name="PAY_TYPE" id="credit-card">
                  <label class="type" for="credit-card"><span>Credit Card</span></label></div>
                </div>
              </div>
            </div>
          </div>

          <div class="order-btn">
            <input class="process" type="button" value="Process Payment" />
          </div>
        </form>
      </div>
    </main>

    <script>
      function selectRestaurant(str){
        if(str == ""){
          document.getElementById("show-items").innerHTML="";
          return;
        }
        else{
          var xmlhttp = new XMLHttpRequest();
          xmlhttp.onreadystatechange = function(){
            if(this.readyState == 4 && this.status == 200){
              document.getElementById("show-items").innerHTML = this.responseText;
            }
          };
          xmlhttp.open("GET", "Item_Getter.php?q=" + str, true);
          xmlhttp.send();
        }
      }
    </script>
  </body>
  
</html>