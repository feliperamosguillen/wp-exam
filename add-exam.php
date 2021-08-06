<?php

/*
Plugin Name: Exam
Plugin URI: 
Description: This plugin add shortcode for list all products and modify related products list.
Version: 1.0
Author: FRG
*/

//Verify if woocommerce is active
include_once(ABSPATH.'wp-admin/includes/plugin.php');

if ( is_plugin_active( 'woocommerce/woocommerce.php' ) ){
	// hooks for plugin
	require_once( plugin_dir_path(__FILE__) . '/lib/filters.php' );

	// shortcodes for plugin
	require_once( plugin_dir_path(__FILE__) . '/lib/shortcodes.php' );
} else {
    function woo_exam_required_plugin() {
        if ( is_admin() && current_user_can( 'activate_plugins' ) &&  !is_plugin_active( 'woocommerce/woocommerce.php' ) ) {
            add_action( 'admin_notices', 'woo_exam_required_plugin_notice' );

            deactivate_plugins( plugin_basename( __FILE__ ) ); 

            if ( isset( $_GET['activate'] ) ) {
                unset( $_GET['activate'] );
            }
        }

    }
    add_action( 'admin_init', 'woo_exam_required_plugin' );

    function woo_exam_required_plugin_notice(){
        ?>
			<div class="error">
				<p>Error! You need to install or activate the Woocommerce plugin before use Exam plugin.</p>
			</div>
		<?php
    }
}///
?>
