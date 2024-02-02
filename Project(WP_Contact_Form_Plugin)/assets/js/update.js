function updateForm(event,id) 
{ 
        event.preventDefault();
        jQuery('#update-cf').show();
        console.log(id);

        var name_id = "#name_"+id;
        var name= jQuery(name_id).text();
        jQuery('#Name').val(name);

        var email_id = "#email_"+id;
        var email= jQuery(email_id).text();
        jQuery('#Email').val(email);

        var subject_id = "#subject_"+id;
        var subject= jQuery(subject_id).text();
        jQuery('#Subject').val(subject);

        var message_id = "#message_"+id;
        var message= jQuery(message_id).text();
        jQuery('#Message').val(message);
        

        jQuery('#updateForm').submit(function(event){
            event.preventDefault();
            var update_name = jQuery('#Name').val();
            var update_email = jQuery('#Email').val();
            var update_subject = jQuery('#Subject').val();
            var update_message = jQuery('#Message').val();
        
        
            var ajax_url = my_ajax_obj.ajaxUrl;
        
            var data = {
            action: 'update_contact_data',
            Name: update_name,
            Email: update_email,
            Subject: update_subject,
            Message: update_message,
            id: id,
            
            };
                jQuery.ajax({
                url: ajax_url,
                data: data,
                type: 'post',
                success: function(result) {
                jQuery('#updateForm')[0].reset();
                jQuery('#update-cf').hide();
                getContactDetails();
                }
            });
        
        })
}
function deleteForm(id)
{
    var ajax_url = my_ajax_obj.ajaxUrl;
    var id =id;

    if(confirm("Are you sure you want to delete this Record?")){
        jQuery.ajax({
            type: "GET",
            url: ajax_url,
            data: {
                action: 'delete_contact_data',
                id: id,  
            },
            success: function(result){
                getContactDetails();
            }
        });
    }
}
function getContactDetails(orderBy, sortOrder, searchQuery) {
   var ajax_url = my_ajax_obj.ajaxUrl;

   var data = {
       action: 'retrieve_contact_data',
       orderby: orderBy,
       order: sortOrder,
       search: searchQuery,
   };

   jQuery.ajax({
       url: ajax_url,
       type: 'GET',
       data: data,
       success: function (response) {
           if (response.success == true) {
               var data = response.data.data;

               var tableBody = jQuery('#table tbody');
               tableBody.empty();      

               for (var i = 0; i < data.length; i++) {
                   var row = '<tr>';
                   row += '<td id="name_'+data[i].id+'">' + escapeHtml(data[i].Name) + '</td>';
                   row += '<td id="email_'+data[i].id+'">' + escapeHtml(data[i].Email) + '</td>';
                   row += '<td id="subject_'+data[i].id+'">' + escapeHtml(data[i].Subject)+ '</td>';
                   row += '<td id="message_'+data[i].id+'">' + escapeHtml(data[i].Message) + '</td>';
                   row += '<td><button class="update-form" onclick="updateForm(event,'+ data[i].id +')">Update</button></td>';
                   // id="update_btn" onclick="updateForm(event,'+ data[i].id +')"
                   // row += '<td><button class="update-form" onclick="updateForm()">Update</button></td>';
                   row += '<td><button class="delete-btn" onclick="deleteForm('+ data[i].id +')">Delete</button></td>';
                   row += '</tr>';
                   tableBody.append(row);
               }
           } else {
               console.log('Error fetching data.');
           }
       }
   });
}   

function escapeHtml(text) 
{
    return jQuery('<div>').text(text).html();
}
jQuery("#asc").click(function () 
{
    console.log("Sorting ASC");
    getContactDetails('Email', 'ASC', jQuery("#searchInput").val());
});
jQuery("#desc").click(function () 
{
    console.log("Sorting DESC");
    getContactDetails('Email', 'DESC', jQuery("#searchInput").val());
});
jQuery("#name_asc").click(function () 
{
    console.log("Sorting Name ASC");
    getContactDetails('Name', 'ASC', jQuery("#searchInput").val());
});
jQuery("#name_desc").click(function () 
{
    console.log("Sorting NAme DESC");
    getContactDetails('Name', 'DESC', jQuery("#searchInput").val());
});
jQuery("#searchButton").click(function () 
{
    console.log("Searching...");
    getContactDetails('', '', jQuery("#searchInput").val());
});
jQuery(document).ready(function ($) 
{
    $('#update-cf').hide();
    getContactDetails();
}); 




