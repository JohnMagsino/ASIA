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
                            <img src="<?php echo $avatarSrc; ?>" alt="Avatar" class="img-thumbnail" style="width: 200px;">
                            <br>
                            <button type="button" class="btn btn-success btn-block" style="margin-top: 10px;">Update Image</button>
                        </div>
                        <div class="col-md-8">
                        <h2> Personal nformation</h2>
                        <div class="form-group">
                            <label>Full Name</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['fullName']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Address</label>
                            <textarea class="form-control"><?php echo htmlspecialchars($userData['fullAddress']); ?></textarea>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['emailAdd']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Contact</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['contactNo']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Username</label>
                            <input class="form-control" value="<?php echo htmlspecialchars($userData['accUsername']); ?>">
                        </div>
                        <div class="form-group">
                            <label>Password</label>
                            <input type="password" class="form-control" value="<?php echo htmlspecialchars($userData['accPass']); ?>">
                        </div>
                        <div class="form-group text-right">
                            <a href="update_profile.php" class="btn btn-primary btn-block">Update Information</a>
                        </div>
                    </form>
                </div>
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
    .img-thumbnail {
        border-radius: 10px;
    }
    .profile-avatar {
        width: 200px;
        height: 200px;
        object-fit: cover;
    }
    .panel-container {
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        background-color: #f9f9f9;
    }
    .panel-body {
        padding: 30px;
    }
    .form-group label {
        font-weight: bold;
    }
    .form-control {
        margin-bottom: 15px;
        border-radius: 5px;
    }
    .btn-block {
        width: 100%;
        background-color: #28a745;
        border: none;
        color: white;
        padding: 10px 20px;
        font-size: 16px;
        cursor: pointer;
    }
    .btn-block:hover {
        background-color: #218838;
    }
</style>