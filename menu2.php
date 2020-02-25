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

          

        <div class="menu2">
            <h2 class="menu2__heading">Carregue no link em baixo para fazer download da ementa!</h2>

            <div class="menu2__download">
                <a class="menu2__download__link" href="<?php echo SITE_PATH; ?>resources/images/banner.jpg" download="Ementa">
                        Download
                </a>
            </div>
            


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

</html>