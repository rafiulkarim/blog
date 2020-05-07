<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<style>
.leftside{
    float: left; width:70%;
}
.rightside{
    float: left; width:20%;
}
.rightside img{
    height: 200px; width: 180px;
}
</style>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Site Title and Description</h2>
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $title = mysqli_real_escape_string($db->link, $_POST['title']);
                $slogan = mysqli_real_escape_string($db->link, $_POST['slogan']);

                $permited  = array('jpg', 'jpeg', 'png');
                $file_name = $_FILES['logo']['name'];
                $file_size = $_FILES['logo']['size'];
                $file_temp = $_FILES['logo']['tmp_name'];

                $div = explode('.', $file_name);
                $file_ext = strtolower(end($div));
                $same_image = 'logo'.'.'.$file_ext;
                $uploaded_image = "upload/".$same_image;
                        


                if(empty($title) || empty($slogan)){
                    echo "<span style='color:red; '>Field must not be empty !</span>";
                }else{
                    if(!empty($file_name)){
                        if($file_size>2097134){
                            echo "<span style='color:red;'>Image must be leass 2MB !</span>";
                        }elseif(in_array($file_ext, $permited) === false){
                            echo "<span style='color:red;'>You can upload only:-".implode(',',$permited)." !</span>";
                        }else{
                            move_uploaded_file($file_temp, $uploaded_image);
                            $query = "UPDATE tbl_slogan SET 
                            title='$title',
                            slogan='$slogan',
                            logo='$uploaded_image'
                            WHERE id='1' ";
                            $result = $db->update($query);
                            if($result){
                                echo "<span style='color:green;'>Data Updated succesfully !</span>";
                            }else{
                                echo "<span style='color:green;'>Some problem is occuer !</span>";
                            }
                        }    
                    }else{
                        $query = "UPDATE tbl_slogan SET 
                        title='$title',
                        slogan='$slogan'
                        WHERE id='1' ";
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
            $query = "SELECT * FROM tbl_slogan WHERE id='1'";
            $slogan = $db->select($query);
            if($slogan){
                while($presult = $slogan->fetch_assoc()){
		?>
        <div class="block sloginblock">  
        
        <div class="leftside">
            <form action="titleslogan.php" method="POST" enctype="multipart/form-data">
                <table class="form">					
                    <tr>
                        <td>
                            <label>Website Title</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $presult['title'] ?>"  name="title" class="medium"/>
                        </td>
                    </tr>
                        <tr>
                        <td>
                            <label>Website Slogan</label>
                        </td>
                        <td>
                            <input type="text" value="<?php echo $presult['slogan'] ?>" name="slogan" class="medium"/>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            <label>Website Logo</label>
                        </td>
                        <td>
                            <input type="file" name="logo"/>
                        </td>
                    </tr>   
                    <tr>
                        <td>
                        </td>
                        <td>
                            <input type="submit" name="submit" Value="Update" />
                        </td>
                    </tr>
                </table>
            </form>
        </div>
        <div class="rightside">
            <img src="<?php echo $presult['logo'] ?>" alt="my image" width="150px" height="50px"><br>
        </div>        
        </div>
        <?php }} ?> 
    </div>
</div>
<?php include "inc/footer.php"; ?>