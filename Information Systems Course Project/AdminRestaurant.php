<?php 

$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

if($conn -> connect_error){
	die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}
session_start();
$restaurant = "SELECT * FROM tigerfoods.RESTAURANT";
$restaurant_result1 = $conn -> query($restaurant);

$location = "SELECT * FROM tigerfoods.LOCATION";
$location_result1 = $conn -> query($location);
$conn -> close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Restaurant Records</title>
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
		<form action="AdminRestaurantUpdate.php" method="POST">
			<table>
				<caption>Restaurant Records</caption>
				<thead>
					<tr>
						<th class="select"></th>
						<th class="title rid">Restaurant Id</th>
						<th class="title rname">Restaurant Name</th>
						<th class="title lid">Location Id</th>
					</tr>
				</thead>

				<tbody>
					<?php
						while($row=$restaurant_result1 -> fetch_assoc()){
					?>
					<tr>
						<td class="select middle"><input type="radio" name="RES_ID" value=<?php echo $row["RES_ID"];?>></td>
						<td><?php echo $row["RES_ID"];?></td>
						<td><?php echo $row["RES_NAME"];?></td>
						<td><?php echo $row["LOC_NUMBER"];?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
				<input class="deleteBtn" type="submit" name="DELETE" value="Delete restaurant">
				
			<div class="info">
				<div class="form-control">
					<label for="rname">Restaurant Name:</label><input id="rname" type="text" name="RES_NAME">
					<label for="lname">Location:</label>
					<select id="lname" name="LOC_NUMBER">
						<option value = "">Select a location</option>
						<?php
							while($op=$location_result1 -> fetch_assoc()){
						?>
						<option value=<?php echo $op["LOC_ID"];?>><?php echo $op["LOC_CITY"];?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="buttons">
					<input class="addBtn" type="submit" name="ADD" value="Add restaurant">
					<input class="updateBtn" type="submit" name="UPDATE" value="Update restaurant">
				</div>
			</div>
		</form>
	</body>
</html>