<?php
/*
*
* View Name: Chat Bubble url
*
*/

if (!defined('ABSPATH')) exit; ?>

	<li class="bluecoral-item-email">
		<a class="bluecoral-a" href="<?php echo esc_url(@$data['url']); ?>" <?php echo $this->get_url_blank(@$data['blank']); ?> <?php echo $this->get_bubble_icon_title_attr($data); ?>>
			<img class="bluecoral-svg" src="<?php echo esc_url(@$data['default_icon']); ?>" width="48" height="48" />
			
		<?php echo $this->get_bubble_icon_title($data); ?>
		</a>
	</li>