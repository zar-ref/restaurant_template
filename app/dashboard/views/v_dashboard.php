<?php 
	$this->load(APP_PATH . 'core/templates/t_page_head.php'); 
?>

<div id="fp_wrapper" class="fp_page">

		<h1> Definições &nbsp;</h1>
		<div id="fp_content">
		
			<div class="fp_left">
				
				<?php $this->cms_nav(); ?>
				
			</div>
			<div class="fp_right">
				<h2>Painel de Controlo</h2>
			
				<p>Bem vindo ao painel de controlo. Escolha das opções à esquerda</p>
			</div>
		
		</div>
</div>

<?php
	$this->load(APP_PATH . 'core/templates/t_page_foot.php'); 
?>