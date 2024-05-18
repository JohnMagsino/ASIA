<nav class="navbar navbar-custom navbar-fixed-top" role="navigation">
	<div class="container-fluid d-flex justify-content-between">
		<div class="navbar-header">
			<button type="button" class="navbar-toggle collapsed" data-toggle="collapse"
				data-target="#sidebar-collapse"><span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span></button>
			<a class="navbar-brand" href="#"><img src="../assets/image/logo-admin.png" alt="Logo"></a>
		</div>
		<?php
		include 'connection.php';


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
</nav>