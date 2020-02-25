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

    <?php $FP->toolbar();?>    

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

            <!--
            <h2 class="menu__sub-title">Carnes</h2>
            <div class="menu__items">
                <div class="menu__items__add-row">add entry</div>
                <div class="menu__items__row">
                    <div class="menu__items__row--name">bife</div>
                    <div class="menu__items__row--description">bife com molho</div>
                    <div class="menu__items__row--price">10</div>
                
                </div>
           </div>
--->
        <div class="menu">
              
            


           
            <?php 
            $FP->Menu->fetch_prato_do_dia();
            $FP->Menu->fetch_prato_do_dia2();
            $FP->Menu->fetchMenu();
            $FP->Menu->fetchMenu2();
             ?> 
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
<script  type="text/javascript"> 
    jQuery(document).ready(function($) {

        $('.menuList').each(function() {
			
			
			$(this).click(function(){
				console.log("olaaa inside");
				$(this).find('.menuList__header').slideToggle();
				$(this).find('.menuList__content').each(function(){
					$(this).slideToggle();
				});
			});			
		});

    });

</script>
</html>