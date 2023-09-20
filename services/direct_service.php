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
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-1">
                        <a href="#" onclick="history.back()"><i class="fas fa-arrow-left" style="color: black;"></i></a>
                    </div>
                    <div class="col-sm-10"><h4></h4></div>
                </div>
            </div>
            <div class="card-body"></div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->

<?php require_once __DIR__ . '/../components/script.html'; ?>

<script>

    $(document).ready(function() {

        let service_name = GetURLParameter('service_name');
        let type_id = GetURLParameter('type_id');


        // If process is for service_info
        if(type_id) {

            // Header Display
            $('h4').text('Services/' + service_name + '/Information');

            // Service Info
            $.ajax({
                url: '../controller/ServicesController.php',
                type: 'POST',
                data: {case: 'service info', type_id: type_id},
                success: function(data) {

                    // Variables
                    let card_body = $('.card-body');
                    let card_row = $("<div class='row'></div>");
                    let image_col = $("<div class='col-6'></div>");
                    let info_col = $("<div class='col-6'></div>");
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
                                    "<div class='row mt-2 float-right'> <a href='client_form.php?type_id='"+ data.type_id +"' class='btn btn-primary'>I Choose This</a> </div>" +
                                "</div>" +
                            "</div>"
                        );

                    // Image
                    image.addClass('shadow-lg p-3 mb-5 bg-white rounded');
                    image_col.append(image);

                    // Description
                    info_col.append(details);

                    // Append Columns
                    card_row.append(image_col).append(info_col);
                    card_body.append(card_row);

                }
            });// ajax

        }
        else {

            // Header Display
            $('h4').text('Services/' + service_name);

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
                            .on('click', () => { 
                                window.location.href = 'direct_service.php?service_name=' + service_name + '&type_id=' + element.type_id 
                            });
                        let p_name = $("<p class='mb-0'>"+ element.type_name +"</p>");
                        let p_availability = $("<p> Available: "+ element.availability_status +"</p>");

                        div_col.append(img).append(p_name).append(p_availability);
                        row.append(div_col);

                    });

                    // Display Images to card
                    $('.card-body').append(row);

                }
            });// ajax

        }// else        

    });// document ready

</script>

</body>
</html>