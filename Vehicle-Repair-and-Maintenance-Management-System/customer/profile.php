<?php
session_start();
include 'connection.php'; // Include your database connection file

// Fetch user information based on session
if (isset($_SESSION['accID'])) {
    $stmt = $pdo->prepare("SELECT fullName, fullAddress, emailAdd, contactNo, avatar, accUsername, accPass FROM tbl_info INNER JOIN tbl_account ON tbl_info.infoID = tbl_account.infoID WHERE tbl_account.accID = :accID");
    $stmt->execute(['accID' => $_SESSION['accID']]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirect if not logged in
    header("Location: login.php");
    exit();
}

// Decode the avatar BLOB data
$avatarData = base64_encode($userData['avatar']);
$avatarSrc = 'data:image/jpeg;base64,'.$avatarData;
?>

<!DOCTYPE html>
<html>
<?php include 'includes/header.php'?>
<link rel="stylesheet" href="../assets/tables/datatables-bs4/css/dataTables.bootstrap4.min.css"> 
<body>
    
    <?php include 'includes/topbar.php'?>
    <?php include 'includes/sidebar.php'?>
        
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
                        <div class="form-group col-md-12">
                            <label>Full Name</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['fullName']); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Address</label>
                            <textarea class="form-control"><?php echo htmlspecialchars($userData['fullAddress']); ?></textarea>
                        </div>
                        <div class="form-group col-md-12">
                            <label>Email</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['emailAdd']); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Contact</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['contactNo']); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Username</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['accUsername']); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Password</label>
                            <input type="password" class="form-control" value="<?php echo htmlspecialchars($userData['accPass']); ?>">
                        </div>
                        <div class="form-group col-md-12">
                            <label>Avatar</label>
                            <img src="<?php echo $avatarSrc; ?>" width="100" style="border-radius:5px;margin-left:10px"><br><br>
                            <!-- If you want to allow users to upload a new avatar, add an input type="file" here -->
                        </div>
                        <div class="form-group col-md-12">
                            <button type="submit" class="btn btn-danger">Cancel</button>
                            <button type="submit" class="btn btn-primary">Save</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div> <!--/.main-->
    
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
    .page-header {
        font-size: 25px;
        font-weight: bold;
        color: black;
        margin-top: 10px;
    }
</style>

</html>
