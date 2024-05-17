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
				<li class="active-link">Team Members</li> <a href="#" class="btnAddCust btn btn-success"><em
						class="fa fa-user-plus">&nbsp;</em> Add Member</a>
			</ol>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div style="margin:10px">
				<?php
				include 'connection.php';

				// Fetch infoID of admin accounts from tbl_account
				$stmt = $pdo->prepare("SELECT infoID FROM tbl_account WHERE accType = 'admin'");
				$stmt->execute();
				$adminInfoIDs = $stmt->fetchAll(PDO::FETCH_COLUMN);

				// Fetch admin account details from tbl_info using the retrieved infoIDs
				$stmt = $pdo->prepare("SELECT fullName, fullAddress, emailAdd, avatar, accStatus FROM tbl_info WHERE infoID IN (" . implode(",", $adminInfoIDs) . ")");
				$stmt->execute();
				$adminAccounts = $stmt->fetchAll(PDO::FETCH_ASSOC);
				?>

				<table id="example1" class="table table-hover">
					<thead>
						<tr>
							<th class="border-top-0">Full Name</th>
							<th class="border-top-0">Address</th>
							<th class="border-top-0">Email</th>
							<th class="border-top-0">Avatar</th>
							<th class="border-top-0">Account Status</th>
							<th class="border-top-0">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($adminAccounts as $admin): ?>
							<tr>
								<td><?php echo $admin['fullName']; ?></td>
								<td><?php echo $admin['fullAddress']; ?></td>
								<td><?php echo $admin['emailAdd']; ?></td>
								<td><img src="data:image/jpeg;base64,<?php echo base64_encode($admin['avatar']); ?>"
										alt="Avatar" width="50" height="50"></td>
								<td><span class="badge bg-success"><?php echo $admin['accStatus']; ?></span></td>
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