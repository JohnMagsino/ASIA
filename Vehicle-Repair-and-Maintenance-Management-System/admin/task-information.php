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
                <li class="active-link">Tasks</li> <a href="#" class="btnAddCust btn btn-success"><em
                        class="fa fa-plus">&nbsp;</em> Create Tasks</a>
            </ol>
        </div><!--/.row-->

        <div class="panel panel-container">
            <div style="margin:10px">
                <?php
                include 'connection.php';
                $stmt = $pdo->query("SELECT * FROM tbl_tasks");
                $tasks = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-top-0">Transaction Code</th>
                            <th class="border-top-0">Task Name</th>
                            <th class="border-top-0">Description</th>
                            <th class="border-top-0">Vehicle Type</th>
                            <th class="border-top-0">Customer</th>
                            <th class="border-top-0">Amount</th>
                            <th class="border-top-0">Status</th>
                            <th class="border-top-0">Completion Date</th>
                            <th class="border-top-0">Create Invoice</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($tasks as $task): ?>
                            <tr>
                                <td><?php echo $task['taskID']; ?></td>
                                <td><?php echo $task['taskName']; ?></td>
                                <td><?php echo $task['taskDesc']; ?></td>
                                <td><?php echo $task['vehicleType']; ?></td>
                                <td><?php echo $task['customerID']; ?></td>
                                <td><?php echo 'Php ' . number_format($task['taskAmount'], 2); ?></td>
                                <td><span class="badge bg-success"><?php echo $task['taskStatus']; ?></span></td>
                                <td><?php echo date('M d, Y', strtotime($task['completeDate'])); ?></td>
                                <td><a href="#" class="btn btn-info"><em class="fa fa-plus">&nbsp;</em> create</a></td>
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