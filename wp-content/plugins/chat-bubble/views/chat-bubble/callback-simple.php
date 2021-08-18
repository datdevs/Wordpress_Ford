<?php
/*
*
* View Name: Chat Bubble Callback
*
*/

if (!defined('ABSPATH')) exit; ?>

	<li class="bluecoral-item-callback-simple">
		<a href="javascript:;" class="bluecoral-a" data-bluecoral-callback-element data-name="modal-callback-simple" <?php echo $this->get_bubble_icon_title_attr($data); ?>>
			<img class="bluecoral-svg" src="<?php echo esc_url(@$data['default_icon']); ?>" width="48" height="48" />
			
		<?php echo $this->get_bubble_icon_title($data); ?>
		</a>		
	</li>