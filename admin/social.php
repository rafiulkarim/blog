<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Social Media</h2>
        <div class="block"> 
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $facebook = mysqli_real_escape_string($db->link, $fm->validation($_POST['facebook']));
                $twitter = mysqli_real_escape_string($db->link, $fm->validation($_POST['twitter']));
                $linkedin = mysqli_real_escape_string($db->link, $fm->validation($_POST['linkedin']));
                $gp = mysqli_real_escape_string($db->link, $fm->validation($_POST['gp']));

                if(empty($facebook) || empty($twitter) || empty($linkedin) || empty($gp)){
                    echo "<span style='color:red; '>Field must not be empty !</span>";
                }else{             
                    $query = "UPDATE tbl_social SET 
                    facebook='$facebook',
                    twitter='$twitter',
                    linkedin='$linkedin',
                    gp='$gp'
                    WHERE id='1' ";
                    $result = $db->update($query);
                    if($result){
                        echo "<span style='color:green;'>Data Updated succesfully !</span>";
                    }else{
                        echo "<span style='color:green;'>Some problem is occuer !</span>";
                    }
                }
            }
        ?>    
        <?php
            $query = "SELECT * FROM tbl_social WHERE id='1'";
            $slogan = $db->select($query);
            if($slogan){
                while($presult = $slogan->fetch_assoc()){
		?>          
            <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Facebook</label>
                    </td>
                    <td>
                        <input type="text" name="facebook" value="<?php echo $presult['facebook'] ?>" class="medium" />
                    </td>
                </tr>
                    <tr>
                    <td>
                        <label>Twitter</label>
                    </td>
                    <td>
                        <input type="text" name="twitter" value="<?php echo $presult['twitter'] ?>" class="medium" />
                    </td>
                </tr>
                
                
                    <tr>
                    <td>
                        <label>LinkedIn</label>
                    </td>
                    <td>
                        <input type="text" name="linkedin" value="<?php echo $presult['linkedin'] ?>" class="medium" />
                    </td>
                </tr>
                
                    <tr>
                    <td>
                        <label>Google Plus</label>
                    </td>
                    <td>
                        <input type="text" name="gp" value="<?php echo $presult['gp'] ?>"class="medium" />
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
</div>
<?php include "inc/footer.php"; ?>
