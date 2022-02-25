<?php include "inc/header.php"; ?>
<?php 
    $pages = $hm->showPage();
    if($pages){
        while($page = $pages->fetch_assoc()){
            if($page['sectionId'] == '1'){
                include "inc/sections/home.php";
            }
            if($page['sectionId'] == '2'){
                include "inc/sections/about.php";
            }
            if($page['sectionId'] == '3'){
                include "inc/sections/services.php";
            }
            if($page['sectionId'] == '4'){
                include "inc/sections/work.php";
            }
            if($page['sectionId'] == '5'){
                include "inc/sections/blog.php";
            }
            if($page['sectionId'] == '6'){
                include "inc/sections/contact.php";
            }
        }
    }else{
        echo "Page or section not found";
    }
?>

<?php include "inc/footer.php"; ?>