<?php
session_start();
include 'connection.php';

$userId = $_SESSION['user_id'];

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

        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $targetFilePath)) {
            // Update the avatar in the database
            $stmt = $pdo->prepare("UPDATE tbl_info SET avatar = ? WHERE infoID = ?");
            $stmt->execute([$avatar, $userId]);
        }
    }

    // Update user info
    $stmt = $pdo->prepare("UPDATE tbl_info SET fullName = ?, fullAddress = ?, emailAdd = ?, contactNo = ?, accStatus = ? WHERE infoID = ?");
    $stmt->execute([$fullName, $fullAddress, $emailAdd, $contactNo, $accStatus, $userId]);

    header("Location: profile.php");
    exit;
}
?>
