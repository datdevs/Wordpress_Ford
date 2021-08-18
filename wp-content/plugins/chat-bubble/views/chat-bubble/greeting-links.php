<?php
/*
*
* View Name: Chat Bubble greeting links
*
*/

if (!defined('ABSPATH')) exit; 

if (count((array) @$this->links) == 0) return; ?>
	
	<!-- Chat Bubble greeting links -->	
	<div class="bluecoral-btn-list">
	<?php foreach ($this->links as $link) { ?>
		<div class="bluecoral-btn-item">
			<a href="<?php echo esc_attr($link['u']); ?>" class="bluecoral-btn bluecoral-btn-link bluecoral-rounded-full white-bg-orange-text bluecoral-rounded-full" title="<?php echo esc_attr($link['t']); ?>" <?php echo ((int) @$link['b'] == 1) ? 'target="_blank"' : ''; ?>>
				<span class="txt"><?php echo esc_html($link['t']); ?></span>
			</a>
		</div>
	<?php } ?>
	</div>
	<!-- // end Chat Bubble greeting links -->	