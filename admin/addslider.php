<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
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
           


            if(empty($title) ||  empty($file_name) ){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }elseif($file_size>2097134){
                echo "<span style='color:red;'>Image must be leass 2MB !</span>";
            }elseif(in_array($file_ext, $permited) === false){
               echo "<span style='color:red;'>You can upload only:-".implode(',',$permited)." !</span>";
            }
            else{
                move_uploaded_file($file_temp, $uploaded_image);
                $query = "INSERT INTO tbl_slider(image, title) VALUES('$uploaded_image', '$title')";
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
                    <label>Upload Image</label>
                </td>
                <td>
                    <input type="file" name="image"/>
                </td>
            </tr>
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Create" />
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