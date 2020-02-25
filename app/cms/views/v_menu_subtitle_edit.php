<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			var val_id = "<?php echo $this->getData('block_id'); ?>";
			
            var tbname = "<?php echo $this->getData('block_table'); ?>";
			// alert("tbname antes da alteração " + tbname);
			tbname = $('<div />').html( tbname ).text();
            // alert("tbname = " + tbname);
			
			
			
			var val_content = $('#field').val();
			// alert("content = " + val_content); 
            // --> usa-se o escape para dar enable nos diferentes caracteres especiais

			var link = "<?php echo SITE_PATH; ?>app/cms/menu_edit.php";



			$.ajax({
				type: "POST",
				url:link,
				data:{menu_id_to_change: val_id , content: val_content },
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

		<h1>Editar nome de prato &nbsp;</h1>
		<div id="fp_content">
		
			<form action="" method="post" id="edit">
			<div>
				
				<div class="row">
					<label for="field">Block Content:</label>
				</div>
				<div class="row">
					<?php echo $this->getData('cms_field'); ?>
					<input type="hidden" id="type" value="<?php $this->getData('block_type'); ?>">
				</div>
			
				<div class="row submitrow">
					
					<input type="submit" name="submit" class="submit" value="Submit">
					&nbsp;<a href="" id="fp_cancel">Cancel</a>
				</div>

			</div>
			</form>
		
		</div>
</div>