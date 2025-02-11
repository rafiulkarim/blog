<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['viewpostid']) || $_GET['viewpostid'] == NULL){
        header("Location: postlist.php");
    }else{
        $id = $_GET['viewpostid'];
    }

?>


<div class="grid_10">
<div class="box round first grid">
    <h2>View Post</h2>
    <div class="block">  
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            echo "<script>window.location = 'postlist.php';</script>";
        }
    ?>
    <?php
        $query = "SELECT * FROM tbl_post WHERE id='$id'";
        $postdata = $db->select($query);
        if($postdata){
            while($postresult = $postdata->fetch_assoc()){
        ?>
    <form action="" method="post" enctype="multipart/form-data">
        <table class="form">
            
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" class="medium" name="title" value="<?php echo $postresult['title'] ?>"/>
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Category</label>
                </td>
                <td>
                    <select id="select" name="category">
                        <option>Select Category</option>
                        <?php
                            $query = "SELECT * FROM tbl_category";
                            $category = $db->select($query);
                            if($category){
                                while($result = $category->fetch_assoc()){
                        ?>
                        <option value="<?php echo $result['id'] ?>"><?php echo $result['name'] ?></option>
                    <?php    } }else{ ?>
                        <h3>this post does not edit !!</h3>
                    <?php } ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <img src="<?php echo $postresult['image'] ?>" alt="my image" width="150px" height="50px"><br>
                    <input type="file" name="image"/>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" name="body"><?php echo $postresult['body'] ?></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tags</label>
                </td>
                <td>
                    <input type="text" value="<?php echo $postresult['tags'] ?>" class="medium" name="tags" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Author</label>
                </td>
                <td>
                    <input type="text" value="<?php echo $postresult['author'] ?>" class="medium" name="author" />
                </td>
            </tr>
            <tr>
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