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
						<th width="20%">NO.</th>
						<th width="60%">Page Name</th>							
						<th width="20%">Action</th>
					</tr>
				</thead>
				<tbody>
				<?php
					$query = "SELECT * FROM tbl_addpages";
					$post_list = $db->select($query);
					if($post_list){
						$i=0;
						while($result = $post_list->fetch_assoc()){
						$i++;
				?>
					<tr class="odd gradeX">
						<td><?php echo $i; ?></td>
						<td><a href="updatepage.php?pageid=<?php echo $result['id']; ?>"><?php echo $result['pageName'];?></a></td>
						<td><a href="updatepage.php?pageid=<?php echo $result['id']; ?>">Edit</a> || 
						<a onclick="return confirm('Are you sure want to delete !');" href="delpage.php?delpageid=<?php echo $result['id']; ?>">Delete</a></td>
					</tr>
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