<?php
  header("Cache-Control: no-cache, must-revalidate");
  header("Pragma: no-cache"); 
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  header("Cache-Control: max-age=2592000");
?>
<?php
    // include "lib/Session.php";
    // Session::init();
    include "lib/Database.php";
    include "helpers/Format.php";

	spl_autoload_register(function($classes){
		include "classes/".$classes.".php";
	});

	$db = new Database();
	$fm = new Format();
	$hm = new Home();

?>

<?php 
    $filepath = realpath(basename(__FILE__));
    
?>
<!DOCTYPE html>

<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bonativo Free HTML5 Responsive Template | Template Stock</title>

    <!-- Bootstrap -->
    <link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet" type="text/css">
    <link href="css/flexslider.css" rel="stylesheet" type="text/css">
    <link href="icons/css/ionicons.min.css" rel="stylesheet" type="text/css">
    <link href="icons/css/simple-line-icons.css" rel="stylesheet" type="text/css">

    <!--revolution slider setting css-->
    <link href="rs-plugin/css/settings.css" rel="stylesheet">
    <link href="css/prettyPhoto.css" rel="stylesheet" type="text/css" />
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="80">


    <!-- Static navbar -->
    <nav class="navbar navbar-default navbar-fixed-top before-color">
        <div class="container">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
                    aria-controls="navbar">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand alo" href="index.php">Bonativo</a>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right scroll-to">
                    <?php 
                    $pages = $hm->showPage();
                    if($pages){
                        while($page = $pages->fetch_assoc()){
                            ?>
                                <li class="active"><a href="#<?php echo $page['pageSlug'];  ?>"><?php echo $page['pageTitle'];  ?></a></li>
                            <?php
                        }
                    }
                    ?>
                </ul>
            </div>
            <!--/.nav-collapse -->
        </div>
        <!--/.container-fluid -->
    </nav>