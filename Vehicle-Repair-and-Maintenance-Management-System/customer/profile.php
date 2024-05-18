<?php
session_start();
include 'connection.php'; // Include your database connection file

// Fetch user information based on session
if (isset($_SESSION['accID'])) {
    $stmt = $pdo->prepare("SELECT tbl_info.infoID, fullName, fullAddress, emailAdd, contactNo, avatar, accUsername, accPass FROM tbl_info INNER JOIN tbl_account ON tbl_info.infoID = tbl_account.infoID WHERE tbl_account.accID = :accID");
    $stmt->execute(['accID' => $_SESSION['accID']]);
    $userData = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    // Redirect if not logged in
    header("Location: login.php");
    exit();
}

// Decode the avatar BLOB data
$avatarData = base64_encode($userData['avatar']);
$avatarSrc = 'data:image/jpeg;base64,' . $avatarData;

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $fullAddress = $_POST['fullAddress'];
    $emailAdd = $_POST['emailAdd'];
    $contactNo = $_POST['contactNo'];
    $accUsername = $_POST['accUsername'];
    $accPass = $_POST['accPass'];
    $retypePass = $_POST['retypePass']; // Added retypePass

    // Check if passwords match
    if ($accPass === $retypePass) {
        // Hash the password
        $hashedPass = password_hash($accPass, PASSWORD_DEFAULT);

        try {
            // Begin transaction
            $pdo->beginTransaction();

            // Update user info
            $stmt = $pdo->prepare("UPDATE tbl_info SET fullName = ?, fullAddress = ?, emailAdd = ?, contactNo = ? WHERE infoID = ?");
            $stmt->execute([$fullName, $fullAddress, $emailAdd, $contactNo, $userData['infoID']]);

            // Update account info
            $stmt = $pdo->prepare("UPDATE tbl_account SET accUsername = ?, accPass = ? WHERE accID = ?");
            $stmt->execute([$accUsername, $accPass, $_SESSION['accID']]);

            // Commit transaction
            $pdo->commit();

            echo "<script>alert('Information successfully updated.');</script>";
        } catch (Exception $e) {
            // Rollback transaction if something failed
            $pdo->rollBack();
            echo "<script>alert('An error occurred while updating your information. Please try again.');</script>";
        }
    } else {
        echo "<script>alert('Passwords do not match.');</script>";
    }
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
                <form role="form" method="post">
                    <div class="row">
                        <div class="col-md-4 text-center">
                            <img src="<?php echo $avatarSrc; ?>" alt="Avatar" class="img-thumbnail" style="width: 200px;">
                            <br>
                            <button type="button" class="btn btn-success btn-block" style="margin-top: 10px;">Update Image</button>
                        </div>
                        <div class="col-md-8">
                            <h2>Personal Information</h2>
                            <div class="form-group">
                                <label>Full Name</label>
                                <input type="text" class="form-control" name="fullName" value="<?php echo htmlspecialchars($userData['fullName']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Address</label>
                                <textarea class="form-control" name="fullAddress" required><?php echo htmlspecialchars($userData['fullAddress']); ?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Email</label>
                                <input type="email" class="form-control" name="emailAdd" value="<?php echo htmlspecialchars($userData['emailAdd']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Contact</label>
                                <input type="text" class="form-control" name="contactNo" value="<?php echo htmlspecialchars($userData['contactNo']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Username</label>
                                <input type="text" class="form-control" name="accUsername" value="<?php echo htmlspecialchars($userData['accUsername']); ?>" required>
                            </div>
                            <div class="form-group">
                                <label>Password</label>
                                <input type="password" class="form-control" name="accPass" required>
                            </div>
                            <div class="form-group">
                                <label>Confirm Password</label>
                                <input type="password" class="form-control" name="retypePass" required>
                            </div>
                            <div class="form-group text-right">
                                <button type="submit" class="btn btn-primary btn-block">Update Information</button>
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
</html>
