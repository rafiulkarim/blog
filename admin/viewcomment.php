<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['viewid']) || $_GET['viewid'] == NULL){
        header("Location: comments.php");
    }else{
        $id = $_GET['viewid'];
    }

?>


<div class="grid_10">
<div class="box round first grid">
    <h2>View Post</h2>
    <div class="block">  
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            echo "<script>window.location = 'comments.php';</script>";
        }
    ?>
    <?php
        $query = "SELECT * FROM tbl_comment WHERE id='$id'";
        $postdata = $db->select($query);
        if($postdata){
            while($postresult = $postdata->fetch_assoc()){
        ?>
    <form action="" method="post">
        <table class="form">
            
            <tr>
                <td>
                    <label>Name</label>
                </td>
                <td>
                    <input type="text" class="medium" value="<?php echo $postresult['name'] ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <input type="text" class="medium" value="<?php echo $postresult['email'] ?>"/>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Comment</label>
                </td>
                <td>
                    <textarea class="tinymce" ><?php echo $postresult['comment'] ?></textarea>
                </td>
            </tr>
            
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="ok" />
                </td>
            </tr>
        </table>
        </form>
        <?php }}?>
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