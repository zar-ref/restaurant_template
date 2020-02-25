



<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();
			
			
			var type = $('#type').val();
            //get tbname
            var tbname = "<?php echo $this->getData('block_table'); ?>";
			tbname = $('<div />').html( tbname ).text();
            //get table column
            var tbcol = "<?php echo $this->getData('table_column'); ?>";
			
			
			
			var content = $('#field').val();
			//alert("content = " + content); // --> usa-se o escape para dar enable nos diferentes caracteres especiais
			var dataString =  'field=' + encodeURIComponent(content) + '&type=' + type + '&tbname=' + encodeURIComponent(tbname)  + '&tbcol=' + tbcol ; //string   que vai ser pssada para o menu_edit.php para se obter a partir do $_POST
			// alert(dataString);
			$.ajax({
				type: "POST",
				url: "<?php echo SITE_PATH; ?>app/cms/upload.php",
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

		<h1>Edit Content <?php echo $this->getData('block_table'); ?> </h1>
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