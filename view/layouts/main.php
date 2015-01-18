<!DOCTYPE> 

<html>

    <head> 
        <title> MayDay </title> 
        <meta charset="utf-8"/>
        <link rel="stylesheet" media="screen" type="text/css" href="asset/style/main.css"/>
    </head> 

    <body>
        
        <header>   
            <div id="logo_menu"> 
            <div id="logo">
                <img src="asset/image/logo.png">
            </div>
            
            <div id="menu">
                <ul>
                    <li class="bouton"> <a href="#"> Accueil </a> </li>
                    <li class="bouton"> <a href="view/Studio.php"> Studio </a> </li>
                    <li class="bouton"> <a href="#"> Production </a> </li>
                    <li class="bouton"> <a href="#"> Graphisme </a>
                        <ul>  
                            <li class="sous_bouton"><a href="#">Web</a></li>  
                            <li class="sous_bouton"><a href="#">Print</a></li>  
                            <li class="sous_bouton"><a href="#">Id. Visuelle</a></li> 
                        </ul>  
                    </li>
                    <li class="bouton"><a href="#"> Interieur </a> </li>
                    <li class="bouton"><a href="#"> Contact </a> </li>
                    <li class="bouton"><a href="view/store.php"> Store </a> </li>
            </ul>
            </div>
        </header>

        <?php echo $yield ?>
    </body>

</html>