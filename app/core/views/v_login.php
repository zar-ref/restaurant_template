<script type="text/javascript">

    jQuery(document).ready(function($){ 

        $("#login").submit(function(e){
            //qundo for submitdo vai ativar o codigo js que se vai definir
            //disable default browser response --> disable refresh

            e.preventDefault();

            //AJAX 
            //caputrar data e passá-la para ajax dando o url 
            var username = $('input#username').val();
            var password = $('input#password').val();
            // alert(username + ' ' + password);
            //combinar as variaves para passar no ajx

            var dataString = 'username=' + username + '&password=' + password; 

            //chamar ajax --> ajax já vem incluido no jquery
            $.ajax({

				type: "POST", 
				url: "<?php echo SITE_PATH; ?>app/login.php", //url do script que vai processar o form
				data: dataString, //data que vamos passar 
				cache: false, //nao fazezr cache no browser
                success: function(html) { //html e o resultado do nosso script
                   // alert(html);
					$('#cboxLoadedContent').html(html); //cboxloadedContent é a caixa de log in conforme se ve na consola do firefox
				}
			});




		});
		
		$('#fp_cancel,#cboxClose').on('click', function(){
			$.colorbox.close();
		});

    });

</script>




<div id="fp_wrapper">

		<h1>FlightPath CMS</h1>
		<!--Como o view login foi loaded dentro do objeto template logo pode-se usar os métodos desse template através do this 
                            ESTE H1 VAI SER O TITULO DA COLORBOX-->
		<div id="fp_content">
		
			<form action="" method="post" id="login">
			<div>
			
				<?php
					$alerts = $this->getAlerts();
					if ($alerts != '') { echo '<ul class="alerts">' . $alerts . '</ul>'; }
				?>
				
				<div class="row">
					<label for="username">Username: *</label>
					<input type="text" id="username" name="username" value="<?php echo $this->getData('input_user'); ?>" class="<?php echo $this->getData('error_user'); ?>">
				</div>
				<div class="row">
					<label for="password">Password: *</label>
					<input type="password" id="password" name="password" value="<?php echo $this->getData('input_pass'); ?>" class="<?php echo $this->getData('error_pass'); ?>">
				</div>
			
				<div class="row submitrow">
					
					<input type="submit" name="submit" class="submit" value="Log In">
					&nbsp;<a href="#" id="fp_cancel">Cancel</a>
				</div>

			</div>
			</form>
		
		</div>
</div>