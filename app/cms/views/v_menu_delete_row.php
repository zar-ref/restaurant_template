
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			var id_ready_to_delete = "<?php echo $this->getData('id_to_delete'); ?>";
            var tbname = "<?php echo $this->getData('tbname'); ?>";
			tbname = $('<div />').html( tbname ).text();
			
		   
			var dataString = 'id_ready_to_delete=' + id_ready_to_delete  +  '&tbname=' + encodeURIComponent(tbname);//string   que vai ser pssada para o menu_edit.php para se obter a partir do $_POST
			
			$.ajax({
				type: "POST",
				url: "<?php echo SITE_PATH; ?>app/cms/menu_edit.php",
				data: dataString,
				cache: false,
				success: function(html) {
					$('#cboxLoadedContent').html(html);
				}
			});
		});
		
		$('#fp_cancel,#cboxClose').on('click', function(){
			
			if (tinyMCE.getInstanceById('field'))
			{
			    tinyMCE.execCommand('mceFocus', false, 'field');                    
			    tinyMCE.execCommand('mceRemoveControl', false, 'field');

			}

			$.colorbox.close();
		});
		
	});
</script>



<div id="fp_wrapper">

		<h1>Deseja apagar <?php echo $this->getData('name_to_delete');?>? <span>&nbsp;</span> </h1>
		<div id="fp_content">
		
			<form action="" method="post" id="edit">
		
			
				<div class="row submitrow">
					
					<input type="submit" name="submit" class="submit" value="Submit">
					&nbsp;<a href="" id="fp_cancel">Cancel</a>
				</div>

		
			</form>
		
		</div>
</div>