/**
 * Trigger AJAX request to save state when the WooCommerce notice is dismissed.
 *
 * @version 2.3.0
 *
 * @author StudioPress
 * @license GPL-2.0-or-later
 * @package DCS
 */

jQuery( document ).on(
	'click', '.dcs-woocommerce-notice .notice-dismiss', function() {

		jQuery.ajax(
			{
				url: ajaxurl,
				data: {
					action: 'dcs_dismiss_woocommerce_notice'
				}
			}
		);

	}
);
