<?PHP
//INCLUDES
Include("class_html.php");
include("mysql_class.php");
Include("func.php");
$MainOutput = New HTML();
?>
<html lang="en-US" xmlns="http://www.w3.org/1999/xhtml" dir="ltr">
<head>
	<title>Sauveteurs</title>
	<meta http-equiv="Content-type" content="text/html; charset=utf-8" />
	<link rel="shortcut icon" href="css/images/favicon.ico" />
	<link rel="stylesheet" href="css/style.css" type="text/css" media="all" />
	<!--[if IE 6]>
		<link rel="stylesheet" href="css/ie6.css" type="text/css" media="all" />
	<![endif]-->
	<script type="text/javascript" src="js/jquery-1.5.min.js"></script>
	<script type="text/javascript" src="js/jquery-func.js"></script>
</head>
<body>
<!-- Shell -->
<div class="shell">
    <!-- Header -->
    <div id="header">
        <h1 id="logo"><a class="notext" href="#">Sauveteurs</a></h1>
        <div class="intro">
            <img src="css/images/intro-image.jpg" alt="image" />
        </div>
        <div class="cl">&nbsp;</div>
        <!-- Navigation -->
        <div id="navigation">
            <ul>
                <?PHP
                $Active = "class=\"active\"";
                $Accueil="";
                $Services="";
                $Media="";
                $Liens="";
                $Joindre="";
                
                if(!isset($_GET['Section']) or $_GET['Section']=="Accueil") 
                    $Accueil = $Active;
                else{
                    if($_GET['Section']=="Services")
                        $Services = $Active;
                    if($_GET['Section']=="Liens")
                        $Liens = $Active;
                    if($_GET['Section']=="Media")
                        $Media = $Active;
                    if($_GET['Section']=="Joindre")
                        $Joindre = $Active;
                }
                
                ?>
                <li><a <?PHP echo $Accueil ?> href="index.php">ACCUEIL</a></li>
                
                <li><a <?PHP echo $Services ?>  href="index.php?Section=Services">SERVICES</a></li>
                <li><a <?PHP echo $Liens ?>  href="index.php?Section=Liens">LIENS</a></li>
                <li><a <?PHP echo $Media ?>  href="index.php?Section=Media">MÉDIAS</a></li>
                <li><a <?PHP echo $Joindre ?>  href="index.php?Section=Joindre">NOUS JOINDRE</a></li>
                <li><a href="/SDSDB/client/" Target="_BLANK">CLIENTS</a></li>
                
                <li class="last"><a href="/SDSDB/" TArget="_BLANK">SAUVETEURS</a></li>
                
            </ul>
            <div class="cl">&nbsp;</div>
        </div>
        <!-- end Navigation -->
    </div>
    <!-- end Header -->
    <!-- Main -->
      <div id="main">
        <!--<div class="attention">
            <p>ATTENTION!!! Le début de la session d'été commence! Assurez-vous de nous <a href="http://www.quebecnatation.com/index.php?Section=CV" target="_BLANK" style="link">envoyer votre CV!</a></p>
        </div> -->
        <!-- Sidebar -->
        <div id="sidebar">
            <!-- Sidebar-box -->
     
            <!-- end Sidebar-box -->
            <!-- Sidebar-box -->
            <div class="sidebar-box">
                <div class="title">
                    <h3>Dernières Nouvelles</h3>
                </div>
                <div class="box-entry">
                    <ul class="news-entry">
                        <li class="last">
                            <p><?php echo getlastnews() ?></p>
                        </li>

                    </ul>        
                </div>    
                <p class="last"><a href="#">Toutes les nouvelles</a></p>
            </div>
            <!-- end Sidebar-box -->    
           
        </div>
        <!-- end Sidebar -->
        <!-- Content -->
     <? include ('section.php'); ?>
        <!-- Content -->
        <div class="cl">&nbsp;</div>
    </div>

    
    <!-- end Main -->
    
</div>
<!-- end Shell -->
<!-- Footer -->
    <div id="footer">
        <div class="shell">
            <p>Service de Sauveteurs inc. &copy; 2011 </p>
        </div>
    </div>
    <!-- end Footer -->
</body>
</html>