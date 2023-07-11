<?php 

$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

if($conn -> connect_error){
	die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}
/*
	else{
		echo "Success";
	}
*/
$customer = "SELECT * FROM tigerfoods.CUSTOMER";
$customer_result1 = $conn -> query($customer);
$customer_result2 = $conn -> query($customer);

$rider = "SELECT * FROM tigerfoods.RIDER"; 
$rider_result = $conn -> query($rider);

$location = "SELECT * FROM tigerfoods.LOCATION";
$location_result1 = $conn -> query($location);
$location_result2 = $conn -> query($location);

$restaurant = "SELECT * FROM tigerfoods.RESTAURANT";
$restaurant_result = $conn -> query($restaurant);

$item = "SELECT * FROM tigerfoods.ITEM";
$item_result = $conn -> query($item);
$conn -> close();
?>

<html>
<head>
	<title>Admin page</title>	
</head>
<body>
	<h1>Customers</h1>
	<form action="Customer_Update.php" method = "POST">
	<table>
		<tr>
			<th></th>
			<th>Id</th>
			<th>First Name</th>
			<th>Last Name</th>
			<th>Contact Number</th>
			<th>Location Id</th>
		</tr>
				<?php
					while($row=$customer_result1 -> fetch_assoc()){
				?>
				<tr>
					<td><input type="checkbox" name="CUS_ID" value=<?php echo $row["CUS_CODE"];?>></td>
					<td><?php echo $row["CUS_CODE"];?></td>
					<td><?php echo $row["CUS_FNAME"];?></td>
					<td><?php echo $row["CUS_LNAME"];?></td>
					<td><?php echo $row["CUS_CONTACT_NUMBER"];?></td>
					<td><?php echo $row["LOC_NUMBER"];?></td>
				</tr>
				<?php
					}
				?>
		</table>
		<input type="submit" name= "DELETE" value="Delete a customer">
		<h5>First Name:</h5><input type="Text" name="CUS_FNAME">
		<h5>Last Name:</h5><input type="Text" name="CUS_LNAME">
		<h5>Contact Number:</h5><input type="number" name="CUS_CNUMBER">
		<h5>Location:</h5>
		<select name="CUS_LOCATION">
		<?php
			while($op=$location_result1 -> fetch_assoc()){
		?>
			<option value = <?php echo $op["LOC_ID"];?>><?php echo $op["LOC_CITY"];?></option>
		<?php
			}
		?>
		<br>
		<input type="submit" name= "ADD" value="Add a customer">
		<input type="submit" name= "UPDATE" value="Update a customer">
	</form>
	<br>
	<br>
		<h1>Rider</h1>
	<table>
		<tr>
			<th>Id</th>
			<th>Last Name</th>
			<th>First Name</th>
			<th>Contact Number</th>
		</tr>
		<?php
			while($row=$rider_result -> fetch_assoc()){
		?>
		<tr>
			<td><?php echo $row["RIDER_ID"];?></td>
			<td><?php echo $row["RIDER_LNAME"];?></td>
			<td><?php echo $row["RIDER_FNAME"];?></td>
			<td><?php echo $row["RIDER_CONTACT_NUMBER"];?></td>
		</tr>
		<?php
			}
		?>
	</table>
	<br>
	<h1>Locations</h1>
	<table>
		<tr>
			<th>Id</th>
			<th>City</th>
			<th>Region</th>
			<th>Latitude</th>
			<th>Longitude</th>
		</tr>
		<?php
			while($row=$location_result2 -> fetch_assoc()){
		?>
		<tr>
			<td><?php echo $row["LOCATION_ID"];?></td>
			<td><?php echo $row["LOC_CITY"];?></td>
			<td><?php echo $row["LOC_REGION"];?></td>
			<td><?php echo $row["LOC_LATITUDE"];?></td>
			<td><?php echo $row["LOC_LONGITUDE"];?></td>
		</tr>
		<?php
			}
		?>
	</table>

	<br>
	<h1>Restaurants</h1>
	<table>
		<tr>
			<th>Id</th>
			<th>Restaurant Name</th>
			<th>Location Id</th>
		</tr>
		<?php
			while($row=$restaurant_result -> fetch_assoc()){
		?>
		<tr>
			<td><?php echo $row["RES_ID"];?></td>
			<td><?php echo $row["RES_NAME"];?></td>
			<td><?php echo $row["LOC_NUMBER"];?></td>
		</tr>
		<?php
			}
		?>
	</table>
</body>
</html>