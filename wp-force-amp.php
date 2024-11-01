<?php

/*
Plugin Name: WP Force AMP
Plugin URI: https://creativebrains.co.in
Description: Force redirect to AMP version of the blog post on Mobile devices
Version: 1.0.2
Author: Creative Brains
*/


// Exit if someone tries to access plugin file directly.
defined( 'ABSPATH' ) or die ( 'No script kiddies please!' );

define("WP_FORCE_AMP_PLUGIN_PATH", plugin_dir_path( __FILE__ ));

define("WP_FORCE_AMP_PLUGIN_URL", plugins_url('',__FILE__));


#################################################################################################################

function wfa_admin_custom_style_scripts() {
    wp_register_style('wfa_admin_custom_style_scripts', plugins_url('css/wfa-style.css?987987',__FILE__ ));
    wp_enqueue_style('wfa_admin_custom_style_scripts');
}
add_action( 'admin_init','wfa_admin_custom_style_scripts', 15);

#################################################################################################################

#################################################################################################################

function wfa_register_options_page() {
  add_options_page('WP Force AMP', 'WP Force AMP', 'manage_options', 'wp-force-amp', 'wp_force_amp_options_page');
  add_action( 'admin_init', 'register_wp_force_amp_settings' );
}
add_action('admin_menu', 'wfa_register_options_page');

#################################################################################################################

#################################################################################################################

function register_wp_force_amp_settings() {
	register_setting( 'wp_force_amp_group', 'wp_force_amp_flag' , array(
        'show_in_rest' => true,
        'type'         => 'boolean',
        'description'  => __( 'Force AMP version of pages on Mobile devices' ),
        'default'      => true,
    ));
}

#################################################################################################################

#################################################################################################################

function wp_force_amp_options_page() { 
	?>
	<div class="wrap">

		<h1>
			<span class="dashicons dashicons-admin-settings" style="font-size: 35px;color: #4665A7;padding-right: 20px;"></span>
			WP Force AMP Settings
		</h1>

	</div>

	<?php 
		if (function_exists('amp_init')) {

		} else { ?>

		<div class="notice notice-error is-dismissible"> 
			<p><strong><?php _e('This plugin depends on <a target="_blank" href="https://wordpress.org/plugins/amp/">AMP plugin by Automattic</a>. Please install it to get started with <i>WP Force AMP</i>.') ?></strong></p>
			<button type="button" class="notice-dismiss">
				<span class="screen-reader-text">Dismiss this notice.</span>
			</button>
		</div>

		<?php }
	?>
	
	<div>
		<div class="wfa-main-options" style="background: #fff;">
			<div class="wfa-options-content">

				<div class="wp-force-amp-table">
					<?php include( WP_FORCE_AMP_PLUGIN_PATH . 'templates/settings.php'); ?>
				</div>

			</div>

			<div style="text-align:center;margin: 0 auto;">
				<h1>How it works?</h1>
				<img src="<?php echo WP_FORCE_AMP_PLUGIN_URL . '/images/wp-force-amp-working.png'; ?>"/>
			</div>	
		</div>


		<div class="wfa-right-sidebar">
			<?php include( WP_FORCE_AMP_PLUGIN_PATH . 'templates/pro-features.php'); ?>
			<br/>
        	<?php include( WP_FORCE_AMP_PLUGIN_PATH . 'templates/how-to.php'); ?>
        	<br/>
        	<?php include( WP_FORCE_AMP_PLUGIN_PATH . 'templates/get-in-touch.php'); ?>
        </div>	
	</div>

	<?php
}

#################################################################################################################

function wp_force_amp_hook() {
	/*
		Only redirect to AMP version of the blog post if 
			1. AMP plugin is installed.
			2. User is on mobile device.
			3. is_single temaplate (blog post).
			4. Not home page.
			5. Not front page.
	*/
	if (function_exists('amp_init') && wp_is_mobile() && is_single() && !is_home() && !is_front_page()) {
		$current_url = get_permalink();
		$amp_current_url = $current_url . 'amp/';
		?>
		<script>
  			window.location.href = "<?php echo $amp_current_url; ?>";
		</script>
		<?php
		exit;
	}
}

add_action('wp_head', 'wp_force_amp_hook', 1);

#################################################################################################################

?>