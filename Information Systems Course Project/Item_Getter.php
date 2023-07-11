
<?php 

	$sql = intval($_GET['q']);
	$conn = new  mysqli("localhost:3310", "root", "D0NotHackMySyst3mY0", "tigerfoods");
	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	$items = "SELECT * FROM ITEM WHERE ITEM_RES = '".$sql."'";
	$items_result = $conn -> query($items);
	$conn -> close();
?>
<html>
<head>

</head>

<body>

	<div class="menu">
		<div class="menu-title">Select items</div>
			<?php 
				while($row=$items_result -> fetch_assoc())
				{
			?>	
				<div><div>
					<input type="checkbox" name="item_list[]" id="<?php echo $row['ITEM_NAME'];?>" value=<?php echo $row['ITEM_CODE'];?>>
					<label for="<?php echo $row['ITEM_NAME'];?>" ><?php echo $row['ITEM_NAME'];?></label></div>
					<div>
				<span>P<?php echo $row['ITEM_PRICE'];?></span>
					Qty:<input class="qty" type="number" placeholder="0" name="<?php echo $row['ITEM_CODE'] ?>qty" ></div></div>
			<?php
				}
			?>
	</div>
</body>
</html>