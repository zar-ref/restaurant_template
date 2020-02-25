<!DOCTYPE html>
<html>
<head>
	<title>FlightPath CMS</title>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	
	<link href="<?php echo APP_RESOURCES; ?>css/fp_style.css" media="screen" rel="stylesheet" type="text/css">
	<link rel="stylesheet" href="../../resources/css/style.css">
	<!-- jquery & colorbox -->
	<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
	<script type="text/javascript">$.noConflict();</script>
	
	<!-- tiny_mce -->
	<script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/tiny_mce/tiny_mce.js"></script>
	
	<script type="text/javascript">
	
		jQuery(document).ready(function($) { 
						
			$('#fp_cancel, #fp_close').on('click', function(){
				
				parent.jQuery.colorbox.close();
			});
			
		});
	
	</script>
</head>
<body class="fp_page">