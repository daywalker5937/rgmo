<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Registration</title>

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

  <!-- Select2 -->
  <link rel="stylesheet" href="../plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="../plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <style>
	#caps-pass, #caps-confirm {
		display: none;
		color: red;
		font-weight: bold;
	}
  </style>

</head>

<body class="hold-transition register-page">
	<div class="register-box w-50">
		<div class="register-logo">
			<div class="row"><a href="#"><b>Resource Generation Management System </b>(RGMO)</a></div>
			<div class="row justify-content-center"><a href="#"><i>Rental Services Monitoring System</i></a></div>
		</div>

		<div class="card">
			<div class="card-body register-card-body">
				<p class="login-box-msg">Create an Account</p>

				<form id="register-user" autocomplete="off" enctype="multipart/form-data">
					
					<div class="row">
						
						<div class="input-group mb-3 col-4">
							<input type="text" name="lname" class="form-control" placeholder="Last Name">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-user"></span>
								</div>
							</div>
						</div>

						<div class="input-group mb-3 col-4">
							<input type="text" name="fname" class="form-control" placeholder="First Name">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-user"></span>
								</div>
							</div>
						</div>

						<div class="input-group mb-3 col-4">
							<input type="text" name="mname" class="form-control" placeholder="Middle Name">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-user"></span>
								</div>
							</div>
						</div>

					</div>
					<!-- /.row -->

					<div class="row">

						<div class="input-group mb-3 col-8">
							<input type="text" name="address" class="form-control" placeholder="Address">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-address-card"></span>
								</div>
							</div>
						</div>

						<div class="input-group mb-3 col-4">
							<select name="civil_status"><option value=""></option></select>
						</div>

					</div>
					<!-- /.row -->

					<div class="row">

						<div class="input-group mb-3 col-6">
							<input type="number" name="contact_number" class="form-control" placeholder="Contact Number">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-phone"></span>
								</div>
							</div>
						</div>

						<div class="input-group mb-3 col-6">
							<input type="email" name="email" class="form-control" placeholder="Email">
							<div class="input-group-append">
								<div class="input-group-text">
									<span class="fas fa-envelope"></span>
								</div>
							</div>
						</div>

					</div>
					<!-- /.row -->

					<div class="row">

						<div class="input-group mb-3 col-6">
							<select name="sex"><option value=""></option></select>
						</div>

						<div class="input-group mb-3 col-6">
							<select name="role"><option value=""></option></select>
						</div>

					</div>
					<!-- /.row -->

					<div class="input-group mb-3">
						<input type="password" id="_pass" name="password" class="form-control" placeholder="Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<i class="fas fa-eye" id="togglePass" style="cursor: pointer;"></i>
							</div>
						</div>
					</div>
					<p id="caps-pass">Caps Lock is ON</p>
					<div class="input-group mb-3">
						<input type="password" id="_confirm-pass" name="confirm_password" class="form-control" placeholder="Confirm Password">
						<div class="input-group-append">
							<div class="input-group-text">
								<i class="fas fa-eye" id="toggleConfirm" style="cursor: pointer;"></i>
							</div>
						</div>
					</div>
					<p id="caps-confirm">Caps Lock is ON</p>
					<div class="row">
						<div class="form-group col-12">
							<label>Upload a Picture: </label>
							<input type="file" id="upload-id" name="upload_pic">
						</div>
					</div>
					<!-- /.row -->

					<div class="row">

						<div class="col-8">
							<p class="mb-2"></p>
								<p class="mb-0">
									<a href="../login" class="text-center">Already Registered? Login here</a>
								</p>
						</div>

						<div class="col-4">
							<button type="submit" class="btn btn-primary btn-block">Register</button>
						</div>

					</div>
					<!-- /.row -->

				</form>

			</div>
			<!-- /.form-box -->

		</div>
		<!-- /.card -->
	</div>
	<!-- /.register-box -->

<!-- jQuery -->
<script src="../plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="../plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="../dist/js/adminlte.min.js"></script>
<!-- Sweet Alert-->
<script src="../plugins/sweetalert2/sweetalert2.min.js"></script>
<!-- jquery-validation -->
<script src="../plugins/jquery-validation/jquery.validate.min.js"></script>
<script src="../plugins/jquery-validation/additional-methods.min.js"></script>
<!-- Select2 -->
<script src="../plugins/select2/js/select2.full.min.js"></script>
<!-- Passsword Show or Hide -->
<script src="../components/pass-show-hide.js"></script>

<script>

	$(document).ready(function() {

		// Select2 Initializations
		let selectCivilStatus = $($('#register-user select')[0]);
		let selectSex = $($('#register-user select')[1]);
		let selectRole = $($('#register-user select')[2]);

		// console.log("selections", $('#register-user select'));

		// Selections
		let civil_selection = [
			{"id": 'Single', "text": 'Single'}, 
			{"id": 'Married', "text": 'Married'},
			{"id": 'Divorced', "text": 'Divorced'},
			{"id": 'Widowed', "text": 'Widowed'}
		];
		let sex_selection = [{"id": 'Male', "text": 'Male'}, {"id": 'Female', "text": 'Female'}];
		let role_selection = [{"id": '1', "text": 'Admin'}, {"id": '2', "text": 'Client'}];

		selectCivilStatus.select2({
			width: '100%',
			theme: 'bootstrap4',
			placeholder: 'Select Civil Status',
			allowClear: true,
			data:civil_selection
		}).on('change', function() {($(this).val() == "") ? $(this).addClass('is-invalid') : $(this).removeClass('is-invalid') });
			
		selectSex.select2({
			width: '100%',
			theme: 'bootstrap4',
			placeholder: 'Select Sex',
			allowClear: true,
			data:sex_selection
		}).on('change', function() {($(this).val() == "") ? $(this).addClass('is-invalid') : $(this).removeClass('is-invalid') });

		selectRole.select2({
			width: '100%',
			theme: 'bootstrap4',
			placeholder: 'Select Role',
			allowClear: true,
			data:role_selection
		}).on('change', function() {($(this).val() == "") ? $(this).addClass('is-invalid') : $(this).removeClass('is-invalid') });

		// Upload Event
		$('#upload-id').on('change', function() {

			let file = $('#upload-id').val().split(".");

			// Check file extension if image
			if(file[file.length - 1] == "jpg" || file[file.length - 1] == "jpeg" || file[file.length - 1] == "png") {}
			else {

				Swal.fire({
					position: 'top',
					icon: 'warning',
					title: 'Invalid File!',
					text: 'JPEG, JPG and PNG image file only.',
					showConfirmButton: true
				});

				$(this).val('');

			}// else 

		});

		$('#register-user').validate({
			rules: {
				lname: {required: true},
				fname: {required: true},
				mname: {required: true},
				address: {required: true},
				civil_status: {required: true},
				sex: {required: true},
				role: {required: true},
				contact_number: {required: true, maxlength: 11, minlength: 11},
				email: {required: true},
				password: {required: true, minlength: 8},
				confirm_password: {equalTo: "#_pass"},
				upload_pic: {required: true}
			},
			messages: {
				confirm_password: "Must be same value with Password"
			},
			errorElement: 'span',
			errorPlacement: function(error, element) {
				error.addClass('invalid-feedback');
				element.closest('.input-group').append(error);
				element.closest('.form-group').append(error);
			},
			highlight: function(element, errorClass, validClass) { $(element).addClass('is-invalid'); },
			unhighlight: function(element, errorClass, validClass) { $(element).removeClass('is-invalid'); },
			submitHandler: function(form) {
			
				Swal.fire({
					position: 'top',
					title: 'Are you sure!',
					text: 'You want to Register?',
					showCancelButton: true,
					confirmButtonColor: '#3085d6',
					cancelButtonColor: '#d33',
					confirmButtonText: 'Register',
				}).then((result) => {

					if(result.isConfirmed) {
						
						let formData = new FormData(form);

						$.ajax({
							url: '../controller/RegisterController.php',
							type: 'POST',
							processData: false,
							contentType: false,
							data:formData,
							success: function(response) {

								if(response.status == true) {

									Swal.fire({
										position: 'top',
										icon: 'success',
										title: 'Registered!',
										showConfirmButton: false,
										timer: 1000
									}).then(function() {
										window.location.href = '../login/';
									});

								}
								else {

									Swal.fire({
										position: 'top',
										icon: 'warning',
										title: response.message,
										showConfirmButton: true
									});

								}

							}
						});
						
					}
					
				});
			
			}// submit handler
		});// validate
	
	});// document ready

</script>

</body>
</html>
