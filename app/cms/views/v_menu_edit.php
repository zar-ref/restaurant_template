



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			var val_id = "<?php echo $this->getData('block_id'); ?>";
			var val_type = $('#type').val();
            //get tbname
            var val_tbname = "<?php echo $this->getData('block_table'); ?>";
			val_tbname = $('<div />').html( val_tbname ).text();
            //get table column
            var val_tbcol = "<?php echo $this->getData('table_column'); ?>";
			
			
			
			var val_content = $('#field').val();
			// alert("tbname = " + val_tbname); // --> usa-se o escape para dar enable nos diferentes caracteres especiais
			

			var link = "<?php echo SITE_PATH; ?>app/cms/menu_edit.php";


			

			$.ajax({
				type: "POST",
				url:link,
				data:{id: val_id , field: val_content , type: val_type , tbname: val_tbname, tbcol: val_tbcol },
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

		<h1>Editar prato </h1>
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