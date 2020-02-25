<link href="<?php echo APP_RESOURCES; ?>css/fp_style.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">$.noConflict();</script> 

<script type="text/javascript" src="<?php echo APP_RESOURCES; ?>javascript/colorbox/jquery.colorbox-min.js"></script>

<link href="<?php echo APP_RESOURCES; ?>javascript/colorbox/colorbox.css" media="screen" rel="stylesheet" type="text/css" />

<script type="text/javascript">

	jQuery(document).ready(function($) {
		console.log("entrei no colorbox");
		$.colorbox({
			transition: 'fade',
			initialWidth: '50px',
			initialHeight: '50px',
			overlayClose: false,
			escKey: false,
			scrolling: false,
			opacity: .6,
			href: '<?php echo SITE_PATH; ?>app/login.php' ///faz-s no html por causa das variaveis do php
		});
		
	});

</script>