<?php

    include_once __DIR__ . '/../objects/session.php';

    $SES = Session::getInstance();

    if($SES->id == null) {
        header("location: ../login/");
    }
    else if(isset($SES->id)) {

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
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
                        <div class="col-sm-6">
                            <h1 class="m-0">Profile</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    
                    <div class="row">

                        <div class="card col-12 border border-dark">

                            <div class="card-header row">
                                <div class="col-6"></div>
                                <div class="col-6"><h3>Basic Information</h3></div>
                            </div>
                            <!-- /.card-header -->

                            <div class="card-body">

                                <div class="row" id="basic-info-row">
                                    <div class="col-6"></div>
                                    <div class="col-6"></div>
                                </div>
                                <!-- /.row -->

                            </div>
                            <!-- /.card-body -->

                        </div>
                        <!-- /.card -->

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

</body>
</html>

<script>

    $(document).ready(function() {

        // Assign Role to js variable
        let user_id = "<?php echo $SES->id; ?>";
        let role = "<?php echo $SES->role_name; ?>";
        let basic_row = $('#basic-info-row col');
        displaySidebar(role, 'Profile');

        $.ajax({
            url: '../controller/ProfileController.php',
            type: 'POST',
            data: {id: user_id, case: 'get_info'},
            success: function(data) {

                let image_col = $($('#basic-info-row div')[0]);
                let info_col = $($('#basic-info-row div')[1]);

                // Display Image
                image_col.append($("<img src='../includes/images/"+data.user_image+"' width='80%' alt='Profile Picture'>"));

                // Display User Info
                info_col.append($("<div class='row p-3'>"+ "<b>Name</b>: "+ data.first_name +" "+ data.middle_name +" "+ data.last_name +"</div>"));
                info_col.append($("<div class='row p-3'>"+ "<b>Phone Number</b>: "+ data.contact_number +"</div>"));
                info_col.append($("<div class='row p-3'>"+ "<b>Address</b>: "+ data.address +"</div>"));
                info_col.append($("<div class='row p-3'>"+ "<b>Email</b>: "+ data.email +"</div>"));

            }
        });

    });// document

</script>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>