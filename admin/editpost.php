<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['editid']) || $_GET['editid'] == NULL){
        header("Location: postlist.php");
    }else{
        $id = $_GET['editid'];
    }

?>


<div class="grid_10">
<div class="box round first grid">
    <h2>Add New Post</h2>
    <div class="block">  
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $title = mysqli_real_escape_string($db->link, $_POST['title']);
            $category = mysqli_real_escape_string($db->link, $_POST['category']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            $tags = mysqli_real_escape_string($db->link, $_POST['tags']);
            $author = mysqli_real_escape_string($db->link, $_POST['author']);
            $userId = mysqli_real_escape_string($db->link, $_POST['userId']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/".$unique_image;
            


            if(empty($title) || empty($category) || empty($body) || empty($tags) || empty($author) ){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }else{
                if(!empty($file_name)){
                    if($file_size>2097134){
                        echo "<span style='color:red;'>Image must be leass 2MB !</span>";
                    }elseif(in_array($file_ext, $permited) === false){
                        echo "<span style='color:red;'>You can upload only:-".implode(',',$permited)." !</span>";
                    }else{
                        move_uploaded_file($file_temp, $uploaded_image);
                        $query = "UPDATE tbl_post SET 
                        category='$category',
                        title='$title',
                        body='$body',
                        image='$uploaded_image',
                        author='$author',
                        tags='$tags',
                        userId='$userId' WHERE id='$id' ";
                        $result = $db->update($query);
                        if($result){
                            echo "<span style='color:green;'>Data Updated succesfully !</span>";
                        }else{
                            echo "<span style='color:green;'>Some problem is occuer !</span>";
                        }
                    }    
                }else{
                    $query = "UPDATE tbl_post SET 
                    category='$category',
                    title='$title',
                    body='$body',
                    author='$author',
                    tags='$tags',
                    userId='$userId' WHERE id='$id' ";
                    $result = $db->update($query);
                    if($result){
                        echo "<span style='color:green;'>Data Updated succesfully !</span>";
                    }else{
                        echo "<span style='color:green;'>Some problem is occuer !</span>";
                    }
                }
            }
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
                    <input type="text" value="<?php echo Session::get('username') ?>" class="medium" name="author" />
                </td>
            </tr>
            <tr>
            <input type="hidden" value="<?php echo Session::get('userId') ?>" class="medium" name="userId" />
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Save" />
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