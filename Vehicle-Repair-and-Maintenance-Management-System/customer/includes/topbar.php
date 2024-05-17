<nav class="navbar navbar-custom navbar-fixed-top" role="navigation" style="background-color: white; box-shadow: 0px 10px 10px rgba(0, 0, 0, 0.2);">
    <div class="container-fluid d-flex justify-content-between">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#sidebar-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#"><img src="../assets/image/loginlogo.png" alt="Logo"></a>
        </div>
        <?php
		include 'connection.php';

		// Check if user is logged in
		if (!isset($_SESSION['accID'])) {
			// Redirect to login page if not logged in
			header("Location: login.php");
			exit();
		}

		// Fetch user information based on accID
		$stmt = $pdo->prepare("SELECT fullName, avatar FROM tbl_info WHERE infoID = (SELECT infoID FROM tbl_account WHERE accID = :accID)");
		$stmt->execute(['accID' => $_SESSION['accID']]);
		$userInfo = $stmt->fetch(PDO::FETCH_ASSOC);
		?>

		<div class="profile-userpic">
			<div class="circular-frame">
				<img src="data:image/jpeg;base64,<?php echo base64_encode($userInfo['avatar']); ?>"
					class="img-responsive" alt="">
			</div>
		</div>
		<div class="profile-usertitle">
			<div class="profile-usertitle-name"><?php echo $userInfo['fullName']; ?></div>
			<div class="profile-usertitle-status"><span class="indicator label-success"></span>Online</div>
		</div>
		<div class="clear"></div>
    </div><!-- /.container-fluid -->
    <style>
        .profile-usertitle-name {
            color: black;
            font-size: medium;
            white-space: nowrap; /* Prevents the text from wrapping */
            overflow: hidden; /* Hides the overflowed text */
            text-overflow: ellipsis; /* Shows an ellipsis when the text overflows */
            background-color: white;
        }
        .profile-usertitle-status {
            color: black;
            font-size: 9px;
            font-weight: 100;
            align-items: center;
        }
    </style>
</nav>
