<?php

    include_once __DIR__ . '/../objects/session.php';

    $SES = Session::getInstance();

    if($SES->id == null) {
        header("location: ../login/");
    }
    else if(isset($SES->id) && $SES->role_name == 'client') {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Client Form</title>
    <?php require_once __DIR__ . '/../components/link.html'; ?>
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
                    <div class="row mb-2">
                        <div class="col-sm-1"> 
                            <a href="#" onclick="history.back()"><i class="fas fa-arrow-left" style="color: black;"></i></a> 
                        </div>
                        <div class="col-sm-10"> <h4 class="m-0">Services</h4> </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid main-content">
                    <div class="card border border-dark">

                        <div class="card-header">
                            <h3>Hi Client!</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body" id="card-body-id">

                            <div class="row mb-2"><h4>Client Information:</h4></div>

                                <div class="row">

                                    <div class="form-group col-4">
                                        <label>Last Name</label>
                                        <div class="form-control disabled-bg-color"></div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>First Name</label>
                                        <div class="form-control disabled-bg-color"></div>
                                    </div>

                                    <div class="form-group col-4">
                                        <label>Middle Name</label>
                                        <div class="form-control disabled-bg-color"></div>
                                    </div>

                                </div>
                                <!-- /.row -->

                                <div class="row">

                                    <div class="form-group col-8">
                                        <label>Address</label>
                                        <div class="form-control disabled-bg-color"></div>
                                    </div>
                                    <div class="form-group col-4">
                                        <label>Civil Status</label>
                                        <div class="form-control disabled-bg-color"></div>
                                    </div>

                                </div>
                                <!-- /.row -->

                                <div class="row">

                                    <div class="form-group col-6">
                                        <label>Email Address</label>
                                        <div class="form-control disabled-bg-color"></div>
                                    </div>

                                    <div class="form-group col-6">
                                        <label>Contact Number</label>
                                        <div class="form-control disabled-bg-color"></div>
                                    </div>

                                </div>
                                <!-- /.row -->

                                <div class="float-right">
                                    <button type="button" class="btn btn-primary">Submit</button>
                                </div>

                        </div>
                        <!-- /.card-body -->

                    </div>
                    <!-- /.card -->
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

</body>
</html>

<script>

    $(document).ready(function() {

        // Assign Role to js variable
        let user_id = "<?php echo $SES->id; ?>";
        let role = "<?php echo $SES->role_name; ?>";
        let type_id = GetURLParameter('type_id');

        // Client Form Variables
        let lname = $($('#card-body-id div')[3]);
        let fname = $($('#card-body-id div')[5]);
        let mname = $($('#card-body-id div')[7]);
        let address = $($('#card-body-id div')[10]);
        let civil_status = $($('#card-body-id div')[12]);
        let email = $($('#card-body-id div')[15]);
        let contact = $($('#card-body-id div')[17]);

        displaySidebar(role, 'Services');

        // User Info
        $.ajax({
            url: '../controller/ProfileController.php',
            type: 'POST',
            data: {case: 'get_info', id: user_id},
            success: function(data) {

                lname.text(data.last_name);
                fname.text(data.first_name);
                mname.text(data.middle_name);
                address.text(data.address);
                civil_status.text(data.civil_status);
                email.text(data.email);
                contact.text(data.contact_number);

            }
        });

        // Submit Service for Rental
        $('button').on('click', function(e) {

            e.preventDefault();

            Swal.fire({
                position: 'top',
                title: 'Are you sure!',
                text: 'You want to Submit this Reservation?',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Submit',
            }).then((result) => { 

                if(result.isConfirmed) {

                    $.ajax({
                        url: '../controller/ServicesController.php',
                        type: 'POST',
                        data: {
                            case: 'client request', type_id: type_id,
                            user_id: user_id, status: 'Pending'
                        },
                        success: function(response) {

                            if(response.status == true) {
                                Swal.fire({
                                    position: 'top',
                                    icon: 'success',
                                    title: 'Your Request has been Processed!',
                                    showConfirmButton: false,
                                    timer: 1000
                                }).then(function() {
                                    window.location.href = '../dashboard/';
                                });
                            }
                            else {
                                Swal.fire({
                                    position: 'top',
                                    icon: 'warning',
                                    title: response.message,
                                    showConfirmButton: true
                                });
                            }// else

                        }
                    });

                }// if

            });// swal

        });// on submit


    });// document

</script>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>