<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php if(!Session::get('userRole')=='0') 
    echo "<script>window.location = 'index.php';</script>";
?>
<div class="grid_10">
<div class="box round first grid">
    <h2>Add New Post</h2>
    <div class="block">      
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $password = mysqli_real_escape_string($db->link, md5($_POST['password']));
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $role = mysqli_real_escape_string($db->link, $_POST['role']);        

            if(empty($username) || empty($password) || empty($role) || empty($email)){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }else{
                $mailquery = "SELECT * FROM tbl_user WHERE email='$email' LIMIT 1";
                $mailcheck = $db->select($mailquery);
                if($mailcheck == true){
                    echo "<span style='color:red;'>Email Already Exists !</span>";
                }else{
                    $query = "INSERT INTO tbl_user(username, password, email, role) 
                    VALUES('$username', '$password','$email', '$role')";
                    $result = $db->insert($query);
                    if($result){
                        echo "<span style='color:green;'>User created succesfully !</span>";
                    }else{
                        echo "<span style='color:red;'>User not created !</span>";
                    }
                }
                
            }
        }
    ?>

        <form action="" method="post">
        <table class="form">
            
            <tr>
                <td>
                    <label>Username</label>
                </td>
                <td>
                    <input type="text" placeholder="Enter Username..." class="medium" name="username" />
                </td>
            </tr>
            
            <tr>
                <td>
                    <label>Password</label>
                </td>
                <td>
                    <input type="password" placeholder="Enter password..." class="medium" name="password" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <input type="email" placeholder="Enter Valid Email..." class="medium" name="email" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Category</label>
                </td>
                <td>
                    <select id="select" name="role">
                        <option>Select User Type</option>
                        <option value="0">Admin</option>  
                        <option value="1">Author</option> 
                        <option value="2">Editor</option>                 
                    </select>
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