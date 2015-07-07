<?php

if (!isset($_GET['Section'])){
    $Section = "Accueil";
    
    }else{
        $Section = $_GET['Section'];
        }
        
        
        switch($Section){
            
            CASE "Accueil":{
                include('accueil.php');
                BREAK;
            }
            
            CASE "Services":{
                include('service.php');
                BREAK;
            }
            
            CASE "Liens":{
                include('liens.php');
                BREAK;
            }
            
            CASE "Joindre":{
                include('joindre.php');
                BREAK;
            }
            
            CASE "Media":{
                include('media.php');
                BREAK;
            }
            
            
        }
           
?>
