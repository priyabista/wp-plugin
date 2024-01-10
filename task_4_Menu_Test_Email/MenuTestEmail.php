<?php
/*
Plugin Name: Send Email
Description: Welcome to this send email plugin --
Version: 1.0
Author: Priya
*/

require_once 'HandleEmail.php';
function add_email_menu() {
    add_menu_page(
        'Test Email Menu Page',
        'Test Email',
        'manage_options',
        'test-email',
        'testEmailPage',
        'dashicons-email',
        20
    );

    add_submenu_page(
        'test-email',
        'Send Email',
        'Send Email',
        'manage_options',
        'send-email',
        'send_email_page_content'
    );
}

add_action('admin_menu', 'add_email_menu');

function testEmailPage() {
    echo "<h3>Welcome to test Email Page</h3>";
}

function send_email_page_content() {
   
    ?>
    <div class="email-form">
        <h2><center>Send Email</center></h2>
        <form method="post" action="" style="text-align:center;">
            <label for="email_subject">Email Subject:</label>
            <input type="text" name="email_subject" id="email_subject" /><br>

            <label for="email_content">Email Content:</label>
            <textarea name="email_content" value="email_content" id="email_content" style="margin-top: 20px; width:200px; height: 200px;"></textarea><br>

            <label for="send_to">Send To:</label>
            <input type="email" name="send_to" id="send_to" style="margin-top: 20px; margin-left: 30px;" /><br>
            <div style="text-align:center; margin-top: 20px;">
            <?php
            submit_button(null, 'primary', 'submit_button')
            ?>
            </div>

        </form>
    </div>
    <?php
}



function changeEmailContent($email_content){
    $email_content = "add this ".$email_content;
    return $email_content;
}


add_filter('task4_email_content','changeEmailContent',10, 1);
?>
