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
            <li class="active-link">Reports</li>
         </ol>
      </div><!--/.row-->

      <div class="panel panel-container">

         <div class="row" style="margin:10px">
            <div class="col-6 col-md-6 col-lg-6 col-xl-6">
               <!-- Top Customer -->
               <div style="display: flex; justify-content: space-between; align-items: center;">
                  <h3 style="display: inline-block;">Top Customers</h3>
                  <a class="btn btn-success" onclick="printReport()">
                     <em class="fa fa-plus">&nbsp;</em> Print Report
                  </a>
               </div>
               <table class="table table-striped" id="customerTable">
                  <thead>
                     <tr>
                        <th>Customer Name</th>
                        <th>Total Spent</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     include 'connection.php';
                     $stmt = $pdo->query('SELECT tbl_info.fullName, SUM(tbl_invoice.totalAmount) as totalSpent 
              FROM tbl_invoice 
              JOIN tbl_info ON tbl_invoice.custID = tbl_info.infoID 
              GROUP BY tbl_invoice.custID 
              ORDER BY totalSpent DESC LIMIT 5');
                     while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>{$row['fullName']}</td>";
                        echo "<td>\${$row['totalSpent']}</td>";
                        echo "</tr>";
                     }
                     ?>
                  </tbody>
               </table>

               <script>
                  function printReport() {
                     const { jsPDF } = window.jspdf;
                     const doc = new jsPDF();

                     // Add table title
                     doc.text("Top Customers Report", 14, 16);

                     // Get the table element
                     const customerTable = document.getElementById("customerTable");

                     // Use autoTable plugin to convert HTML table to PDF
                     doc.autoTable({
                        html: customerTable,
                        startY: 20,
                        styles: { cellPadding: 2, fontSize: 10 },
                        headStyles: { fillColor: [22, 160, 133] },
                        alternateRowStyles: { fillColor: [245, 245, 245] }
                     });

                     // Save the PDF
                     doc.save("Top_Customers_Report.pdf");
                  }
               </script>



            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xl-6">
               <div style="display: flex; justify-content: space-between; align-items: center;">
                  <h3 style="display: inline-block;">Top Team Members</h3>
                  <a class="btn btn-success" onclick="printTeamMembersReport()">
                     <em class="fa fa-plus">&nbsp;</em> Print Report
                  </a>
               </div>
               <table class="table table-striped" id="teamMembersTable">
                  <thead>
                     <tr>
                        <th>Team Member Username</th>
                        <th>Task Count</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $stmt = $pdo->query('SELECT accUsername, COUNT(taskID) as taskCount 
                          FROM tbl_tasks 
                          JOIN tbl_account ON tbl_tasks.customerID = tbl_account.accID 
                          WHERE accType = "admin" 
                          GROUP BY customerID 
                          ORDER BY taskCount DESC LIMIT 5');
                     while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>{$row['accUsername']}</td>";
                        echo "<td>{$row['taskCount']} tasks</td>";
                        echo "</tr>";
                     }
                     ?>
                  </tbody>
               </table>

               <script>
                  function printTeamMembersReport() {
                     const { jsPDF } = window.jspdf;
                     const doc = new jsPDF();

                     // Add table title
                     doc.text("Top Team Members Report", 14, 16);

                     // Get the table element
                     const teamMembersTable = document.getElementById("teamMembersTable");

                     // Use autoTable plugin to convert HTML table to PDF
                     doc.autoTable({
                        html: teamMembersTable,
                        startY: 20,
                        styles: { cellPadding: 2, fontSize: 10 },
                        headStyles: { fillColor: [22, 160, 133] },
                        alternateRowStyles: { fillColor: [245, 245, 245] }
                     });

                     // Save the PDF
                     doc.save("Top_Team_Members_Report.pdf");
                  }
               </script>


            </div>
         </div>
         <div class="row" style="margin:10px">
            <div class="col-6 col-md-6 col-lg-6 col-xl-6">
               <!-- Vehicle Types Report -->
               <div style="display: flex; justify-content: space-between; align-items: center;">
                  <h3 style="display: inline-block;">Vehicle Types Report</h3>
                  <a class="btn btn-success" onclick="printVehicleReport()">
                     <em class="fa fa-plus">&nbsp;</em> Print Report
                  </a>
               </div>
               <table class="table table-striped" id="vehicleTable">
                  <thead>
                     <tr>
                        <th>Vehicle Type</th>
                        <th>Task Count</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $stmt = $pdo->query('SELECT vehicleType, COUNT(taskID) as taskCount 
                          FROM tbl_tasks 
                          GROUP BY vehicleType 
                          ORDER BY taskCount DESC');
                     while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>{$row['vehicleType']}</td>";
                        echo "<td>{$row['taskCount']} tasks</td>";
                        echo "</tr>";
                     }
                     ?>
                  </tbody>
               </table>

               <script>
                  function printVehicleReport() {
                     const { jsPDF } = window.jspdf;
                     const doc = new jsPDF();

                     // Add table title
                     doc.text("Vehicle Types Report", 14, 16);

                     // Get the table element
                     const vehicleTable = document.getElementById("vehicleTable");

                     // Use autoTable plugin to convert HTML table to PDF
                     doc.autoTable({
                        html: vehicleTable,
                        startY: 20,
                        styles: { cellPadding: 2, fontSize: 10 },
                        headStyles: { fillColor: [22, 160, 133] },
                        alternateRowStyles: { fillColor: [245, 245, 245] }
                     });

                     // Save the PDF
                     doc.save("Vehicle_Types_Report.pdf");
                  }
               </script>

            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xl-6">
               <!-- Parts Report -->
               <div style="display: flex; justify-content: space-between; align-items: center;">
                  <h3 style="display: inline-block;">Parts Report</h3>
                  <a class="btn btn-success">
                     <em class="fa fa-plus">&nbsp;</em> Print Report
                  </a>
               </div>
               <table class="table table-striped">
                  <thead>
                     <tr>
                        <th>Parts</th>
                        <th>Quantity</th>
                        <th>Total Amount</th>
                     </tr>
                  </thead>
                  <tbody>
                     <tr>
                        <td>Windshield</td>
                        <td>4</td>
                        <td>$20000</td>
                     </tr>
                     <tr>
                        <td>Head Light</td>
                        <td>2</td>
                        <td>$10000</td>
                     </tr>

                  </tbody>
               </table>
               <!-- Placeholder for parts report -->
               <!-- Implement parts report query and display here -->
            </div>
         </div>
         <div class="row" style="margin:10px">
            <div class="col-6 col-md-6 col-lg-6 col-xl-6">
               <!-- Revenue Report -->
               <div style="display: flex; justify-content: space-between; align-items: center;">
                  <h3 style="display: inline-block;">Revenue Report</h3>
                  <a class="btn btn-success" onclick="printRevenueReport()">
                     <em class="fa fa-plus">&nbsp;</em> Print Report
                  </a>
               </div>
               <table class="table table-striped" id="revenueTable">
                  <thead>
                     <tr>
                        <th>Date</th>
                        <th>Daily Revenue</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $stmt = $pdo->query('SELECT DATE(invoiceDate) as date, SUM(totalAmount) as dailyRevenue 
                          FROM tbl_invoice 
                          GROUP BY DATE(invoiceDate) 
                          ORDER BY date DESC LIMIT 7');
                     while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>{$row['date']}</td>";
                        echo "<td>\${$row['dailyRevenue']}</td>";
                        echo "</tr>";
                     }
                     ?>
                  </tbody>
               </table>

               <script>
                  function printRevenueReport() {
                     const { jsPDF } = window.jspdf;
                     const doc = new jsPDF();

                     // Add table title
                     doc.text("Revenue Report", 14, 16);

                     // Get the table element
                     const revenueTable = document.getElementById("revenueTable");

                     // Use autoTable plugin to convert HTML table to PDF
                     doc.autoTable({
                        html: revenueTable,
                        startY: 20,
                        styles: { cellPadding: 2, fontSize: 10 },
                        headStyles: { fillColor: [22, 160, 133] },
                        alternateRowStyles: { fillColor: [245, 245, 245] }
                     });

                     // Save the PDF
                     doc.save("Revenue_Report.pdf");
                  }
               </script>

            </div>
            <div class="col-6 col-md-6 col-lg-6 col-xl-6">
               <!-- Outstanding Balance Report -->
               <div style="display: flex; justify-content: space-between; align-items: center;">
                  <h3 style="display: inline-block;">Outstanding Balance Report</h3>
                  <a class="btn btn-success" onclick="printOutstandingBalanceReport()">
                     <em class="fa fa-plus">&nbsp;</em> Print Report
                  </a>
               </div>
               <table class="table table-striped" id="outstandingBalanceTable">
                  <thead>
                     <tr>
                        <th>Customer Name</th>
                        <th>Outstanding Balance</th>
                     </tr>
                  </thead>
                  <tbody>
                     <?php
                     $stmt = $pdo->query('SELECT tbl_info.fullName, tbl_payment.payBalance 
                          FROM tbl_payment 
                          JOIN tbl_invoice ON tbl_payment.invoiceNo = tbl_invoice.invoiceID 
                          JOIN tbl_info ON tbl_invoice.custID = tbl_info.infoID 
                          WHERE tbl_payment.payStatus = "partially paid"');
                     while ($row = $stmt->fetch()) {
                        echo "<tr>";
                        echo "<td>{$row['fullName']}</td>";
                        echo "<td>\${$row['payBalance']}</td>";
                        echo "</tr>";
                     }
                     ?>
                  </tbody>
               </table>

               <script>
                  function printOutstandingBalanceReport() {
                     const { jsPDF } = window.jspdf;
                     const doc = new jsPDF();

                     // Add table title
                     doc.text("Outstanding Balance Report", 14, 16);

                     // Get the table element
                     const outstandingBalanceTable = document.getElementById("outstandingBalanceTable");

                     // Use autoTable plugin to convert HTML table to PDF
                     doc.autoTable({
                        html: outstandingBalanceTable,
                        startY: 20,
                        styles: { cellPadding: 2, fontSize: 10 },
                        headStyles: { fillColor: [22, 160, 133] },
                        alternateRowStyles: { fillColor: [245, 245, 245] }
                     });

                     // Save the PDF
                     doc.save("Outstanding_Balance_Report.pdf");
                  }
               </script>

            </div>
         </div>

      </div> <!--/.main-->
      <style>
         .table-striped {
            border: 1px solid #ccc;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
         }
      </style>
      <?php include 'includes/footer.php' ?>
      <script src="../assets/js/chart.js"></script>

</body>

</html>