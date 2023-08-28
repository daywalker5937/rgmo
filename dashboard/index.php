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

                        <!-- Small boxes (Stat box) -->
                        <div class="row">

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-info">
                                <div class="inner">
                                    <h3>150</h3>

                                    <p>New Orders</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-bag"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-success">
                                <div class="inner">
                                    <h3>53<sup style="font-size: 20px">%</sup></h3>

                                    <p>Bounce Rate</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-stats-bars"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-warning">
                                <div class="inner">
                                    <h3>44</h3>

                                    <p>User Registrations</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-person-add"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

                            <div class="col-lg-3 col-6">
                                <!-- small box -->
                                <div class="small-box bg-danger">
                                <div class="inner">
                                    <h3>65</h3>

                                    <p>Unique Visitors</p>
                                </div>
                                <div class="icon">
                                    <i class="ion ion-pie-graph"></i>
                                </div>
                                <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
                                </div>
                            </div>
                            <!-- ./col -->

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

</body>
</html>

<script>

    $(document).ready(function() {

        // Assign PHP variable to js variable
        let role = "<?php echo $SES->role_name;  ?>"
        displaySidebar(role, 'Dashboard');

        $.ajax({
            url: '../controller/ServicesController.php',
            type: 'POST',
            data: {case: 'fetch service'},
            success: function(data) {

                // Icon Total Number of Services
                $('#number-icon-id').addClass("bi bi-"+data.length+"-circle fa-lg");
                
                // List of Services
                data.forEach(element => {
                    
                    let outer_div = $("<div class='row justify-content-center mb-2'></div>");
                    let inner_div = $("<div class='col-11'></div>");
                    let data_a = $("<a href='#'></a>");
                    let data_div = $("<div class='form-control border border-dark'></div>");

                    data_div.text(element.service_name).on('mouseover', () => { 
                        $(data_div).css('background-color', '#A9A9A9').css('color', '#fff');
                    }).on('mouseleave', () => { 
                        $(data_div).css('background-color', '#fff').css('color', '#000000');
                    });
                    data_a.append(data_div)
                    inner_div.append(data_a);
                    outer_div.append(inner_div);
                    $('#card-services-id').append(outer_div);

                });
            }
        });

    });

</script>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>