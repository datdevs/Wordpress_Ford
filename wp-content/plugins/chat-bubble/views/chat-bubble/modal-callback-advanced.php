<?php
/*
*
* View Name: Chat Bubble Callback modal
*
*/

if (!defined('ABSPATH')) exit; 

$callback = $this->callback_advanced; ?>

	<!-- modal callback advanced -->
	<div data-bluecoral-chat-content data-bluecoral-callback-content data-name="modal-callback-advanced" class="callback-now">
        <a href="#" data-bluecoral-close-element data-name="modal-callback-advanced" class="bluecoral-close w-white">
            <span class="bluecoral-icon-close-outline"></span>
        </a>
		
        <span class="bluecoral-overlay" data-bluecoral-close-element data-name="modal-callback-advanced"></span>
		
        <div class="bluecoral-box">            
			<!-- step - 01 -->
			<div data-call-me-later-step-content data-name="step-01" class="on">
				<div class="bluecoral-box-wrap">
					<div class="callback-now-tabs">
						<a href="#" class="block-custom on" data-tab-element data-name="modal-callback-advanced-callmenow">
							<span class="bluecoral-icon-phone-ver02"></span>
							<span class="txt block-custom"><?php echo stripcslashes($callback['callmenow_title']); ?></span>
						</a>
						<a href="#" class="block-custom " data-tab-element data-name="modal-callback-advanced-callmelater">
							<span class="bluecoral-icon-timer"></span>
							<span class="txt block-custom"><?php echo stripcslashes($callback['callmelater_title']); ?></span>
						</a>
						<a href="#" class="block-custom" data-tab-element data-name="modal-callback-advanced-leaveamsg">
							<span class="bluecoral-icon-message"></span>
							<span class="txt block-custom"><?php echo stripcslashes($callback['leaveamsg_title']); ?></span>
						</a>
					</div>
					<div class="callback-now-tabs-content">
						<div data-tab-content-element data-name="modal-callback-advanced-callmenow" class="tab-modal tab-callmenow on">
						<?php if (!empty(@$callback['callmenow_header'])) { ?>
							<span class="callback-now-heading"><?php echo stripcslashes($callback['callmenow_header']); ?></span>
						<?php } ?>
							
							<form method="POST" class="w-skin-03 form-callmenow" autocomplete="off">
								<div class="callback-now-list w-skin-01">
									<div class="callback-now-item">
										<div class="phone-group large">
											<span class="bluecoral-icon-phone"></span>
											<div class="input">
												<input type="number" name="fphone" id="fphone-callmenow" class="bluecoral-form-control" value="" placeholder="<?php echo esc_attr(stripcslashes($callback['callmenow_input_phone_ph'])); ?>" required />
											</div>
										</div>
									</div>
									<div class="callback-now-item">
										<a href="javascript:;" data-button data-name="callmenow" class="bluecoral-btn bluecoral-btn-link bluecoral-rounded-5px orange-bg-white-text bluecoral-w-full modal-callback-submit-sub">
											<span class="txt"><?php echo stripcslashes($callback['callmenow_submit']); ?></span>
										</a>
									</div>
								</div>
								
							<?php if (!empty(@$callback['callmenow_notice'])) { ?>
								<span class="callback-now-notice"><?php echo stripcslashes($callback['callmenow_notice']); ?></span>
							<?php } ?>
							
							<?php if (!empty(@$callback['callmenow_footer_textarea'])) { ?>
								<div class="callback-now-note"><?php echo nl2br($callback['callmenow_footer_textarea']); ?></div>
							<?php } ?>
								
								<input type="hidden" name="fname" value="" />
								<input type="hidden" name="fmail" value="" />
								
							<?php wp_nonce_field('cbb_callback', 'wpnonce'); ?>
							</form>
						</div>
						
						<div data-tab-content-element data-name="modal-callback-advanced-callmelater" class="tab-modal tab-callmelater">
						<?php if (!empty(@$callback['callmelater_header'])) { ?>
							<span class="callback-now-heading"><?php echo stripcslashes($callback['callmelater_header']); ?></span>
						<?php } ?>
							
							<form method="POST" class="form-callmelater" autocomplete="off">
								<div class="callback-now-list w-skin-01">
								<?php if ((int) @$callback['callmelater_days'] >= 0) { ?>
									<div class="callback-now-item">
										<div class="select">
											<select name="fdate" id="fdate-callmelater" class="bluecoral-select-custom">
											<?php $date_format = get_option('date_format'); 
											for($i = 0; $i <= (int) $callback['callmelater_days']; $i++) {
												switch ($i) {
													case '0':
														$day_lbl = __('Today', 'chat-bubble');
														break;
														
													case '1':
														$day_lbl = __('Tomorrow', 'chat-bubble');
														break;
														
													default:
														$day_lbl = date($date_format, strtotime('+'.$i.'days')); 
												} ?>
												<option value="<?php echo esc_attr($i); ?>"><?php echo $day_lbl; ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
								<?php } ?>
								
								<?php if ((int) @$callback['callmelater_min_interval'] >= 0 && !empty($callback['callmelater_time_min']) && !empty($callback['callmelater_time_max'])) { ?>
									<div class="callback-now-item">
										<div class="select">
											<select name="ftime" id="ftime-callmelater" class="bluecoral-select-custom">
											<?php $min = (int) $callback['callmelater_time_min'];
											$max = (int) $callback['callmelater_time_max'];
											$interval = $callback['callmelater_min_interval'] / 60;
											
											for ($i = $min; $i <= $max; $i += $interval) { 
												$timeopt = date('H:i A', ($i * 3600)); ?>
												<option value="<?php echo esc_attr($i); ?>"><?php echo $timeopt; ?></option>
											<?php } ?>
											</select>
										</div>
									</div>
								<?php } ?>
								</div>
								<div class="callback-now-list w-skin-01">
									<div class="callback-now-item">
										<div class="phone-group large">
											<span class="bluecoral-icon-phone"></span>
											<div class="input">
												<input type="number" name="fphone" id="fphone-callmelater" class="bluecoral-form-control" value="" placeholder="<?php echo esc_attr(stripcslashes($callback['callmelater_input_phone_ph'])); ?>" required />
											</div>
										</div>
									</div>
									<div class="callback-now-item">
										<a href="javascript:;" data-button data-name="callmelater" class="bluecoral-btn bluecoral-btn-link bluecoral-rounded-5px orange-bg-white-text bluecoral-w-full modal-callback-submit-sub">
											<span class="txt"><?php echo stripcslashes($callback['callmelater_submit']); ?></span>
										</a>
									</div>
								</div>
								
							<?php if (!empty(@$callback['callmelater_notice'])) { ?>
								<span class="callback-now-notice"><?php echo stripcslashes($callback['callmelater_notice']); ?></span>
							<?php } ?>
							
							<?php if (!empty(@$callback['callmelater_footer_textarea'])) { ?>
								<div class="callback-now-note"><?php echo nl2br($callback['callmelater_footer_textarea']); ?></div>
							<?php } ?>
							
								<input type="hidden" name="fname" value="" />
								<input type="hidden" name="fmail" value="" />
								
							<?php wp_nonce_field('cbb_callback', 'wpnonce'); ?>
							</form>
						</div>
						<div data-tab-content-element data-name="modal-callback-advanced-leaveamsg" class="tab-modal tab-leaveamsg">
						<?php if (!empty(@$callback['leaveamsg_header'])) { ?>
							<span class="callback-now-heading"><?php echo stripcslashes($callback['leaveamsg_header']); ?></span>
						<?php } ?>
							
							<form method="POST" data-bluecoral-callback-form class="w-skin-03 form-leaveamsg" autocomplete="off">
								<div class="callback-now-list w-skin-02">
									<div class="callback-now-item">
										<textarea class="bluecoral-form-control" name="fmessage" id="fmessage-leaveamsg" cols="30" rows="10" placeholder="<?php echo esc_attr(stripcslashes($callback['leaveamsg_input_message_ph'])); ?>"></textarea>
									</div>
									<div class="callback-now-item">
										<div class="callback-now-sub-item">
											<div class="phone-group medium">
												<span class="bluecoral-icon-phone"></span>
												<div class="input">
													<input type="number" name="fphone" id="fphone-leaveamsg" class="bluecoral-form-control" value="" placeholder="<?php echo esc_attr(stripcslashes($callback['leaveamsg_input_phone_ph'])); ?>" required />
												</div>
											</div>
										</div>
										<div class="callback-now-sub-item">
											<div class="input">
												<input type="email" name="fmail" id="fmail-leaveamsg" class="bluecoral-form-control" placeholder="Your email" value="" placeholder="<?php echo esc_attr(stripcslashes($callback['leaveamsg_input_email_ph'])); ?>" required />
											</div>
										</div>
										<div class="callback-now-sub-item">
											<a href="javascript:;" data-button data-name="leaveamsg" class="bluecoral-btn bluecoral-btn-link bluecoral-rounded-5px orange-bg-white-text bluecoral-w-full modal-callback-submit-sub">
												<span class="txt"><?php echo stripcslashes($callback['leaveamsg_submit']); ?></span>
											</a>
										</div>
									</div>
								</div>
								
							<?php if (!empty(@$callback['leaveamsg_notice'])) { ?>
								<span class="callback-now-notice"><?php echo stripcslashes($callback['leaveamsg_notice']); ?></span>
							<?php } ?>
							
							<?php if (!empty(@$callback['leaveamsg_footer_textarea'])) { ?>
								<div class="callback-now-note"><?php echo nl2br($callback['leaveamsg_footer_textarea']); ?></div>
							<?php } ?>
							
								<input type="hidden" name="fname" value="" />
								
							<?php wp_nonce_field('cbb_callback', 'wpnonce'); ?>
							</form>
						</div>
					</div>
				</div>
			</div>
			<span class="bluecoral-copyright">Copyright by <a href="https://go.bluecoral.vn/chat-bubble" target="_black">Chat Bubble</a></span>		
		</div>
	</div>
		
	<div data-bluecoral-chat-content data-bluecoral-callback-content data-name="modal-callback-advanced-2" class="callback-now">
        <a href="#" data-bluecoral-close-element data-name="modal-callback-advanced" class="bluecoral-close w-white">
            <span class="bluecoral-icon-close-outline"></span>
        </a>
		
        <span class="bluecoral-overlay" data-bluecoral-close-element data-name="modal-callback-advanced-2"></span>
		
        <div class="bluecoral-box">				
			<!-- step - 02 -->
			<div data-call-me-later-step-content data-name="step-02" class="on">
				<div class="bluecoral-box-wrap">
				<?php if (!empty(@$callback['info_header'])) { ?>
					<span class="callback-now-heading"><?php echo stripcslashes($callback['info_header']); ?></span>
				<?php } ?>
					
					<div class="hand">
						<img height="50" width="50" class="" src="data:image/png;base64,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" />
					</div>
					
					<form method="POST" class="form-advanced-submit" autocomplete="off">
						<div class="form-group">
							<label for=""><?php echo stripcslashes($callback['info_input_name_lbl']); ?></label>
							<div class="input">
								<input type="text" name="fname" class="bluecoral-form-control" value="" placeholder="<?php echo esc_attr(stripcslashes($callback['info_input_name_ph'])); ?>" required />
							</div>
						</div>
						<div class="form-group">
							<label for=""><?php echo stripcslashes($callback['info_input_email_lbl']); ?></label>
							<div class="input">
								<input type="email" name="fmail" class="bluecoral-form-control" value="" placeholder="<?php echo esc_attr(stripcslashes($callback['info_input_email_ph'])); ?>" required />
							</div>
						</div>
						<a href="javascript:;" data-button class="bluecoral-btn bluecoral-btn-link bluecoral-rounded-5px orange-bg-white-text bluecoral-w-full modal-callback-submit-adv">
							<span class="txt"><?php echo stripcslashes($callback['info_submit']); ?></span>
						</a>
						<input type="hidden" name="ftype" value="" />
					</form>
				</div>
			</div>
		</div>
	</div>
	<!-- // end modal callback advanced -->