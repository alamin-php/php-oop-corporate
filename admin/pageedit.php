<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Home.php");
    $hm = new Home();
?>
<?php 
    if(!isset($_GET['pageId']) || $_GET['pageId'] == NULL){
        echo "<script>window.location='pagelist.php'</script>";
    }else{
        $pageId = $_GET['pageId'];
    }

?>
<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST['update']))
    $updatePage = $hm->updatePage($_POST, $pageId);
}
?>

<?php
if($_SERVER["REQUEST_METHOD"] === "POST"){
    if(isset($_POST['slider']))
    $addSlider = $hm->addSlider($_POST, $_FILES);
}
?>
<?php 
    $page = $hm->pageById($pageId);
    if($page){?>
    <div class="grid_10">
            <div class="box round first grid">
                
                <h2>Edit <?php echo $page['pageTitle'] ?> Page</h2>
                <?php 
                    if(isset($updatePage)){
                        echo $updatePage;
                    } 
                    if(isset($addSlider)){
                        echo $addSlider;
                    }
                ?>
               <div class="block copyblock"> 
                 <form action="" method="post">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="pageTitle" value="<?php echo $page['pageTitle'] ?>" class="medium" />
                            </td>
                        </tr>				
                        <tr>
                            <td>
                            <select name="sectionId" id="">
                                    <option value="">Select One</option>
                                    <option value="1" <?php if($page['sectionId'] == '1'){echo "selected";} ?>>Home Section</option>
                                    <option value="2" <?php if($page['sectionId'] == '2'){echo "selected";} ?>>About Section</option>
                                    <option value="3" <?php if($page['sectionId'] == '3'){echo "selected";} ?>>Services Section</option>
                                    <option value="4" <?php if($page['sectionId'] == '4'){echo "selected";} ?>>Work Section</option>
                                    <option value="5" <?php if($page['sectionId'] == '5'){echo "selected";} ?>>Blog Section</option>
                                    <option value="6" <?php if($page['sectionId'] == '6'){echo "selected";} ?>>Contact Section</option>
                            </select>
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="update" Value="Update" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
<?php 
    if($page['sectionId'] == '1') {?>
                <div class="block copyblock">
                    <h3>Add New Slider</h3>
                    <hr>
                 <form action="" method="post" enctype="multipart/form-data">
                    <table class="form">					
                        <tr>
                            <td>
                                <input type="text" name="sliderTitle" placeholder="Enter slider title" class="large" />
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <input type="text" name="sliderSubTitle" placeholder="Enter slider sub title" class="large" />
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <input type="text" name="btnTitle" placeholder="Enter slider button title" class="large" />
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <input type="text" name="btnLink" placeholder="Enter slider button link" class="large" />
                            </td>
                        </tr>					
                        <tr>
                            <td>
                                <input type="file" name="image" />
                            </td>
                        </tr>
						<tr> 
                            <td>
                                <input type="submit" name="slider" Value="Save" />
                            </td>
                        </tr>
                    </table>
                    </form>
                </div>
                <?php } ?>
            </div>
        </div>
    <?php
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Slider List</h2>
        <div class="block">  
            <table class="data display datatable" id="example">
			<thead>
				<tr>
					<th>No.</th>
					<th>Slider Title</th>
					<th>Button Title</th>
					<th>Button Link</th>
					<th>Slider Image</th>
					<th>Status</th>
					<th>Action</th>
				</tr>
			</thead>
			<tbody>
<?php 
    $sliders = $hm->getSlider();
    if($sliders){
        $i=0;
        while($slider = $sliders->fetch_assoc()){
            $i++;

?>
			<tr class="odd gradeX">
					<td><?php echo $i; ?></td>
					<td><?php echo $slider['sliderTitle']; ?></td>
					<td><?php echo $slider['btnTitle']; ?></td>
					<td><?php echo $slider['btnLink']; ?></td>
					<td><img src="<?php echo $slider['image']; ?>" height="40px" width="60px"/></td>				
                    <td>
                        <?php 
                            if($page["status"] === '0'){
                                echo "Enable";
                            }if($page["status"] === '1'){
                                echo "Desable";
                            }
                        ?>
                    </td>
                    <td>
					<a href="">Edit</a> || 
					<a onclick="return confirm('Are you sure to Delete!');" >Delete</a> 
				</td>
			</tr>
            <?php }} ?>
			</tbody>
		</table>

       </div>
    </div>
</div>

<script type="text/javascript">
    $(document).ready(function () {
        setupLeftMenu();
        $('.datatable').dataTable();
		setSidebarHeight();
    });
</script>
<?php } ?>
<?php include 'inc/footer.php';?>