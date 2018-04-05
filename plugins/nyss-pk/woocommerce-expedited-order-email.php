<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

/**
 *  Add a custom email to the list of emails WooCommerce should load
 *
 * @since 0.1
 * @param array $email_classes available email classes
 * @return array filtered available email classes
 */
function add_expedited_order_woocommerce_email( $email_classes ) {

	// include our custom email class
	require( 'includes/class-wc-expedited-order-email.php' );

	// add the email class to the list of email classes that WooCommerce loads
	$email_classes['WC_Expedited_Order_Email'] = new WC_Expedited_Order_Email();

	return $email_classes;

}
add_filter( 'woocommerce_email_classes', 'add_expedited_order_woocommerce_email' );