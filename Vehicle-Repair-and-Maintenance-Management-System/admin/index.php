<!DOCTYPE html>
<html>
<?php include 'includes/header.php' ?>
<?php
include 'connection.php';

// Query for total customers
$stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tbl_account WHERE accType = 'customer'");
$stmt->execute();
$customerCount = $stmt->fetch()['count'];

// Query for total team members
$stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tbl_account WHERE accType = 'admin'");
$stmt->execute();
$adminCount = $stmt->fetch()['count'];

// Calculate total revenue
$stmt = $pdo->query("SELECT SUM(payAmount) AS totalRevenue FROM tbl_payment");
$totalRevenue = $stmt->fetch(PDO::FETCH_ASSOC)['totalRevenue'];

// Calculate total balances
$stmt = $pdo->query("SELECT SUM(payBalance) AS totalBalances FROM tbl_payment");
$totalBalances = $stmt->fetch(PDO::FETCH_ASSOC)['totalBalances'];

// Query for total revenue over time
$stmt = $pdo->query("SELECT DATE(payDate) AS date, SUM(payAmount) AS totalRevenue FROM tbl_payment GROUP BY DATE(payDate)");
$totalRevenueData = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query for top vehicle types
$stmt = $pdo->query("SELECT vehicleType, COUNT(*) AS count FROM tbl_tasks GROUP BY vehicleType ORDER BY count DESC LIMIT 5");
$topVehicleTypes = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query for top customers
$stmt = $pdo->query("SELECT custID, SUM(totalAmount) AS totalAmount FROM tbl_invoice GROUP BY custID ORDER BY totalAmount DESC LIMIT 5");
$topCustomers = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Query for task completion status overview
$stmt = $pdo->query("SELECT taskStatus, COUNT(*) AS count FROM tbl_tasks GROUP BY taskStatus");
$taskStatusOverview = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<body>

	<?php include 'includes/topbar.php' ?>
	<?php include 'includes/sidebar.php' ?>

	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		<div class="row">
			<ol class="breadcrumb">
				<li class="active-link">Dashboard</li>
			</ol>
		</div><!--/.row-->

		<div class="row">
			<div class="col-md-3">
				<!-- Total Customers panel -->
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-users"></i></div>
					<div class="details">
						<div class="number"><?php echo $customerCount; ?></div>
						<div class="label">TOTAL CUSTOMERS</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<!-- Total Team Members panel -->
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-home"></i></div>
					<div class="details">
						<div class="number"><?php echo $adminCount; ?></div>
						<div class="label">TOTAL TEAM MEMBERS</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-briefcase"></i></div>
					<div class="details">
						<div class="number">₱<?php echo number_format($totalRevenue, 2); ?></div>
						<div class="label">TOTAL REVENUE</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<!-- Total Balances panel -->
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-money"></i></div>
					<div class="details">
						<div class="number">₱<?php echo number_format($totalBalances, 2); ?></div>
						<div class="label">TOTAL BALANCES</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Add more panels or content below as needed -->
		<div class="row">
			<div class="col-md-9">
					<div class="panel panel-default">
						<div class="panel-heading">
							Revenue Over Time
						</div>
						<div class="panel-body">
							<div class="canvas-wrapper">
								<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
							</div>
						</div>
					</div>

			</div>

			<div class="col-md-3">
				<div class="panel panel-default">
					<div class="panel-heading">
						Top Vehicle Types
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Vehicle Type</th>
									<th>Count</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($topVehicleTypes as $vehicleType): ?>
									<tr>
										<td><?php echo $vehicleType['vehicleType']; ?></td>
										<td><?php echo $vehicleType['count']; ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Top Customers
					</div>
					<div class="panel-body">
						<table class="table table-striped">
							<thead>
								<tr>
									<th>Customer ID</th>
									<th>Total Amount</th>
								</tr>
							</thead>
							<tbody>
								<?php foreach ($topCustomers as $customer): ?>
									<tr>
										<td><?php echo $customer['custID']; ?></td>
										<td><?php echo number_format($customer['totalAmount'], 2); ?></td>
									</tr>
								<?php endforeach; ?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default">
					<div class="panel-heading">
						Task Completion Status Overview
					</div>
					<div class="panel-body">
						<canvas id="task-status-chart" height="300"></canvas>
					</div>
				</div>
			</div>
		</div><!--/.row-->
		<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>

		<script>
			// Get task status data
			var taskStatusData = <?php echo json_encode(array_column($taskStatusOverview, 'count')); ?>;
			var taskStatusLabels = <?php echo json_encode(array_column($taskStatusOverview, 'taskStatus')); ?>;

			// Create pie chart
			var ctx = document.getElementById('task-status-chart').getContext('2d');
			var taskStatusChart = new Chart(ctx, {
				type: 'pie',
				data: {
					labels: taskStatusLabels,
					datasets: [{
						label: 'Task Completion Status',
						data: taskStatusData,
						backgroundColor: [
							'rgba(255, 99, 132, 0.7)',
							'rgba(54, 162, 235, 0.7)',
							'rgba(255, 206, 86, 0.7)',
							'rgba(75, 192, 192, 0.7)',
						],
						borderColor: [
							'rgba(255, 99, 132, 1)',
							'rgba(54, 162, 235, 1)',
							'rgba(255, 206, 86, 1)',
							'rgba(75, 192, 192, 1)',
						],
						borderWidth: 1
					}]
				},
				options: {
					responsive: true,
					plugins: {
						legend: {
							position: 'bottom',
						}
					}
				}
			});
		</script>
	</div><!--/.row-->

	</div> <!--/.main-->

	<?php include 'includes/footer.php' ?>

	<!-- Include JavaScript libraries for charts (e.g., Chart.js) -->
	<script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
	<script>
		// JavaScript code to render charts using fetched data
		var ctx = document.getElementById('line-chart').getContext('2d');
		var lineChart = new Chart(ctx, {
			type: 'line',
			data: {
				labels: <?php echo json_encode(array_column($totalRevenueData, 'date')); ?>,
				datasets: [{
					label: 'Revenue Trend',
					data: <?php echo json_encode(array_column($totalRevenueData, 'totalRevenue')); ?>,
					borderColor: 'rgba(255, 99, 132, 1)',
					backgroundColor: 'rgba(255, 99, 132, 0.2)',
					fill: true,
				}]
			},

		});
	</script>
</body>

</html>