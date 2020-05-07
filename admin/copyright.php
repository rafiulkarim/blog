<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<div class="grid_10">

    <div class="box round first grid">
        <h2>Update Copyright Text</h2>
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $copyright = mysqli_real_escape_string($db->link, $fm->validation($_POST['copyright']));

                if(empty($copyright)){
                    echo "<span style='color:red; '>Field must not be empty !</span>";
                }else{             
                    $query = "UPDATE tbl_copyright SET 
                    copyright='$copyright'
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
            $query = "SELECT * FROM tbl_copyright WHERE id='1'";
            $slogan = $db->select($query);
            if($slogan){
                while($presult = $slogan->fetch_assoc()){
		?> 
        <div class="block copyblock"> 
            <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $presult['copyright'] ?>" name="copyright" class="large" />
                    </td>
                </tr>
                
                    <tr> 
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
