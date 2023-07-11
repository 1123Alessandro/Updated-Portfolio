<?php
	$conn = new mysqli("localhost:3310", "root", "nigelsql0321", "tigerfoods");

	if($conn -> connect_error){
		die("Connect Error (".@mysqli -> connect_errno.")".@mysqli -> connect_error);
	}
	$customer = "SELECT * FROM tigerfoods.CUSTOMER";
	$customer_result1 = $conn -> query($customer);
	$customer_result2 = $conn -> query($customer);

	$location = "SELECT * FROM tigerfoods.LOCATION";
	$location_result1 = $conn -> query($location);
	if(isset($_POST['ADD'])){
		$CUS_LNAME = $_REQUEST['CUS_LNAME']; 
		$CUS_FNAME = $_REQUEST['CUS_FNAME'];
		$CUS_CONTACT_NUMBER = $_REQUEST['CUS_CNUMBER'];
		$LOC_NUMBER = $_REQUEST['CUS_LOCATION'];
		echo $CUS_LNAME;
		echo $CUS_FNAME;
		echo $CUS_CONTACT_NUMBER;
		echo $LOC_NUMBER;
		$sql = "INSERT INTO CUSTOMER(CUS_LNAME, CUS_FNAME, CUS_CONTACT_NUMBER, LOC_NUMBER) VALUES('$CUS_LNAME', '$CUS_FNAME', '$CUS_CONTACT_NUMBER', '$LOC_NUMBER')";
		if(mysqli_query($conn, $sql)){
			echo "Customer was added";
		}
		else{
			echo mysql_error($conn);
		}
		
	}
	elseif(isset($_POST['UPDATE'])){
		$CUS_LNAME = $_REQUEST['CUS_LNAME']; 
		$CUS_FNAME = $_REQUEST['CUS_FNAME'];
		$CUS_CONTACT_NUMBER = $_REQUEST['CUS_CNUMBER'];
		$LOC_NUMBER = $_REQUEST['CUS_LOCATION'];
		$CUS_ID = $_REQUEST['CUS_ID'];
		echo $CUS_LNAME;
		echo $CUS_FNAME;
		echo $CUS_CONTACT_NUMBER;
		echo $LOC_NUMBER;
		
		$origin = "SELECT * FROM CUSTOMER WHERE CUS_CODE = $CUS_ID";
		$result = $conn -> query($origin);
		$rows = $result -> fetch_assoc();

		if($CUS_LNAME != "" AND $CUS_LNAME != $rows['CUS_LNAME']){
			$CUS_LNAME = $CUS_LNAME;
		}
		else{
			$CUS_LNAME = $rows['CUS_LNAME'];
		}

		if($CUS_FNAME != "" AND $CUS_FNAME != $rows['CUS_FNAME']){
			$CUS_FNAME = $CUS_FNAME;
		}
		else{
			$CUS_FNAME = $rows['CUS_FNAME'];
		}

		if($CUS_CONTACT_NUMBER != "" AND $CUS_CONTACT_NUMBER != $rows['CUS_CODE']){
			$CUS_CONTACT_NUMBER = $CUS_CONTACT_NUMBER;
		}
		else{
			$CUS_CONTACT_NUMBER = $rows['CUS_CODE'];
		}


		if($LOC_NUMBER != "" AND $LOC_NUMBER != $rows['LOC_NUMBER']){
			$LOC_NUMBER = $LOC_NUMBER;
		}
		else{
			$LOC_NUMBER = $rows['LOC_NUMBER'];
		}
		$sql = "UPDATE CUSTOMER SET CUS_FNAME = '$CUS_FNAME', CUS_LNAME = '$CUS_LNAME', CUS_CONTACT_NUMBER = '$CUS_CONTACT_NUMBER', LOC_NUMBER = '$LOC_NUMBER' WHERE CUS_CODE = '$CUS_ID'";
		if(mysqli_query($conn, $sql)){
			echo "Data is now updated";
		}
		else{
			echo mysql_error($conn);
		}
	}

	elseif(isset($_POST['DELETE'])){
		$CUS_ID = $_REQUEST['CUS_ID'];
		$sql = "DELETE FROM CUSTOMER WHERE CUS_CODE = $CUS_ID";
		if(mysqli_query($conn,$sql)){
			echo "Customer is now deleted";
		}
		else{
			echo mysqli_error($conn);
		}
	}
?>
<html>
<head>
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
		</select>
		<br>
		<input type="submit" name= "ADD" value="Add a customer">
		<input type="submit" name= "UPDATE" value="Update a customer">
	</form>
</body>
</html>

