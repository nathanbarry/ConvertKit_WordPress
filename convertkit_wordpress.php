<?php 
/*
Plugin Name: ConvertKit Wordpress
Plugin URI: https://convertkit.com
Description: Plugin for embeding ConvertKit forms
Author: ConvertKit
Version: 1.0
Author URI: https://convertkit.com
*/

//************ CURL ************

/* gets the data from a URL */
function get_data($url) {
	$ch = curl_init();
	$timeout = 5;
	curl_setopt($ch, CURLOPT_URL, $url);
	curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $timeout);
	$data = curl_exec($ch);
	curl_close($ch);
	return $data;
}

//************ Meta Boxes ************

function convertkit_initialize_cmb_meta_boxes() {
	if ( ! class_exists( 'cmb_Meta_Box' ) )
		require_once(plugin_dir_path( __FILE__ ) . 'convertkit_metabox.php');
}

function convertkit_sample_metaboxes( $meta_boxes ) {
	if (get_option('convertkit_api_key') && get_option('convertkit_api_key') != "") {
		$prefix = '_convertkit_'; // Prefix for all fields
		$json = get_data("https://convertkit.com/app/api/v1/forms.json?api_key=" . get_option('convertkit_api_key'));
		$data = json_decode($json);

		$landingPages = array(array('name' => "Default", 'value' => 0), array('name' => "None", 'value' => -1));
		if ($data) {
  		foreach ($data as $lp) {
  			array_push($landingPages, array('name' => $lp->landing_page->name, 'value' => $lp->landing_page->id));
  		}
		}
		// $landingPages = array(array('name' => 'Designing Web Apps', 'value' => '1'), array( 'name' => 'Designing Mobile Apps', 'value' => '2', 'selected' => "t"));

		$meta_boxes[] = array(
			'id' => 'convertkit_meta',
			'title' => 'ConvertKit',
			'pages' => array('post'), // post type
			'context' => 'normal',
			'priority' => 'high',
			'show_names' => true, // Show field names on the left
			'fields' => array(
				array(
					'name'    => 'Form',
					'desc'    => 'Choose a form for ConvertKit',
					'id'      => $prefix . 'convertkit_form',
					'type'    => 'select',
					'options' => $landingPages
				),
			),
		);

		return $meta_boxes;
	}
}

//************ Bottom of every post ************
function convertkit_bottom_of_post($content){
	global $post;
	$savedForm = get_post_meta($post->ID, "_convertkit_convertkit_form", true);
	if ($savedForm != 0 && $savedForm) {
		$msg = convertkit_form($savedForm);
	} else if($savedForm == -1) {
		$msg = "";
	} else {
		$msg = convertkit_form(get_option('convertkit_default_form'));
	}
		

	return $content . stripslashes($msg);
}

//************* Template functions *************

function convertkit_form($form_id) {
	require_once(plugin_dir_path( __FILE__ ) . 'convertkit_form.php');
	if($form_id == -1 || !$form_id) {
		return "";
	}
	if (get_option('convertkit_api_key') && get_option('convertkit_api_key') != "") {
		$json = get_data("https://convertkit.com/app/api/v1/forms/" . $form_id . "/info.json?api_key=" . get_option('convertkit_api_key'));
		$data = json_decode($json);
		if ($data) {
			return generateFormHTML($data, $form_id);
		} else {
			return "";
		}
	} else {
		return "";
	}
}

function convertkit_form_shortcode($attrs) {
  return convertkit_form($attrs['formid']);
}

//*************** Admin function ***************
function convertkit_admin() {
	include('convertkit_wordpress_admin.php');
}

function convertkit_admin_actions() {
    add_options_page("ConvertKit", "ConvertKit", 1, "ConvertKit", "convertkit_admin");
}

add_action('admin_menu', 'convertkit_admin_actions');
add_action( 'init', 'convertkit_initialize_cmb_meta_boxes', 9999 );
add_filter('the_content', 'convertkit_bottom_of_post');
if (get_option('convertkit_api_key') && get_option('convertkit_api_key') != "") {
	add_filter( 'cmb_meta_boxes', 'convertkit_sample_metaboxes' );
}
add_shortcode('convertkit', 'convertkit_form_shortcode');

?>