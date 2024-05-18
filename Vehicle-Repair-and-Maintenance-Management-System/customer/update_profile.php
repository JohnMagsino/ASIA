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
    <link rel="stylesheet" href="../assets/css/styles.css"> <!-- Link to your CSS file -->
    <style>
        body {
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            max-width: 800px;
            margin: 50px auto;
            background: #fff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        .container h1 {
            text-align: center;
            margin-bottom: 20px;
            font-size: 24px;
            color: #333;
        }

        .form-group {
            margin-bottom: 15px;
        }

        .form-group label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }

        .form-group input,
        .form-group textarea {
            width: calc(100% - 20px);
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-group input[type="file"] {
            padding: 0;
        }

        .avatar-container {
            text-align: center;
            margin-bottom: 15px;
        }

        .avatar-container img {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            margin-bottom: 10px;
        }

        .form-group button {
            width: 100%;
            padding: 10px;
            border: none;
            border-radius: 5px;
            background-color: #28a745;
            color: #fff;
            font-size: 16px;
            cursor: pointer;
        }

        .form-group button:hover {
            background-color: #218838;
        }

        .note {
            text-align: center;
            margin-top: 15px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Update Profile</h1>
        <form action="update_profile.php" method="post" enctype="multipart/form-data">
            <div class="form-group">
                <label for="fullName">Full Name:</label>
                <input type="text" id="fullName" name="fullName" required>
            </div>

            <div class="form-group">
                <label for="fullAddress">Full Address:</label>
                <input type="text" id="fullAddress" name="fullAddress" required>
            </div>

            <div class="form-group">
                <label for="emailAdd">Email Address:</label>
                <input type="email" id="emailAdd" name="emailAdd" required>
            </div>

            <div class="form-group">
                <label for="contactNo">Contact Number:</label>
                <input type="text" id="contactNo" name="contactNo" required>
            </div>

            <div class="form-group">
                <label for="accStatus">Account Status:</label>
                <input type="text" id="accStatus" name="accStatus" required>
            </div>

            <div class="avatar-container">
                <img src="path_to_default_avatar.jpg" alt="Avatar"> <!-- Replace with PHP to show current avatar -->
                <label for="avatar">Upload Avatar:</label>
                <input type="file" id="avatar" name="avatar">
            </div>

            <div class="form-group">
                <button type="submit">Update Information</button>
            </div>
        </form>
    </div>
</body>
</html>