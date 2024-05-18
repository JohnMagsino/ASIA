<!DOCTYPE html>
<html>
<?php include 'includes/header.php';
session_start(); ?>
<link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">

<body>

	<?php include 'includes/topbar.php' ?>
	<?php include 'includes/sidebar.php' ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li class="active-link">Customer</li>
			</ol>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div class="panel-body">
				<div class="col-md-12">
					<form role="form">
						<div class="form-group col-md-12">
							<label>Full Name</label>
							<input class="form-control">
						</div>
						<div class="form-group col-md-12">
							<label>Address</label>
							<textarea class="form-control"></textarea>
						</div>
						<div class="form-group col-md-12">
							<label>Email</label>
							<input class="form-control">
						</div>
						<div class="form-group col-md-12">
							<label>Contact</label>
							<input class="form-control">
						</div>
						<div class="form-group col-md-12">

							<div class="form-group col-md-4">
								<label>Avatar </label>
								<input type="file" class="form-control">
							</div>
							<div class="form-group col-md-8">

								<div class="form-group col-md-12">
									<label>Username</label>
									<input class="form-control">
								</div>
								<div class="form-group col-md-12">
									<label>Paswword</label>
									<input class="form-control">
								</div>
							</div>
						</div>
				</div>
				<button type="submit" class="btn btn-danger">Cancel</button>
				<button type="submit" class="btn btn-primary">Save</button>
			</div>
			</form>
		</div>
	</div>
	</div>
	</div> <!--/.main-->

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