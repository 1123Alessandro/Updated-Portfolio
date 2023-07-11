<?php 

$conn = new  mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

if($conn -> connect_error){
	die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
}

$restaurant = "SELECT * FROM tigerfoods.RESTAURANT";
$restaurant_result = $conn -> query($restaurant);
?>

<html>
<head>
	<title>Restaurant selection test</title>
</head>
<body>
	<form action="PlaceOrder.php" method="POST">
		<h1>First name:</h1><input type="text" name="CUS_FNAME"> 
		<h1>Last name:</h1><input type="text" name="CUS_LNAME"> 
		<h1>Contact Number:</h1><input type="number" name="CUS_CNUMBER"> 

		<h1>Select Restaurant</h1>
		<select id="select_res" onchange="selectRestaurant(this.value)">
			<?php 
				while($op = $restaurant_result -> fetch_assoc()){
			?>
				<option value = <?php echo $op["RES_ID"];?>><?php echo $op["RES_NAME"];?></option>
			<?php
				}
			?>
		</select>
		<div class="menu" id="menu">
		</div>

		<h1>Payment Detais</h1>
		<p>Pay Type</p>
		<input type="radio" name="pay_type" value="GCash">
		<label>Gcash</label>
		<input type="radio" name="pay_type" value="CreditCard">
		<label>Credit Card</label>
		<input type="radio" name="pay_type" value="Cash">
		<label>Cash on Delivery</label>
		<br>
		<input type="submit" value="PLACE">
	</form>
	<script>
		function selectRestaurant(str){
			if(str == ""){
				document.getElementById("menu").innerHTML="";
				return;
			}
			else{
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function(){
					if(this.readyState == 4 && this.status == 200){
						document.getElementById("menu").innerHTML = this.responseText;
					}
				};
				xmlhttp.open("GET", "Item_Getter.php?q=" + str, true);
				xmlhttp.send();
			}
		}
	</script>
</body>
</html>