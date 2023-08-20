<?php

	include_once __DIR__ . '/../objects/session.php';

	$SES = SESSION::getInstance();

	if($SES->id == null) {
		$SES->destroy();
	}

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Login</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="../plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="../plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="../dist/css/adminlte.min.css">
</head>

<body class="hold-transition login-page">

	<div class="row w-100">

	<!-- Left Column -->
	<div class="col-6 d-flex align-items-center justify-content-center">

		<div class="login-box">
			<div class="login-logo">
				<a href="#">
					<b>Resource Generation Management System </b>(RGMO)
				</a>
			</div>
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">Log in to your account</p>

					<form id="login-user">
						<div class="input-group mb-3">
							<input type="email" class="form-control" placeholder="Email">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" class="form-control" placeholder="Password">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-lock"></span>
								</div>
							</div>
						</div>

						<div class="row">

							<div class="col-8">
								<p class="mb-2"></p>
								<p class="mb-0">
									<a href="../register" class="text-center">Not a Client? Register here</a>
								</p>
							</div>

							<div class="col-4">
								<button type="submit" class="btn btn-primary btn-block">Sign In</button>
							</div>

						</div>
						<!-- /.row -->

					</form>

					<!-- <p class="mb-1">
						<a href="forgot-password.html">I forgot my password</a>
					</p> -->
					

				</div>
				<!-- /.login-card-body -->

			</div>
		</div>
		<!-- /.login-box -->

	</div>
	<!-- left column end -->

	<!-- Right Column -->
	<div class="col-6">
		<img src="../includes/images/sample_pic.png" alt="Sample Pic">
	</div>
	<!-- right column end -->

	</div>
	<!-- /.row -->


<!-- jQuery -->
<script src="../../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../../dist/js/adminlte.min.js"></script>
</body>
</html>
