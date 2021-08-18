<?php
/*
*
* View Name: Chat Bubble messenger
*
*/

if (!defined('ABSPATH')) exit; ?>

	<li class="bluecoral-item-messenger">
		<a class="bluecoral-a" href="<?php echo $this->get_url_messenger(@$data['facebook']); ?>" <?php echo $this->get_url_blank(@$data['blank']); ?> data-bluecoral-icon>
			<img class="bluecoral-svg" src="<?php echo esc_url(@$data['default_icon']); ?>" width="48" height="48" />
			
		<?php echo $this->get_bubble_icon_title($data); ?>
		</a>
	</li>