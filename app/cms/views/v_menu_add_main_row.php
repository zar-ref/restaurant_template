
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			var valId_add_entry = "<?php echo $this->getData('block_id'); ?>";
            
			
            //get tbname
            var valTbname = "<?php echo $this->getData('block_table'); ?>";
			
            var valNewMenuType = $('#fieldMenuType').val();
			///alert(valNewMenuType);


			var link = "<?php echo SITE_PATH; ?>app/cms/menu_edit.php";


			$.ajax({
				type: "POST",
				url:link,
				data: {id_add_entry: valId_add_entry , tbname: valTbname , newMenuType: valNewMenuType },
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

		<h1>Adicionar tipo de prato? &nbsp;</h1>
		<div id="fp_content">
		
			<form action="" method="post" id="edit">
			<div>
				
				<div class="row">
					<label for="field">Block Content:</label>
				</div>
				<div class="row">
					<?php echo $this->getData('cms_field'); ?>
					
				</div>
			
				<div class="row submitrow">
					
					<input type="submit" name="submit" class="submit" value="Submit">
					&nbsp;<a href="" id="fp_cancel">Cancel</a>
				</div>

			</div>
			</form>
		
		</div>
</div>