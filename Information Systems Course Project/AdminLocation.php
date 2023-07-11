<?php 

$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

if($conn -> connect_error){
	die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}
session_start();
$location = "SELECT * FROM tigerfoods.LOCATION";
$location_result = $conn -> query($location);
$conn -> close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Location Records</title>
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
		<form action="AdminLocationUpdate.php" method="POST">
			<table>
				<caption>Location Records</caption>
				<thead>
					<tr>
						<th class="select"></th>
						<th class="title lid">Location Id</th>
						<th class="title cname">City Name</th>
						<th class="title sname">Street Name</th>
						<th class="title bnumber">Building Number</th>
					</tr>
				</thead>

				<tbody>
					<?php
						while($row=$location_result -> fetch_assoc()){
					?>
					<tr>
						<td class="select middle"><input type="radio" name="LOC_ID" value=<?php echo $row["LOC_ID"];?>></td>
						<td><?php echo $row["LOC_ID"];?></td>
						<td><?php echo $row["LOC_CITY"];?></td>
						<td><?php echo $row["LOC_STREET"];?></td>
						<td><?php echo $row["LOC_BNUM"];?></td>
					</tr>
					<?php
						}
					?>
				</tbody>
			</table>
				<input class="deleteBtn" type="submit" name="DELETE" value="Delete location">
				
			<div class="info">
				<div class="form-control">
					<label for="cname">City Name:</label><input id="cname" type="text" name="LOC_CITY">
					<label for="sname">Street Name:</label><input id="sname" type="text" name="LOC_STREET">
					<label for="bnumber">Building Number:</label><input id="bnumber" type="number" name="LOC_BNUM">
				</div>
				<div class="buttons">
					<input class="addBtn" type="submit" name="ADD" value="Add location">
					<input class="updateBtn" type="submit" name="UPDATE" value="Update location">
				</div>
			</div>
		</form>
	</body>
</html>