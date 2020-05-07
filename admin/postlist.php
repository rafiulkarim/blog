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
						<th width="5%">NO.</th>
						<th width="15%">Post Title</th>
						<th width="10%">Category</th>							
						<th width="10%">Image</th>
						<th width="10%">author</th>
						<th width="10%">Tags</th>
						<th width="10%">Date</th>
						<th width="15%">Action</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$query = "SELECT tbl_post.*, tbl_category.name FROM tbl_post INNER JOIN tbl_category ON 
						tbl_post.Category = tbl_category.id ORDER BY tbl_post.title DESC";
						$post_list = $db->select($query);
						if($post_list){
							$i=0;
							while($result = $post_list->fetch_assoc()){
							$i++;
					?>
					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><?php echo $result['title'];?></td>
						<td><?php echo $result['name']; ?></td>
						<td><img src="<?php echo $result['image'];?>" height="40px" width="60px" alt="missing image"></td>
						<td><?php echo $result['author']; ?></td> 
						<td><?php echo $result['tags']; ?></td> 
						<td><?php echo $result['date']; ?></td>
						<td>
						<a href="viewpost.php?viewpostid=<?php echo $result['id']; ?>">View</a>
						<?php if((Session::get('userId')==$result['userId']) || (Session::get('userRole')=='0')){  ?>
						|| <a href="editpost.php?editid=<?php echo $result['id']; ?>">Edit</a> || 
						<a onclick="return confirm('Are you sure want to delete !');" href="delpost.php?deleteid=<?php echo $result['id']; ?>">Delete</a></td>
						</tr>
						<?php } ?>
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