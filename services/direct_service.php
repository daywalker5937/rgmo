<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Services</title>
    <?php require_once __DIR__ . '/../components/link.html'; ?>
</head>

<body class="hold-transition sidebar-mini layout-fixed">
    <div class="row justify-content-center">
        <div class="card m-4 col-10">
            <div class="card-header"><h3>Services</h3></div>
            <div class="card-body"></div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->

<?php require_once __DIR__ . '/../components/script.html'; ?>

<script>

    $(document).ready(function() {

        let service_name = GetURLParameter('direct_service');

        // List of Services Available
        $.ajax({
            url: '../controller/ServicesController.php',
            type: 'POST',
            data: {case: 'fetch type', service_name: service_name},
            success: function(data) {

                let row = $("<div class='row'></div>");
                
                data.forEach(element => {
                    
                    let div_col = $("<div class='col-sm-6'></div>");
                    let img = $("<img src='../includes/images/"+element.service_image+"' alt='service image' class='border border-dark' height='200' width='50%'>")
                        .css('cursor', 'pointer')
                        .on('click', () => { window.location.href = 'service_info.php?s=' + service_name + '&type_id=' + element.type_id });
                    let p_name = $("<p class='mb-0'>"+ element.type_name +"</p>");
                    let p_availability = $("<p> Available: "+ element.availability_status +"</p>");

                    div_col.append(img).append(p_name).append(p_availability);
                    row.append(div_col);

                });

                // Display Images to card
                $('.card-body').append(row);

            }
        });

    });

</script>

</body>
</html>