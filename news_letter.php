<!--PAGINA DE MENU-->


<?php include("app/init.php"); ?>



<!DOCTYPE html>
<html >
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="stylesheet" href="resources/css/style.css">
    <title>test</title>

    <?php $FP->head();?>
</head>
<body class="home <?php $FP->body_class();?>">

    <?php $FP->toolbar2();?>    

    <div id="wrapper">

        <h1>Website</h1>

        <div id="banner">
            <span>Funcionalidades</span>
        </div>    


        <ul id="nav">
            <li><a href="index.php"> Home</a> </li>
            <li><a href="menu.php"> Menu</a> </li>
            <li><a href="news_letter.php"> NewsLetter</a> </li>
            <li><a href="menu2.php"> Menu2</a> </li>
            <li><a href="news_letter2.php"> Newsletter2</a> </li>


        </ul>


        <div class="newsletter">
            <form  id="form" method="POST" class="form">

                <div class="form__heading">
                    <h2 class="heading-secondary">
                        Receba Novidades e Descontos no seu Email!
                    </h2>
                </div>

                <div class="form__group">
                    <input type="text" name="nome" class="form__input" placeholder="Nome Completo" id="name" required>
                    <label for="name" class="form__label">Nome Completo</label>
                </div>

                <div class="form__group">
                    <input type="email"  name="email" class="form__input" placeholder="Email" id="email" required>
                    <label for="email" class="form__label">Email</label>
                </div>

                

                <div class="form__group">
                    <input type="submit" name="submit" value="Enviar" class="form__btn form__btn--primary" id="submit">
                </div>
            </form> 
        </div>

        <div id="footer">
        &copy; <script type="text/javascript">
                var today = new Date();
                var yyyy = today.getFullYear();
                today = yyyy;
                document.write(today);
            </script> Test Website |  <?php $FP->login_link(); ?>
        </div>
    </div>



 
    


    
</body>
<script type="text/javascript" src="https://code.jquery.com/jquery-3.4.1.js"></script>
<script type="text/javascript">$.noConflict();</script> 


<script type="text/javascript" >
    
    
    jQuery(document).ready(function($) {
		console.log("ola");


		$('#form').submit(function(e){
			e.preventDefault();

            var valNome = $("#name").val();
            var valEmail = $("#email").val();
			
			
			var link = '<?php echo SITE_PATH; ?>app/cms/client.php';
            
            
            $.post(link,
                {nome: valNome , email: valEmail},
                function(response){                   
                    alert(response);
                    $("#name").val("");
                    $("#email").val("");
                }
            );
            
		});
		
		
		
	});
    
</script>
 
</html>