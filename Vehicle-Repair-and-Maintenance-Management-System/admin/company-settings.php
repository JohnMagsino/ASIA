<!DOCTYPE html>
<html>
<?php include 'includes/header.php' ?>
<link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">

<body>

	<?php include 'includes/topbar.php' ?>
	<?php include 'includes/sidebar.php' ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li class="active-link">Settings</li>
			</ol>
		</div><!--/.row-->


		<div class="container">
			<div class="logo-container">
				<img src="your-logo.png" alt="Logo" style="max-width: 100%;">
				<button class="btn btn-info">LOGO</button>
			</div>
			<div class="form-container">
				<h2>Company Information</h2>
				<form role="form">
					<div class="form-group">
						<label>Company Name</label>
						<input class="form-control" type="text"
							value="Vehicle-Repair-and-Maintenance-Management-System">
					</div>
					<div class="form-group">
						<label>Address</label>
						<input type="text" class="form-control" value="123 St. Manggahan Pasig City, Philippines 1171">
					</div>
					<div class="form-group">
						<label>TIN</label>
						<input type="text" class="form-control" value="00-00301000199-21">
					</div>
					<div class="form-group">
						<label>Contact</label>
						<input type="text" class="form-control" value="09089786675">
					</div>
					<button type="submit" class="btn btn-success">Update Information</button>
				</form>
			</div>
		</div>
	</div>
	</div>
	</div> <!--/.main-->
	<style>
		.container {
			display: flex;
			justify-content: center;
			align-items: center;
			height: 100vh;
		}

		.logo-container {
			padding: 20px;
			border-right: 1px solid #ddd;
		}

		.form-container {
			padding: 20px;
			max-width: 600px;
			width: 100%;
		}

		.form-group {
			margin-bottom: 15px;
		}

		.form-container label {
			font-weight: bold;
		}

		.form-container input[type="text"],
		.form-container input[type="file"] {
			width: 100%;
			padding: 8px;
			margin-top: 5px;
			margin-bottom: 15px;
			box-sizing: border-box;
		}

		.form-container button {
			background-color: #4CAF50;
			border: none;
			color: white;
			padding: 10px 20px;
			text-align: center;
			text-decoration: none;
			display: inline-block;
			font-size: 16px;
			margin: 4px 2px;
			cursor: pointer;
			border-radius: 5px;
		}
	</style>
	<?php include 'includes/footer.php' ?>
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

</html>