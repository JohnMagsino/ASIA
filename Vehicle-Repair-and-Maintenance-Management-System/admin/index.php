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
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-users"></i></div>
					<div class="details">
						<div class="number"><?php echo $customerCount; ?></div>
						<div class="label">TOTAL CUSTOMERS</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
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
					<div class="icon"><i class="fa fa-wallet"></i></div>
					<div class="details">
						<div class="number">₱<?php echo number_format($totalRevenue, 2); ?></div>
						<div class="label">TOTAL REVENUE</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
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
			<div class="col-md-12">
				<div class="panel panel-default">
					<div class="panel-heading">
						Sales Overview

						<span class="pull-right clickable panel-toggle panel-button-tab-left"><em
								class="fa fa-toggle-up"></em></span>
					</div>
					<div class="panel-body">
						<div class="canvas-wrapper">
							<canvas class="main-chart" id="line-chart" height="200" width="600"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

		<div class="row">
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Pending Tasks</h4>
						<div class="easypiechart" id="easypiechart-blue" data-percent="92"><span
								class="percent">92%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Completed Tasks</h4>
						<div class="easypiechart" id="easypiechart-orange" data-percent="65"><span
								class="percent">65%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Paid Tasks</h4>
						<div class="easypiechart" id="easypiechart-teal" data-percent="56"><span
								class="percent">56%</span></div>
					</div>
				</div>
			</div>
			<div class="col-xs-6 col-md-3">
				<div class="panel panel-default">
					<div class="panel-body easypiechart-panel">
						<h4>Others</h4>
						<div class="easypiechart" id="easypiechart-red" data-percent="27"><span
								class="percent">27%</span></div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

	</div> <!--/.main-->

	<?php include 'includes/footer.php' ?>

</body>

</html>