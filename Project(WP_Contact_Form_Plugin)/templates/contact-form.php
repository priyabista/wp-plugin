
	<div class="contact-form">
		<form action="<?php echo admin_url('admin-ajax.php') ?>" id="contactForm" method="post">
				<label for="name"><?php _e('Name:', 'contact-form');?></label> 
				<input type="text" id="Name" name="Name" required><br><br>
		
				<label for="email"><?php _e('Email:', 'contact-form'); ?></label>
				<input type="email" id="Email" name="Email" required><br><br>
		
				<label for="subject"><?php _e('Subject:', 'contact-form'); ?></label>
				<input type="text" id="Subject" name="Subject" required><br><br>
		
				<label for="message"><?php _e('Message:', 'contact-form'); ?></label>
				<input type="text" id="Message" name="Message" required><br><br>
		
				<?php
				wp_nonce_field('cf_new_user','cf_new_user_nonce',true,true);
				?>
			
				<div style="text-align:center; margin-top: 20px;">
				<input type="submit" name="submit" class="btn btn-primary">
				</div>
			
		</form>
	</div>
