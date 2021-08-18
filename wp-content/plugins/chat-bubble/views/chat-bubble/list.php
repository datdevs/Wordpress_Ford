<?php
/*
*
* View Name: Chat Bubble list items
*
*/

if (!defined('ABSPATH')) exit; ?>

	<!-- bubble <?php echo $this->bubble_list_pos; ?> list -->
	<ul class="<?php echo esc_attr($this->bubble_list_class); ?>">
	<?php foreach ($this->bubble_list_fields as $group) { 
		$action = 'get_bubble_'.@$group['type'];
		if (method_exists($this, $action)) $this->$action($group);
	} ?>
	</ul>
	<!-- // end bubble <?php echo $this->bubble_list_pos; ?> list -->