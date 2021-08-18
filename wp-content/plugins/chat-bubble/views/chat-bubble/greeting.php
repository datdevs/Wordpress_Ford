<?php
/*
*
* View Name: Chat Bubble greeting section
*
*/

if (!defined('ABSPATH')) exit; ?>

	<!-- Chat Bubble greeting section -->	
	<a href="#" class="bluecoral-btn bluecoral-btn-more <?php echo ($this->greeting_show == 1) ? 'off' : ''; ?>" data-bluecoral-more-element data-name="chat">
		<span class="bluecoral-icon-more"></span>
	</a> 
	
	<div data-bluecoral-chat-content data-bluecoral-mss-content data-name="chat" class="w-skin-03">
		<a href="#" data-bluecoral-close-element data-bluecoral-close-cookie data-name="chat" class="bluecoral-close">
			<span class="bluecoral-icon-close-outline"></span>
		</a>
		<div class="top">
		<?php if ($this->is_greeting_title()) { ?>
			<a href="javascript:;" class="account">
				<div class="avatar">
					<img src="<?php echo esc_attr($this->greeting_avatar); ?>" class="object-cover h-full" alt="<?php echo esc_attr($this->greeting_name); ?>">
				</div>
				<span class="title"><?php echo esc_html($this->greeting_name); ?></span>
				<span class="sub"><?php echo esc_html($this->greeting_label); ?></span>
			</a>
		<?php } ?>
			
			<div class="des">
				<p><?php echo stripslashes($this->greeting); ?></p>
			</div>
		</div>		
		
	<?php $this->get_greeting_links(); ?>
	</div>
	<!-- // end Chat Bubble greeting section -->