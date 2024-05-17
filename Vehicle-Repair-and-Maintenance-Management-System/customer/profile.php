<!DOCTYPE html>
<html>
<?php
session_start();
include 'includes/header.php';
include 'connection.php';

// Check if user is logged in
if (!isset($_SESSION['infoID'])) {
    header("Location: index.php"); // Redirect to login page if not logged in
    exit;
}

// Fetch user info
$userId = $_SESSION['infoID'];
$stmt = $pdo->prepare("SELECT fullName, fullAddress, emailAdd, contactNo, avatar, accStatus FROM tbl_info WHERE infoID = ?");
$stmt->execute([$userId]);
$user = $stmt->fetch();
?>
<link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css"> 

<body>
    <?php include 'includes/topbar.php'; ?>
    <?php include 'includes/sidebar.php'; ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">&nbsp;</em>Profile</h1>
            </div>
        </div><!--/.row-->

        <div class="panel panel-container">
            <div class="panel-body">
                <div class="col-md-12">
                    <form role="form" action="update_profile.php" method="POST" enctype="multipart/form-data">
                        <div class="form-group col-md-12">
                            <label>Full Name</label>
                            <input type="text" name="fullName" class="form-control" value="<?php echo htmlspecialchars($user['fullName']); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea name="fullAddress" class="form-control"><?php echo htmlspecialchars($user['fullAddress']); ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input type="email" name="emailAdd" class="form-control" value="<?php echo htmlspecialchars($user['emailAdd']); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Contact</label>
                            <input type="text" name="contactNo" class="form-control" value="<?php echo htmlspecialchars($user['contactNo']); ?>">
                        </div>
                        <div class="form-group col-md-4">
                            <label>Avatar</label>
                            <img src="../assets/image/<?php echo htmlspecialchars($user['avatar']); ?>" width="100" style="border-radius:5px;margin-left:10px"><br><br>
                            <input type="file" name="avatar" class="form-control">
                        </div>
                        <div class="form-group col-md-8">
                            <div class="form-group col-md-12">
                                <label>Status</label>
                                <input type="text" name="accStatus" class="form-control" value="<?php echo htmlspecialchars($user['accStatus']); ?>">
                            </div>
                        </div>
                        <button type="submit" class="btn btn-danger">Cancel</button>
                        <button type="submit" class="btn btn-primary">Save</button>
                    </form>
                </div>
            </div>
        </div>
    </div><!--/.main-->

    <?php include 'includes/footer.php'; ?>
    <!-- DataTables & Plugins -->
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
    .page-header {
        font-size: 25px;
        font-weight: bold;
        color: black;
        margin-top: 10px;
    }
</style>

</html>
