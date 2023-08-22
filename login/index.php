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
  <!-- SweetAlert2 -->
  <link rel="stylesheet" href="../plugins/sweetalert2-theme-bootstrap-4/bootstrap-4.min.css">
</head>

<body class="hold-transition login-page">

	<div class="row w-100">

	<!-- Left Column -->
	<div class="col-6 d-flex align-items-center justify-content-center">

		<div class="login-box">
			<div class="login-logo">
				<a href="#"><b>Resource Generation Management Office </b>(RGMO)</a>
				<div class="row"><a href="#"><i>Rental Services Monitoring System</i></a></div>
			</div>
			<!-- /.login-logo -->
			<div class="card">
				<div class="card-body login-card-body">
					<p class="login-box-msg">Log in to your account</p>

					<form id="login-user">
						<div class="input-group mb-3">
							<input type="email" name="_email" class="form-control" placeholder="Email">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>
						<div class="input-group mb-3">
							<input type="password" name="_pass" class="form-control" placeholder="Password">
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
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Sweet Alert-->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>

<script>

	$(document).ready(function() {

		$('#login-user').on('submit', function(e) {

			let formData = new FormData(this);
			e.preventDefault();

			$.ajax({
				url: '../controller/LoginController.php',
				type: 'POST',
				processData: false,
				contentType: false,
				data: formData,
				success: function(response) {

					console.log("res", response);

					// If Login is Successful
					if(response) {

						Swal.mixin({
							toast: true, position: 'top-end', showConfirmButton: false
						}).fire({ 
							icon: 'success', title: 'Login Successful'
						});
		
						setTimeout(function() {
							window.location.href = '../dashboard/';
						},1000);

					}
					// If not
					else {

						Swal.mixin({
							toast: true, position: 'top-end', showConfirmButton: false, timer: 3000
						}).fire({ 
							icon: 'error', title: 'Username or Password do not match! Please Try Again!'
						});

					}
				}
			});

		});// submit

	});// document ready

</script>

</body>
</html>
