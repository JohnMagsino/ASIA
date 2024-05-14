<!DOCTYPE html>
<html>
<?php include 'includes/header.php' ?>
<body>
    
    <?php include 'includes/topbar.php' ?>
    <?php include 'includes/sidebar.php' ?>
        
    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <ol class="breadcrumb">
                <li><a href="#">
                    <em class="fa fa-home"></em>
                </a></li>
                <li class="active">Dashboard</li>
            </ol>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header"><em class="fa fa-tachometer">&nbsp;</em> Dashboard</h1>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-widget panel-dark">
                    <div class="row no-padding"><em class="fa fa-xl fa-file-text color-green"></em>
                        <div class="large">123</div>
                        <div class="text-muted">Total Invoice</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-widget panel-dark">
                    <div class="row no-padding"><em class="fa fa-xl fa-money color-green"></em>
                        <div class="large">₱20,000</div>
                        <div class="text-muted">Total Payment</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-widget panel-dark">
                    <div class="row no-padding"><em class="fa fa-xl fa-money color-green"></em>
                        <div class="large">₱120,000</div>
                        <div class="text-muted">Total Balance</div>
                    </div>
                </div>
            </div>
            <div class="col-xs-6 col-md-3 col-lg-3 no-padding">
                <div class="panel panel-widget panel-dark">
                    <div class="row no-padding"><em class="fa fa-xl fa-file color-green"></em>
                        <div class="large">213</div>
                        <div class="text-muted">Total Transactions</div>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
        <div class="row">
            <div class="col-md-6">
                <div class="panel panel-default panel-dark">
                    <div class="panel-heading">
                        Task Completion Status Overview
                    </div>
                    <div class="panel-body">
                        <canvas id="pie-chart"></canvas>
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
                        <canvas id="line-chart"></canvas>
                    </div>
                </div>
            </div>
        </div><!--/.row-->
        
    </div>    <!--/.main-->
    
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
</html>
