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
    <title>Services</title>
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
                            <h1 class="m-0">List of Services Available</h1>
                        </div><!-- /.col -->
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">

                    <div class="card border border-dark">

                        <div class="card-header">
                            <h3>Hi Client!</h3>
                        </div>
                        <!-- /.card-header -->

                        <div class="card-body" >
                            <div class="row" id="services-row-id"></div>
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
        displaySidebar(role, 'Services');

        // List of Services Available
        $.ajax({
            url: '../controller/ServicesController.php',
            type: 'POST',
            data: {case: 'services'},
            success: function(data) {
                
                data.forEach(element => {

                    let div_col = $("<div class='col-lg-3 col-6'></div>");
                    let small_box = $("<div class='small-box bg-info'></div>");
                    let inner = $("<div class='inner'></div>");

                    inner.append("<p>"+element.service_name+"</p>");
                    small_box.append(inner).css('cursor', 'pointer').on('click', () => {
                        window.location.href = 'service_type.php?s=' + element.service_name;
                    });
                    
                    div_col.append(small_box);
                    $('#services-row-id').append(div_col);
                    
                });

            }
        });

    });// document

</script>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>