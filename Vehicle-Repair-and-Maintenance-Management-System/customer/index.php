<?php
session_start();
include 'connection.php';

// Your existing login handling code
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $stmt = $pdo->prepare("SELECT infoID, email, password FROM tbl_account WHERE email = ?");
    $stmt->execute([$email]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['infoID'] = $user['infoID']; // Set the infoID in the session
        header("Location: profile.php");
        exit;
    } else {
        // Handle login failure
        $loginError = "Invalid email or password.";
    }
}

// Query for total invoices count
$stmt = $pdo->prepare("SELECT COUNT(*) as count FROM tbl_invoice");
$stmt->execute();
$invoiceCount = $stmt->fetch()['count'];

// Query for total payment
$stmt = $pdo->prepare("SELECT SUM(totalAmount) as totalPayment FROM tbl_invoice");
$stmt->execute();
$totalPayment = $stmt->fetch()['totalPayment'];

// Query for total balance
$stmt = $pdo->prepare("SELECT SUM(payBalance) as totalBalance FROM tbl_payment");
$stmt->execute();
$totalBalance = $stmt->fetch()['totalBalance'];

// Query for total transactions
$stmt = $pdo->prepare("SELECT COUNT(*) as totalTransaction FROM tbl_invoice WHERE transCode IS NOT NULL");
$stmt->execute();
$totalTransaction = $stmt->fetch()['totalTransaction'];

// Query for task status counts
$stmt = $pdo->prepare("SELECT taskStatus, COUNT(*) as count FROM tbl_tasks GROUP BY taskStatus");
$stmt->execute();
$statusCounts = $stmt->fetchAll(PDO::FETCH_KEY_PAIR);

// Query for total payments over time
$stmt = $pdo->prepare("SELECT DATE_FORMAT(payDate, '%Y-%m') as month, SUM(payAmount) as totalPayment FROM tbl_payment GROUP BY month ORDER BY month");
$stmt->execute();
$paymentData = $stmt->fetchAll(PDO::FETCH_ASSOC);
$months = array_column($paymentData, 'month');
$payments = array_column($paymentData, 'totalPayment');
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle-Repair-and-Maintenance-Management-System</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <link href="../assets/css/datepicker3.css" rel="stylesheet">
    <link href="../assets/css/styles.css" rel="stylesheet">
    <link href="../assets/css/topbar.css" rel="stylesheet">
    <link href="../assets/css/sidebar.css" rel="stylesheet">
</head>
<body>
    <?php include 'includes/header.php' ?>
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
                        <div class="number"><?php echo $invoiceCount; ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-panel">
                    <div class="icon"><i class="fa fa-money-bill"></i></div>
                    <div class="details">
                        <div class="label">TOTAL PAYMENT</div>
                        <div class="number">₱<?php echo number_format($totalPayment, 2); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-panel">
                    <div class="icon"><i class="fa fa-coins"></i></div>
                    <div class="details">
                        <div class="label">TOTAL BALANCE</div>
                        <div class="number">₱<?php echo number_format($totalBalance, 2); ?></div>
                    </div>
                </div>
            </div>
            <div class="col-md-3">
                <div class="dashboard-panel">
                    <div class="icon"><i class="fa fa-clipboard-list"></i></div>
                    <div class="details">
                        <div class="label">TOTAL TRANSACTION</div>
                        <div class="number"><?php echo $totalTransaction; ?></div>
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
                        <ul class="list-inline text-center mt-3" id="status-list">
                            <!-- Status labels will be injected here by JavaScript -->
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
        // Pass PHP data to JavaScript
        var taskStatusData = <?php echo json_encode($statusCounts); ?>;
        var paymentMonths = <?php echo json_encode($months); ?>;
        var paymentAmounts = <?php echo json_encode($payments); ?>;

        // Prepare data for the pie chart
        var labels = Object.keys(taskStatusData);
        var data = Object.values(taskStatusData);

        // Pie chart
        var ctxP = document.getElementById('pie-chart').getContext('2d');
        var pieChart = new Chart(ctxP, {
            type: 'pie',
            data: {
                datasets: [{
                    data: data,
                    backgroundColor: ['#4CAF50', '#FFEB3B', '#FF9800', '#F44336']
                }]
            },
            options: {
                responsive: true
            }
        });

        // Generate status labels dynamically
        var statusList = document.getElementById('status-list');
        var backgroundColors = ['#4CAF50', '#FFEB3B', '#FF9800', '#F44336'];

        labels.forEach((label, index) => {
            var listItem = document.createElement('li');
            listItem.innerHTML = `<span class="dot" style="background-color:${backgroundColors[index]};"></span> ${label}`;
            statusList.appendChild(listItem);
        });

        // Line chart
        var ctxL = document.getElementById('line-chart').getContext('2d');
        var lineChart = new Chart(ctxL, {
            type: 'line',
            data: {
                labels: paymentMonths,
                datasets: [{
                    label: 'Total Payment',
                    data: paymentAmounts,
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
    border-radius: 15px;
    padding: 25px; /* Increased padding */
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 20px;
    box-shadow: 0 4px 8px rgba(0, 0, 0, 0.2);
    color: white;
}

.dashboard-panel .icon {
    background-color: #72CD4B;
    border-radius: 50%;
    padding: 20px; /* Increased padding */
    display: flex;
    align-items: center;
    justify-content: center;
    min-width: 60px; /* Ensure consistent size */
    min-height: 60px; /* Ensure consistent size */
    font-size: 24px; /* Ensure consistent size */
}

.dashboard-panel .icon i {
    color: #1E1E1E;
}

.dashboard-panel .details {
    text-align: center;
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
    max-width: 450px;
    margin: 0 auto;
    border-radius: 8px;
    overflow: hidden;
    padding: 20px; /* Added padding */
}

.panel-dark {
    background-color: #1E1E1E;
    border-color: #333;
    color: #fff;
    border-radius: 15px; /* Ensure border radius for all corners */
}

.panel-dark .panel-heading {
    background-color: #1E1E1E;
    border-color: #444;
    color: white;
    border-top-left-radius: 15px; /* Top-left border radius */
    border-top-right-radius: 15px; /* Top-right border radius */
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