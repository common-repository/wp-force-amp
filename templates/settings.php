<div class="wfa-white-background">
	<form id="wp-force-amp-settings-form" method="post" action="options.php">
		<?php settings_fields( 'wp_force_amp_group' ); ?>
		<?php do_settings_sections( 'wp_force_amp_group' ); ?>
		<div class="form-table wfa-form">
				<div>
					<p>
						To test the changes, save the settings and view any blog post on a mobile device,
						<br/>
						eg: <i>https://yourdomain.com/your-sample-article/</i>
						<br/>
						'WP Force AMP' plugin would automatically redirect you to AMP version of the blog post,
						<br/>
						eg: <i>https://yourdomain.com/your-sample-article/amp/</i>
					</p>	
					<p>
						<strong>Note:</strong> Don't see any changes? try to clear the site/browser cache and refresh.</strong>
					</p>
					<br/>
					<br/>
				</div>

				<div>
					<div class="wfa-form-label" scope"row">Enable WP Force AMP:</div>
					<div class="wfa-form-input">
						<input type="checkbox" <?php if (get_option('wp_force_amp_flag')) echo "checked"; ?> name="wp_force_amp_flag"/>
						<br/>
						<p>Force redirect to AMP version of the blog post on Mobile devices. <a target="_blank" href="https://creativebrains.co.in/product/wp-force-amp-wordpress-plugin/"/>Read more.</a></p>
					</div>
				</div>

				<div>
					<p class="submit">
						<input type="submit" name="submit" id="submit" class="button button-primary" value="Save Changes">
					</p>
				</div>
		</div>	
	</form>	
</div>	
