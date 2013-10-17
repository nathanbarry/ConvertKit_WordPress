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
  get_header(); ?>
    <center>
      <h1><?php echo $data->title ?></h1>
      <p><?php echo $data->subtitle ?></p>
      <br>
      <h1><?php echo $data->heading ?></h1>
      <h3><?php echo $data->subheading ?></h2>
      <p><?php echo $data->content ?></p>
      <?php echo convertkit_form(get_post_meta($post->ID, "_convertkit_convertkit_form", true)); ?>
      <br>
      <br>
    </center>
    <style type="text/css">
    .ck_embed_form {
    	overflow: hidden;
    	font-family: 'Helvetica Neue', Helvetica, Arial, Verdana, sans-serif;
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
    	background: #f6f4f5 url('https://convertkit.com/assets/embed_divider.gif') repeat-y -50px 0px;
    }	


    .ck_vertical_subscription_form {
    	width: 348px;
    }	

    .ck_embed_form_content {
    	padding: 30px;	
    }

    .ck_horizontal_subscription_form .ck_embed_form_content {
    	float: left;
    	width: 240px;
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

    .ck_embed_form .ck_image img {
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

    #ck_success_msg {
      padding: 1em;
      margin-left: 50%;
    }



    </style>
    <script src="https://convertkit.com/assets/CKJS4.js"></script>
<?php get_footer();
} ?>