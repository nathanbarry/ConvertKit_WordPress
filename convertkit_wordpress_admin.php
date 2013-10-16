<?php
	if($_POST['convertkit_hidden'] == 'Y') {
		//Form data sent
		$dbhost = $_POST['convertkit_dbhost'];
		update_option('convertkit_dbhost', $dbhost);
		
		$dbname = $_POST['convertkit_dbname'];
		update_option('convertkit_dbname', $dbname);
		
		$dbuser = $_POST['convertkit_dbuser'];
		update_option('convertkit_dbuser', $dbuser);
		
		$dbpwd = $_POST['convertkit_dbpwd'];
		update_option('convertkit_dbpwd', $dbpwd);

		$api_key = $_POST['convertkit_api_key'];
		update_option('convertkit_api_key', $api_key);

		if ($_POST['convertkit_default_form']) {
			$default_form = $_POST['convertkit_default_form'];
			update_option('convertkit_default_form', $default_form);
		}
		?>
		<div class="updated"><p><strong><?php _e('Options saved.' ); ?></strong></p></div>
		<?php
	} else {
		//Normal page display
		$dbhost = get_option('convertkit_dbhost');
		$dbname = get_option('convertkit_dbname');
		$dbuser = get_option('convertkit_dbuser');
		$dbpwd = get_option('convertkit_dbpwd');
		$default_form = get_option('convertkit_default_form');
		$api_key = get_option('convertkit_api_key');
	}
	if (get_option('convertkit_api_key') && get_option('convertkit_api_key') != "") {
		$dataOrig = get_data("https://convertkit.com/app/api/v1/forms.json?api_key=" . get_option('convertkit_api_key'));
		if ($dataOrig->errors["http_request_failed"] == null) {
  		$data = json_decode($dataOrig["body"]);
  		if ($data->error != null) {
  		  echo "<div class=\"updated\"><p><strong>" . $data->error->message . "</strong></p></div>";
  		}
    }
	}
?>

<div class="wrap">
	<form name="convertkit_form" method="post" action="<?php echo str_replace( '%7E', '~', $_SERVER['REQUEST_URI']); ?>">
		<input type="hidden" name="convertkit_hidden" value="Y" />
		<h1>ConvertKit Settings</h1>
		<p>Using your ConvertKit API key you can connect this WordPress blog to ConvertKit. To get the key <a href="https://convertkit.com">sign in to ConvertKit</a> and visit the Account tab.</p>
		
		<p>Then copy and paste the key into the box below.</p>
		<p><strong><?php _e("API Key: " ); ?></strong></p>
				
		<p><input type="text" name="convertkit_api_key" value="<?php echo $api_key; ?>" size="20"></p>
		<?php if($api_key != "" && $api_key && $data->error == null) { ?> 
			<h2>Default Form</h2>
			<p>The default form will be displayed on all your posts. It can be overridden on any individual post or page.</p> 
			<p>You can either set each post to "none" or two a new form specific to that post.</p>
			<p><strong><?php _e("Default Form: "); ?></strong></p>
				<select name="convertkit_default_form">
					<option value="-1">None</option>
					<?php if ($data) {
					  foreach ($data as $lp) { ?>
						<?php if($default_form == $lp->landing_page->id) { ?>
							<option value="<?php print $lp->landing_page->id ?>" selected><?php print $lp->landing_page->name ?></option>
						<?php } else { ?>
							<option value="<?php print $lp->landing_page->id ?>"><?php print $lp->landing_page->name ?></option>
						<?php } ?>
					<?php }
					} ?>
				</select>
		<?php } ?>
		

		<p class="submit">
		<input type="submit" name="Submit" value="<?php _e('Save Settings', 'convertkit_trdom' ) ?>" />
		</p>
	</form>
	
	<p><em>If you have questions or problems please contact <a href="mailto:support@converkit.com">support@convertkit.com</a>.</em></p>
</div>