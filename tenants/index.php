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
                    <div class="col-sm-6">
                        <h1 class="m-0">Tenants</h1>
                    </div><!-- /.col -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                <div class="row">

                    <div class="col-12">
                        <div class="card">
                            <div class="card-header">
                                <button class="btn btn-primary"><i class="fas fa-plus"> Add New</i></button>
                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <table id="tenants-table-id" class="table table-bordered table-striped"></table>
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

</body>
</html>

<script>

    $(document).ready(function() {

        // Assign Role to js variable
        let user_id = "<?php echo $SES->id; ?>";
        let role = "<?php echo $SES->role_name; ?>";
        displaySidebar(role, 'Tenants');

        $('#tenants-table-id').DataTable({
            "responsive": true,
            "autoWidth": false,
            "lengthChange": false,
            ajax: {
                url: '../controller/ProfileController.php',
                type: 'POST',
                data: {case: 'get all clients'}
            },
            columns: [

                {title: 'Last Name', 'data': 'last_name', targets: [0]},
                {title: 'First Name', 'data': 'first_name', targets: [1]},
                {title: 'Address', 'data': 'address', targets: [2]},
                {title: 'Email', 'data': 'email', targets: [3]},
                {title: 'Phone Number', 'data': 'contact_number', targets: [4]},
                {title: 'Location', 'data': 'location', targets: [5]},
                {title: 'Action', 'data': 'action', targets: [6]},

            ],
            createdRow: function(row, data, index) {

                // Location Button
                $('td', row).eq(5).text('').append("<button class='btn btn-primary'>View</button>");

                // Action Button
                let action_buttons = 
                $(
                    "<div>" +
                        "<button class='btn btn-success mr-2'>Update</button>" +
                        "<button class='btn btn-danger'>Delete</button>" +
                    "</div>"
                );
                $('td', row).eq(6).text('').append(action_buttons);

            }
        });

    });// document

</script>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>