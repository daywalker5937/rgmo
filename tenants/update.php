<?php

    include_once __DIR__ . '/../objects/session.php';

    $SES = Session::getInstance();

    if($SES->id == null) {
        header("location: ../login/");
    }
    else if(isset($SES->id) && $SES->role_name == 'admin') {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Tenants</title>
    <?php require_once __DIR__ . '/../components/link.html'; ?>

    <style>
        #caps-pass, #caps-confirm {
            display: none;
            color: red;
            font-weight: bold;
        }
    </style>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <?php
            require_once __DIR__ . '/../components/navbar.php';
            require_once __DIR__ . '/../components/sidebar.php';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="col-sm-1">
                        <a href="#" onclick="history.back()"><i class="fas fa-arrow-left" style="color: black;"></i></a>
                    </div>
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                <div class="row">

                    <div class="col-10 mx-auto">
                        <div class="card">

                            <div class="card-header">
                                <h4>Update Tenant's Info</h4>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <form id="update-info-id" autocomplete="off" enctype="multipart/form-data">
                        
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
                                        <div class="input-group mb-3 col-12">
                                            <input type="text" name="address" class="form-control" placeholder="Address">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-address-card"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <div class="input-group mb-3 col-6">
                                            <select name="civil_status"></select>
                                        </div>
                                        <div class="input-group mb-3 col-6">
                                            <input type="number" name="contact_number" class="form-control" placeholder="Contact Number">
                                            <div class="input-group-append">
                                                <div class="input-group-text">
                                                    <span class="fas fa-phone"></span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                    <div class="row">
                                        <div class="input-group mb-3 col-6">
                                            <select name="sex"></select>
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

                                    <div class="col-12">
                                        <div class="float-right">
                                            <button type="submit" class="btn btn-primary btn-block">Update</button>
                                        </div>
                                    </div>
                                    <!-- /.row -->

                                </form>
                                
                            </div>
                            <!-- /.card-body -->
                        </div>
                        <!-- /.card -->
                    </div>
                    <!-- /.col-12 -->

                </div>
                <!-- /.row -->

                </div><!-- /.container-fluid -->
            </section>
            <!-- /.content -->

        </div>
        <!-- /.content-wrapper -->

        <?php require_once __DIR__ . '/../components/footer.html'; ?>

        <!-- Control Sidebar -->
        <aside class="control-sidebar control-sidebar-dark">
            <!-- Control sidebar content goes here -->
        </aside>
        <!-- /.control-sidebar -->

    </div>
    <!-- ./wrapper -->

    <?php require_once __DIR__ . '/../components/script.html'; ?>
    <script src="../components/pass-show-hide.js"></script>

    <script>

        $(document).ready(function() {

            // Assign Role to js variable
            let user_id = "<?php echo $SES->id; ?>";
            let role = "<?php echo $SES->role_name; ?>";
            displaySidebar(role, 'Tenants');

            // Display Info Variables
            let lastname = $($('#update-info-id input')[0]);
            let firstname = $($('#update-info-id input')[1]);
            let middlename = $($('#update-info-id input')[2]);
            let address = $($('#update-info-id input')[3]);
            let contact = $($('#update-info-id input')[4]);
            let email = $($('#update-info-id input')[5]);
            let civil_select = $($('#update-info-id select')[0]);
            let sex = $($('#update-info-id select')[1]);

            // Get User Info and Display
            $.ajax({
                url: '../controller/ProfileController.php',
                type: 'POST',
                data: {case: 'get for update', id: GetURLParameter('id')},
                success: function(data) {

                    // Display Info
                    lastname.val(data.last_name);
                    firstname.val(data.first_name);
                    middlename.val(data.middle_name);
                    address.val(data.address);
                    contact.val(data.contact_number);
                    email.val(data.email);

                    // Display Selected Civil Status
                    civil_select.select2({width: '100%', theme: 'bootstrap4', data: data.civil_status});

                    // Display Selected Gender
                    sex.select2({width: '100%', theme: 'bootstrap4', data: data.sex});


                }
            });

            // Validate and Submit Update
            $('#update-info-id').validate({
                rules: {
                    lname: {required: true},
                    fname: {required: true},
                    mname: {required: true},
                    address: {required: true},
                    civil_status: {required: true},
                    sex: {required: true},
                    contact_number: {required: true, maxlength: 11, minlength: 11},
                    email: {required: true}
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                },
                highlight: function(element, errorClass, validClass) { $(element).addClass('is-invalid'); },
                unhighlight: function(element, errorClass, validClass) { $(element).removeClass('is-invalid'); },
                submitHandler: function(form) {
			
                    Swal.fire({
                        position: 'top',
                        title: 'Are you sure!',
                        text: 'You want to Update this User?',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes',
                    }).then((result) => {

                        if(result.isConfirmed) {
                            
                            let formData = new FormData(form);
                            formData.append('case', 'update client info');
                            formData.append('id', GetURLParameter('id'));

                            $.ajax({
                                url: '../controller/ProfileController.php',
                                type: 'POST',
                                contentType: false,
                                processData: false,
                                data: formData,
                                success: function(response) {

                                    if(response.status == true) {
                                        Swal.fire({
                                            position: 'top',
                                            icon: 'success',
                                            title: 'Updated!',
                                            showConfirmButton: false,
                                            timer: 1000
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


        });// ready

    </script>

</body>
</html>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>