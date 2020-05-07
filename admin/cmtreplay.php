<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['replyid']) || $_GET['replyid'] == NULL){
        echo "<script>window.location='comments.php';</script>";
    }else{
        $id = $_GET['replyid'];
    }

?>


<div class="grid_10">
<div class="box round first grid">
    <h2>View Post</h2>
    <div class="block">  
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $comment = mysqli_real_escape_string($db->link, $_POST['comment']);
            $postid = mysqli_real_escape_string($db->link, $_POST['postid']);
            $modaration = mysqli_real_escape_string($db->link, $_POST['modaration']);
            $reply = mysqli_real_escape_string($db->link, $_POST['reply']);

            if(empty($name) || empty($email) || empty($comment)){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }else{
                $query = "INSERT INTO tbl_comment(name, email, comment, postid, modaration, reply) 
                VALUES('$name', '$email', '$comment', '$postid','$modaration','$reply')";
                $result = $db->insert($query);
                if($result){
                    echo "<span style='color:green;'>Data inserted succesfully !</span>";
                }else{
                    echo "<span style='color:green;'>Data not inserted !</span>";
                }
            }
        }
    ?>
    
        
    <form action="" method="post">
    <?php
        $query = "SELECT * FROM tbl_comment where id='$id'";
        $conlist = $db->select($query);
        if($conlist){
            while($result = $conlist->fetch_assoc()){
    ?>
        <table class="form">
            <tr>
                <td>
                    <label>Name</label>
                </td>
                <td>
                    <input type="text" readonly class="medium" value="<?php echo Session::get('username') ?>" name="name"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <input type="text" class="medium" value="admin@gmail.com" name="email"/>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;" >
                    <label>Comment</label>
                </td>
                <td>
                    <textarea class="tinymce" name="comment"></textarea>
                </td>
            </tr>
            <input type="hidden" class="medium" value="1" name="modaration"/>
            <input type="hidden" class="medium" value="1" name="reply"/>
            <input type="hidden" class="medium" value="<?php echo $result['postid']?>" name="postid"/>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Submit"/>
                </td>
            </tr>
        </table>
        <?php } } ?>
        </form>

    </div>
</div>

<!-- Load TinyMCE -->
<script src="js/tiny-mce/jquery.tinymce.js" type="text/javascript"></script>
<script type="text/javascript">
    $(document).ready(function () {
        setupTinyMCE();
        setDatePicker('date-picker');
        $('input[type="checkbox"]').fancybutton();
        $('input[type="radio"]').fancybutton();
    });
</script>
<?php include "inc/footer.php"; ?>