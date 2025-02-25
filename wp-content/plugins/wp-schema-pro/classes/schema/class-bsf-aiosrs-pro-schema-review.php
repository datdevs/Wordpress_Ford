<?php
/**
 * Schemas Template.
 *
 * @package Schema Pro
 * @since 1.0.0
 */

if ( ! class_exists( 'BSF_AIOSRS_Pro_Schema_Review' ) ) {

	/**
	 * AIOSRS Schemas Initialization
	 *
	 * @since 1.0.0
	 */
	class BSF_AIOSRS_Pro_Schema_Review {

		/**
		 * Render Schema.
		 *
		 * @param  array $data Meta Data.
		 * @param  array $post Current Post Array.
		 * @return array
		 */
		public static function render( $data, $post ) {
			$schema             = array();
			$schema['@context'] = 'https://schema.org';
			$schema['@type']    = 'Review';

			/* start Book schema fields */

			$data['schema-type'] = isset( $data['schema-type'] ) ? $data['schema-type'] : '';

			switch ( $data['schema-type'] ) {
				case 'bsf-aiosrs-book':
					$schema['itemReviewed']['@type'] = 'Book';
					if ( isset( $data['bsf-aiosrs-book-name'] ) && ! empty( $data['bsf-aiosrs-book-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-book-name'] );

					}
					if ( isset( $data['bsf-aiosrs-book-author'] ) && ! empty( $data['bsf-aiosrs-book-author'] ) ) {
						$schema['itemReviewed']['author']['@type']  = 'Person';
						$schema['itemReviewed']['author']['name']   = wp_strip_all_tags( $data['bsf-aiosrs-book-author'] );
						$schema['itemReviewed']['author']['sameAs'] = wp_strip_all_tags( $data['bsf-aiosrs-book-same-As'] );

					}
					if ( isset( $data['bsf-aiosrs-book-serial-number'] ) && ! empty( $data['bsf-aiosrs-book-serial-number'] ) ) {

						$schema['itemReviewed']['isbn'] = wp_strip_all_tags( $data['bsf-aiosrs-book-serial-number'] );
					}
					if ( isset( $data['bsf-aiosrs-book-description'] ) && ! empty( $data['bsf-aiosrs-book-description'] ) ) {
						$schema['description'] = wp_strip_all_tags( $data['bsf-aiosrs-book-description'] );
					}
					$book_url = get_permalink( $post['ID'] );
					if ( isset( $book_url ) && ! empty( $book_url ) ) {
						$schema['url'] = esc_url( $book_url );
					}
					break;
				case 'bsf-aiosrs-course':
					$schema['itemReviewed']['@type'] = 'Course';
					if ( isset( $data['bsf-aiosrs-course-name'] ) && ! empty( $data['bsf-aiosrs-course-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-course-name'] );

					}
					if ( isset( $data['bsf-aiosrs-course-description'] ) && ! empty( $data['bsf-aiosrs-course-description'] ) ) {
						$schema['itemReviewed']['description'] = wp_strip_all_tags( $data['bsf-aiosrs-course-description'] );

					}
					if ( isset( $data['bsf-aiosrs-course-orgnization-name'] ) && ! empty( $data['bsf-aiosrs-course-orgnization-name'] ) ) {
						$schema['itemReviewed']['provider']['@type'] = 'Organization';
						$schema['itemReviewed']['provider']['name']  = wp_strip_all_tags( $data['bsf-aiosrs-course-orgnization-name'] );
					}
					break;
				case 'bsf-aiosrs-event':
					$schema['itemReviewed']['@type'] = 'event';
					if ( isset( $data['bsf-aiosrs-event-name'] ) && ! empty( $data['bsf-aiosrs-event-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-event-name'] );
					}
					if ( isset( $data['bsf-aiosrs-event-description'] ) && ! empty( $data['bsf-aiosrs-event-description'] ) ) {
						$schema['itemReviewed']['description'] = wp_strip_all_tags( $data['bsf-aiosrs-event-description'] );
					}
					if ( isset( $data['bsf-aiosrs-event-image'] ) && ! empty( $data['bsf-aiosrs-event-image'] ) ) {
						$schema['itemReviewed']['image'] = wp_get_attachment_image_url( $data['bsf-aiosrs-event-image'] );
					}
					if ( isset( $data['bsf-aiosrs-event-start-date'] ) && ! empty( $data['bsf-aiosrs-event-start-date'] ) ) {
						if ( 'OfflineEventAttendanceMode' !== $data['bsf-aiosrs-event-event-attendance-mode'] ) {
							$start_date                          = gmdate( DATE_ISO8601, strtotime( $data['bsf-aiosrs-event-start-date'] ) );
							$schema['itemReviewed']['startDate'] = wp_strip_all_tags( $start_date );
						} else {
							$schema['itemReviewed']['startDate'] = wp_strip_all_tags( $data['bsf-aiosrs-event-start-date'] );
						}
					}
					if ( isset( $data['bsf-aiosrs-event-end-date'] ) && ! empty( $data['bsf-aiosrs-event-end-date'] ) ) {
						$schema['itemReviewed']['endDate'] = wp_strip_all_tags( $data['bsf-aiosrs-event-end-date'] );
					}
					if ( isset( $data['bsf-aiosrs-event-event-status'] ) && ! empty( $data['bsf-aiosrs-event-event-status'] ) ) {
						$schema['itemReviewed']['eventStatus'] = wp_strip_all_tags( $data['bsf-aiosrs-event-event-status'] );
					}

					if ( isset( $data['bsf-aiosrs-event-event-attendance-mode'] ) && ! empty( $data['bsf-aiosrs-event-event-attendance-mode'] ) ) {
						$schema['itemReviewed']['eventAttendanceMode'] = wp_strip_all_tags( $data['bsf-aiosrs-event-event-attendance-mode'] );
					}

					if ( isset( $data['bsf-aiosrs-event-previous-date'] ) && ! empty( $data['bsf-aiosrs-event-previous-date'] ) ) {
						if ( 'EventRescheduled' === $data['bsf-aiosrs-event-event-status'] ) {
							$schema['itemReviewed']['previousStartDate'] = wp_strip_all_tags( $data['bsf-aiosrs-event-previous-date'] );
						}
					}
					if ( isset( $data['bsf-aiosrs-event-online-location'] ) && ! empty( $data['bsf-aiosrs-event-online-location'] ) &&
					( 'OfflineEventAttendanceMode' !== $data['bsf-aiosrs-event-event-attendance-mode'] ) ||
					( 'MixedEventAttendanceMode' === $data['bsf-aiosrs-event-event-attendance-mode'] ) ) {
						$schema['itemReviewed']['location']['@type'] = 'VirtualLocation';
						$schema['itemReviewed']['location']['url']   = esc_url( $data['bsf-aiosrs-event-online-location'] );
					}
					if ( isset( $data['bsf-aiosrs-event-performer'] ) && ! empty( $data['bsf-aiosrs-event-performer'] ) ) {
						$schema['itemReviewed']['performer']['@type'] = 'Person';
						$schema['itemReviewed']['performer']['name']  = wp_strip_all_tags( $data['bsf-aiosrs-event-performer'] );
					}
					if ( isset( $data['bsf-aiosrs-event-location'] ) && ! empty( $data['bsf-aiosrs-event-location'] ) && 'OnlineEventAttendanceMode' !== $data['bsf-aiosrs-event-event-attendance-mode'] ) {
						$schema['itemReviewed']['location']['@type'] = 'Place';
						$schema['itemReviewed']['location']['name']  = wp_strip_all_tags( $data['bsf-aiosrs-event-location'] );
					}
					if ( ( ( isset( $data['bsf-aiosrs-event-location-street'] ) && ! empty( $data['bsf-aiosrs-event-location-street'] ) ) ||
					( isset( $data['bsf-aiosrs-event-location-locality'] ) && ! empty( $data['bsf-aiosrs-event-location-locality'] ) ) ||
					( isset( $data['bsf-aiosrs-event-location-postal'] ) && ! empty( $data['bsf-aiosrs-event-location-postal'] ) ) ||
					( isset( $data['bsf-aiosrs-event-location-region'] ) && ! empty( $data['bsf-aiosrs-event-location-region'] ) ) ||
					( isset( $data['bsf-aiosrs-event-location-country'] ) && ! empty( $data['bsf-aiosrs-event-location-country'] ) ) ) && ( 'OnlineEventAttendanceMode' !== $data['bsf-aiosrs-event-event-attendance-mode'] ) ) {
						$schema['itemReviewed']['location']['address']['@type'] = 'PostalAddress';

						if ( isset( $data['bsf-aiosrs-event-location-street'] ) && ! empty( $data['bsf-aiosrs-event-location-street'] ) ) {
							$schema['itemReviewed']['location']['address']['streetAddress'] = wp_strip_all_tags( $data['bsf-aiosrs-event-location-street'] );
						}
						if ( isset( $data['bsf-aiosrs-event-location-locality'] ) && ! empty( $data['bsf-aiosrs-event-location-locality'] ) ) {
							$schema['itemReviewed']['location']['address']['addressLocality'] = wp_strip_all_tags( $data['bsf-aiosrs-event-location-locality'] );
						}
						if ( isset( $data['bsf-aiosrs-event-location-postal'] ) && ! empty( $data['bsf-aiosrs-event-location-postal'] ) ) {
							$schema['itemReviewed']['location']['address']['postalCode'] = wp_strip_all_tags( $data['bsf-aiosrs-event-location-postal'] );
						}
						if ( isset( $data['bsf-aiosrs-event-location-region'] ) && ! empty( $data['bsf-aiosrs-event-location-region'] ) ) {
							$schema['itemReviewed']['location']['address']['addressRegion'] = wp_strip_all_tags( $data['bsf-aiosrs-event-location-region'] );
						}
						if ( isset( $data['bsf-aiosrs-event-location-country'] ) && ! empty( $data['bsf-aiosrs-event-location-country'] ) ) {
							$schema['itemReviewed']['location']['address']['addressCountry'] = wp_strip_all_tags( $data['bsf-aiosrs-event-location-country'] );
						}
					}
					$schema['itemReviewed']['offers']['@type'] = 'Offer';

					if ( ( isset( $data['bsf-aiosrs-event-avail'] ) && ! empty( $data['bsf-aiosrs-event-avail'] ) ) ||
						( isset( $data['bsf-aiosrs-event-currency'] ) && ! empty( $data['bsf-aiosrs-event-currency'] ) ) ||
						( isset( $data['bsf-aiosrs-event-valid-from'] ) && ! empty( $data['bsf-aiosrs-event-valid-from'] ) ) ||
						( isset( $data['bsf-aiosrs-event-ticket-buy-url'] ) && ! empty( $data['bsf-aiosrs-event-ticket-buy-url'] ) ) ) {
						if ( isset( $data['bsf-aiosrs-event-ticket-buy-url'] ) && ! empty( $data['bsf-aiosrs-event-ticket-buy-url'] ) ) {
							$schema['itemReviewed']['offers']['url'] = esc_url( $data['bsf-aiosrs-event-ticket-buy-url'] );
						}
						if ( isset( $data['bsf-aiosrs-event-price'] ) && ! empty( $data['bsf-aiosrs-event-price'] ) ) {
							$schema['itemReviewed']['offers']['price'] = wp_strip_all_tags( $data['bsf-aiosrs-event-price'] );
						}
						if ( isset( $data['bsf-aiosrs-event-avail'] ) && ! empty( $data['bsf-aiosrs-event-avail'] ) ) {
							$schema['itemReviewed']['offers']['availability'] = wp_strip_all_tags( $data['bsf-aiosrs-event-avail'] );
						}
						if ( isset( $data['bsf-aiosrs-event-currency'] ) && ! empty( $data['bsf-aiosrs-event-currency'] ) ) {
							$schema['itemReviewed']['offers']['priceCurrency'] = wp_strip_all_tags( $data['bsf-aiosrs-event-currency'] );
						}
						if ( isset( $data['bsf-aiosrs-event-valid-from'] ) && ! empty( $data['bsf-aiosrs-event-valid-from'] ) ) {
							$schema['itemReviewed']['offers']['validFrom'] = wp_strip_all_tags( $data['bsf-aiosrs-event-valid-from'] );
						}
					}
					if ( ( isset( $data['bsf-aiosrs-event-event-organizer-name'] ) && ! empty( $data['bsf-aiosrs-event-event-organizer-name'] ) ) ||
						( isset( $data['bsf-aiosrs-event-event-organizer-url'] ) && ! empty( $data['bsf-aiosrs-event-event-organizer-url'] ) ) ) {

						$schema['itemReviewed']['organizer']['@type'] = 'Organization';

						if ( isset( $data['bsf-aiosrs-event-event-organizer-name'] ) && ! empty( $data['bsf-aiosrs-event-event-organizer-name'] ) ) {
							$schema['itemReviewed']['organizer']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-event-event-organizer-name'] );
						}
						if ( isset( $data['bsf-aiosrs-event-event-organizer-url'] ) && ! empty( $data['bsf-aiosrs-event-event-organizer-url'] ) ) {
							$schema['itemReviewed']['organizer']['url'] = esc_url( $data['bsf-aiosrs-event-event-organizer-url'] );
						}
					}
					break;
				case 'bsf-aiosrs-local-business':
					$schema['itemReviewed']['@type'] = 'LocalBusiness';
					if ( isset( $data['bsf-aiosrs-local-business-name'] ) && ! empty( $data['bsf-aiosrs-local-business-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-name'] );
					}
					if ( isset( $data['bsf-aiosrs-local-business-image'] ) && ! empty( $data['bsf-aiosrs-local-business-image'] ) ) {

						$schema['itemReviewed']['image'] = wp_get_attachment_image_url( $data['bsf-aiosrs-local-business-image'] );
					}
					if ( isset( $data['bsf-aiosrs-local-business-telephone'] ) && ! empty( $data['bsf-aiosrs-local-business-telephone'] ) ) {
						$schema['itemReviewed']['telephone'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-telephone'] );
					}
					if ( ( isset( $data['bsf-aiosrs-local-business-location-street'] ) && ! empty( $data['bsf-aiosrs-local-business-location-street'] ) ) ||
						( isset( $data['bsf-aiosrs-local-business-location-locality'] ) && ! empty( $data['bsf-aiosrs-local-business-location-locality'] ) ) ||
						( isset( $data['bsf-aiosrs-local-business-location-postal'] ) && ! empty( $data['bsf-aiosrs-local-business-location-postal'] ) ) ||
						( isset( $data['bsf-aiosrs-local-business-location-region'] ) && ! empty( $data['bsf-aiosrs-local-business-location-region'] ) ) ||
						( isset( $data['bsf-aiosrs-local-business-location-country'] ) && ! empty( $data['bsf-aiosrs-local-business-location-country'] ) ) ) {

						$schema['itemReviewed']['address']['@type'] = 'PostalAddress';

						if ( isset( $data['bsf-aiosrs-local-business-location-street'] ) && ! empty( $data['bsf-aiosrs-local-business-location-street'] ) ) {
							$schema['itemReviewed']['address']['streetAddress'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-location-street'] );
						}
						if ( isset( $data['bsf-aiosrs-local-business-location-locality'] ) && ! empty( $data['bsf-aiosrs-local-business-location-locality'] ) ) {
							$schema['itemReviewed']['address']['addressLocality'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-location-locality'] );
						}
						if ( isset( $data['bsf-aiosrs-local-business-location-postal'] ) && ! empty( $data['bsf-aiosrs-local-business-location-postal'] ) ) {
							$schema['itemReviewed']['address']['postalCode'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-location-postal'] );
						}
						if ( isset( $data['bsf-aiosrs-local-business-location-region'] ) && ! empty( $data['bsf-aiosrs-local-business-location-region'] ) ) {
							$schema['itemReviewed']['address']['addressRegion'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-location-region'] );
						}
						if ( isset( $data['bsf-aiosrs-local-business-location-country'] ) && ! empty( $data['bsf-aiosrs-local-business-location-country'] ) ) {
							$schema['itemReviewed']['address']['addressCountry'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-location-country'] );
						}
					}
					if ( isset( $data['bsf-aiosrs-local-business-price-range'] ) && ! empty( $data['bsf-aiosrs-local-business-price-range'] ) ) {
						$schema['itemReviewed']['priceRange'] = wp_strip_all_tags( $data['bsf-aiosrs-local-business-price-range'] );
					}
					break;
				case 'bsf-aiosrs-recipe':
					$schema['itemReviewed']['@type'] = 'Recipe';
					if ( isset( $data['bsf-aiosrs-recipe-name'] ) && ! empty( $data['bsf-aiosrs-recipe-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-name'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-image'] ) && ! empty( $data['bsf-aiosrs-recipe-image'] ) ) {
						$schema['itemReviewed']['image'] = wp_get_attachment_image_url( $data['bsf-aiosrs-recipe-image'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-author'] ) && ! empty( $data['bsf-aiosrs-recipe-author'] ) ) {
						$schema['itemReviewed']['author']['@type'] = 'Person';
						$schema['itemReviewed']['author']['name']  = wp_strip_all_tags( $data['bsf-aiosrs-recipe-author'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-description'] ) && ! empty( $data['bsf-aiosrs-recipe-description'] ) ) {
						$schema['itemReviewed']['description'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-description'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-preperation-time'] ) && ! empty( $data['bsf-aiosrs-recipe-preperation-time'] ) ) {
						$schema['itemReviewed']['prepTime'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-preperation-time'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-cook-time'] ) && ! empty( $data['bsf-aiosrs-recipe-cook-time'] ) ) {
						$schema['itemReviewed']['cookTime'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-cook-time'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-recipe-keywords'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-keywords'] ) ) {
						$schema['itemReviewed']['keywords'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-recipe-keywords'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-recipe-category'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-category'] ) ) {
						$schema['itemReviewed']['recipeCategory'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-recipe-category'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-recipe-cuisine'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-cuisine'] ) ) {
						$schema['itemReviewed']['recipeCuisine'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-recipe-cuisine'] );
					}
					if ( ( isset( $data['bsf-aiosrs-recipe-rating'] ) && ! empty( $data['bsf-aiosrs-recipe-rating'] ) ) ||
					( isset( $data['review-count'] ) && ! empty( $data['review-count'] ) ) ) {
						$schema['itemReviewed']['aggregateRating']['@type'] = 'AggregateRating';
						if ( isset( $data['bsf-aiosrs-recipe-rating'] ) && ! empty( $data['bsf-aiosrs-recipe-rating'] ) ) {
							$schema['itemReviewed']['aggregateRating']['ratingValue'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-rating'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-review-count'] ) && ! empty( $data['bsf-aiosrs-recipe-review-count'] ) ) {
							$schema['itemReviewed']['aggregateRating']['reviewCount'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-review-count'] );
						}
					}
					if ( isset( $data['bsf-aiosrs-recipe-nutrition'] ) && ! empty( $data['bsf-aiosrs-recipe-nutrition'] ) ) {
						$schema['itemReviewed']['nutrition']['@type']    = 'NutritionInformation';
						$schema['itemReviewed']['nutrition']['calories'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-nutrition'] );
					}
					if ( isset( $data['bsf-aiosrs-recipe-ingredients'] ) && ! empty( $data['bsf-aiosrs-recipe-ingredients'] ) ) {
						$recipe_ingredients = explode( ',', $data['bsf-aiosrs-recipe-ingredients'] );
						foreach ( $recipe_ingredients as $key => $value ) {
							$schema['itemReviewed']['recipeIngredient'][ $key ] = wp_strip_all_tags( $value );
						}
					}
					if ( isset( $data['bsf-aiosrs-recipe-recipe-instructions'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-instructions'] ) ) {
								$recipe_instructions = explode( ',', $data['bsf-aiosrs-recipe-recipe-instructions'] );
						foreach ( $recipe_instructions as $key => $value ) {
							if ( isset( $value ) && ! empty( $value ) ) {
								$schema['itemReviewed']['recipeInstructions'][ $key ]['@type'] = 'HowToStep';
								$schema['itemReviewed']['recipeInstructions'][ $key ]['text']  = wp_strip_all_tags( $value );
							}
						}
					}

					if ( isset( $data['bsf-aiosrs-recipe-video-name'] ) && ! empty( $data['bsf-aiosrs-recipe-video-name'] ) ) {
								$schema['itemReviewed']['video']['@type'] = 'VideoObject';
								$schema['itemReviewed']['video']['name']  = wp_strip_all_tags( $data['bsf-aiosrs-recipe-video-name'] );
						if ( isset( $data['bsf-aiosrs-recipe-video-desc'] ) && ! empty( $data['bsf-aiosrs-recipe-video-desc'] ) ) {
							$schema['itemReviewed']['video']['description'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-video-desc'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-video-image'] ) && ! empty( $data['bsf-aiosrs-recipe-video-image'] ) ) {
							$schema['itemReviewed']['video']['thumbnailUrl'] = wp_get_attachment_image_url( $data['bsf-aiosrs-recipe-video-image'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-recipe-video-content-url'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-video-content-url'] ) ) {
							$schema['itemReviewed']['video']['contentUrl'] = esc_url( $data['bsf-aiosrs-recipe-recipe-video-content-url'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-recipe-video-embed-url'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-video-embed-url'] ) ) {
							$schema['itemReviewed']['video']['embedUrl'] = esc_url( $data['bsf-aiosrs-recipe-recipe-video-embed-url'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-recipe-video-duration'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-video-duration'] ) ) {
							$schema['itemReviewed']['video']['duration'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-recipe-video-duration'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-recipe-video-upload-date'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-video-upload-date'] ) ) {
							$schema['itemReviewed']['video']['uploadDate'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-recipe-video-upload-date'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-recipe-video-interaction-count'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-video-interaction-count'] ) ) {
							$schema['itemReviewed']['video']['interactionCount'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-recipe-video-interaction-count'] );
						}
						if ( isset( $data['bsf-aiosrs-recipe-recipe-video-expires-date'] ) && ! empty( $data['bsf-aiosrs-recipe-recipe-video-expires-date'] ) ) {
							$schema['itemReviewed']['video']['expires'] = wp_strip_all_tags( $data['bsf-aiosrs-recipe-recipe-video-expires-date'] );
						}
					}
					break;
				case 'bsf-aiosrs-software-application':
					$schema['itemReviewed']['@type'] = 'SoftwareApplication';
					if ( isset( $data['bsf-aiosrs-software-application-name'] ) && ! empty( $data['bsf-aiosrs-software-application-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-software-application-name'] );
					}

					if ( isset( $data['bsf-aiosrs-software-application-operating-system'] ) && ! empty( $data['bsf-aiosrs-software-application-operating-system'] ) ) {
						$schema['itemReviewed']['operatingSystem'] = wp_strip_all_tags( $data['bsf-aiosrs-software-application-operating-system'] );
					}

					if ( isset( $data['bsf-aiosrs-software-application-category'] ) && ! empty( $data['bsf-aiosrs-software-application-category'] ) ) {
						$schema['itemReviewed']['applicationCategory'] = wp_strip_all_tags( $data['bsf-aiosrs-software-application-category'] );
					}

					if ( ( isset( $data['bsf-aiosrs-software-application-rating'] ) && ! empty( $data['bsf-aiosrs-software-application-rating'] ) ) ||
						( isset( $data['bsf-aiosrs-software-application-review-count'] ) && ! empty( $data['bsf-aiosrs-software-application-review-count'] ) ) ) {

						$schema['itemReviewed']['aggregateRating']['@type'] = 'AggregateRating';

						if ( isset( $data['bsf-aiosrs-software-application-rating'] ) && ! empty( $data['bsf-aiosrs-software-application-rating'] ) ) {
							$schema['itemReviewed']['aggregateRating']['ratingValue'] = wp_strip_all_tags( $data['bsf-aiosrs-software-application-rating'] );
						}
						if ( isset( $data['bsf-aiosrs-software-application-review-count'] ) && ! empty( $data['bsf-aiosrs-software-application-review-count'] ) ) {
							$schema['itemReviewed']['aggregateRating']['reviewCount'] = wp_strip_all_tags( $data['bsf-aiosrs-software-application-review-count'] );
						}
					}
					if ( true === apply_filters( 'wp_schema_pro_remove_software_application_offers_review_type', true ) ) {
						$schema['itemReviewed']['offers']['@type'] = 'Offer';
						$schema['itemReviewed']['offers']['price'] = '0';

						if ( isset( $data['bsf-aiosrs-software-application-price'] ) && ! empty( $data['bsf-aiosrs-software-application-price'] ) ) {
							$schema['itemReviewed']['offers']['price'] = wp_strip_all_tags( $data['bsf-aiosrs-software-application-price'] );
						}

						if ( isset( $data['bsf-aiosrs-software-application-currency'] ) && ! empty( $data['bsf-aiosrs-software-application-currency'] ) ) {
							$schema['itemReviewed']['offers']['priceCurrency'] = wp_strip_all_tags( $data['bsf-aiosrs-software-application-currency'] );
						}
					}
					break;
				case 'bsf-aiosrs-product':
					$schema['itemReviewed']['@type'] = 'product';
					if ( isset( $data['bsf-aiosrs-product-name'] ) && ! empty( $data['bsf-aiosrs-product-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-product-name'] );
					}
					if ( isset( $data['bsf-aiosrs-product-image'] ) && ! empty( $data['bsf-aiosrs-product-image'] ) ) {
						$schema['itemReviewed']['image'] = wp_get_attachment_image_url( $data['bsf-aiosrs-product-image'] );
					}

					if ( isset( $data['bsf-aiosrs-product-description'] ) && ! empty( $data['bsf-aiosrs-product-description'] ) ) {
						$schema['itemReviewed']['description'] = wp_strip_all_tags( $data['bsf-aiosrs-product-description'] );
					}

					if ( isset( $data['bsf-aiosrs-product-sku'] ) && ! empty( $data['bsf-aiosrs-product-sku'] ) ) {
						$schema['itemReviewed']['sku'] = wp_strip_all_tags( $data['bsf-aiosrs-product-sku'] );
					}
					if ( isset( $data['bsf-aiosrs-product-mpn'] ) && ! empty( $data['bsf-aiosrs-product-mpn'] ) ) {
						$schema['itemReviewed']['mpn'] = wp_strip_all_tags( $data['bsf-aiosrs-product-mpn'] );
					}
					if ( isset( $data['bsf-aiosrs-product-brand-name'] ) && ! empty( $data['bsf-aiosrs-product-brand-name'] ) ) {
						$schema['itemReviewed']['brand']['@type'] = 'Thing';
						$schema['itemReviewed']['brand']['name']  = wp_strip_all_tags( $data['bsf-aiosrs-product-brand-name'] );
					}

					if ( ( isset( $data['bsf-aiosrs-product-rating'] ) && ! empty( $data['bsf-aiosrs-product-rating'] ) ) ||
						( isset( $data['bsf-aiosrs-product-review-count'] ) && ! empty( $data['bsf-aiosrs-product-review-count'] ) ) ) {

						$schema['itemReviewed']['aggregateRating']['@type'] = 'AggregateRating';

						if ( isset( $data['bsf-aiosrs-product-rating'] ) && ! empty( $data['bsf-aiosrs-product-rating'] ) ) {
							$schema['itemReviewed']['aggregateRating']['ratingValue'] = wp_strip_all_tags( $data['bsf-aiosrs-product-rating'] );
						}
						if ( isset( $data['bsf-aiosrs-product-review-count'] ) && ! empty( $data['bsf-aiosrs-product-review-count'] ) ) {
							$schema['itemReviewed']['aggregateRating']['reviewCount'] = wp_strip_all_tags( $data['bsf-aiosrs-product-review-count'] );
						}
					}
					if ( apply_filters( 'wp_schema_pro_remove_product_offers', true ) ) {
						$schema['itemReviewed']['offers']['@type'] = 'Offer';
						$schema['itemReviewed']['offers']['price'] = '0';
						if ( isset( $data['bsf-aiosrs-product-price'] ) && ! empty( $data['bsf-aiosrs-product-price'] ) ) {
							$schema['itemReviewed']['offers']['price'] = wp_strip_all_tags( $data['bsf-aiosrs-product-price'] );
						}
						if ( isset( $data['bsf-aiosrs-product-price-valid-until'] ) && ! empty( $data['bsf-aiosrs-product-price-valid-until'] ) ) {
							$schema['itemReviewed']['offers']['priceValidUntil'] = wp_strip_all_tags( $data['bsf-aiosrs-product-price-valid-until'] );
						}

						if ( isset( $data['url'] ) && ! empty( $data['url'] ) ) {
							$schema['itemReviewed']['offers']['url'] = esc_url( $data['url'] );
						}

						if ( ( isset( $data['bsf-aiosrs-product-currency'] ) && ! empty( $data['bsf-aiosrs-product-currency'] ) ) ||
							( isset( $data['bsf-aiosrs-product-avail'] ) && ! empty( $data['bsf-aiosrs-product-avail'] ) ) ) {

							if ( isset( $data['bsf-aiosrs-product-currency'] ) && ! empty( $data['bsf-aiosrs-product-currency'] ) ) {
								$schema['itemReviewed']['offers']['priceCurrency'] = wp_strip_all_tags( $data['bsf-aiosrs-product-currency'] );
							}
							if ( isset( $data['bsf-aiosrs-product-avail'] ) && ! empty( $data['bsf-aiosrs-product-avail'] ) ) {
								$schema['itemReviewed']['offers']['availability'] = wp_strip_all_tags( $data['bsf-aiosrs-product-avail'] );
							}
						}
					}

					break;
				case 'bsf-aiosrs-movie':
					$schema['itemReviewed']['@type'] = 'Movie';
					if ( isset( $data['bsf-aiosrs-movie-name'] ) && ! empty( $data['bsf-aiosrs-movie-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-movie-name'] );
					}
					if ( isset( $data['bsf-aiosrs-movie-same-As'] ) && ! empty( $data['bsf-aiosrs-movie-same-As'] ) ) {
						$schema['itemReviewed']['sameAs'] = wp_strip_all_tags( $data['bsf-aiosrs-movie-same-As'] );
					}
					if ( isset( $data['bsf-aiosrs-movie-image'] ) && ! empty( $data['bsf-aiosrs-movie-image'] ) ) {
						$schema['itemReviewed']['image'] = wp_get_attachment_image_url( $data['bsf-aiosrs-movie-image'] );
					}
					if ( isset( $data['bsf-aiosrs-movie-dateCreated'] ) && ! empty( $data['bsf-aiosrs-movie-dateCreated'] ) ) {
						$schema['itemReviewed']['dateCreated'] = wp_strip_all_tags( $data['bsf-aiosrs-movie-dateCreated'] );
					}
					if ( isset( $data['bsf-aiosrs-movie-director-name'] ) && ! empty( $data['bsf-aiosrs-movie-director-name'] ) ) {
						$schema['itemReviewed']['director']['@type'] = 'Person';
						$schema['itemReviewed']['director']['name']  = wp_strip_all_tags( $data['bsf-aiosrs-movie-director-name'] );
					}
					if ( isset( $data['bsf-aiosrs-movie-description'] ) && ! empty( $data['bsf-aiosrs-movie-description'] ) ) {
						$schema['description'] = wp_strip_all_tags( $data['bsf-aiosrs-movie-description'] );
					}

					break;
				case 'bsf-aiosrs-organization':
					$schema['itemReviewed']['@type'] = 'Organization';
					if ( isset( $data['bsf-aiosrs-organization-name'] ) && ! empty( $data['bsf-aiosrs-organization-name'] ) ) {
						$schema['itemReviewed']['name'] = wp_strip_all_tags( $data['bsf-aiosrs-organization-name'] );
					}
					if ( ( isset( $data['bsf-aiosrs-organization-location-street'] ) && ! empty( $data['bsf-aiosrs-organization-location-street'] ) ) ||
						( isset( $data['bsf-aiosrs-organization-location-locality'] ) && ! empty( $data['bsf-aiosrs-organization-location-locality'] ) ) ||
						( isset( $data['bsf-aiosrs-organization-location-postal'] ) && ! empty( $data['bsf-aiosrs-organization-location-postal'] ) ) ||
						( isset( $data['bsf-aiosrs-organization-location-region'] ) && ! empty( $data['bsf-aiosrs-organization-location-region'] ) ) ||
						( isset( $data['bsf-aiosrs-organization-location-country'] ) && ! empty( $data['bsf-aiosrs-organization-location-country'] ) ) ) {

						$schema['itemReviewed']['address']['@type'] = 'PostalAddress';

						if ( isset( $data['bsf-aiosrs-organization-location-street'] ) && ! empty( $data['bsf-aiosrs-organization-location-street'] ) ) {
							$schema['itemReviewed']['address']['streetAddress'] = wp_strip_all_tags( $data['bsf-aiosrs-organization-location-street'] );
						}
						if ( isset( $data['bsf-aiosrs-organization-location-locality'] ) && ! empty( $data['bsf-aiosrs-organization-location-locality'] ) ) {
							$schema['itemReviewed']['address']['addressLocality'] = wp_strip_all_tags( $data['bsf-aiosrs-organization-location-locality'] );
						}
						if ( isset( $data['bsf-aiosrs-organization-location-postal'] ) && ! empty( $data['bsf-aiosrs-organization-location-postal'] ) ) {
							$schema['itemReviewed']['address']['postalCode'] = wp_strip_all_tags( $data['bsf-aiosrs-organization-location-postal'] );
						}
						if ( isset( $data['bsf-aiosrs-organization-location-region'] ) && ! empty( $data['bsf-aiosrs-organization-location-region'] ) ) {
							$schema['itemReviewed']['address']['addressRegion'] = wp_strip_all_tags( $data['bsf-aiosrs-organization-location-region'] );
						}
						if ( isset( $data['bsf-aiosrs-organization-location-country'] ) && ! empty( $data['bsf-aiosrs-organization-location-country'] ) ) {
							$schema['itemReviewed']['address']['addressCountry'] = wp_strip_all_tags( $data['bsf-aiosrs-organization-location-country'] );
						}
					}
					break;
				default:
					break;
			}
			/*Review schema fields*/

			if ( isset( $data['rating'] ) && ! empty( $data['rating'] ) ) {
				$schema['reviewRating']['@type']       = 'Rating';
				$schema['reviewRating']['ratingValue'] = wp_strip_all_tags( $data['rating'] );
			}
			if ( isset( $data['review-body'] ) && ! empty( $data['review-body'] ) ) {
				$schema['reviewBody'] = wp_strip_all_tags( $data['review-body'] );
			}
			if ( isset( $data['date'] ) && ! empty( $data['date'] ) ) {
				$schema['datePublished'] = wp_strip_all_tags( $data['date'] );
			}
			if ( isset( $data['reviewer-type'] ) && ! empty( $data['reviewer-type'] ) ) {
				$schema['author']['@type'] = wp_strip_all_tags( $data['reviewer-type'] );
			} else {
				$schema['author']['@type'] = 'Person';
			}
			if ( isset( $data['reviewer-name'] ) && ! empty( $data['reviewer-name'] ) ) {
				$schema['author']['name']   = wp_strip_all_tags( $data['reviewer-name'] );
				$schema['author']['sameAs'] = get_permalink( $post['ID'] );
			}
			if ( isset( $data['publisher-name'] ) && ! empty( $data['publisher-name'] ) ) {
				$schema['publisher']['@type']  = 'Organization';
				$schema['publisher']['name']   = wp_strip_all_tags( $data['publisher-name'] );
				$schema['publisher']['sameAs'] = get_permalink( $post['ID'] );
			}

			return apply_filters( 'wp_schema_pro_schema_review', $schema, $data, $post );
		}

	}
}
