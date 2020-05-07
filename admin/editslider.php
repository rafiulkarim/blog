<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['sliderid']) || $_GET['sliderid'] == NULL){
        header("Location: sliderlist.php");
    }else{
        $id = $_GET['sliderid'];
    }

?>


<div class="grid_10">
<div class="box round first grid">
    <h2>Add New Post</h2>
    <div class="block">  
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $title = mysqli_real_escape_string($db->link, $_POST['title']);

            $permited  = array('jpg', 'jpeg', 'png', 'gif');
            $file_name = $_FILES['image']['name'];
            $file_size = $_FILES['image']['size'];
            $file_temp = $_FILES['image']['tmp_name'];

            $div = explode('.', $file_name);
            $file_ext = strtolower(end($div));
            $unique_image = substr(md5(time()), 0, 10).'.'.$file_ext;
            $uploaded_image = "upload/slider/".$unique_image;
            


            if(empty($title) || empty($file_name)){
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
                        title='$title',
                        image='$uploaded_image'
                         WHERE id='$id' ";
                        $result = $db->update($query);
                        if($result){
                            echo "<span style='color:green;'>Slider Updated succesfully !</span>";
                        }else{
                            echo "<span style='color:green;'>Some problem is occuer !</span>";
                        }
                    }    
                }else{
                    $query = "UPDATE tbl_post SET 
                        title='$title',
                        image='$uploaded_image'
                        WHERE id='$id' ";
                        $result = $db->update($query);
                    if($result){
                        echo "<span style='color:green;'>Slider Updated succesfully !</span>";
                    }else{
                        echo "<span style='color:green;'>Some problem is occuer !</span>";
                    }
                }
            }
        }
    ?>
    <?php
        $query = "SELECT * FROM tbl_slider WHERE id='$id'";
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
                    <label>Upload Image</label>
                </td>
                <td>
                    <img src="<?php echo $postresult['image'] ?>" alt="my image" width="150px" height="50px"><br>
                    <input type="file" name="image"/>
                </td>
            </tr>
           
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