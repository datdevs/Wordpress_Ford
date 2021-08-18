<?php
/*
*
* View Name: Chat Bubble Callback modal
*
*/

if (!defined('ABSPATH')) exit; 

$callback = $this->callback_simple; ?>

	<!-- modal callback simple -->
	<div data-bluecoral-chat-content data-bluecoral-callback-content data-name="modal-callback-simple" class="custom">
        <a href="#" data-bluecoral-close-element data-name="modal-callback-simple" class="bluecoral-close w-white">
            <span class="bluecoral-icon-close-outline"></span>
        </a>
		
        <span class="bluecoral-overlay" data-bluecoral-close-element data-name="modal-callback-simple"></span>
		
        <div class="bluecoral-box">
		<?php if (!empty(@$callback['header'])) { ?>
            <div class="bluecoral-heading-wrap">
                <span class="heading"><?php echo stripcslashes($callback['header']); ?></span>
            </div>
		<?php } ?>
		
            <div class="bluecoral-box-wrap">
                <form method="POST" data-bluecoral-callback-form data-name="tks-2" class="w-skin-02" autocomplete="off">
                    <div class="bluecoral-group">
                        <label class="bluecoral-label" for="fname-simple"><?php echo stripcslashes($callback['input_name_lbl']); ?></label>
                        <div class="input">
                            <input type="text" name="fname" id="fname-simple" class="bluecoral-form-control" placeholder="<?php echo esc_attr(stripcslashes($callback['input_name_ph'])); ?>" required />
                        </div>
                    </div>
                    <div class="bluecoral-group">
                        <label class="bluecoral-label" for="fphone-simple"><?php echo stripcslashes($callback['input_phone_lbl']); ?></label>
                        <div class="phone-group small">
                            <span class="bluecoral-icon-phone"></span>
                            <div class="input">
                                <input type="number" name="fphone" id="fphone-simple" class="bluecoral-form-control" data-phone placeholder="<?php echo esc_attr(stripcslashes($callback['input_phone_ph'])); ?>" required />
                            </div>
                        </div>
                        <div data-bluecoral-error-mss data-bluecoral-phone-mss class="text-red-100 mt-10px">
                            <p>Error mss !!</p>
                        </div>
                    </div>
                    <div class="bluecoral-group large">
                        <label for="" class="bluecoral-label"><?php echo stripcslashes($callback['input_option_lbl']); ?></label>
						
					<?php $options = explode(',', @$callback['input_option_val']); 
					
					if (count($options) > 0) { ?>
                        <ul class="bluecoral-ul">
						<?php foreach ($options as $i => $option) { ?>
                            <li>
                                <div class="bluecoral-radio">
                                    <input type="radio" name="fopt" id="rad-<?php echo esc_attr($i); ?>" value="<?php echo esc_attr(stripcslashes($option)); ?>" <?php checked($i, 0); ?> />
                                    <label for="rad-<?php echo esc_attr($i); ?>"><?php echo esc_html(stripcslashes($option)); ?></label>
                                </div>
                            </li>
						<?php } ?>
                        </ul>
					<?php } ?>
                    </div>
                    <a href="javascript:;" data-button class="bluecoral-btn bluecoral-btn-link bluecoral-rounded-5px orange-bg-white-text bluecoral-w-full modal-callback-submit">
                        <span class="txt"><?php echo stripcslashes($callback['submit_lbl']); ?></span>
                    </a>
					
				<?php if (!empty(@$callback['footer_textarea'])) { ?>
                    <div class="bluecoral-copy text-12px leading-13px">
                        <p><?php echo nl2br('<span class="bluecoral-text-red">*</span> '.$callback['footer_textarea']); ?></p>
                    </div>
				<?php } ?>
				
				<?php wp_nonce_field('cbb_callback', 'wpnonce'); ?>
                </form>
            </div>
        </div>
    </div>
	<!-- // end modal callback simple -->