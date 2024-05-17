<!DOCTYPE html>
<html>
<?php 
session_start();
include 'includes/header.php';
include 'connection.php'; // Include your database connection file
?>
<link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css"> 
<body>
	
    <?php include 'includes/topbar.php'?>
    <?php include 'includes/sidebar.php'?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">&nbsp;</em> Task List</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div style="margin:10px">
				<table id="example1" class="table table-hover">
                    <thead>
                        <tr>
                            <th class="border-top-0">Transaction Code</th>
                            <th class="border-top-0">Task Name</th>
                            <th class="border-top-0">Description</th>
                            <th class="border-top-0">Vehicle Type</th>
                            <th class="border-top-0">Amount</th>
                            <th class="border-top-0">Status</th>
                            <th class="border-top-0">Completion Date</th>
                            <th class="border-top-0">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            // Retrieve task information from database
                            $stmt = $pdo->query("SELECT * FROM tbl_tasks");
                            while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                                echo '<tr>';
                                echo '<td>' . $row['taskID'] . '</td>';
                                echo '<td>' . $row['taskName'] . '</td>';
                                echo '<td>' . $row['taskDesc'] . '</td>';
                                echo '<td>' . $row['vehicleType'] . '</td>';
                                echo '<td>Php ' . number_format($row['taskAmount'], 2) . '</td>';
                                echo '<td><span class="badge bg-' . ($row['taskStatus'] == 'completed' ? 'success' : 'info') . '">' . $row['taskStatus'] . '</span></td>';
                                echo '<td>' . date('M d, Y', strtotime($row['completeDate'])) . '</td>';
                                echo '<td><a href="task-details.php?id=' . $row['taskID'] . '" class="btn btn-info"><em class="fa fa-eye">&nbsp;</em> details</a></td>';
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
			</div><!--/.row-->
		</div>
	</div>	<!--/.main-->
	
    <?php include 'includes/footer.php'?>
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

<style>
    body {
    background-color: white;
}
	.page-header{
    font-size: 25px;
    font-weight: bold;
    color: black;
    margin-top: 10px;
	}
</style>
</html>
