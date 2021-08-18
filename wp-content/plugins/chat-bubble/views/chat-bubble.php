<?php
/*
*
* View Name: Chat Bubble view
*
*/

if (!defined('ABSPATH')) exit;

global $cbb_options; 

$cbb = new CBB_Msg($cbb_options); ?>

<?php do_action('cbb_before'); ?>
	
	<!-- Chat Bubble -->
	<?php $cbb->get_theme_styles(); ?>
	
	<div class="<?php echo esc_attr($cbb->class); ?>" data-bluecoral-chat style="visibility: hidden; opacity: 0">
		<div class="bluecoral-lets-chat">
		<?php $cbb->get_intro(); ?>
			
			<div>
			<?php $cbb->get_bubble_list('outer', 'bluecoral-custom-list'); ?>              
			
				<div data-bluecoral-switch-element data-name="chat" class="bluecoral-lets-chat-switch">
					<span class="bluecoral-icon-chat"></span>
				</div>
			</div>
		</div>
		
	<?php $cbb->get_greeting(); ?>
		
		<div data-bluecoral-chat-content data-bluecoral-switch-content data-name="chat" class="w-skin-01">
		<?php $cbb->get_bubble_list('inner', 'bluecoral-ul w-skin-01'); ?> 
		</div>		
		
	<?php $cbb->get_callback_modal(); ?>
	</div>
	<!-- // end Chat Bubble -->
	
<?php do_action('cbb_after'); ?>