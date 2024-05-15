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
<?php include 'includes/header.php' ?>

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
					<div class="icon"><i class="fas fa-receipt"></i></div>
					<div class="details">
						<div class="label">TOTAL INVOICE</div>
						<div class="number">123</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-money-bill"></i></i></div>
					<div class="details">
						<div class="label">TOTAL PAYMENT</div>
						<div class="number">₱20,000</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-coins"></i></div>
					<div class="details">
						<div class="label">TOTAL BALANCE</div>
						<div class="number">₱120,000</div>
					</div>
				</div>
			</div>
			<div class="col-md-3">
				<div class="dashboard-panel">
					<div class="icon"><i class="fa fa-clipboard-list"></i></div>
					<div class="details">
						<div class="label">TOTAL TRANSACTIONS</div>
						<div class="number">213</div>
					</div>
				</div>
			</div>
		</div>
		<!-- Add more panels or content below as needed -->
		<div class="row">
			<div class="col-md-6">
				<div class="panel panel-default panel-dark">
					<div class="panel-heading">
						Task Completion Status Overview
					</div>
					<div class="panel-body">
						<div class="chart-container">
							<canvas id="pie-chart"></canvas>
						</div>
						<ul class="list-inline text-center mt-3">
							<li><span class="dot color-green"></span> Completed Tasks</li>
							<li><span class="dot color-yellow"></span> Paid Tasks</li>
							<li><span class="dot color-orange"></span> Pending Tasks</li>
							<li><span class="dot color-red"></span> Not Started</li>
						</ul>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="panel panel-default panel-dark">
					<div class="panel-heading">
						Total Payment Over Time
					</div>
					<div class="panel-body">
						<div class="chart-container">
							<canvas id="line-chart"></canvas>
						</div>
					</div>
				</div>
			</div>
		</div><!--/.row-->

	</div> <!--/.main-->

	<?php include 'includes/footer.php' ?>

	<!-- Include Chart.js -->
	<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

	<script>
		// Pie chart
		var ctxP = document.getElementById('pie-chart').getContext('2d');
		var pieChart = new Chart(ctxP, {
			type: 'pie',
			data: {
				labels: ['Completed Tasks', 'Paid Tasks', 'Pending Tasks', 'Not Started'],
				datasets: [{
					data: [40, 20, 20, 20], // Example data
					backgroundColor: ['#4CAF50', '#FFEB3B', '#FF9800', '#F44336']
				}]
			},
			options: {
				responsive: true
			}
		});

		// Line chart
		var ctxL = document.getElementById('line-chart').getContext('2d');
		var lineChart = new Chart(ctxL, {
			type: 'line',
			data: {
				labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun', 'Jul'], // Example labels
				datasets: [{
					label: 'Total Payment',
					data: [1000, 2000, 1500, 3000, 2500, 3500, 4000], // Example data
					backgroundColor: 'rgba(76, 175, 80, 0.1)',
					borderColor: '#4CAF50',
					borderWidth: 2
				}]
			},
			options: {
				responsive: true
			}
		});
	</script>
</body>

<style>
	body {
		background-color: white;
	}

	.breadcrumb {
		background-color: white;
	}

	.active-link {
		font-size: 25px;
		font-weight: bold;
		color: black;
		margin-top: 10px;
	}

	.panel-container {
		margin-top: 20px;
	}

	.dashboard-panel {
		background-color: #1E1E1E;
		/* Changed color */
		border-radius: 20px;
		padding: 20px;
		display: flex;
		align-items: center;
		justify-content: space-between;
		margin-bottom: 20px;
		box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
		color: white;
		/* Added color white for text */
	}

	.dashboard-panel .icon {
		background-color: #72CD4B;
		border-radius: 50%;
		padding: 15px;
		display: flex;
		align-items: center;
		justify-content: center;
	}

	.dashboard-panel .icon i {
		color: #1E1E1E;
		font-size: 24px;
	}

	.dashboard-panel .details {
		text-align: right;
	}

	.dashboard-panel .details .number {
		font-size: 24px;
		font-weight: bold;
	}

	.dashboard-panel .details .label {
		font-size: 14px;
		color: gray;
	}

	.chart-container {
		width: 100%;
		max-width: 400px;
		margin: 0 auto;
		border-radius: 8px;
		overflow: hidden;

	}

	.panel-dark {
		background-color: #1E1E1E;
		border-color: #333;
		color: #fff;
		border-bottom-left-radius: 15px;
		border-bottom-right-radius: 15px;
	}

	.panel-dark .panel-heading {
		background-color: #1E1E1E;
		border-color: #444;
		color: white;
	}

	.color-green {
		color: #4CAF50;
	}

	.color-yellow {
		background-color: #FFEB3B;
	}

	.color-orange {
		background-color: #FF9800;
	}

	.color-red {
		background-color: #F44336;
	}

	.dot {
		height: 10px;
		width: 10px;
		background-color: #bbb;
		border-radius: 50%;
		display: inline-block;
	}

	.list-inline {
		padding-left: 0;
		list-style: none;
	}

	.list-inline>li {
		display: inline;
		padding-right: 10px;
	}
</style>

</html>