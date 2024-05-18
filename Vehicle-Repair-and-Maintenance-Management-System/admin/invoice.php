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
				<li class="active-link">Invoice</li>
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

				// Fetch data from tbl_invoice and join tbl_info to get customer's full name
				$stmt = $pdo->query("SELECT 
                        i.invoiceID, 
                        info.fullName AS customerName, 
                        i.transCode, 
                        i.totalAmount, 
                        i.invoiceDate 
                    FROM tbl_invoice i 
                    INNER JOIN tbl_info info ON i.custID = info.infoID");
				$invoices = $stmt->fetchAll(PDO::FETCH_ASSOC);
				?>

				<table id="example1" class="table table-hover">
					<thead>
						<tr>
							<th class="border-top-0">Invoice No.</th>
							<th class="border-top-0">Customer</th>
							<th class="border-top-0">Transaction Code</th>
							<th class="border-top-0">Total Amount</th>
							<th class="border-top-0">Date</th>
							<th class="border-top-0">Action</th>
						</tr>
					</thead>
					<tbody>
						<?php foreach ($invoices as $invoice): ?>
							<tr>
								<td><?php echo $invoice['invoiceID']; ?></td>
								<td><?php echo $invoice['customerName']; ?></td>
								<td><?php echo $invoice['transCode']; ?></td>
								<td><?php echo 'Php ' . number_format($invoice['totalAmount'], 2); ?></td>
								<td><?php echo date('M d, Y', strtotime($invoice['invoiceDate'])); ?></td>
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