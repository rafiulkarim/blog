<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
	<div class="grid_10">
		<div class="box round first grid">
			<h2>Post List</h2>
			<div class="block">  
				<table class="data display datatable" id="example">
				<?php

				?>
				<thead>
					<tr>
						<th width="25%">NO.</th>
						<th width="25%">Slider Title</th>							
						<th width="25%">Image</th>
                        <th width="25s%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = "SELECT * FROM tbl_slider";
						$slider_list = $db->select($query);
						if($slider_list){
							$i=0;
							while($result = $slider_list->fetch_assoc()){
							$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $result['title'];?></td>
						<td><img src="<?php echo $result['image'];?>" height="40px" width="60px" alt="missing image"></td>
						<td>
						<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a>
						<?php //if((Session::get('userId')==$result['userId']) || (Session::get('userRole')=='0')){  ?>
						|| <a href="editslider.php?sliderid=<?php echo $result['id']; ?>">Edit</a> || 
						<a onclick="return confirm('Are you sure want to delete !');" href="delpost.php?deleteid=<?php echo $result['id']; ?>">Delete</a></td>
						</tr>
						<?php //} ?>
					<?php } ?>
						<?php } else{ ?>
						<h3><strong>Sorry !</strong> No data found</h3>
					<?php } ?>
				</tbody>
			</table>

			</div>
		</div>
	</div>
	<div class="clear">
	</div>
</div>
	<script type="text/javascript">
        $(document).ready(function () {
            setupLeftMenu();
            $('.datatable').dataTable();
			setSidebarHeight();
        });
	</script>
<?php include "inc/footer.php"; ?>