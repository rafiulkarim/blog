<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['pageid']) || $_GET['pageid'] == NULL){
        echo "<script>window.location = 'index.php'; </script>";
    }else{
        $id = $_GET['pageid'];
    }
?>
<div class="grid_10">

<div class="box round first grid">
    <h2>Update post</h2>
    <div class="block">      
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $pageName = mysqli_real_escape_string($db->link, $_POST['pageName']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            

            if(empty($pageName) || empty($body) ){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }else{
                $query = "UPDATE tbl_addpages SET pageName='$pageName', body='$body'  WHERE id='$id' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>Page updates succesfully !</span>";
                }else{
                    echo "<span style='color:green;'>page not updateed !</span>";
                }
            }
        }
    ?>
    <?php
        $query = "SELECT * FROM tbl_addpages WHERE id='$id'";
        $page = $db->select($query);
        if($page){
            while($result = $page->fetch_assoc()){
    ?>

        <form action="" method="post">
        <table class="form">
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" value="<?php echo $result['pageName'] ?>" class="medium" name="pageName" />
                </td>
            </tr>
          
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" name="body">
                        <?php echo $result['body'] ?>
                    </textarea>
                </td>
            </tr>
            
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Update" />
                </td>
            </tr>
        </table>
        </form>
        <?php } } ?>
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