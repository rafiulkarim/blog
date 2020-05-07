<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <!-- transfer seen box -->
        <?php
            if(isset($_GET['modarateid'])){
                $seenid = $_GET['modarateid'];
                $query = "UPDATE tbl_comment SET modaration = '1' WHERE id='$seenid' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>Comment transfar in the Seen box  !</span>";
                }else{
                    echo "<span style='color:green;'>Comment does not transfer seen box !</span>";
                }
            }
        ?>
        <!-- delete seen message from seen box -->
        <?php
            if(isset($_GET['delid'])){
                $id = $_GET['delid'];
                $query = "DELETE FROM tbl_comment WHERE id='$id' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>Comment deleted succesfully!</span>";
                }else{
                    echo "<span style='color:green;'>Somethong Error !</span>";
                }

            }
        ?>
        <!-- Transfer inbox -->
        <?php
            if(isset($_GET['unmodarateid'])){
                $unseenid = $_GET['unmodarateid'];
                $query = "UPDATE tbl_comment SET modaration = '0' WHERE id='$unseenid' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>Comment transfar in the inbox  !</span>";
                }else{
                    echo "<span style='color:green;'>Comment does not transfer inbox !</span>";
                }
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="10%">Serial No.</th>
                    <th width="15%">Name</th>
                    <th width="20%">Email</th>
                    <th width="30%">Comment</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM tbl_comment where modaration = '0'";
                $conlist = $db->select($query);
                if($conlist){
                    $i=0;
                    while($result = $conlist->fetch_assoc()){
                    $i++;
            ?>
            <tr class="odd gradeX">         
                <td width="10%"><?php echo $i; ?></td>
                <td width="15%"><?php echo $result['name'] ?></td>
                <td width="20%"><?php echo $result['email'] ?></td>
                <td width="30%"><?php echo $fm->testShorten($result['comment'], 40); ?></td>               
                <td width="25%"><a href="viewcomment.php?viewid=<?php echo $result['id'] ?>">View</a>  
                || <a href="?modarateid=<?php echo $result['id'] ?>">Modarate</a>
                || <a href="cmtreplay.php?replyid=<?php echo $result['id'] ?>">Reply</a>
                || <a href="?delid=<?php echo $result['id'] ?>">Delete</a>
                </td>                   
            </tr>
            <?php } }else{ ?>
                <p style="color: red;"> No comments yet !</p>
            <?php } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Seen Comments</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th width="10%">Serial No.</th>
                    <th width="15%">Name</th>
                    <th width="20%">Email</th>
                    <th width="30%">Comment</th>
                    <th width="25%">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM tbl_comment where modaration ='1'";
                $conlist = $db->select($query);
                if($conlist){
                    $i=0;
                    while($result = $conlist->fetch_assoc()){
                    $i++;
            ?>
            <tr class="odd gradeX">         
                <td width="10%"><?php echo $i; ?></td>
                <td width="15%"><?php echo $result['name'] ?></td>
                <td width="20%"><?php echo $result['email'] ?></td>
                <td width="30%"><?php echo $fm->testShorten($result['comment'], 40); ?></td>               
                <td width="25%"><a href="viewcomment.php?viewid=<?php echo $result['id'] ?>">View</a>  
                || <a href="?unmodarateid=<?php echo $result['id'] ?>">Unmodarate</a>
                || <a href="?delid=<?php echo $result['id'] ?>">Delete</a> 
                </td>                  
            </tr>
            <?php } }else{ ?>
                <p style="color: red;"> No comments yet !</p>
            <?php } ?>
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

