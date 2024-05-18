<?php
session_start(); // Start the session
include 'connection.php'; // Include your database connection file

// Fetch user information based on session
if (isset($_SESSION['accID'])) {
    $stmt = $pdo->prepare("SELECT fullName, fullAddress, emailAdd, contactNo, avatar, accUsername, accPass FROM tbl_info INNER JOIN tbl_account ON tbl_info.infoID = tbl_account.infoID WHERE tbl_account.accID = :accID");
    $stmt->execute(['accID' => $_SESSION['accID']]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);

    // Decode the avatar BLOB data
    $avatarData = base64_encode($userData['avatar']);
    $avatarSrc = 'data:image/jpeg;base64,' . $avatarData;
} else {
    // Handle unauthorized access or redirect to login page
    header("Location: login.php");
    exit(); // Stop further execution
}
?>

<!DOCTYPE html>
<html>
<?php include 'includes/header.php' ?>
<link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css">

<body>

    <?php include 'includes/topbar.php' ?>
    <?php include 'includes/sidebar.php' ?>

    <div class="col-sm-9 col-sm-offset-3 col-lg-10 col-lg-offset-2 main">
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Profile</h1>
            </div>
        </div><!--/.row-->

        <div class="panel panel-container">
            <div class="panel-body">
                <div class="col-md-12">
                    <form role="form">
                        <div class="row">
                            <div class="col-md-4 text-center">
                                <img src="<?php echo $avatarSrc; ?>" alt="Avatar" class="img-thumbnail"
                                    style="width: 200px;">
                                <br>
                                <button type="button" class="btn btn-success btn-block" style="margin-top: 10px;">Update
                                    Image</button>
                            </div>
                            <div class="col-md-8">
                                <h2> Personal Information</h2>
                                <div class="form-group">
                                    <label>Full Name</label>
                                    <input class="form-control"
                                        value="<?php echo htmlspecialchars($userData['fullName']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Address</label>
                                    <textarea
                                        class="form-control"><?php echo htmlspecialchars($userData['fullAddress']); ?></textarea>
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input class="form-control"
                                        value="<?php echo htmlspecialchars($userData['emailAdd']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Contact</label>
                                    <input class="form-control"
                                        value="<?php echo htmlspecialchars($userData['contactNo']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Username</label>
                                    <input class="form-control"
                                        value="<?php echo htmlspecialchars($userData['accUsername']); ?>">
                                </div>
                                <div class="form-group">
                                    <label>Password</label>
                                    <input type="password" class="form-control"
                                        value="<?php echo htmlspecialchars($userData['accPass']); ?>">
                                </div>
                                <div class="form-group text-right">
                                    <a href="update_profile.php" class="btn btn-primary btn-block">Update
                                        Information</a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!--/.main-->

    <?php include 'includes/footer.php'; ?>
    <!-- DataTables & Plugins -->
    <script src="../assets/tables/datatables/jquery.dataTables.min.js"></script>
    <script src="../assets/tables/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
    <script src="../assets/tables/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
    <script src="../assets/tables/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script>
        $(function () {
            $("#example1").DataTable();
        });
    </script>
</body>

</html>