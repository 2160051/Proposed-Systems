<?php
	include 'includes/connection.php';

	$fsic_no = $_GET['fsicNo'];
	$date_received = $_GET['dateReceived'];
	$date_released = $_GET['dateReleased'];
	$name_of_business = $_GET['nameOfBusiness'];
	$type_of_business = $_GET['typeOfBusiness'];
	$name_owner = $_GET['nameOwner'];

	if ($_GET['orNo'] == "") {
		$or_no = "None";
	}else{
		$or_no = $_GET['orNo'];
	}
	
	if ($_GET['remarks'] == "Not Stated") {
		$remarks = "";
	}else{
		$remarks = $_GET['remarks'];
	}

	if ($_GET['new'] == "Not Stated") {
		$new = "";
	}else{
		$new = "checked";
	}

?>
<!DOCTYPE HTML>
<html style="overflow: scroll;">
<head>
	<meta charset="UTF-8">
	<title>FSIC | Edit Document</title>
	<meta charset="UTF-8"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
	<meta name="HandheldFriendly" content="true">
  	<script src='js/jquery-3.3.1.js'></script>
  	<link rel='stylesheet prefetch' href='css/bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/dataTables.bootstrap.min.css'>
	<link rel='stylesheet prefetch' href='css/buttons.bootstrap.min.css'>
	<link rel="stylesheet" href="css/styles.css">
  	<script src="js/jquery.min.js"></script>
  	<script src="js/bootstrap.min.js"></script>
	<link rel="icon" href="images/fsic.ico">
</head>
	<body style="background: none;">

		<nav class="navbar navbar-inverse" role="navigation">
			<div class="container">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#top-navbar-1">
						<span class="sr-only">Toggle navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="navbar-brand" href="client.php"><img src="images/logo2.png" alt="FSIC" height="35" /></a>
				</div>
				<div class="collapse navbar-collapse" id="top-navbar-1">
					<ul class="nav navbar-nav navbar-right">
						<li><a href="client.php" style="color: #444; border: 0;">Home</a></li>
						<li><a href="payments.php">Payments</a></li>
						<li><a href="account.php">Account</a></li>
						<li><a href="logout.php">Logout</a></li>
					</ul>
				</div>
			</div>
		</nav>

	<div style="margin-top: 3%;font-size: 32px;text-align: center;">Edit FSIC Document</div>
	<div style="margin:0 auto;margin-top: 2%;font-size: 18px;width: 35%;">
		<form action="" method="POST">
	        	 <div class="form-group">
				  <div style="text-align: center;">
					  <b>FSIC #:</b>&nbsp;&nbsp;&nbsp;<input type="number" class="form-control" id="schedule" name="fsicNo" min="1" max="10000" style="width: 25%;" value="<?php echo $fsic_no; ?>" required>&nbsp;&nbsp;&nbsp;<b>OR #:</b>&nbsp;&nbsp;&nbsp; 
					  <input type="number" class="form-control" id="schedule" name="orNo" min="1" max="10000" value="<?php echo $or_no; ?>" style="width: 25%;">
				  </div>
				 </div>
				 <div class="form-group">
				  <label for="nameOfBusiness">Name of Business:</label>
				  <input type="text" class="form-control" id="nameOfBusiness" name="nameOfBusiness" maxlength="120" value="<?php echo $name_of_business; ?>" required>
				 </div>
				 <div class="form-group">
				  <label for="typeOfBusiness">Type of Business:</label>
				  <input type="text" class="form-control" id="typeOfBusiness" name="typeOfBusiness" maxlength="120" value="<?php echo $type_of_business; ?>" required>
				 </div>
				 <div class="form-group">
				  <label for="nameOwner">Owner:</label>
				  <input type="nameOwner" value="<?php echo $name_owner; ?>" class="form-control" id="nameOwner" name="nameOwner" maxlength="80" required>
				 </div>
				 <div class="form-group">
				  <div style="text-align: center;">
					  Received:&nbsp;&nbsp;<input type="date" class="form-control" id="schedule" name="dateReceived" style="width: 28%;" value="<?php echo $date_received; ?>" required>&nbsp;&nbsp;&nbsp;Released:&nbsp;&nbsp; 
					  <input type="date" class="form-control" id="schedule" name="dateReleased" style="width: 28%;" value="<?php echo $date_released; ?>" required>
				  </div>
				 </div>
				 <div class="form-group">
				  <label for="remarks">Remarks:</label>
				  <textarea class="form-control" rows="5" maxlength='500' name='remarks' style="resize: none;"><?php echo $remarks; ?></textarea>
				 </div>
				 <div class="checkbox">
				  <label>
				  <input type="checkbox" <?php echo $new; ?> id="new" name="new">New
				  </label>
				 </div>
				<div style="float: right;">
					<input type="submit" class="btn btn-default btn-md" formaction="client.php" value="Go Back" />
					<input type="submit" class="btn btn-primary btn-md" value="Submit" />
				</div>
	          	</form>
	</div>

	<?php 
		if(isset($_POST['submit'])){
			$fsic_no = $_POST['fsicNo'];
			$date_received = $_POST['dateReceived'];
			$date_released = $_POST['dateReleased'];
			$name_of_business = mysqli_real_escape_string($conn, $_POST['nameOfBusiness']);
			$type_of_business = mysqli_real_escape_string($conn, $_POST['typeOfBusiness']);
			$name_owner = mysqli_real_escape_string($conn, $_POST['nameOwner']);

			if ($_POST['orNo'] == "") {
				$or_no = "None";
			}else{
				$or_no = $_POST['orNo'];
			}
			
			if ($_POST['remarks'] == "") {
				$remarks = "Not Stated";
			}else{
				$remarks = mysqli_real_escape_string($conn, $_POST['remarks']);
			}

			if (!isset($_POST['new'])) {
				$new = "Not Stated";
			}else{
				$new = "Yes";
			}

			$query = "UPDATE document SET fsicNo = '$fsic_no', dateReceived = '$date_received', dateReleased = '$date_released', nameOfBusiness = '$name_of_business', typeOfBusiness = '$type_of_business', nameOwner = '$name_owner', orNo = '$or_no', remarks = '$remarks', new = '$new' WHERE fsicNo = '$fsic_no';";

			if(mysqli_query($conn, $query)){
				echo "<script>
					    window.location = 'client.php';
					</script>";
			}else{
				echo "<script>
						alert('An Error Occured. Please Try Again.');
						window.location.href = 'client.php';
					  </script>";
			}
		}
	?>

</body>
</html>