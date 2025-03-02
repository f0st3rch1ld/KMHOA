<?php
/*
 * Plugin Name:       Kimberly Meadows HOA Plugin
 * Description:       This plugin adapts the Kimberly Meadows HOA site to do a little more than what it can out of the box.
 * Author:            Andrew Foster
 * Author URI:        https://becomerenown.com
 */

//  Lets allow more file types than stock
function cc_mime_types($mimes)
{
  $mimes['svg'] = 'image/svg+xml';
  return $mimes;
}
add_filter('upload_mimes', 'cc_mime_types');

/** ~~~~~~~~~~~VUE PAYMENTS~~~~~~~~~~~ **/

// Lets add our scripts for vuePayments
function enqueueVuePaymentScripts() {
  // enqueue will only run on these pages
  $enqueueOnPages = array(
    'pay-your-dues'
  );

  if (is_page($enqueueOnPages)) {
    wp_enqueue_script('paypal', 'https://sandbox.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID', array(), null);

    $jsFiles = glob('wp-content/plugins/Kimberly-Meadows-HOA/vuePayments/dist/assets/*.js');
    foreach ($jsFiles as $file) {
      $fileName = basename($file);
      wp_enqueue_script_module(str_replace('.js', '', $fileName), '../' . $file, array(), null);
    }

    $cssFiles = glob('wp-content/plugins/Kimberly-Meadows-HOA/vuePayments/dist/assets/*.css');
    foreach($cssFiles as $file) {
      $fileName = basename($file);
      wp_enqueue_style(str_replace('.css', '', $fileName), site_url() . '/' . $file, 'array()', null);
    }
  }
}
add_action('wp_enqueue_scripts', 'enqueueVuePaymentScripts');

// We need a shortcode to enable our vue application to run inside a page.
function vue_payments() {
  return '<div id="app"></div>';
}
add_shortcode('vuePayments', 'vue_payments');

/** ~~~~~~~~~~~VUE PAYMENTS~~~~~~~~~~~ **/