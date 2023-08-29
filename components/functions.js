
// Initializations

function displaySidebar(role, page) {

    let sidebar_id = (role == 'client') ? [1, 4, 5, 6, 7] : [1, 2, 3, 5, 6];
        
    $.ajax({
        url: '../controller/SidebarController.php',
        type: 'POST',
        data: {
            id: sidebar_id,
            case: 'sidebar_list'
        },
        success: function(data) {

            // Append Sidebar
            data.forEach(element => {
                
                let li = $("<li class='nav-item'></li>");
                let a = $("<a href='" + element.element_uri + "' class='nav-link'></a>");
                let i = $("<i></i>");
                let p = $("<p></p>");

                // Check if what sidebar will be active
                if(element.element_text == page) { a.addClass('active') }

                p.text(" " + element.element_text);
                i.addClass(element.element_class);
                a.append(i).append(p);
                li.append(a);

                // Append List to ul
                $('#sidebar-ul-id').append(li);

            });

        }
    });

}// display sidebar
