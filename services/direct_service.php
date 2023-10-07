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
        <div class="card m-4 col-10 border border-dark">
            <div class="card-header">
                <div class="row">
                    <div class="col-sm-1">
                        <a href="#" onclick="history.back()"><i class="fas fa-arrow-left" style="color: black;"></i></a>
                    </div>
                    <div class="col-sm-10"><h4></h4></div>
                </div>
            </div>
            <div class="card-body">
                <?php if(isset($_GET['client']) && $_GET['client'] == 1) { ?>

                    <form id="client-form-id">
                    
                        <div class="row mb-2"><h5>Client Information:</h5></div>

                        <div class="row">
                            <div class="form-group col-4">
                                <input type="text" name="lname" class="form-control" placeholder="Surname">
                            </div>
                            <div class="form-group col-4">
                                <input type="text" name="fname" class="form-control" placeholder="Given Name">
                            </div>
                            <div class="form-group col-4">
                                <input type="text" name="mname" class="form-control" placeholder="Middle Name">
                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="form-group col-8">
                                <input type="text" name="address" class="form-control" placeholder="Address">
                            </div>
                            <div class="form-group col-4">
                                <select name="civil_status"><option value=""></option>
                                </select>
                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="row">
                            <div class="form-group col-6">
                                <input type="email" name="email" class="form-control" placeholder="Email">
                            </div>
                            <div class="form-group col-6">
                                <input type="number" name="contact" class="form-control" placeholder="Contact Number">
                            </div>
                        </div>
                        <!-- /.row -->

                        <div class="float-right">
                            <button type="submit" class="btn btn-primary">Submit</button>
                        </div>

                    </form>

                <?php } ?>
            </div>
        </div>
        <!-- /.card -->
    </div>
    <!-- /.row -->

<?php require_once __DIR__ . '/../components/script.html'; ?>

<script>

    $(document).ready(function() {

        let service_name = GetURLParameter('service_name');
        let type_id = GetURLParameter('type_id');
        let client_bool = GetURLParameter('client');
        let civil_selection = [
            {"id": 'Single', "text": 'Single'},{"id": 'Married', "text": 'Married'},
            {"id": 'Divorced', "text": 'Divorced'},{"id": 'Widowed', "text": 'Widowed'}
        ];

        // Select Sub Service
        if(type_id == 0 && client_bool == 0) {
            
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
                                window.location.href = 'direct_service.php?service_name=' + service_name + '&type_id=' + element.type_id + '&client=0' 
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

        }// if sub service is on

        // Display Info of Selected Sub Service
        if(type_id > 0 && client_bool == 0) {

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
                                    "<div class='row mt-2 float-right'> " + 
                                        "<a href='direct_service.php?service_name="+service_name+"&type_id="+type_id+"&client=1' class='btn btn-primary'>" +
                                        "I Choose This</a>" +
                                    "</div>" +
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

        }// if display info selected sub service

        // Client Submitting Form
        if(client_bool == 1) {

            // Initialize Civil Status
            let cs_select = $('#client-form-id select');

            // Header
            $('h4').text('Hi Client!');

            // Select2 cs
            $('#client-form-id select').select2({
                width: '100%',
                theme: 'bootstrap4',
                placeholder: 'Civil Status',
                allowClear: true,
                data: civil_selection
            }).on('change', function() {($(this).val() == "") ? $(this).addClass('is-invalid') : $(this).removeClass('is-invalid') });

            // Submit Client Data
            $('#client-form-id').validate({
                rules: {
                    lname: {required: true},
                    fname: {required: true},
                    mname: {required: true},
                    address: {required: true},
                    civil_status: {required: true},
                    email: {required: true},
                    contact: {required: true, maxlength: 11, minlength: 11}
                },
                errorElement: 'span',
                errorPlacement: function(error, element) {
                    error.addClass('invalid-feedback');
                    element.closest('.input-group').append(error);
                    element.closest('.form-group').append(error);
                },
                highlight: function(element, errorClass, validClass) { $(element).addClass('is-invalid'); },
                unhighlight: function(element, errorClass, validClass) { $(element).removeClass('is-invalid'); },
                submitHandler: function(form) {

                    Swal.fire({
                        position: 'top',
                        title: 'Are you sure!',
                        text: 'You want to Submit this Request?',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Submit',
                    }).then((result) => {

                        if(result.isConfirmed) {
                            
                            let formData = new FormData(form);
                            formData.append('case', 'request');
                            formData.append('type_id', type_id);

                            $.ajax({
                                url: '../controller/RegisterController.php',
                                type: 'POST',
                                processData: false,
                                contentType: false,
                                data:formData,
                                success: function(response) {

                                    if(response.status == true) {

                                        Swal.fire({
                                            position: 'top',
                                            icon: 'success',
                                            title: 'Request Successfully Submitted!',
                                            showConfirmButton: false,
                                            timer: 1000
                                        }).then(function() {
                                            window.location.href = '../';
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
                            
                        }// is confirmed
                        
                    });// swal

                }// submit handler
            });// validate

        }// if client is submitting form

    });// document ready

</script>

</body>
</html>