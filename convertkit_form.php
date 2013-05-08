<?php
	function generateFormHTML($data, $form_id) {
	  if ($data->subscription_form->image->url && $data->subscription_form->image->url != "/images/standard/missing.png" && $data->subscription_form->image->url != "") {
	    $img_string = '<img alt="Dismissrr_(20130110)" src="' . $data->subscription_form->image->url . '" />';
    } else {
      $img_string = '';
    }
		$returnMsgPart1 = '<div class="ck_subscription_form ck_horizontal_subscription_form">
	              	 <div class="ck_subscription_form_content">
	  	<h3 class="ck_subscription_form_title">' . $data->subscription_form->title . '</h3>
	  	<span class="ck_image">' . $img_string . '</span>
	  	<div class="ck_subscription_description">' . $data->subscription_form->description . '</div>
	</div>  	
	    <p id="ck_success_msg" style="display: none; opacity: 0;">' . $data->subscription_form->success_message . '</p>
	  	<!--  Form starts here	-->
	  	<form id="ck_subscribe_form" class="ck_subscribeForm" action="https://convertkit.com/app/landing_pages/' . $form_id . '/subscribeFromId">
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
	  	</form>
	  	<span class="ck_guarantee">We won\'t send you spam. Unsubscribe at any time.</span>
	  </div>
	  <script src="https://convertkit.com/app/assets/CKJS.js"></script>
	  <script src="https://convertkit.com/app/assets/CKJS_UI.js"></script>
	<style type="text/css">
	.ck_subscription_form {
		background: #fff;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		border: 1px solid #dbdbdb;
		overflow: hidden;
	}	

	.ck_horizontal_subscription_form {
		width: 560px;
		padding: 20px 20px 20px;
	}	


	.ck_vertical_subscription_form {
		width: 320px;
		padding: 30px 40px 40px;
	}	

	.ck_horizontal_subscription_form .ck_subscription_form_content {
		float: left;
		width: 310px;
		margin-right: 10px;
	}
		
	.ck_horizontal_subscription_form .ck_subscribeForm {
		float: right;
		width: 240px;
	}

	.ck_subscription_form .ck_subscription_form_title {
			color: #222;
			margin-top: 0px;
			padding: 0px;
			font-weight: 400;
			font-size: 22px;
		}
		
	.ck_subscription_form .ck_image {
			width: 150px;
			text-align: center;
			float: left;
		}
		
	.ck_subscription_form .ck_subscription_description {
			float: left;
			margin-left: 10px;
			width: 150px;
		}
		
	.ck_subscription_form input[type="text"], .ck_subscription_form input[type="text"] {
		font-size: 14px;
		border: 1px solid #ddd;
		-webkit-border-radius: 5px;
		-moz-border-radius: 5px;
		border-radius: 5px;
		padding:  5px;
		width: 240px;
	}	

	.ck_subscription_form input[type="text"]:focus, .ck_subscription_form input[type="text"]:focus {
		outline: none;
		border-color: #aaa;
	}	

	/* Horizontal Styles */	
	.ck_horizontal_subscription_form .ck_label {
			font-weight: bold;
			display: block;
			}
			
	.ck_subscription_form .ck_form-horizontal.ck_controls {
				margin-left: 110px;
			}
			
	/* Vertical Styles */

	.ck_vertical_subscription_form #ck_subscribe_form {
		clear: both;
		padding-top: 20px;
		}	
					
	.ck_vertical_subscription_form .ck_label {
		font-weight: bold;
		display: block;
		width:  100px;
		float: left;
		text-align: right;
		height: 32px;
		line-height: 32px;
		}
					
	.ck_vertical_subscription_form input[type="text"], .ck_vertical_subscription_form input[type="text"] {
		width: 200px;
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
		
	.ck_subscription_form .ck_subscribe_button {
			width: 100%;
			margin: 0px 0px 0px;
			padding-top: 15px;
			padding-bottom: 15px;
			font-size: 18px;
		}
		
	.ck_subscription_form .ck_guarantee {
			color: #777;
			font-size: 13px;
			clear: left;
			display: block;
		}
	</style>';
		
		$returnMsg = $returnMsgPart1 . $returnMsgPart2 . $returnMsgPart3;
	 	return $returnMsg;
	}
?>