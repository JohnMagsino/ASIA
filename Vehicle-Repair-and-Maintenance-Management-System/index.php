<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Vehicle-Repair-and-Maintenance-Management-System</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link href="assets/css/datepicker3.css" rel="stylesheet">
    <link href="assets/css/styles.css" rel="stylesheet">
    <style>
        

        .container-fluid {
			padding-left: 100px;
			padding-right: 100px;
			margin-top: 0;
        }

        .row {
            margin: 0;
        }

        #slideshow,
        #login-container {
            height: 100vh;
            display: flex;
            align-items: center;
        }

        #slideshow .container,
        #login-container .container {
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 0;
        }

        #image-container img {
            max-width: 100%;
            height: auto;
        }

        .login-panel {
            background-color: #f1f1f1;
        }
		
    </style>
</head>
<body style="padding: 0">
<div class="container-fluid" style="background: #f1f1f1;">
    <div class="row">
        <div class="col-md-6" id="slideshow" style="background: #1E1E1E;">
            <div class="container text-left mx-auto" id="image-container">
                <img src="assets\image\image1.png" alt="" width="440" height="400" class="img-fluid">
            </div>
        </div>
        <div class="col-md-6" id="login-container" style="background: white;">
            <div class="container">
                <div class="login-panel panel panel-default" >
                    <img src="assets\image\loginlogo.png" alt="" width="400" height="100" style="background: white;">
                    <div class="panel-body" style="background: white;">
                        <form role="form">
							<h1> Login</h1>
							<p>Please login to access your account</p>
                            <fieldset>
                                <div class="form-group">
									<h4>Username:</h4>
                                    <input class="form-control" placeholder="Username" type="text" autofocus="">
                                </div>
                                <div class="form-group">
									<h4>Password:</h4>
                                    <input class="form-control" placeholder="Password" type="password" value="">
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Remember Me
                                    </label>
                                </div>
                                <center><a href="admin" class="btn btn-success btn-lg">Login as Admin</a>
                                    <a href="customer" class="btn btn-info btn-lg">Login as Customer</a></center>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.col-->
    </div><!-- /.row -->
</div>

<script src="assets/js/jquery-1.11.1.min.js"></script>
<script src="assets/js/bootstrap.min.js"></script>
</body>

</html>