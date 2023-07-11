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
$conn -> close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Customer Records</title>
        <link rel="stylesheet" href="AdminDesign.css">
	</head>
	<body>
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
		<form action="AdminCustomerUpdate.php" method="POST">
			<table>
				<caption>Customer Records</caption>
				<thead>
					<tr>
						<th class="select"></th>
						<th class="title cid">Customer Id</th>
						<th class="title fname">First Name</th>
						<th class="title lname">Last Name</th>
						<th class="title cnumber">Contact Number</th>
						<th class="title lid">Location Id</th>
					</tr>
				</thead>

				<tbody>
					<?php
						while($row=$customer_result1 -> fetch_assoc()){
					?>
					<tr>
						<td class="select middle"><input type="radio" name="CUS_CODE" value=<?php echo $row["CUS_CODE"];?>></td>
						<td><?php echo $row["CUS_CODE"];?></td>
						<td><?php echo $row["CUS_FNAME"];?></td>
						<td><?php echo $row["CUS_LNAME"];?></td>
						<td><?php echo $row["CUS_CONTACT_NUMBER"];?></td>
						<td><?php echo $row["LOC_NUMBER"];?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
			<input class="deleteBtn" type="submit" name="DELETE" value="Delete customer">
			
			<div class="info">
				<div class="form-control">
					<label for="fname">First Name:</label><input id="fname" type="text" name="CUS_FNAME">
					<label for="lname">Last Name:</label><input id="lname" type="text" name="CUS_LNAME">
					<label for="cnumber">Contact Number:</label><input id="cnumber" type="number" name="CUS_CNUMBER">
					<label for="location">Location:</label>
					<select id="location" name="CUS_LOCATION">
						<option value="">Select a location</option>
						<?php
							while($op=$location_result1 -> fetch_assoc()){
						?>
						<option value=<?php echo $op["LOC_ID"];?>><?php echo $op["LOC_BNUM"]?> <?php echo $op["LOC_STREET"]?> <?php echo $op["LOC_CITY"];?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="buttons">
					<input class="addBtn" type="submit" name="ADD" value="Add customer">
					<input class="updateBtn" type="submit" name="UPDATE" value="Update customer">
				</div>
			</div>
		</form>
	</body>
</html>