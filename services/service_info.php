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
    <title>Service Info</title>
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
                        <div class="col-sm-10"> <h4 class="m-0"></h4> </div>
                    </div><!-- /.row -->
                </div><!-- /.container-fluid -->
            </div>
            <!-- /.content-header -->

            <!-- Main content -->
            <section class="content">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-6"></div>
                        <div class="col-6"></div>
                    </div>
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
        let service_name = GetURLParameter('s');
        let type_id = GetURLParameter('type_id');

        displaySidebar(role, 'Services');
        $('h4').text('Services/' + service_name + '/Information');

        // Service Info
        $.ajax({
            url: '../controller/ServicesController.php',
            type: 'POST',
            data: {case: 'service info', type_id: type_id},
            success: function(data) {

                // Variables
                let image_col = $($('.col-6')[0]);
                let info_col = $($('.col-6')[1]);
                let image = $("<img src='../includes/images/"+data.service_image+"' alt='service info image' width='100%'>");
                let details = 
                    $(
                        "<div class='row justify-content-center'> <h3>DETAILS</h3></div>" +
                        "<div class='row justify-content-center'>" +
                            "<div style='width: 80%'>" +
                                "<div class='row'>"+ data.description +"</div>" +
                            "</div>" +
                            "<div style='width: 80%'>" +
                                "<div class='row mt-2'> <b class='mr-1'>Price:</b> " + data.price + "</div>" +
                            "</div>" +
                            "<div style='width: 80%'>" +
                                "<div class='row mt-2'> <b class='mr-1'>Location:</b> " + data.location + "</div>" +
                            "</div>" +
                            "<div style='width: 80%'>" +
                                "<div class='row mt-2 float-right'> <a href='client_form.php?type_id="+ data.type_id +"' class='btn btn-primary'>I Choose This</a> </div>" +
                            "</div>" +
                        "</div>"
                    );

                // Image
                image.addClass('shadow-lg p-3 mb-5 bg-white rounded');
                image_col.append(image);

                // Description
                info_col.append(details);

            }
        });

    });// document

</script>

<?php
    }else {
        header("location: ../objects/logout.php");
    }
?>