
<?php
include(APP_PATH . "core/templates/t_head.php");
include(APP_PATH . "core/templates/t_login.php");

?>


<script type="text/javascript">

    jQuery.colorbox.resize();

    console.log("antes de fechar");
	jQuery.colorbox.close();
    console.log("fechei a colorbox");
	var page = window.location.href;
	page = page.substring(0, page.lastIndexOf('?'));
	window.location = page;
    window.location.reload();

</script>

<div id="fp_wrapper">

    <h1>Log In</h1>

    <div class="fp_content">
        Login...
    </div>

</div>