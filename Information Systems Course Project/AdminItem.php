<?php 

$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

if($conn -> connect_error){
	die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}
session_start();
$item = "SELECT * FROM tigerfoods.ITEM";
$item_result = $conn -> query($item);

$restaurant = "SELECT * FROM tigerfoods.RESTAURANT";
$restaurant_result = $conn -> query($restaurant);
$conn -> close();
?>

<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin Item Records</title>
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
		<form action="AdminItemUpdate.php" method="POST">
		<table>
			<caption>Item Records</caption>
			<thead>
				<tr>
					<th class="select"></th>
					<th class="title icode">Item Code</th>
					<th class="title iname">Item Name</th>
					<th class="title iprice">Item Price</th>
					<th class="title rid">Restaurant Id</th>
				</tr>
			</thead>

			<tbody>
				<?php
					while($row=$item_result -> fetch_assoc()){
				?>
				<tr>
					<td class="select middle"><input type="radio" name="ITEM_CODE" value=<?php echo $row["ITEM_CODE"];?>></td>
					<td><?php echo $row["ITEM_CODE"];?></td>
					<td><?php echo $row["ITEM_NAME"];?></td>
					<td><?php echo $row["ITEM_PRICE"];?></td>
					<td><?php echo $row["ITEM_RES"];?></td>
				</tr>
				<?php
					}
				?>
				</tbody>
			</table>
			<input class="deleteBtn" type="submit" name="DELETE" value="Delete item">
			
			<div class="info">
				<div class="form-control">
					<label for="name">Item Name:</label><input id="name" type="text" name="ITEM_NAME">
					<label for="price">Item Price:</label><input id="price" type="number" name="ITEM_PRICE" placeholder="Currency Unit: Philippine Peso (PHP)">
					<label for="restaurant">Restaurant:</label>
					<select id="restaurant" name="ITEM_RES">
						<option value="">Select a restaurant</option>
						<?php
							while($op=$restaurant_result -> fetch_assoc()){
						?>
						<option value=<?php echo $op["RES_ID"];?>><?php echo $op["RES_NAME"];?></option>
						<?php
							}
						?>
					</select>
				</div>
				<div class="buttons">
					<input class="addBtn" type="submit" name="ADD" value="Add item">
					<input class="updateBtn" type="submit" name="UPDATE" value="Update item">
				</div>
			</div>
		</form>
	</body>
</html>