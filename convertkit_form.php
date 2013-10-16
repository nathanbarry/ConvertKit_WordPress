<?php
	function generateFormHTML($data, $form_id) {
	  if ($data->subscription_form->image->url && $data->subscription_form->image->url != "/images/standard/missing.png" && $data->subscription_form->image->url != "") {
	    $img_string = '<img alt="" src="' . $data->subscription_form->image->url . '" />';
    } else {
      $img_string = '';
    }
		$returnMsgPart1 = '<div class="ck_embed_form ck_horizontal_subscription_form">
	              	 <div class="ck_embed_form_content">
	  	<h3 class="ck_embed_form_title">' . $data->subscription_form->title . '</h3>
	  	<div class="ck_embed_description"><span class="ck_image">' . $img_string . '</span>' . $data->subscription_form->description . '</div>
	</div>  	
	    <p id="ck_success_msg" style="display: none; opacity: 0;">' . $data->subscription_form->success_message . '</p>
	  	<!--  Form starts here	-->
	  	<form id="ck_subscribe_form" class="ck_subscribe_form" action="https://convertkit.com/app/landing_pages/' . $form_id . '/subscribeFromId">
	  	  <input type="hidden" name="id" value="' . $form_id . '" id="landing_page_id"></input>
	  	  <p class="ck_errorArea"></p>
	  		<div class="ck_control_group">
	  			<label class="ck_label" for="ck_firstNameField">First Name</label>
	  			<input type="text" name="first_name" class="ck_first_name" id="ck_firstNameField"></input>
	  		</div>	
	  		<div class="control_group fields">
	  			<label class="ck_label" for="ck_emailField">Email Address</label>
	          <input type="text" name="email" class="ck_email_address" id="ck_emailField"></input>
	  		</div>';
	  	if ($data->subscription_form->landing_page->course) {
			$returnMsgPart2 = '<label class="ck_checkbox"><input class="optIn ck_course_opted" type="checkbox" id="optIn" checked />' . $data->subscription_form->course_opt_in_prompt . '</label>';
		} else {
			$returnMsgPart2 = "<label class=\"ck_checkbox\" style=\"display:none;\"><input class=\"optIn ck_course_opted\" type=\"checkbox\" id=\"optIn\" /></label>";
		}
		$returnMsgPart3 = '<button class="subscribe_button ck_subscribe_button btn fields">' . $data->subscription_form->sign_up_button_text . '</button>
			<span class="ck_guarantee">We won\'t send you spam. Unsubscribe at any time.</span>
	  	</form>
	  </div>
	  <script src="https://convertkit.com/app/assets/CKJS.js"></script>
	  <script src="https://convertkit.com/app/assets/CKJS_UI.js"></script>
	<style type="text/css">
.ck_embed_form {
	overflow: hidden;
	font-family: \'Helvetica Neue\', Helvetica, Arial, Verdana, sans-serif;
	font-size: 14px;
	border: 1px solid #d8d8d8; /* stroke */
	background-color: #f6f4f5; /* layer fill content */
	-moz-box-shadow: 0 1px 5px rgba(0,0,0,.1), inset 0 1px 0 rgba(255,255,255,1); /* drop shadow and inner shadow */
	-webkit-box-shadow: 0 1px 5px rgba(0,0,0,.1), inset 0 1px 0 rgba(255,255,255,1); /* drop shadow and inner shadow */
	box-shadow: 0 1px 5px rgba(0,0,0,.1), inset 0 1px 0 rgba(255,255,255,1); /* drop shadow and inner shadow */
	color: #383838;
}	

.ck_horizontal_subscription_form {
	width: 598px;
}	


.ck_vertical_subscription_form {
	width: 348px;
}	

.ck_embed_form_content {
	padding: 30px;	
	background: #f8f8f8;
}

.ck_horizontal_subscription_form .ck_embed_form_content {
	float: left;
	width: 240px;
	border-right: 1px solid #e4e4e4;
}

.ck_vertical_subscription_form .ck_embed_form_content {
	border-bottom: 1px solid #e4e4e4;
	-webkit-box-shadow: 0 1px 0 rgba(255,255,255,1);
	-moz-box-shadow: 0 1px 0 rgba(255,255,255,1);
	box-shadow: 0 1px 0 rgba(255,255,255,1);
}


.ck_subscribe_form {
	padding: 25px 30px 30px;
}
	
.ck_horizontal_subscription_form .ck_subscribe_form {
	float: right;
	width: 235px;
}

.ck_embed_form .ck_embed_form_title {
		color: #222;
		margin-top: 0px;
		padding: 0px;
		font-weight: 400;
		font-size: 24px;
		
	}
	
.ck_embed_form .ck_image {
		text-align: center;
		float: left;
		margin: 0px 10px 5px 0px;
	}
	
.ck_embed_form .ck_embed_description {
	}

.ck_subscribe_form {
	
}

.ck_horizontal_subscription_form input[type="text"] {
	margin-bottom: 10px;
}	

.ck_embed_form input[type="text"], .ck_embed_form input[type="email"] {
	font-size: 14px;
	padding: 10px 8px;
	width: 220px;
	border: 1px solid #dfdfdf; /* stroke */
	-moz-border-radius: 4px;
	-webkit-border-radius: 4px;
	border-radius: 4px; /* border radius */
	-moz-background-clip: padding;
	-webkit-background-clip: padding-box;
	background-clip: padding-box; /* prevents bg color from leaking outside the border */
	background-color: #fff; /* layer fill content */
	-moz-box-shadow: inset 0 1px 3px rgba(0,0,0,.11); /* inner shadow */
	-webkit-box-shadow: inset 0 1px 3px rgba(0,0,0,.11); /* inner shadow */
	box-shadow: inset 0 1px 3px rgba(0,0,0,.11); /* inner shadow */
	
}	

.ck_embed_form input[type="text"]:focus, .ck_embed_form input[type="email"]:focus {
	outline: none;
	border-color: #aaa;
}	

.ck_label {
		font-weight: bold;
		display: block;
		font-size: 12px;
		color: #565656;
		text-transform: uppercase;
		}
		
		
/* Vertical Styles */

.ck_vertical_subscription_form .ck_subscribe_form {
	clear: both;
	padding-top: 20px;
	}	
				
.ck_vertical_subscription_form .ck_label {
	font-weight: bold;
	display: block;
	width: 100px;
	float: left;
	text-align: right;
	height: 42px;
	line-height: 42px;
	}
				
.ck_vertical_subscription_form input[type="text"], .ck_vertical_subscription_form input[type="email"] {
	width: 160px;
	float: right;
	}	

.ck_checkbox {
	padding: 10px 0px 10px 20px;
	display: block;
	clear: both;
}

.ck_checkbox input.optIn {
	margin-left:  -20px;
}
	
.ck_embed_form .ck_subscribe_button {
		width: 100%;
		color: #fff;
		text-shadow: 0 -1px 0 rgba(0,0,0,.43);
		margin: 0px 0px 0px;
		padding:  10px 5px;
		font-size: 18px;
		border: 1px solid #0d6db7; /* stroke */
		-moz-border-radius: 4px;
		-webkit-border-radius: 4px;
		border-radius: 4px; /* border radius */
		-moz-background-clip: padding;
		-webkit-background-clip: padding-box;
		background-clip: padding-box; /* prevents bg color from leaking outside the border */
		background-color: #0d6db8; /* layer fill content */
		-moz-box-shadow: inset 0 1px 0 rgba(255,255,255,.33); /* inner shadow */
		-webkit-box-shadow: inset 0 1px 0 rgba(255,255,255,.33); /* inner shadow */
		box-shadow: inset 0 1px 0 rgba(255,255,255,.33); /* inner shadow */
		background-image: url(data:image/svg+xml;base64,PD94bWwgdmVyc2lvbj0iMS4wIiA/Pgo8c3ZnIHhtbG5zPSJodHRwOi8vd3d3LnczLm9yZy8yMDAwL3N2ZyIgd2lkdGg9IjEwMCUiIGhlaWdodD0iMTAwJSIgdmlld0JveD0iMCAwIDEwMCAxMDAiIHByZXNlcnZlQXNwZWN0UmF0aW89Im5vbmUiPjxsaW5lYXJHcmFkaWVudCBpZD0iaGF0MCIgZ3JhZGllbnRVbml0cz0ib2JqZWN0Qm91bmRpbmdCb3giIHgxPSI1MCUiIHkxPSIxMDAlIiB4Mj0iNTAlIiB5Mj0iLTEuNDIxMDg1NDcxNTIwMmUtMTQlIj4KPHN0b3Agb2Zmc2V0PSIwJSIgc3RvcC1jb2xvcj0iIzAwMCIgc3RvcC1vcGFjaXR5PSIwLjEiLz4KPHN0b3Agb2Zmc2V0PSIxMDAlIiBzdG9wLWNvbG9yPSIjZmZmIiBzdG9wLW9wYWNpdHk9IjAuMSIvPgogICA8L2xpbmVhckdyYWRpZW50PgoKPHJlY3QgeD0iMCIgeT0iMCIgd2lkdGg9IjEwMCIgaGVpZ2h0PSIxMDAiIGZpbGw9InVybCgjaGF0MCkiIC8+Cjwvc3ZnPg==); /* gradient overlay */
		background-image: -moz-linear-gradient(bottom, rgba(0,0,0,.1) 0%, rgba(255,255,255,.1) 100%); /* gradient overlay */
		background-image: -o-linear-gradient(bottom, rgba(0,0,0,.1) 0%, rgba(255,255,255,.1) 100%); /* gradient overlay */
		background-image: -webkit-linear-gradient(bottom, rgba(0,0,0,.1) 0%, rgba(255,255,255,.1) 100%); /* gradient overlay */
		background-image: linear-gradient(bottom, rgba(0,0,0,.1) 0%, rgba(255,255,255,.1) 100%); /* gradient overlay */
		cursor: pointer;
	}
	
.ck_embed_form .ck_guarantee {
		color: #777;
		font-size: 10px;
		clear: left;
		display: block;
		padding: 15px 0px 0px;
		text-align: center;
	}

	</style>';
		
		$returnMsg = $returnMsgPart1 . $returnMsgPart2 . $returnMsgPart3;
	 	return $returnMsg;
	}
?>