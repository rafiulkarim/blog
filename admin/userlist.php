<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php if(!Session::get('userRole')=='0') 
    echo "<script>window.location = 'index.php';</script>";
?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>User List</h2>
        <?php
            if(isset($_GET['deluser'])){
                $deluser = $_GET['deluser'];
                $query = "DELETE FROM tbl_user WHERE id='$deluser' ";
                $delcat = $db->delete($query);
                if($delcat){
                    echo "<span style='color:green;'>User deleted succesfully !</span>";
                }else{
                    echo "<span style='color:green;'>User does not deleted !</span>";
                }
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>User Name</th>
                    <th>Email</th>
                    <th>Details</th>
                    <th>Role</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                    $query = "SELECT * FROM tbl_user";
                    $cat_list = $db->select($query);
                    if($cat_list){
                        $i=0;
                        while($result = $cat_list->fetch_assoc()){
                        $i++;
                ?>
                <tr class="odd gradeX">
                    <td width="10%"><?php echo $i ;?></td>
                    <td width="15%"><?php echo $result['name'] ?></td>
                    <td width="15%"><?php echo $result['username'] ?></td>
                    <td width="17%"><?php echo $result['email'] ?></td>
                    <td width="23%"><?php echo $fm->testshorten($result['details'], 30) ?></td>
                    <td width="5%">
                        <?php 
                            if($result['role']=='0'){
                                echo  'Admin';
                            }elseif($result['role']=='1'){
                                echo  'Author';
                            }else{
                                echo  'Editor';
                            }
                        ?></td>
                    <td width="15%"><a href="viewuser.php?userid=<?php echo $result['id'] ?>">View</a> || 
                        <a onclick="return confirm('Are you sure to delete !');" href="?deluser=<?php echo $result['id'] ?>">Delete</a></td>
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
