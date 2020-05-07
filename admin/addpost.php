<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
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
           


            if(empty($title) || empty($category) || empty($file_name) || empty($body) || empty($tags) || empty($author) ){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }elseif($file_size>2097134){
                echo "<span style='color:red;'>Image must be leass 2MB !</span>";
            }elseif(in_array($file_ext, $permited) === false){
               echo "<span style='color:red;'>You can upload only:-".implode(',',$permited)." !</span>";
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_post(category, title, body, image, author, tags, userId) 
                VALUES('$category', '$title', '$body', '$uploaded_image','$author','$tags','$userId')";
                $result = $db->insert($query);
                if($result){
                    echo "<span style='color:green;'>Data inserted succesfully !</span>";
                }else{
                    echo "<span style='color:green;'>Data not inserted !</span>";
                }
            }
        }
    ?>

        <form action="" method="post" enctype="multipart/form-data">
        <table class="form">
            
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" placeholder="Enter Post Title..." class="medium" name="title" />
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
                    <?php    } } ?>
                    
                    </select>
                </td>
            </tr>
        
        
            <!-- <tr>
                <td>
                    <label>Date Picker</label>
                </td>
                <td>
                    <input type="text" id="date-picker" />
                </td>
            </tr> -->
            <tr>
                <td>
                    <label>Upload Image</label>
                </td>
                <td>
                    <input type="file" name="image"/>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" name="body"></textarea>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Tags</label>
                </td>
                <td>
                    <input type="text" placeholder="Enter Post Title..." class="medium" name="tags" />
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
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Save" />
                </td>
            </tr>
        </table>
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