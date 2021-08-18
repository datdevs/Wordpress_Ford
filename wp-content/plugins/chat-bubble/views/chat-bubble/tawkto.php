<?php
/*
*
* View Name: Chat Bubble Tawk.to
*
*/

if (!defined('ABSPATH')) exit; ?>

	<li class="bluecoral-item-tawkto">
		<a class="bluecoral-a bluecoral-a-tawkto" href="javascript:;" data-id="<?php echo $data['tawkto']; ?>"  <?php echo $this->get_bubble_icon_title_attr($data); ?>>
			<img class="bluecoral-svg" src="<?php echo esc_url(@$data['default_icon']); ?>" width="48" height="48" />
			
		<?php echo $this->get_bubble_icon_title($data); ?>
		</a>
	</li>