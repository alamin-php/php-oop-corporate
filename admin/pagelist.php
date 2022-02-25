<?php include 'inc/header.php';?>
<?php include 'inc/sidebar.php';?>
<?php 
    $filepath = realpath(dirname(__FILE__));
    include_once ($filepath."/../classes/Home.php");
    $hm = new Home();
?>
        <div class="grid_10">
            <div class="box round first grid">
                <h2>Page List</h2>
                <div class="block">        
                    <table class="data display datatable" id="example">
					<thead>
						<tr>
							<th>Serial No.</th>
							<th>Page Name</th>
							<th>Page Slug</th>
							<th>Section</th>
							<th>Status</th>
							<th>Action</th>
						</tr>
					</thead>
					<tbody>
						<?php 
							$i=0;
							$pages = $hm->showPage();
							if($pages){
								while($page = $pages->fetch_assoc()){
									$i++;
									?>
									<tr class="odd gradeX">
										<td><?php echo $i; ?></td>
										<td><?php echo $page["pageTitle"] ?></td>
										<td><?php echo $page["pageSlug"] ?></td>
										<td>
											<?php 
												if($page["sectionId"] === '1'){
													echo "Home Section";
												}if($page["sectionId"] === '2'){
													echo "About Section";
												}if($page["sectionId"] === '3'){
													echo "Services Section";
												}if($page["sectionId"] === '4'){
													echo "Work Section";
												}if($page["sectionId"] === '5'){
													echo "Blog Section";
												}if($page["sectionId"] === '6'){
													echo "Contact Section";
												}
											?>
										</td>
										<td>
											<?php 
												if($page["status"] === '0'){
													echo "Enable";
												}if($page["status"] === '1'){
													echo "Desable";
												}
											?>
										</td>
										<td><a href="pageedit.php?pageId=<?php echo $page['pageId'] ?>">Edit</a> || <a href="">Delete</a></td>
									</tr>
									<?php
								}
							}
						?>
						
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
<?php include 'inc/footer.php';?>

