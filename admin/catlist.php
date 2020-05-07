<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Category List</h2>
        <?php
            if(isset($_GET['id'])){
                $delcat = $_GET['id'];
                $query = "DELETE FROM tbl_category WHERE id='$delcat' ";
                $delcat = $db->delete($query);
                if($delcat){
                    echo "<span style='color:green;'>Category deleted succesfully !</span>";
                }else{
                    echo "<span style='color:green;'>Category does not delete !</span>";
                }
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Category Name</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM tbl_category";
                    $cat_list = $db->select($query);
                    if($cat_list){
                        $i=0;
                        while($result = $cat_list->fetch_assoc()){
                        $i++;
                ?>
                <tr class="odd gradeX">
                    <td><?php echo $i ;?></td>
                    <td><?php echo $result['name'] ?></td>
                    <td>
                        <a href="viewcat.php?catid=<?php echo $result['id'] ?>">view</a>  
                        <?php if((Session::get('userId')==$result['id']) || (Session::get('userRole')=='0')){  ?>
                        || <a href="editcat.php?catid=<?php echo $result['id'] ?>">Edit</a> || 
                        <a onclick="return confirm('Are you sure to delete !');" href="?id=<?php echo $result['id'] ?>">Delete</a>
                        <?php } ?>
                    </td>
                    
                </tr>
                <?php  } ?>
                <?php  } else{?>
                <p>No category found !!</p>
                <?php  } ?>
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
<?php include "inc/footer.php"; ?>
