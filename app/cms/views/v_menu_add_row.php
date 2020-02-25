
<script type="text/javascript" >
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			var val_id_add_entry = "<?php echo $this->getData('block_id'); ?>";
            
			// alert("ola");
            //get tbname
            var val_tbname = "<?php echo $this->getData('block_table'); ?>";
			// alert(val_tbname);

			val_tbname = $('<div />').html( val_tbname ).text();
			// alert(val_tbname); 
            var val_newName = $('#fieldName').val();

            var val_newDescription = $('#fieldDescription').val();
            
            var val_newPrice = $('#fieldPrice').val();
			
			var link = "<?php echo SITE_PATH; ?>app/cms/menu_edit.php";


			
			
		
			$.ajax({
				type: "POST",
				url:link,
				data: {id_add_entry: val_id_add_entry, tbname: val_tbname, newName: val_newName , newDescription: val_newDescription , newPrice: val_newPrice },
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

		<h1>Adicionar prato?&nbsp;</h1>
		<div id="fp_content">
		
			<form action="" method="post" id="edit">
			<div>
				
				<div class="row">
					<label for="field">Block Content:</label>
				</div>
				<div class="row">
					<?php echo $this->getData('cms_field'); ?>
					<!--- <input type="hidden" id="type" value="<?php $this->getData('block_type'); ?>"> -->
				</div>
			
				<div class="row submitrow">
					
					<input type="submit" name="submit" class="submit" value="Submit">
					&nbsp;<a href="" id="fp_cancel">Cancel</a>
				</div>

			</div>
			</form>
		
		</div>
</div>