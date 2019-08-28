<?php
$currentItem = 'defect_equipment';
include('sidebar.php');
$protocol = ((!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] != 'off') || $_SERVER['SERVER_PORT'] == 443) ? "https://" : "http://";
$getURI = $protocol . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
$_SESSION['getURI'] = $getURI;
include('process_misc_things.php');
?>
<!DOCTYPE html>
<html>
<head>
	<title>Defect Equipment</title>

	<script src="libs/js/bootstrap.min.min.js"></script>
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
	<link href="vendor/datatables/dataTables.bootstrap4.min.css" rel="stylesheet">
</head>
<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper" style="width: 100% !important;">
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
        <div id="content">
	<?php include('topbar.php'); ?>
<div class="container-fluid">
	<?php
		if(isset($_SESSION['message'])):
	?>
	<div class="alert alert-<?=$_SESSION['msg_type']?> alert-dismissible">
	<a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
		<?php
			echo $_SESSION['message'];
			unset($_SESSION['message']);

		?>
	</div>
	<?php
		endif;
		if($update_equipment){
			echo "<h5 style='color: blue;'>Update ".$peripheral_type."</h5>";
		}
		else{
			//echo "<h5 style='color: blue;'>Stock Room</h5>";
		}
	?>
	<!-- Add Building Here -->
	<div class="row justify-content-center">
	<form action="process_misc_things.php" method="POST">
	</form>
	</div>
	<br/>
	<h5 style="color: blue;">List of Defective Equipments in Stock Room</h5>
	<?php
		$fileName = basename($_SERVER['PHP_SELF']);
		if(!isset($_GET['type'])){
			$current_type = '*';
			$type='All Types';
		}
		else{
			$current_type = $_GET['type'];
			if($current_type=='*'){
				$type = 'All Types';
			}
			else{
				$type = $current_type;	
			}	
		}
	?>
	<table class="table">
		<tr>
			<td>Select Type</td>
			<td>
					
				<select class="form-control" onchange="location = this.value;">
					<option class='text-danger' disabled selected><?php echo $type; ?></option>
					<option value="<?php echo $fileName.'?type=*';?>">All Types</option>
					<option value="<?php echo $fileName.'?type=Monitor';?>">Monitor</option>
					<option value="<?php echo $fileName.'?type=Keyboard';?>">Keyboard</option>
					<option value="<?php echo $fileName.'?type=Mouse';?>">Mouse</option>
					<option value="<?php echo $fileName.'?type=AVR';?>">AVR</option>
					<option value="<?php echo $fileName.'?type=Headset';?>">Headset</option>
					<option value="<?php echo $fileName.'?type=CPU';?>">CPU</option>
					<option value="<?php echo $fileName.'?type=Motherboard';?>">Motherboard</option>
					<option value="<?php echo $fileName.'?type=GPU';?>">GPU</option>
					<option value="<?php echo $fileName.'?type=RAM';?>">RAM</option>
					<option value="<?php echo $fileName.'?type=HDD';?>">HDD</option>
				</select>
			</td>
		</tr>
	</table>
	<div class='row justify-content-center'>
	<?php
	if($current_type=="*"){
		$getStockRooms = mysqli_query($mysqli, "SELECT * FROM peripherals WHERE unit_id='StockRoom' AND peripheral_condition='Not Working'");
	}
	else{
		$getStockRooms = mysqli_query($mysqli, "SELECT * FROM peripherals WHERE unit_id='StockRoom' AND peripheral_type='$current_type' AND peripheral_condition='Not Working'");
	}
	?>
	<table class="table" id="dataTable" width="100%" cellspacing="0">
		<thead>
		<tr>
			<th>Type</th>
			<th>Brand</th>
			<th>Description</th>
			<th>Serial ID</th>
			<th>Date Purchased</th>
			<th>Date Issued</th>
			<th>Condition</th>
			<th>For Repair?</th>
			<th>Actions</th>
		</tr>
		</thead>
			<?php
			if(mysqli_num_rows($getStockRooms)==0){
				echo "<div class='alert alert-warning'>No ".$current_type." currently is defective</div>";
			}
			else{
				while($perripheral_row=$getStockRooms->fetch_assoc()){ ?>
		<tr>
			<td><?php echo $perripheral_row['peripheral_type']; ?></td>
			<td><?php echo $perripheral_row['peripheral_brand']; ?></td>
			<td><?php echo $perripheral_row['peripheral_description']; ?></td>
			<td><?php echo $perripheral_row['peripheral_serial_no']; ?></td>
			<td><?php echo $perripheral_row['peripheral_date_purchased']; ?></td>
			<td><?php echo $perripheral_row['peripheral_date_issued']; ?></td>
			<td><?php echo $perripheral_row['peripheral_condition']; ?></td>
			<td><?php echo $perripheral_row['remarks']; ?></td>
			<td>
			<a class="btn btn-success btn-secondary btn-sm" href="<?php echo $fileName.'?edit='.$perripheral_row['peripheral_id']; ?>"><i class="far fa-edit"></i> Edit</a>
			<button class="btn btn-danger btn-secondary dropdown-toggle btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			<i class="far fa-trash-alt"></i> Delete
					</button><div class="dropdown-menu" aria-labelledby="dropdownMenuButton btn-sm">
					You sure you want to delete? You cannot undo the changes<br/>
						<a href="process_misc_things.php?delete=<?php echo $perripheral_row['peripheral_id'] ?>" class='btn btn-danger btn-sm'><i class="far fa-trash-alt"></i> Confirm Delete</a>
						<a href="#" class='btn btn-success btn-sm'><i class="far fa-window-close"></i> Cancel</a> 
			</div></td>
		</tr>
			<?php	
				}}
			?>
	</table>
	</div>
	<!-- End Here-->
	<?php
	include('footer.php');
?>