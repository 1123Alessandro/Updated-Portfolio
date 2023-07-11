<?php 

$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

if($conn -> connect_error){
	die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}
session_start();
$rider = "SELECT * FROM tigerfoods.RIDER"; 
$rider_result = $conn -> query($rider);

$conn -> close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Rider Records</title>
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
		<form action="AdminRiderUpdate.php" method = "POST">
			<table>
				<caption>Rider Records</caption>
				<thead>
					<tr>
						<th class="select"></th>
						<th class="title rid">Rider Id</th>
						<th class="title fname">First Name</th>
						<th class="title lname">Last Name</th>
						<th class="title cnumber">Contact Number</th>
					</tr>
				</thead>

				<tbody>
					<?php
						while($row=$rider_result -> fetch_assoc()){
					?>
					<tr>
						<td class="select middle"><input type="radio" name="RIDER_ID" value=<?php echo $row["RIDER_ID"];?>></td>
						<td><?php echo $row["RIDER_ID"];?></td>
						<td><?php echo $row["RIDER_FNAME"];?></td>
						<td><?php echo $row["RIDER_LNAME"];?></td>
						<td><?php echo $row["RIDER_CONTACT_NUMBER"];?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
				<input class="deleteBtn" type="submit" name="DELETE" value="Delete rider">
				
			<div class="info">
				<div class="form-control">
					<label for="fname">First Name:</label><input id="fname" type="text" name="RIDER_FNAME">
					<label for="lname">Last Name:</label><input id="lname" type="text" name="RIDER_LNAME">
					<label for="cnumber">Contact Number:</label><input id="cnumber" type="number" name="RIDER_CONTACT_NUMBER">
				</div>
				<div class="buttons">
					<input class="addBtn" type="submit" name="ADD" value="Add rider">
					<input class="updateBtn" type="submit" name="UPDATE" value="Update rider">
				</div>
			</div>
		</form>
	</body>
</html>