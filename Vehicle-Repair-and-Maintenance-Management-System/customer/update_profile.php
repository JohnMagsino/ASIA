<?php
session_start();
include 'connection.php'; // Include your database connection file

// Check if the user is logged in
if (!isset($_SESSION['accID'])) {
    header("Location: login.php");
    exit();
}

$userId = $_SESSION['accID'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $fullName = $_POST['fullName'];
    $fullAddress = $_POST['fullAddress'];
    $emailAdd = $_POST['emailAdd'];
    $contactNo = $_POST['contactNo'];
    $accStatus = $_POST['accStatus'];

    // Handle avatar upload
    if (!empty($_FILES['avatar']['name'])) {
        $avatar = basename($_FILES['avatar']['name']);
        $targetDir = "../assets/image/";
        $targetFilePath = $targetDir . $avatar;
        $fileType = pathinfo($targetFilePath, PATHINFO_EXTENSION);

        // Allow certain file formats
        $allowedTypes = ['jpg', 'jpeg', 'png', 'gif'];
        if (in_array($fileType, $allowedTypes)) {
            if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath)) {
                // Update the avatar in the database
                $stmt = $pdo->prepare("UPDATE tbl_info SET avatar = ? WHERE infoID = ?");
                $stmt->execute([$avatar, $userId]);
            } else {
                echo "Sorry, there was an error uploading your file.";
            }
        } else {
            echo "Sorry, only JPG, JPEG, PNG, & GIF files are allowed.";
        }
    }

    // Update user info
    $stmt = $pdo->prepare("UPDATE tbl_info SET fullName = ?, fullAddress = ?, emailAdd = ?, contactNo = ?, accStatus = ? WHERE infoID = ?");
    $stmt->execute([$fullName, $fullAddress, $emailAdd, $contactNo, $accStatus, $userId]);

    header("Location: profile.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Update Profile</title>
    <!-- Add any required CSS files -->
</head>
<body>
    <form action="update_profile.php" method="post" enctype="multipart/form-data">
        <label for="fullName">Full Name:</label>
        <input type="text" id="fullName" name="fullName" required><br>

        <label for="fullAddress">Full Address:</label>
        <input type="text" id="fullAddress" name="fullAddress" required><br>

        <label for="emailAdd">Email Address:</label>
        <input type="email" id="emailAdd" name="emailAdd" required><br>

        <label for="contactNo">Contact Number:</label>
        <input type="text" id="contactNo" name="contactNo" required><br>

        <label for="accStatus">Account Status:</label>
        <input type="text" id="accStatus" name="accStatus" required><br>

        <label for="avatar">Avatar:</label>
        <input type="file" id="avatar" name="avatar"><br>

        <button type="submit">Update Information</button>
    </form>
</body>
</html>
