<?php
/*
*
* View Name: Chat Bubble Viber
*
*/

if (!defined('ABSPATH')) exit; ?>

	<li class="bluecoral-item-viber">
		<a class="bluecoral-a" href="<?php echo $this->get_url_viber(@$data['viber']); ?>" <?php echo $this->get_url_blank(@$data['blank']); ?> <?php echo $this->get_bubble_icon_title_attr($data); ?>>
			<img class="bluecoral-svg" src="<?php echo esc_url(@$data['default_icon']); ?>" width="48" height="48" />
			
		<?php echo $this->get_bubble_icon_title($data); ?>
		</a>
	</li>