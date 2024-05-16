<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle-Repair-and-Maintenance-Management-System</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet"> <!-- Using CDN for Font Awesome -->
    <link href="../assets/css/datepicker3.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link href="../assets/css/topbar.css" rel="stylesheet">
    <link href="../assets/css/sidebar.css" rel="stylesheet">
</head>
<?php include 'includes/header.php'?>
   <link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css"> 
<body>
	
    <?php include 'includes/topbar.php'?>
    <?php include 'includes/sidebar.php'?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">&nbsp;</em> New Tasks</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
		<div class="panel-body">
						<div class="col-md-12">
							<form role="form">
								<div class="form-group col-md-12">
									<label>Task Name</label>
									<input class="form-control" Placeholder="Task Name">
								</div>
								<div class="form-group col-md-12">
									<label>Description</label>
									<textarea class="form-control">Description here</textarea>
								</div>
								<div class="form-group col-md-12">
									<label>Vehicle Type</label>
									<select class="form-control">
										<option>Car</option>
										<option>Motorcycle</option>
										<option>Truck</option>
									</select>
								</div>
								</div>
									<button type="submit" class="btn btn-danger">Cancel</button>
									<button type="submit" class="btn btn-primary">Save</button>
								</div>
							</form>
						</div>
					</div>
		</div>
	</div>	<!--/.main-->
	
    <?php include 'includes/footer.php'?>
   <!-- DataTables  & Plugins -->
   <script src="../assets/tables/datatables/jquery.dataTables.min.js"></script>
   <script src="../assets/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
   <script src="../assets/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
   <script src="../assets/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
  <script>
      $(function () {
         $("#example1").DataTable();
      });
   </script>
		
</body>

<style>
	body {
    background-color: white;
}
	.page-header{
    font-size: 25px;
    font-weight: bold;
    color: black;
    margin-top: 10px;
	}
</style>
</html>