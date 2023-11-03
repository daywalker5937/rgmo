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
    <title>Reports</title>
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
                            <!-- <h1 class="m-0">Reports</h1> -->
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    
                    <!-- Admin Report View -->
                    <?php
                        if($SES->role_name == 'admin') {

                            // Switch Get
                            switch($_GET['link']) {
                                case 'payment': require_once 'payment.html'; break;
                            }// switch

                        }
                    ?>
                    
                    <!-- Client Dashboard View -->
                    <?php if($SES->role_name == 'client') { ?>

                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Payments Reports</h4>
                                    </div>
                                    <!-- /.card-header -->
                                    <div class="card-body">
                                        <table class="table table-bordered table-striped" id="client-reports-table"></table>
                                    </div>
                                    <!-- /.card-body -->
                                </div>
                                <!-- /.card -->
                            </div>
                            <!-- /.col-12 -->
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

    <script>

        $(document).ready(function() {

            // Assign PHP variable to js variable
            let role = "<?php echo $SES->role_name;  ?>";
            let user_id = "<?php echo $SES->id; ?>";
            displaySidebar(role, 'Reports');

            switch(role) {

                // If Admin
                case 'admin':

                    switch(GetURLParameter('link')) {
                        
                        // Reports Table
                        case 'payment':
                            $('#admin-reports-table').DataTable({
                                "responsive": true,
                                "autoWidth": false,
                                "lengthChange": false,
                                "aaSorting": [],
                                ajax: {
                                    url: '../controller/ServicesController.php',
                                    type: 'POST',
                                    data: {case: 'get client payments'}
                                },
                                columns: [
                                    {title: 'Client Name', 'data': 'client_name', targets: [0]},
                                    {title: 'Service', 'data': 'type_name', targets: [1]},
                                    {title: 'Price', 'data': 'service_price', targets: [2]},
                                    {title: 'Total Paid', 'data': 'total_paid', targets: [3]},
                                    {title: 'Paid in Transaction', 'data': 'payment', targets: [4]},
                                    {title: 'Balance', 'data': 'payment_balance', targets: [5]}
                                ]
                            });
                        break;

                    }// switch
                    

                break;

                // If Client
                case 'client':
                    
                    $('#client-reports-table').DataTable({
                        "responsive": true,
                        "autoWidth": false,
                        "lengthChange": false,
                        ajax: {
                            url: '../controller/ServicesController.php',
                            type: 'POST',
                            data: {case: 'client reports', client_id: user_id}
                        },
                        columns: [
                            {title: 'Service', 'data': 'type_name', targets: [0]},
                            {title: 'Price', 'data': 'service_price', targets: [1]},
                            {title: 'Total Paid', 'data': 'total_paid', targets: [2]},
                            {title: 'Paid in Transaction', 'data': 'payment', targets: [3]},
                            {title: 'Balance', 'data': 'balance', targets: [4]}
                        ]
                    });

                break;

            }// switch

        });// document ready

    </script>

</body>
</html>



<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>