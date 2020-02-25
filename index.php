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
            <span>Funcionalidades   88888</span>
        </div>    



        <ul id="nav">
            <li><a href="index.php"> Home</a> </li>
            <li><a href="menu.php"> Menu</a> </li>
            <li><a href="news_letter.php"> NewsLetter</a> </li>
            <li><a href="menu2.php"> Menu2</a> </li>
            <li><a href="news_letter2.php"> Newsletter2</a> </li>


        </ul>



        

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