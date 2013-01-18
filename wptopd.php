<?php
/*
Plugin Name: WP to PipeDrive
Plugin URI: http://nerdyworm.com/wptopd
Description: Wordpress leads straight into your PipeDrive account.
Version: 1.0.0
Author: nerdyworm.
Author URI: http://nerdyworm.com
License:
*/

function wptopd_widget($args) {
?>

<div id="wptopd">
  <?php if($_GET['wptopd-saved'] == 'true') { ?>

  <div class="wptopd-thank-you">
    <?php echo get_option("wptopd_thank_you") ?>
  </div>

  <?php  } else { ?>
  <form action="<?php echo get_option('siteurl') ?>/wp-content/plugins/wptopd/save.php" method="post" class="wptopd-form">

    <div class="wptopd-title">
      <?php echo get_option("wptopd_title") ?>
    </div>

    <div class="wptopd-field wptopd-name">
      <label for="wptopd-name" class="wptopd-label">Name:</label>
      <input type="text" name="wptopd-name">
    </div>

    <div class="wptopd-field wptopd-email">
      <label for="wptopd-email" class="wptopd-label">Email:</label>
      <input type="text" name="wptopd-email">
    </div>

    <div class="wptopd-field wptopd-phone">
      <label for="wptopd-phone" class="wptopd-label">Phone:</label>
      <input type="text" name="wptopd-phone">
    </div>

    <div class="wptopd-field">
      <input type="submit" value="<?php echo get_option("wptopd_button") ?>" class="wptopd-submit"/>
    </div>
  </form>
  <?php  } ?>
</div> <!-- /#wptopd -->
<?php
}

function wptopd_init() {
	if(function_exists('wp_register_sidebar_widget')) {
		wp_register_sidebar_widget('WP to PipeDrive', 'WP to PipeDrive', 'wptopd_widget');
	}
}

function wptopd_admin() {
?>
<div class="wrap">
  <h2>WP to PipeDrive</h2>

  <form action="options.php" method="post">
    <?php settings_fields('wptopd'); ?>
    <?php do_settings_sections('wptopd'); ?>
    <table class="form-table">
      <tbody>
        <tr>
          <th><label for="api_token">Api Token</label></th>
          <td><input type="text" name="wptopd_api_token" value="<?php echo get_option('wptopd_api_token'); ?>" class="regular-text code"/></td>
        </tr>
        <tr>
          <th><label for="title">Title</label></th>
          <td><input type="text" name="wptopd_title" value="<?php echo get_option('wptopd_title'); ?>" class="regular-text code"/></td>
        </tr>
        <tr>
          <th><label for="title">Button Text</label></th>
          <td><input type="text" name="wptopd_button" value="<?php echo get_option('wptopd_button'); ?>" class="regular-text code"/></td>
        </tr>
        <tr>
          <th><label for="title">Thank you message</label></th>
          <td><input type="text" name="wptopd_thank_you" value="<?php echo get_option('wptopd_thank_you'); ?>" class="regular-text code"/></td>
        </tr>
      </tbody>
    </table>
    <div>
      <input name="Submit" type="submit" value="<?php esc_attr_e('Save Changes'); ?>" />
    </div>
  </form>
</div>
<?php
}

function wptopd_register_mysettings() {
  register_setting( 'wptopd', 'wptopd_api_token' );
  register_setting( 'wptopd', 'wptopd_title' );
  register_setting( 'wptopd', 'wptopd_button' );
  register_setting( 'wptopd', 'wptopd_thank_you' );
}

function wptopd_admin_menu() {
  add_options_page('WP to PipeDrive', 'WP to PipeDrive', 'manage_options', __FILE__, 'wptopd_admin' );
  add_options_page('WP to PipeDrive', '', 'manage_options', "wptopd/setting.php",'' );
}

add_action("plugins_loaded", "wptopd_init");

if ( is_admin() ) {
  add_action( 'admin_menu', 'wptopd_admin_menu' );
  add_action( 'admin_init', 'wptopd_register_mysettings' );
}
