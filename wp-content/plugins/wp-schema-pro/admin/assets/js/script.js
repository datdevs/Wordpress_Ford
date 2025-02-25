(function ($) {

    /**
     * AIOSRS Schema
     *
     * @class AIOSRS_Schema
     * @since 1.0
     */
	AIOSRS_Schema = {

        /**
         * Initializes a AIOSRS Schema.
         *
         * @since 1.0
         * @method init
         */
		container: '',

		init: function () {

			var self = this;

			self.container = $('#aiosrs-schema-settings, #aiosrs-pro-custom-fields');

			// Init backgrounds.
			$(document).ready(function ($) {
				$('.select2-class').select2();
				var select_option = ["Site Meta", "Post Meta (Basic Fields)"];
				var custom_option_group = $('#bsf-aiosrs-schema-type').val();
				if ('custom-markup' === custom_option_group) {
					for (var i = 0; i < select_option.length; i++) {
						$('#bsf-aiosrs-custom-markup-custom-markup optgroup[label="' + select_option[i] + '"]').remove();
					}
				}
				var custom_markup_schem_id = $('#custom-schema-schema-field').val();
				if (custom_markup_schem_id) {
					for (i = 0; i < select_option.length; i++) {
						$('#custom-markup-' + custom_markup_schem_id + '-custom-markup-connected optgroup[label="' + select_option[i] + '"]').remove();
					}
				}
			});

			self.container.on('change', 'select.bsf-aiosrs-schema-meta-field', function () {
				var self = $(this),
					parent = self.parent(),
					value = self.val();

				var text_wrapper = parent.find('.bsf-aiosrs-schema-custom-text-wrap');
				if ('custom-text' == value) {
					text_wrapper.removeClass('bsf-hidden-field');
				} else if (!text_wrapper.hasClass('bsf-hidden-field')) {
					text_wrapper.addClass('bsf-hidden-field');
				}

				var text_wrapper = parent.find('.bsf-aiosrs-schema-fixed-text-wrap');
				if ('fixed-text' == value) {
					text_wrapper.removeClass('bsf-hidden-field');
				} else if (!text_wrapper.hasClass('bsf-hidden-field')) {
					text_wrapper.addClass('bsf-hidden-field');
				}

				var specific_meta_wrapper = parent.find('.bsf-aiosrs-schema-specific-field-wrap');
				if ('specific-field' == value) {
					specific_meta_wrapper.removeClass('bsf-hidden-field');
				} else if (!specific_meta_wrapper.hasClass('bsf-hidden-field')) {
					specific_meta_wrapper.addClass('bsf-hidden-field');
				}
			});


			self.container.on('change', '.bsf-aiosrs-schema-row-rating-type select.bsf-aiosrs-schema-meta-field', function (e) {
				e.preventDefault();

				$(this).closest('.bsf-aiosrs-schema-table').find('.bsf-aiosrs-schema-row').css('display', '');
				if ('accept-user-rating' === $(this).val()) {
					var review_count_wrap = $(this).closest('.bsf-aiosrs-schema-row').next('.bsf-aiosrs-schema-row'),
						name = review_count_wrap.find('.bsf-aiosrs-schema-meta-field').attr('name');

					var selected_schema_type = jQuery(".bsf-aiosrs-review-schema-type").val();
					if (selected_schema_type) {
						var prepare_name = 'bsf-aiosrs-review[' + selected_schema_type + '-review-count]';

						if (name.indexOf(prepare_name) >= 0) {
							review_count_wrap.hide();
						}
					}

					if (name.indexOf('[review-count]') >= 0) {
						review_count_wrap.hide();
					}
				}
			});
			self.container.find('select.bsf-aiosrs-schema-meta-field').trigger('change');

			$('select.bsf-aiosrs-schema-select2').each(function (index, el) {
				self.init_target_rule_select2(el);
			});

			self.container.on('click', '.bsf-repeater-add-new-btn', function (event) {

				event.preventDefault();
				self.add_new_repeater($(this));
				self.prepare_event_schmea_fields();
			});

			self.container.on('click', '.bsf-repeater-close', function (event) {
				event.preventDefault();
				self.add_remove_repeater($(this));

			});

			self.schemaTypeDependency();
			self.bindTooltip();
			if (!$('body').hasClass('post-type-aiosrs-schema')) {
				self.field_validation();
			}
		},
		field_validation: function () {
			$('.wpsp-custom-field-connect, .wpsp-field-close, .bsf-aiosrs-schema-meta-field, image-field-wrap, .aiosrs-pro-custom-field, .wpsp-custom-field-connect').on('click focus change', function () {
				$('.bsf-aiosrs-schema-type-wrap').each(function (index, repeater) {
					var field_value = $(repeater).find('.wpsp-default-hidden-value').val();
					var required_path = $(repeater).parents('.bsf-aiosrs-schema-row-content').prev();
					field_value = field_value.trim();
					if (field_value) {
						if ($('body').hasClass('block-editor-page')) {
							if (!$(repeater).find('.wpsp-required-error-field').length) {
								switch (field_value) {
									case 'post_title':
										var meta_field = $('.editor-post-title__input').val();
										break;
									case 'post_content':
										var meta_field = $('p.block-editor-rich-text__editable').text().length > 1 ? $('p.block-editor-rich-text__editable').text() : '';
										break;
									case 'post_excerpt':
										var meta_field = $('.components-textarea-control__input').val();
										break;
									case 'featured_img':
										if ("Set featured image" === $('.editor-post-featured-image__toggle').text()) {
											var meta_field = "";
										} else {
											var meta_field = $('.components-responsive-wrapper__content').attr('src');
										}
										break;
									default:
										required_path.removeClass('wpsp-required-error-field');
										required_path.find('label').removeClass('wpsp-required-error-field');
								}
								if (undefined !== meta_field) {
									if ("" !== meta_field) {
										required_path.removeClass('wpsp-required-error-field');
										required_path.find('label').removeClass('wpsp-required-error-field');
									}
									else {
										if (required_path.find('.required').length) {
											required_path.find('label').addClass('wpsp-required-error-field');
										}
									}
								}
							}
						} else {
							required_path.removeClass('wpsp-required-error-field');
							required_path.find('label').removeClass('wpsp-required-error-field');
						}
					} else {
						if (required_path.find('.required').length) {
							required_path.find('label').addClass('wpsp-required-error-field');
						}
					}
				});
			});
		},
		hide_review_count: function () {
			$(this).closest('.bsf-aiosrs-schema-table').find('.bsf-aiosrs-schema-row').css('display', '');
			if ('accept-user-rating' == $(this).val()) {
				var review_count_wrap = $(this).closest('.bsf-aiosrs-schema-row').next('.bsf-aiosrs-schema-row'),
					name = review_count_wrap.find('.bsf-aiosrs-schema-meta-field').attr('name');

				var selected_schema_type = jQuery(".bsf-aiosrs-review-schema-type").val();
				if (selected_schema_type) {
					var prepare_name = 'bsf-aiosrs-review[' + selected_schema_type + '-review-count]';

					if (name.indexOf(prepare_name) >= 0) {
						review_count_wrap.hide();
					}
				}

				if (name.indexOf('[review-count]') >= 0) {
					review_count_wrap.hide();
				}
			}
		},

		add_new_repeater: function (selector) {

			var self = this,
				parent_wrap = selector.closest('.bsf-aiosrs-schema-type-wrap'),
				total_count = parent_wrap.find('.aiosrs-pro-repeater-table-wrap').length,
				template = parent_wrap.find('.aiosrs-pro-repeater-table-wrap').first().clone();

			template.find('.bsf-aiosrs-schema-custom-text-wrap, .bsf-aiosrs-schema-specific-field-wrap').each(function (index, el) {

				if (!$(this).hasClass('bsf-hidden-field')) {
					$(this).addClass('bsf-hidden-field');
				}
			});

			template.find('select.bsf-aiosrs-schema-meta-field').each(function (index, el) {
				$(this).val('none');

				var field_name = 'undefined' != typeof $(this).attr('name') ? $(this).attr('name').replace('[0]', '[' + total_count + ']') : '',
					field_class = 'undefined' != typeof $(this).attr('class') ? $(this).attr('class').replace('-0-', '-' + total_count + '-') : '',
					field_id = 'undefined' != typeof $(this).attr('id') ? $(this).attr('id').replace('-0-', '-' + total_count + '-') : '';

				$(this).attr('name', field_name);
				$(this).attr('class', field_class);
				$(this).attr('id', field_id);
			});
			template.find('input, textarea, select:not(.bsf-aiosrs-schema-meta-field)').each(function (index, el) {
				$(this).val('');

				var field_name = 'undefined' != typeof $(this).attr('name') ? $(this).attr('name').replace('[0]', '[' + total_count + ']') : '',
					field_class = 'undefined' != typeof $(this).attr('class') ? $(this).attr('class').replace('-0-', '-' + total_count + '-') : '',
					field_id = 'undefined' != typeof $(this).attr('id') ? $(this).attr('id').replace('-0-', '-' + total_count + '-') : '';

				$(this).attr('name', field_name);
				$(this).attr('class', field_class);
				$(this).attr('id', field_id);
			});

			template.find('span.select2-container').each(function (index, el) {
				$(this).remove();
			});

			template.insertBefore(selector);
			template.find('select.bsf-aiosrs-schema-select2').each(function (index, el) {
				self.init_target_rule_select2(el);
			});

			AIOSRS_Schema.init_date_time_fields();
		},

		add_remove_repeater: function (selector) {
			var parent_wrap = selector.closest('.bsf-aiosrs-schema-type-wrap'),
				repeater_count = parent_wrap.find('> .aiosrs-pro-repeater-table-wrap').length;

			if (repeater_count > 1) {
				selector.closest('.aiosrs-pro-repeater-table-wrap').remove();


				if ("aiosrs-pro-custom-fields" === this.container.attr('id')) {
					// Reset index to avoid duplicate names.
					parent_wrap.find('> .aiosrs-pro-repeater-table-wrap').each(function (wrap_index, repeater_wap) {
						$(repeater_wap).each(function (element_index, element) {
							$(element).find('input, textarea, select:not(.bsf-aiosrs-schema-meta-field)').each(function (el_index, el) {
								var field_name = 'undefined' != typeof $(el).attr('name') ? $(el).attr('name').replace(/\[\d+]/, '[' + wrap_index + ']') : '';
								$(el).attr('name', field_name);
							});
						});
					});
				}
			}
		},

		bindTooltip: function () {

			// Call Tooltip
			$('.bsf-aiosrs-schema-heading-help').tooltip({
				content: function () {
					return $(this).prop('title');
				},
				tooltipClass: 'bsf-aiosrs-schema-ui-tooltip',
				position: {
					my: 'center top',
					at: 'center bottom+10',
				},
				hide: {
					duration: 200,
				},
				show: {
					duration: 200,
				},
			});
		},

		schemaTypeDependency: function () {

			var container = this.container;
			this.container.on('change', 'select[name="bsf-aiosrs-schema-type"]', function () {

				container.find('.bsf-aiosrs-schema-meta-wrap').css('display', 'none');
				var schema_type = $(this).val();
				if ('undefined' != typeof schema_type && '' != schema_type) {
					container.find('#bsf-' + schema_type + '-schema-meta-wrap').css('display', '');
				}
			});
		},

		init_target_rule_select2: function (selector) {

			$(selector).select2({

				placeholder: "Search Fields...",

				ajax: {
					url: ajaxurl,
					dataType: 'json',
					method: 'post',
					delay: 250,
					data: function (params) {
						return {
							nonce_ajax: AIOSRS_Rating.specified_field,
							q: params.term, // search term
							page: params.page,
							action: 'bsf_get_specific_meta_fields'
						};
					},
					processResults: function (data) {
						return {
							results: data
						};
					},
					cache: true
				},
				minimumInputLength: 2,
			});
		},

		get_review_item_type_html: function (item_type) {

			jQuery.post({
				url: ajaxurl,
				data: {
					action: 'fetch_item_type_html',
					item_type: item_type,
					nonce: AIOSRS_Rating.security,
					post_id: jQuery("#post_ID").val(),
				}
			})
				.done(function (response) {

					$(".bsf-review-item-type-field").remove();
					$(response).insertAfter(jQuery('#bsf-aiosrs-review-schema-type').parent().parent().closest('tr'));
					$('select.bsf-aiosrs-schema-select2').each(function (index, el) {

						AIOSRS_Schema.init_target_rule_select2(el);
					});

					var item_specific_type = '.bsf-aiosrs-review-' + item_type + '-rating';
					$(item_specific_type).each(function () {
						$(this).closest('.bsf-aiosrs-schema-table').find('.bsf-aiosrs-schema-row').css('display', '');
						if ('accept-user-rating' === $(this).val()) {
							var review_count_wrap = $(this).closest('.bsf-aiosrs-schema-row').next('.bsf-aiosrs-schema-row'),
								name = review_count_wrap.find('.bsf-aiosrs-schema-meta-field').attr('name');

							var selected_schema_type = jQuery(".bsf-aiosrs-review-schema-type").val();
							if (selected_schema_type) {
								var prepare_name = 'bsf-aiosrs-review[' + selected_schema_type + '-review-count]';

								if (name.indexOf(prepare_name) >= 0) {
									review_count_wrap.hide();
								}
							}

							if (name.indexOf('[review-count]') >= 0) {
								review_count_wrap.hide();
							}
						}
					})

					AIOSRS_Schema.init_date_time_fields();
					AIOSRS_Schema.prepare_event_schmea_fields();

				})
				.fail(function (e) {
					console.log("Something went wrong");
				});

		},

		prepare_event_schmea_fields: function () {
			$(".wpsp-dropdown-event-status, .wpsp-dropdown-bsf-aiosrs-event-event-status").change(function () {
				let parent = $(this).parents('.bsf-aiosrs-schema-meta-wrap, .aiosrs-pro-meta-fields-wrap');

				parent.find('td.wpsp-event-status-rescheduled, td.bsf-aiosrs-review-bsf-aiosrs-event-previous-date').hide();
				if (!this.value) {
					this.value = 'EventScheduled';
				}

				if ("EventRescheduled" === this.value) {
					parent.find('td.wpsp-event-status-rescheduled, td.bsf-aiosrs-review-bsf-aiosrs-event-previous-date').show();
				}

				var event_status = $(".wpsp-dropdown-event-attendance-mode, .wpsp-dropdown-bsf-aiosrs-event-event-attendance-mode").val();

				if ("EventMovedOnline" === this.value || "OfflineEventAttendanceMode" !== event_status) {
					parent.find('td.wpsp-event-status-offline').hide();
					parent.find('td.wpsp-event-status-online').show();
					parent.find('.wpsp-dropdown-event-attendance-mode, .wpsp-dropdown-bsf-aiosrs-event-event-attendance-mode').val("OnlineEventAttendanceMode");
				} else {
					parent.find('td.wpsp-event-status-offline').show();
					parent.find('td.wpsp-event-status-online').hide();
				}
			});
			$(".wpsp-dropdown-event-attendance-mode, .wpsp-dropdown-bsf-aiosrs-event-event-attendance-mode").change(function () {


				let parent = $(this).parents('.bsf-aiosrs-schema-meta-wrap, .aiosrs-pro-meta-fields-wrap');
				parent.find('td.wpsp-event-status-rescheduled').hide();
				var event_status = $(".wpsp-dropdown-event-status, .wpsp-dropdown-bsf-aiosrs-event-event-status").val();

				if ("EventMovedOnline" !== event_status) {
					parent.find('td.wpsp-event-status-offline').show();
					parent.find('td.wpsp-event-status-online').hide();
				}

				if ("OfflineEventAttendanceMode" !== this.value) {
					parent.find('td.wpsp-event-status-offline').hide();
					parent.find('td.wpsp-event-status-online').show();
				}

				if ("MixedEventAttendanceMode" === this.value) {
					parent.find('td.wpsp-event-status-offline').show();
					parent.find('td.wpsp-event-status-online').show();
				}
			});

			$(".wpsp-dropdown-event-attendance-mode, .wpsp-dropdown-bsf-aiosrs-event-event-attendance-mode").trigger("change");
		},

		init_date_time_fields: function () {

			$('.wpsp-datetime-local-field, .wpsp-date-field, .wpsp-time-duration-field').each(function () {
				$(this).removeClass('hasDatepicker')
			});

			let start_date_selectors = '.wpsp-date-published-date, .wpsp-datetime-local-event-start-date, .wpsp-date-start-date, .wpsp-datetime-local-start-date';
			let end_date_selectors = '.wpsp-date-modified-date, .wpsp-datetime-local-event-end-date, .wpsp-date-end-date, .wpsp-datetime-local-end-date';

			$(document).on('focus', '.wpsp-time-duration-field', function () {
				$(this).timepicker({
					timeFormat: 'HH:mm:ss',
					hourMin: 0,
					hourMax: 99,
					oneLine: true,
					currentText: 'Clear',
					onSelect: function (date) {
						update_time_format(this);
					},
				});
			});

			$(document).on('focus', '.wpsp-datetime-local-field, .wpsp-date-field', function () {
				$(this).datetimepicker({
					dateFormat: "yy-mm-dd",
					timeFormat: "hh:mm TT",
					changeMonth: true,
					changeYear: true,
					showOn: 'focus',
					showButtonPanel: true,
					closeText: 'Done',
					currentText: 'Clear',
					yearRange: "-100:+10", // last hundred year
					onClose: function (dateText, inst) {

						let this_ele = "#" + inst.id;
						if (jQuery(this_ele).is(start_date_selectors)) {
							$(end_date_selectors).datetimepicker('option', 'minDate', new Date(dateText));
						} else if (jQuery(this_ele).is(end_date_selectors)) {
							$(start_date_selectors).datetimepicker('option', 'maxDate', new Date(dateText));
						}
						jQuery(this_ele).parents('.wpsp-local-fields').find('.wpsp-default-hidden-value').val(dateText);
					}
				});
			});

			$.datepicker._gotoToday = function (id) {
				$(id).datepicker('setDate', '').datepicker('hide').blur();
			};

			function update_time_format(this_ele) {

				let duration_wrap = $(this_ele).closest('.aiosrs-pro-custom-field-time-duration'),
					input_field = duration_wrap.find('.time-duration-field'),
					value = $(this_ele).val();
				value = value.replace(/:/, 'H');
				value = value.replace(/:/, 'M');
				value = "PT" + value + "S";
				input_field.val(value);

				// Post/pages related support.
				let parent = $(this_ele).parents('.wpsp-local-fields');
				parent.find('.wpsp-default-hidden-value').val(value);
			}

		}
	}

	/* Initializes the AIOSRS Schema. */
	$(function () {
		AIOSRS_Schema.init();

		if (!$('body').hasClass('aiosrs-pro-setup')) {
			AIOSRS_Schema.init_date_time_fields();
		}

	});

	$(document).ready(function () {



		$("#bsf-aiosrs-review-schema-type").change(function () {
			var item_val = $(this).val().trim();
			if (!item_val) {
				$(".bsf-review-item-type-field").remove();
				return;
			}
			AIOSRS_Schema.get_review_item_type_html(item_val)
		});
		$("#bsf-aiosrs-review-schema-type").change();


		AIOSRS_Schema.prepare_event_schmea_fields();

	});

})(jQuery);
