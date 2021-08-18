<?php
/*
*
* View Name: Chat Bubble WhatsApp
*
*/

if (!defined('ABSPATH')) exit; ?>

	<li class="bluecoral-item-whatsapp">
		<a class="bluecoral-a" href="<?php echo $this->get_url_whatsapp(@$data['whatsapp']); ?>" <?php echo $this->get_url_blank(@$data['blank']); ?> <?php echo $this->get_bubble_icon_title_attr($data); ?>>
			<img class="bluecoral-svg" src="<?php echo esc_url(@$data['default_icon']); ?>" width="48" height="48" />
			
		<?php echo $this->get_bubble_icon_title($data); ?>
		</a>
	</li>