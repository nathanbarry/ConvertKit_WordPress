<?php
/*
Template Name: ConvertKit Page
*/
if (get_post_meta($post->ID, "_convertkit_convertkit_form", true) == 0 || !get_post_meta($post->ID, "_convertkit_convertkit_form", true)) {
  $dataOrig = get_data("https://convertkit.com/app/api/v1/landing_pages/" . get_option('convertkit_default_form') . ".json?api_key=" . get_option('convertkit_api_key'));
  if (get_option('convertkit_default_form') == -1) {
    die("The default landing page cannot be used if it is \"None\".  Please change this by editing this page's landing page.");
  }
} else {
  $dataOrig = get_data("https://convertkit.com/app/api/v1/landing_pages/" . get_post_meta($post->ID, "_convertkit_convertkit_form", true) . ".json?api_key=" . get_option('convertkit_api_key'));  
}
if ($dataOrig->errors["http_request_failed"] == null) {
  $data = json_decode($dataOrig["body"]);
?>
  <iframe src="https://convertkit.com<?php echo $data->accessPath ?>" style="width: 100%; height: 100%; border: 0;"></iframe>
<?php } ?>
<style>
  body {
    margin: 0;
  }
</style>