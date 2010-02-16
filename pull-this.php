<?php
/*
Plugin Name: Pull This
Plugin URI: http://wordpress.org/extend/plugins/pull-this/
Description: Select and place pull quotes inside your posts using shortcodes ([pullthis][/pullthis] and [pullshow]). Pull quotes are inserted with javascript.
Author: Jon Smajda
Version: 1.0
*/

/* Create shortcodes */

// shortcode to mark a pull quote: [pullthis id="foo"]Make me a pull quote[/pullthis]
function pull_this_mark($atts, $content = null) {
  extract(shortcode_atts(array( 'id' => '1', 'display' => 'both'), $atts));
  if ($display == 'outside' )
    return '<span class="pull-this-mark" id="pull-this-mark-'.$id.'" style="display:none;">'.$content.'</span>';
  else 
    return '<span class="pull-this-mark" id="pull-this-mark-'.$id.'">'.$content.'</span>';
}
add_shortcode('pullthis', 'pull_this_mark');

// shortcode to display a pullquote: [pullshow id="foo"]
function pull_this_show($atts) {
  extract(shortcode_atts(array( 'id' => '1'), $atts));
  return '<div class="pull-this-show" id="pull-this-show-'.$id.'" style="display:none;"></div>';
}
add_shortcode('pullshow', 'pull_this_show');

/* Load JS and CSS */
function pull_this_scripts() {
  wp_enqueue_style(
    'pull-this', 
    WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)).'/pull-this.css', 
    false, false, 'all'
  );
  wp_enqueue_script(
    'pull-this',
    WP_PLUGIN_URL.'/'.basename(dirname(__FILE__)).'/pull-this.js',
    array('jquery')
  );
}
add_action('wp_enqueue_scripts', 'pull_this_scripts');

?>
