
jQuery(document).ready(function($) {

  $('#registrationForm').submit(function(event){
    event.preventDefault();

    var reg_nonce = $('[name="ur_new_user_nonce"]').val();
    var reg_user = $('#username').val();
    var reg_email = $('#email').val();
    var reg_pass = $('#password').val();


    var ajax_url = my_ajax_obj.ajax_url;

     var data = {
     action: 'register_user',
     nonce: reg_nonce,
     user_login: reg_user,
     user_pass: reg_pass,
     user_email: reg_email,
     
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