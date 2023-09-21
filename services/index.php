<?php

    include_once __DIR__ . '/../objects/session.php';

    $SES = Session::getInstance();

    if(isset($SES->id)) {

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

            <?php 
            
                switch($SES->role_name) {

                    case 'client':
                        require_once __DIR__ . '/client_index.html';
                    break;

                }// switch
            
            ?>

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

        switch(role) {

            case 'client':

                // List of Services Available
                $.ajax({
                    url: '../controller/ServicesController.php',
                    type: 'POST',
                    data: {case: 'services'},
                    success: function(data) {
                        
                        data.forEach(element => {

                            let div_col = $("<div class='col-lg-3 col-6'></div>");
                            let small_box = $("<div class='small-box bg-success'></div>");
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

            break;

        }// switch

    });// document

</script>

<?php
    }else if(isset($_GET['direct_service'])){
        require_once __DIR__ . '/direct_service.php';
    }
    else {
        header("location: ../objects/logout.php");
    }
?>