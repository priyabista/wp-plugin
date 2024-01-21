jQuery(document).ready(function($) {
    $('#contactForm').submit(function(event){
      event.preventDefault();
  
      var reg_nonce = $('[name="cf_new_user_nonce"]').val();
      var reg_name = $('#Name').val();
      var reg_email = $('#Email').val();
      var reg_subject = $('#Subject').val();
      var reg_message = $('#Message').val();
  
  
      var ajax_url = my_ajax_obj.ajax_url;
  
       var data = {
       action: 'contact_details',
       nonce: reg_nonce,
       Name: reg_name,
       Email: reg_email,
       Subject: reg_subject,
       Message: reg_message,
       
      };
  
      jQuery.ajax({
        url: ajax_url,
        data: data,
        type: 'post',
        success:function(result){
          alert(result);
        }
  
      });
    
     })
});
