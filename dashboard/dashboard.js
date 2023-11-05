
// Client Dashboard
let client_payments = $('#client-payments-table').DataTable({
    "responsive": true,
    "autoWidth": false,
    "lengthChange": false,
    select: true,
    ajax: {
        url: '../controller/ServicesController.php',
        type: 'POST',
        data: {case: 'user payment'}
    },
    columns: [
        {title: 'Service', 'data': 'type_name', targets: [0]},
        {title: 'Price', 'data': 'service_price', targets: [1]},
        {title: 'Payment', 'data': 'payment', targets: [2]},
        {title: 'Balance', 'data': 'payment_balance', targets: [3]}
    ]
});

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

        let click_count = 0;

        // Total Number of Persons Paid Display Count
        $('#paid-box-id h3').text(data.length);

        // Paid Box On Click
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

        // Total Number of Occupied Display Count
        $('#occupied-box-id h3').text(data.length);

        // Occupied Box On Click
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

                    Swal.fire({
                        title: 'Client Payment',
                        html: `<input type="number" id="payment" class="swal2-input" placeholder="Enter Payment">`,
                        confirmButtonText: 'Submit',
                        showCancelButton: true,
                        focusConfirm: false,
                        preConfirm: () => {

                            const payment = Swal.getPopup().querySelector('#payment').value;
                            const client_id = selected_row.client_id;
                            const form_id = selected_row.id;
                            const service_id = selected_row.service_id;
                            const service_price = selected_row.service_price.replaceAll(",","");
                            const status = selected_row.status;

                            // If Empty
                            if (!payment) {
                                Swal.showValidationMessage(`Please Enter Payment!`)
                            }

                            // If Entered Payment is more than Price
                            if(parseInt(payment) > parseInt(service_price)) {
                                Swal.showValidationMessage(`Payment Inserted is more than the Service Price`);
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

// Get List of Payments
let payments_table = $('#admin-payment-list').DataTable({
    "responsive": true,
    "autoWidth": false,
    "lengthChange": false,
    select: true,
    ajax: {
        url: '../controller/ServicesController.php',
        type: 'POST',
        data: {case: 'admin reports'}
    },
    columns: [
        {title: 'Client Name', 'data': 'client_name', targets: [0]},
        {title: 'Email', 'data': 'client_email', targets: [1]},
        {title: 'Phone Number', 'data': 'contact_number', targets: [2]},
        {title: 'Service', 'data': 'service_name', targets: [3]},
        {title: 'Service Price', 'data': 'service_price', targets: [4]},
        {title: 'Balance', 'data': 'remaining_balance', targets: [5]}
    ]
});

// On Select for Payments Table
payments_table.on('select', function(e, dt, type, indexes) {

    let selected_row = payments_table.row('.selected').data();

    if(selected_row.remaining_balance !== 0) {

        Swal.fire({
            position: 'top',
            title: 'Pay Balance?',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            confirmButtonText: 'Yes',
            cancelButtonColor: '#d33'
        }).then((result) => {
    
            if(result.isConfirmed) {
    
                // Payment Form
                Swal.fire({
                    title: 'New Payment',
                    html: `<input type="number" id="new-payment" class="swal2-input" placeholder="Enter Payment">`,
                    confirmButtonText: 'Submit',
                    showCancelButton: true,
                    focusConfirm: false,
                    preConfirm: () => {
    
                        const payment = Swal.getPopup().querySelector('#new-payment').value;
                        const client_id = selected_row.client_id;
                        const payment_id = selected_row.payment_id;
                        const form_id = selected_row.id;
                        const service_id = selected_row.service_id;
                        const service_price = selected_row.service_price;
                        const remaining_balance = selected_row.remaining_balance;
                        const total_paid = selected_row.total_paid;
                        const status = selected_row.status;
    
                        // If Empty
                        if(!payment) {
                            Swal.showValidationMessage(`Please Enter Payment`);
                        }
    
                        // If Entered Payment is more than Remaining Balance
                        if(payment > remaining_balance) {
                            Swal.showValidationMessage(`Payment Inserted is more than the Remaining Balance`);
                        }
    
                        return {
                            payment: payment, payment_id: payment_id,
                            client_id: client_id, form_id: form_id, 
                            service_id: service_id, service_price: service_price,
                            remaining_balance: remaining_balance, total_paid: total_paid,
                            status: status
                        }
    
                    }
                }).then((result) => {
    
                    // Submit New Payment
                    $.ajax({
                        url: '../controller/ServicesController.php',
                        type: 'POST',
                        data: {
                            case: 'submit client payment', payment: result.value.payment,
                            client_id: result.value.client_id, payment_id: result.value.payment_id,
                            form_id: result.value.form_id, service_id: result.value.service_id,
                            service_price: result.value.service_price, remaining_balance: result.value.remaining_balance,
                            total_paid: result.value.total_paid, status: result.value.status
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
    
                });// swal
    
            }// confirmed
            
    
        }); // sweet alert end

    }// if remaining balance is not equal to 0

});// on select