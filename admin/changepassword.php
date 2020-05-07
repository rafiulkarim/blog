<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>

<div class="grid_10">
    <div class="box round first grid">
        <h2>Change Password</h2>
        <?php
            $id = Session::get('userId');
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $newpass = $fm->validation($_POST['newpass']);
                $oldpass = $fm->validation($_POST['oldpass']);
                $pass = mysqli_real_escape_string($db->link, md5($oldpass));
                
                if(empty($newpass) || empty($oldpass)){
                    echo "<span style='color:red;'>Field must not be Empty !</span>";			
                }else{
                    $query = "UPDATE tbl_user SET password='$pass' WHERE id='$id' ";
                    $result = $db->update($query);
                    if($result){
                        echo "<span style='color:green;'>Password updated succesfully !</span>";
                    }else{
                        echo "<span style='color:green;'>Password not updated !</span>";
                    }
                }
            }
        ?>
          
        <div class="block">               
            <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <label>Old Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter Old Password..."  name="newpass" class="medium" />
                    </td>
                </tr>
                    <tr>
                    <td>
                        <label>New Password</label>
                    </td>
                    <td>
                        <input type="password" placeholder="Enter New Password..." name="oldpass" class="medium" />
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
    </div>
</div>
<?php include "inc/footer.php"; ?>