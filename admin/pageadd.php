<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Home.php");
    $hm = new Home();
?>
<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){

    $addPage = $hm->addPage($_POST);
}
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Add New Page</h2>
                <?php 
                    if(isset($addPage)){
                        echo $addPage;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="pageTitle" placeholder="Enter Page Name..." class="medium" />
                            </td>
                        </tr>				
                        <tr>
                            <td>
                            <select name="sectionId" id="">
                                    <option value="">Select One</option>
                                    <option value="1">Home</option>
                                    <option value="2">About</option>
                                    <option value="3">Services</option>
                                    <option value="4">Work</option>
                                    <option value="5">Blog</option>
                                    <option value="6">Contact</option>
                            </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="submit" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
            </div>
        </div>
<?php include 'inc/footer.php';?>