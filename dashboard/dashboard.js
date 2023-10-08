
// Get Number of Tenants
$.ajax({
    url: '../controller/ProfileController.php',
    type: 'POST',
    data: {case: 'get registered clients'},
    success: function(data) {

        let click_count = 0;

        // Total Number of Tenants Display Count
        $('#tenants-box-id h3').text(data.length);

        // Tenants Box On Click
        $('#tenants-box-id').on('click', function() {

            if(click_count == 0) {
    
                // Modal Table
                $('#modal-tenant-id table').DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    "data": data,
                    columns: [
                        {data: 'name'}, {data: 'sex'},
                        {data: 'email'}, {data: 'civil_status'},
                        {data: 'address'}, {data: 'contact_number'}
                    ]
                });    
    
            }// if

            click_count++;

        });// on click tenants box

    }
});// ajax number of tenants

// Get Total Number of Rental Service Available
$.ajax({
    url: '../controller/ServicesController.php',
    type: 'POST',
    data: {case: 'available service', status: 'yes'},
    success: function(data) {

        let click_count = 0;

        // Total Rental Service
        $('#available-box-id h3').text(data.length);

        // Total Rental Box
        $('#available-box-id').on('click', function() {

            if(click_count == 0) {
                
                $('#modal-rental-id table').DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    "data": data,
                    columns: [
                        {data: 'type_name'}, {data: 'location'},
                        {data: 'price'}, {data: 'description'}
                    ]
                });

            }// if

            click_count++;

        });// rental box on click

    }
});

// GET Total Number of Persons Paid
$.ajax({
    url: '../controller/ServicesController.php',
    type: 'POST',
    data: {case: 'persons paid'},
    success: function(data) {

        console.table(data);

        let click_count = 0;

        // Total Number of Tenants Display Count
        $('#paid-box-id h3').text(data.length);

        // Tenants Box On Click
        $('#paid-box-id').on('click', function() {

            if(click_count == 0) {
    
                // Modal Table
                $('#modal-paid-id table').DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    "data": data,
                    columns: [
                        {data: 'client_name'}, 
                        {data: 'service_name'}, 
                        {data: 'location'},
                        {data: 'service_price'},
                        {data: 'total_paid'}
                    ]
                });    
    
            }// if

            click_count++;

        });// on click tenants box

    }
});

// GET Total Number of Occupied Slots
$.ajax({
    url: '../controller/ServicesController.php',
    type: 'POST',
    data: {case: 'occupied slots', availability: 'no'},
    success: function(data) {

        let click_count = 0;

        // Total Number of Tenants Display Count
        $('#occupied-box-id h3').text(data.length);

        // Tenants Box On Click
        $('#occupied-box-id').on('click', function() {

            if(click_count == 0) {
    
                // Modal Table
                $('#modal-occupied-id table').DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    "data": data,
                    columns: [
                        {data: 'type_name'}, {data: 'location'}, {data: 'price'}
                    ]
                });    
    
            }// if

            click_count++;

        });// on click tenants box

    }
});

// Get Pending Requests
$.ajax({
    url: '../controller/ServicesController.php',
    type: 'POST',
    data: {case: 'pending request'},
    success: function(data) {

        let click_count = 0;

        // Pending Request Count Display
        $('#pending-box-id h3').text(data.length);

        // Pending Request Box On Click
        $('#pending-box-id').on('click', function() {

            if(click_count == 0) {

                // Modal Table
                let pending_table = $('#modal-pending-id table').DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    select: true,
                    "data": data,
                    columns: [
                        {data: 'client_name'}, 
                        {data: 'service_name'}, 
                        {data: 'service_price'}, 
                        {data: 'status'}
                    ]
                });// table end

                // Table Select Event
                pending_table.on('select', function(e, dt, type, indexes) {

                    let selected_row = pending_table.row('.selected').data();

                    console.log("selected", selected_row);

                    Swal.fire({
                        title: 'Client Payment',
                        html: `<input type="number" id="payment" class="swal2-input" placeholder="Enter Payment">`,
                        confirmButtonText: 'Submit',
                        showCancelButton: true,
                        focusConfirm: false,
                        preConfirm: () => {

                            const payment = Swal.getPopup().querySelector('#payment').value
                            const client_id = selected_row.client_id;
                            const form_id = selected_row.id;
                            const service_id = selected_row.service_id;
                            const service_price = selected_row.service_price;
                            const status = selected_row.status;

                            // If Empty
                            if (!payment) {
                                Swal.showValidationMessage(`Please Enter Payment!`)
                            }
                            
                            return {
                                payment: payment, client_id: client_id,
                                form_id: form_id, service_id: service_id, 
                                service_price: service_price, status: status
                            }

                        }
                    }).then((result) => {

                        // Submit to Payments
                        $.ajax({
                            url: '../controller/ServicesController.php',
                            type: 'POST',
                            data: {
                                case: 'submit client payment',
                                client_id: result.value.client_id,
                                form_id: result.value.form_id,
                                service_id: result.value.service_id,
                                payment: result.value.payment,
                                service_price: result.value.service_price,
                                status: result.value.status
                            },
                            success: function(response) {

                                if(response.status) {

                                    Swal.fire({
										position: 'top',
										icon: 'success',
										title: 'Payment Successful!',
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
                        

                    }); // sweet alert end

                });// pending table select

            }// if
            
            click_count++;

        });// on click

    }
});// ajax pending request