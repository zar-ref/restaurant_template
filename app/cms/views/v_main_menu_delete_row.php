
<script type="text/javascript">
	jQuery(document).ready(function($){
		
		$('#edit').submit(function(e){
			e.preventDefault();

			var val_id_ready_to_delete = "<?php echo $this->getData('id_to_delete'); ?>";
            var val_tbname = "<?php echo $this->getData('tbname'); ?>";
			val_tbname = $('<div />').html( val_tbname ).text();
			var val_tbcode = "<?php echo $this->getData('tbcode'); ?>";
			
		   
			//var dataString = 'menu_id_ready_to_delete=' + id_ready_to_delete  +  '&tbname=' + encodeURIComponent(tbname);//string   que vai ser pssada para o menu_edit.php para se obter a partir do $_POST
			
			var link = "<?php echo SITE_PATH; ?>app/cms/menu_edit.php";


		
			$.ajax({
				type: "POST",
				url:link,
				data:  {menu_id_ready_to_delete: val_id_ready_to_delete , tbname: val_tbname , tbcode: val_tbcode },
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

		<h1>Deseja apagar <?php echo $this->getData('tbname');?> e todos os dados desse tipo de prato?&nbsp;&nbsp;    </i></h1>
		<div id="fp_content">
		
			<form action="" method="post" id="edit">
		
			
				<div class="row submitrow">
					
					<input type="submit" name="submit" class="submit" value="Submit">
					&nbsp;<a href="" id="fp_cancel">Cancel</a>
				</div>

		
			</form>
		
		</div>
</div>