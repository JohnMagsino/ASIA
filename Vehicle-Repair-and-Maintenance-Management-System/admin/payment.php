<!DOCTYPE html>
<html>
<?php include 'includes/header.php';
session_start();
?>
<link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">

<body>

	<?php include 'includes/topbar.php' ?>
	<?php include 'includes/sidebar.php' ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li class="active-link">Payment</li> <a href="add-customer.php" class="btnAddCust btn btn-success"><em
						class="fa fa-plus">&nbsp;</em> Add Payment</a>
			</ol>
		</div><!--/.row-->

		<div class="panel panel-container">
			<div style="margin:10px">
				<?php
				if (session_status() == PHP_SESSION_NONE) {
					// Start the session
					session_start();
				}
				include 'connection.php';

				// Fetch data from tbl_payment
				$stmt = $pdo->query("SELECT 
                        invoiceNo, 
                        payDate, 
                        payAmount, 
                        payBalance, 
                        payStatus 
                    FROM tbl_payment");
				$payments = $stmt->fetchAll(PDO::FETCH_ASSOC);
				?>

				<table id="example1" class="table table-hover">
					<thead>
						<tr>
							<th class="border-top-0">Invoice No.</th>
							<th class="border-top-0">Payment Date</th>
							<th class="border-top-0">Amount</th>
							<th class="border-top-0">Balance</th>
							<th class="border-top-0">Status</th>
							<th class="border-top-0">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($payments as $payment): ?>
							<tr>
								<td><?php echo $payment['invoiceNo']; ?></td>
								<td><?php echo date('M d, Y', strtotime($payment['payDate'])); ?></td>
								<td><?php echo 'Php ' . number_format($payment['payAmount'], 2); ?></td>
								<td><?php echo 'Php ' . number_format($payment['payBalance'], 2); ?></td>
								<td><span class="badge bg-warning"><?php echo $payment['payStatus']; ?></span></td>
								<td>
									<ul class="pull-right panel-settings" style="border:none">
										<li class="dropdown">
											<a class="pull-right dropdown-toggle" data-toggle="dropdown" href="#">
												<em class="fa fa-cogs"></em>
											</a>
											<ul class="dropdown-menu dropdown-menu-right">
												<li>
													<ul class="dropdown-settings">
														<li><a href="#"><em class="fa fa-eye"></em> view invoice</a></li>
														<li><a href="#"><em class="fa fa-download"></em> download</a></li>
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