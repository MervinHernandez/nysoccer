<?php
/**
* Plugin Name: NYSS Customizations
* Plugin URI: https://wingmanwp.com
* Description: NYSS website customizations
* Version: 1.07.24
* Author: WingMan WP
* Author URI: https://wingmanwp.com
* Plugin Type: Piklist
*/
/* WOOCOMMERCE - Hide Upsell Admin Notices */
remove_action( 'admin_notices', 'woothemes_updater_notice' );

/* JETPACK - Hide Upsell Notes */
add_filter( 'jetpack_just_in_time_msgs', '_return_false' );

/* WORDPRESS - Hide Dashboard Items */
function dweandw_remove() {
	remove_meta_box( 'dashboard_primary', get_current_screen(), 'side' );
}
add_action( 'wp_network_dashboard_setup', 'dweandw_remove', 20 );
add_action( 'wp_user_dashboard_setup',    'dweandw_remove', 20 );
add_action( 'wp_dashboard_setup',         'dweandw_remove', 20 );

/* WORDPRESS - Hide Custom Fields Metabox */
if( !defined( 'ABSPATH' ) ) { exit; }

class Remove_custom_fields_metabox
{
	public function __construct()
	{
		add_action( 'admin_menu', array($this, 'remove_post_meta_box'));
	}

	public function remove_post_meta_box()
	{
		if ( is_admin() ) {
			$post_types = get_post_types();

			foreach ($post_types as $post_type) {
				if ( post_type_supports( $post_type, 'custom-fields' ) )
					remove_meta_box( 'postcustom', $post_type, 'normal' );
			}
		}
	}
}
global $remove_custom_fields_metabox;
if( !isset($remove_custom_fields_metabox) ) {
	$remove_custom_fields_metabox = new Remove_custom_fields_metabox();
}
