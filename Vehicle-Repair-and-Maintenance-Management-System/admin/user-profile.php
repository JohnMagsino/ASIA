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
                <li class="active-link">Profile</li>
            </ol>
        </div><!--/.row-->


        <div class="panel panel-container">
            <div class="row" style="margin:10px">
                <div class="col-12 col-md-4 col-lg-4 col-xl-4">
                    <div class="panel">
                        <div class="btn btn-success">Update Image</div>
                    </div>
                </div>
                <div class="col-12 col-md-8 col-lg-8 col-xl-8">
                    <form method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <h4>Personal Information</h4>
                            <div class="default-orgName">
                                <label for=" userName">First Name</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Middle Name</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Last Name</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Address</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Contact Number</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Email Address</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Username</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Password</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                            <div class="default-orgName">
                                <label for=" userName">Re-enter password</label>
                                <input type="text" name="userName" value="">
                                <br>
                            </div>
                        </div>
                </div>
            </div>
        </div>
    </div> <!--/.main-->

    <?php include 'includes/footer.php' ?>
    <script src="../assets/js/chart.js"></script>

</body>

</html>