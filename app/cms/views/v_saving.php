
<?php
include(APP_PATH . "core/templates/t_head.php");
include(APP_PATH . "core/templates/t_login.php");

?>


<script type="text/javascript">

    jQuery.colorbox.resize();


	jQuery.colorbox.close();


	window.location.reload();

</script>

<div id="fp_wrapper">

   
		<h1>Edit Content Block: <i><?php echo $this->getData('block_id'); ?></i></h1>

    <div class="fp_content">
        Saving...
    </div>

</div>