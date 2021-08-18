<?php
/*
*
* View Name: Chat Bubble theme
*
*/

if (!defined('ABSPATH')) exit; ?>

	<?php if (!empty($this->color)) { ?>
		<style>
			.bluecoral-copy a,
			[data-bluecoral-chat] .bluecoral-btn.bluecoral-btn-link.white-bg-orange-text .txt,
			[data-bluecoral-chat] [data-bluecoral-callback-form].w-skin-01 .bluecoral-call .bluecoral-txt,
			[data-bluecoral-chat] .bluecoral-lets-chat-title span,
			[data-bluecoral-chat] [data-bluecoral-chat-content].callback-now .callback-now-tabs a.on .txt,
			[data-bluecoral-chat] [data-bluecoral-chat-content].callback-now .callback-now-tabs a.on [class^="bluecoral-icon"] {
				color: <?php echo $this->color; ?> !important;
			}
			
			[data-bluecoral-chat] .bluecoral-btn.bluecoral-btn-link.white-bg-orange-text:hover,
			[data-bluecoral-chat] .bluecoral-btn.bluecoral-btn-link.orange-bg-white-text,
			[data-bluecoral-chat] [data-bluecoral-callback-form].w-skin-01 [data-button],
			[data-bluecoral-chat] .bluecoral-lets-chat-switch,
			[data-bluecoral-chat] [data-bluecoral-chat-content].custom .bluecoral-heading-wrap,
			[data-bluecoral-chat] [data-bluecoral-chat-content].custom .bluecoral-radio label:after,
			[data-bluecoral-chat] [data-bluecoral-chat-content].w-skin-04 .bluecoral-box-wrap {
				background-color: <?php echo $this->color; ?> !important;
			}

			[data-bluecoral-chat] .bluecoral-lets-chat-switch:before {
				background-color: <?php echo $this->color; ?> !important;
			}

			[data-bluecoral-chat] [data-bluecoral-chat-content].custom .bluecoral-radio input:checked + label:before {
				border-color: <?php echo $this->color; ?> !important;
			}
			
			@media screen and (min-width: 1024px) {
				[data-bluecoral-chat] [data-bluecoral-callback-form].w-skin-01 .bluecoral-call:hover {
					border-color: <?php echo $this->color; ?> !important;
				}  
				
				[data-bluecoral-chat] [data-bluecoral-chat-content].callback-now .callback-now-tabs a:hover .txt,
				[data-bluecoral-chat] [data-bluecoral-chat-content].callback-now .callback-now-tabs a:hover [class^="bluecoral-icon"] {
					color: <?php echo $this->color; ?> !important;
				}
			}
		</style>
	<?php } ?>