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
				<li class="active-link">Customer</li> <a href="add-customer.php" class="btnAddCust btn btn-success">
					<em class="fa fa-plus">&nbsp;</em> Add customer</a>
			</ol>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div style="margin:10px">
				<?php
				include 'connection.php';
				$stmt = $pdo->query("SELECT infoID FROM tbl_account WHERE accType = 'customer'");
				$infoIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);

				// Fetch data from tbl_info using infoID
				$placeholders = str_repeat('?,', count($infoIDs) - 1) . '?';
				$stmt = $pdo->prepare("SELECT * FROM tbl_info WHERE infoID IN ($placeholders)");
				$stmt->execute($infoIDs);
				$customers = $stmt->fetchAll(PDO::FETCH_ASSOC);
				?>

				<table id="example1" class="table table-hover">
					<thead>
						<tr>
							<th class="border-top-0">Full Name</th>
							<th class="border-top-0">Address</th>
							<th class="border-top-0">Email</th>
							<th class="border-top-0">Contact</th>
							<th class="border-top-0">Avatar</th>
							<th class="border-top-0">Account Status</th>
							<th class="border-top-0">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($customers as $customer): ?>
							<tr>
								<td><?php echo $customer['fullName']; ?></td>
								<td><?php echo $customer['fullAddress']; ?></td>
								<td><?php echo $customer['emailAdd']; ?></td>
								<td><?php echo $customer['contactNo']; ?></td>
								<td>
									<?php
									$avatar = base64_encode($customer['avatar']);
									echo '<img src="data:image/jpeg;base64,' . $avatar . '" width="50" style="border-radius:5px">';
									?>
								</td>
								<td><span class="badge bg-success"><?php echo $customer['accStatus']; ?></span></td>
								<td>
									<ul class="pull-right panel-settings" style="border:none">
										<li class="dropdown">
											<a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
												<em class="fa fa-cogs"></em>
											</a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li>
													<ul class="dropdown-settings">
														<li><a href="#"><em class="fa fa-eye"></em> view</a></li>
														<li><a href="#"><em class="fa fa-edit"></em> edit</a></li>
														<li class="divider"></li>
														<li><a href="#"><em class="fa fa-trash"></em> delete</a></li>
													</ul>
												</li>
											</ul>
										</li>
									</ul>
								</td>
							</tr>
						<?php endforeach; ?>
					</tbody>
				</table>

			</div><!--/.row-->
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