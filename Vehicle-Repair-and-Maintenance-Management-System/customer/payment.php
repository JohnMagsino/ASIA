<!DOCTYPE html>
<html>
<?php
session_start();
 include 'includes/header.php'?>
   <link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css"> 
<body>
	
    <?php include 'includes/topbar.php'?>
    <?php include 'includes/sidebar.php'?>
		
	<div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
		
		
		<div class="row">
			<div class="col-lg-12">
				<h1 class="page-header">&nbsp;</em> Payments</h1>
			</div>
		</div><!--/.row-->
		
		<div class="panel panel-container">
			<div style="margin:10px">
			<table id="example1" class="table table-hover">
                                        <thead>
                                            <tr>
                                                <th class="border-top-0">Invoice No.</th>
                                                <th class="border-top-0">Payment Date</th>
                                                <th class="border-top-0">Amount</th>
                                                <th class="border-top-0">Balance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                        // Retrieve task information from database
                        $stmt = $pdo->query("SELECT * FROM tbl_payment");
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo '<tr>';
                            echo '<td>' . $row['invoiceNo'] . '</td>';
                            echo '<td>' . $row['payDate'] . '</td>';
                            echo '<td>' . $row['payAmount'] . '</td>';
                            echo '<td>' . $row['payBalance'] . '</td>';
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