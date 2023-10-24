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
            "order": [[6, 'desc']],
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
                {title: 'Status', 'data': 'status_id', targets: [6]},
                {title: 'Action', 'data': 'action', targets: [7]},

            ],
            createdRow: function(row, data, index) {
                
                // Action Buttons
                let btn_approve = $("<button type='button' class='btn btn-success mr-2'> Approve </button>");
                let btn_disapprove = $("<button type='button' class='btn btn-danger'> Disapprove </button>");
                let btn_update = $("<button type='button' class='btn btn-success mr-2'> Update </button>");
                let btn_delete = $("<button type='button' class='btn btn-danger'> Delete </button>");
                
                // Location Button
                $('td', row).eq(5).text('').append("<button class='btn btn-primary'>View</button>");
                
                // Status bg color
                $('td', row).eq(6).text('').append(data.status).addClass(data.status_class);

                // Action Dropdown Menus
                switch(data.status) {

                    case 'Client':

                        // Append Buttons
                        $('td', row).eq(7).text('').append(btn_update).append(btn_delete);

                        btn_update.on('click', function(e) {
                            e.preventDefault();
                            window.location.href = 'update.php?id=' + data.user_id;
                        });// button update

                    break;

                    case 'Pending Registration':

                        // Append Buttons
                        $('td', row).eq(7).text('').append(btn_approve).append(btn_disapprove);

                        btn_approve.on('click', function(e) {

                            e.preventDefault();

                            Swal.fire({
                                position: 'top',
                                title: 'Approve this User?',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => { 
                                if(result.isConfirmed) {

                                    Swal.fire({
                                        title: 'Processing..',
                                        didOpen: () => {
                                            Swal.showLoading()
                                        }
                                    });

                                    $.ajax({
                                        url: '../controller/ProfileController.php',
                                        type: 'POST',
                                        data: {
                                            case: 'update client registration',
                                            button: 'approve',
                                            user_id: data.user_id
                                        },
                                        success: function(response) {

                                            if(response.status) {
                                                Swal.fire({
                                                    position: 'top',
                                                    icon: 'success',
                                                    title: 'Client Registration Approved!',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {
                                                    location.reload();
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
                                }// if
                            });// swal

                        });// approve on click

                        btn_disapprove.on('click', function(e) { 

                            e.preventDefault();

                            Swal.fire({
                                position: 'top',
                                title: 'Disapprove this User?',
                                showCancelButton: true,
                                confirmButtonColor: '#3085d6',
                                cancelButtonColor: '#d33',
                                confirmButtonText: 'Yes'
                            }).then((result) => { 
                                if(result.isConfirmed) {
                                    $.ajax({
                                        url: '../controller/ProfileController.php',
                                        type: 'POST',
                                        data: {
                                            case: 'update client registration',
                                            button: 'disapprove',
                                            user_id: data.user_id
                                        },
                                        success: function(response) {
                                            if(response.status) {
                                                Swal.fire({
                                                    position: 'top',
                                                    icon: 'success',
                                                    title: 'Client Registration Disapproved!',
                                                    showConfirmButton: false,
                                                    timer: 1500
                                                }).then(function() {
                                                    location.reload();
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
                                }// if
                            });// swal

                        });// disapprove on click

                    break;

                }// switch

            }
        });// DataTable

    });// document

</script>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>