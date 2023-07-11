<?php   session_start() ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Rider Info Window Interface</title>
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

      <?php if(isset($_SESSION['confirmed'])) { ?>
        <div class='goods-box'>
          <?php 
            echo $_SESSION['confirmed'];
            session_destroy(); 
          ?>
        </div>
      <?php } ?>
      <div class="rider-flex">
        <div class="rider-header"><ion-icon name="fast-food-outline"></ion-icon>TigerFoods</div>
        <form action="editriderUpdate.php" method="POST">
          <div class="cur-rider">
            <div class="section-header">Current Rider Info</div>
            <div class="info">
              <div class="rid-header">Rider Credentials:</div>
                <label for="RIDER_FNAME">First Name: </label>
                <input type="text" name="RIDER_FNAME_ORG" placeholder="Enter your first name" />
                <label for="RIDER_LNAME">Last Name: </label>
                <input type="text" name="RIDER_LNAME_ORG" placeholder="Enter your last name" />
                <label for="RIDER_CONTACT_NUMBER_ORG">Contact Number: </label>
                <input type="number" name="RIDER_CONTACT_NUMBER_ORG" placeholder="Enter your contact number" />
            </div>
          </div>
          <div class="new-rider">
            <div class="section-header">New Rider Info</div>
            <div class="info">
              <div class="rid-header">Rider Credentials:</div>
              <label for="RIDER_FNAME">First Name: </label>
              <input type="text" name="RIDER_FNAME" placeholder="Enter your first name" />
              <label for="RIDER_LNAME">Last Name: </label>
              <input type="text" name="RIDER_LNAME" placeholder="Enter your last name" />
              <label for="RIDER_CONTACT_NUMBER">Contact Number: </label>
              <input type="number" name="RIDER_CONTACT_NUMBER" placeholder="Enter your contact number" />
            </div>
          </div>
          <div class="update-btn">
            <input class="update" name="UPDATE" type="submit" value="Update Info" />
          </div>
        </form>
      </div>
    </main>

    <!--Import icons-->
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
  </body>
</html>