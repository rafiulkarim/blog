<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Inbox</h2>
        <!-- transfer seen box -->
        <?php
            if(isset($_GET['seenid'])){
                $seenid = $_GET['seenid'];
                $query = "UPDATE tbl_contact SET status='1' WHERE id='$seenid' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>Message transfar in the Seen box  !</span>";
                }else{
                    echo "<span style='color:green;'>Message does not transfer seen box !</span>";
                }
            }
        ?>
        <!-- delete seen message from seen box -->
        <?php
            if(isset($_GET['delid'])){
                $id = $_GET['delid'];
                $query = "DELETE FROM tbl_contact WHERE id='$id' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>Message message deleted succesfully!</span>";
                }else{
                    echo "<span style='color:green;'>Somethong Error !</span>";
                }

            }
        ?>
        <!-- Transfer inbox -->
        <?php
            if(isset($_GET['unseenid'])){
                $unseenid = $_GET['unseenid'];
                $query = "UPDATE tbl_contact SET status='0' WHERE id='$unseenid' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>Message transfar in the inbox  !</span>";
                }else{
                    echo "<span style='color:green;'>Message does not transfer inbox !</span>";
                }
            }
        ?>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM tbl_contact WHERE status='0'";
                $conlist = $db->select($query);
                if($conlist){
                    $i=0;
                    while($result = $conlist->fetch_assoc()){
                    $i++;
            ?>
                <tr class="odd gradeX">
                    <td width="8%"><?php echo $i; ?></td>
                    <td width="20%"><?php echo $result['firstname']." ".$result['lastname'] ?></td>
                    <td width="20%"><?php echo $result['email'] ?></td>
                    <td width="25%"><?php echo $fm->testShorten($result['body'], 40); ?></td>
                    <td width="10%"><?php echo $fm->formatDate($result['date']) ?></td>
                    <td width="17%"><a href="viewmsg.php?msgid=<?php echo $result['id'] ?>">View</a> || 
                    <a onclick="return confirm('Are you sure want to tranfer seen box !');" href="?seenid=<?php echo $result['id'] ?>">Seen</a> || 
                    <a href="replay.php?replayid=<?php echo $result['id'] ?>">Reply</a>
                    </td> 
                </tr>
            <?php } } ?>
            </tbody>
        </table>
        </div>
    </div>
</div>
<div class="grid_10">
    <div class="box round first grid">
        <h2>Seen Messages</h2>
        <div class="block">        
            <table class="data display datatable" id="example">
            <thead>
                <tr>
                    <th>Serial No.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Message</th>
                    <th>Date</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
            <?php
                $query = "SELECT * FROM tbl_contact WHERE status='1' ";
                $conlist = $db->select($query);
                if($conlist){
                    $i=0;
                    while($result = $conlist->fetch_assoc()){
                    $i++;
            ?>
                <tr class="odd gradeX">
                    <td width="8%"><?php echo $i; ?></td>
                    <td width="20%"><?php echo $result['firstname']." ".$result['lastname'] ?></td>
                    <td width="20%"><?php echo $result['email'] ?></td>
                    <td width="25%"><?php echo $fm->testShorten($result['body'], 40); ?></td>
                    <td width="10%"><?php echo $fm->formatDate($result['date']) ?></td>
                    <td width="17%"><a onclick="return confirm('Are you sure want to delete Message !');" href="?delid=<?php echo $result['id'] ?>">Delete</a> ||
                    <a onclick="return confirm('Are you sure want to tranfer inbox !');" href="?unseenid=<?php echo $result['id'] ?>">Unseen</a></td> 
                </tr>
            <?php } } ?>
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

