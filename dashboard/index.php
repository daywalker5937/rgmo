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
    <title>Dashboard</title>
    <?php require_once __DIR__ . '/../components/link.html'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">

    <div class="wrapper">

        <?php
            require_once __DIR__ . '/../components/navbar.php';
            require_once __DIR__ . '/../components/sidebar.php';
            require_once __DIR__ . '/../components/modals.html';
        ?>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">

            <!-- Content Header (Page header) -->
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Dashboard</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    
                    <!-- Admin Dashboard View -->
                    <?php if($SES->role_name == 'admin') { ?>

                        <div class="row justify-content-center">

                            <div class="col-lg-3 col-4">
                                <div class="small-box bg-success" id="tenants-box-id" style="cursor: pointer;"
                                    data-toggle="modal" data-target="#modal-tenant-id">
                                    <div class="inner">
                                        <h3></h3>
                                        <p>Total Number of Tenants</p>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->

                            <div class="col-lg-3 col-4">
                                <div class="small-box bg-success" id="available-box-id" style="cursor: pointer;"
                                    data-toggle="modal" data-target="#modal-rental-id">
                                    <div class="inner">
                                        <h3></h3>
                                        <p>Total Number of Rental Service Available</p>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->

                            <div class="col-lg-3 col-4">
                                <div class="small-box bg-success" id="paid-box-id" style="cursor: pointer;"
                                data-toggle="modal" data-target="#modal-paid-id">
                                    <div class="inner">
                                        <h3></h3>
                                        <p>Total Number of Person's Paid</p>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->

                        </div>
                        <!-- /.row -->

                        <div class="row justify-content-center">

                        <div class="col-lg-3 col-4">
                                <div class="small-box bg-success" id="occupied-box-id" style="cursor: pointer;"
                                data-toggle="modal" data-target="#modal-occupied-id">
                                    <div class="inner">
                                        <h3></h3>
                                        <p>Total Number of Occupied Slots</p>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->

                            <div class="col-lg-3 col-4">
                                <div class="small-box bg-success" id="pending-box-id" style="cursor: pointer;"
                                    data-toggle="modal" data-target="#modal-pending-id">
                                    <div class="inner">
                                        <h3></h3>
                                        <p>Pending Request</p>
                                    </div>
                                </div>
                            </div>
                            <!-- ./col -->

                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>List of Payments</h4>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped"></table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col-12 -->
                        </div>
                        <!-- /.row -->

                    <?php } ?>
                    <!-- Admin Dashboard View End -->
                    
                    <!-- Client Dashboard View -->
                    <?php if($SES->role_name == 'client') { ?>

                        <!-- Header -->
                        <div class="row">

                            <div class="card border border-dark col-12">

                                <div class="card-header">
                                    
                                    <div class="row">
                                        <div class="col-11">
                                            <h3>Total Number of Services Available</h3>
                                        </div>

                                        <div class="col-1">
                                            <h3><i id="number-icon-id"></i></h3>
                                        </div>
                                    </div>

                                </div>
                                <!-- /.card-header -->

                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.row -->

                        <!-- List of Services -->
                        <div class="row">

                            <div class="card border border-dark col-12">

                                <div class="card-header">
                                    <h3>List of Services</h3>
                                </div>
                                <!-- /.card-header -->

                                <div class="card-body" id="card-services-id"></div>

                            </div>
                            <!-- /.card -->

                        </div>
                        <!-- /.row -->

                    <?php } ?>
                    <!-- Client Dashboard View End -->

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
    <script src="dashboard.js"></script>

    <script>

        $(document).ready(function() {

            // Assign PHP variable to js variable
            let role = "<?php echo $SES->role_name;  ?>"
            displaySidebar(role, 'Dashboard');

        });

    </script>

</body>
</html>



<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>