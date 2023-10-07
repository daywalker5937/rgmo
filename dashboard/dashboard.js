
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

        console.table(data);

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

// Get Pending Requests
$.ajax({
    url: '../controller/ServicesController.php',
    type: 'POST',
    data: {case: 'pending request'},
    success: function(data) {

        let click_count = 0;

        // Pending Request Count Display
        $('#pending-box-id h3').text(data.length);

        // Pending Request On Click
        $('#pending-box-id').on('click', function() {

            if(click_count == 0) {

                // Modal Table
                $('#modal-pending-id table').DataTable({
                    "pageLength": 10,
                    "responsive": true,
                    "autoWidth": false,
                    "lengthChange": false,
                    "data": data,
                    columns: [
                        {data: 'client_name'}, {data: 'service_name'},
                        {data: 'status'}, {data: 'action'}
                    ],
                    createdRow: function(row, data, index) {

                        let btn_approve = $("<button type='button' class='btn btn-success mr-2'> Approve </button>");
                        let btn_disapprove = $("<button type='button' class='btn btn-danger'> Disapprove </button>");
                        
                        // Approval or Request
                        $('td', row).eq(3).text('').append(btn_approve).append(btn_disapprove);

                    }
                });

            }// if
            
            click_count++;

        });// on click

    }
});// ajax pending request