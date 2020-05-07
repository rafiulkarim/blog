<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    $userId = Session::get('userId');
    $userRole = Session::get('userRole');
?>

<div class="grid_10">
<div class="box round first grid">
    <h2>User Profile</h2>
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $name = mysqli_real_escape_string($db->link, $_POST['name']);
            $username = mysqli_real_escape_string($db->link, $_POST['username']);
            $email = mysqli_real_escape_string($db->link, $_POST['email']);
            $details = mysqli_real_escape_string($db->link, $_POST['details']);

            if(empty($name) || empty($username) || empty($email) || empty($details)){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }else{
                $query = "UPDATE tbl_user SET 
                name='$name',
                username='$username',
                email='$email',
                details='$details' WHERE id='$userId' ";
                $result = $db->update($query);
                if($result){
                    echo "<span style='color:green;'>User Data Updated succesfully !</span>";
                }else{
                    echo "<span style='color:green;'>Some problem is occur !</span>";
                }
            }
        }
    ?>
    <div class="block"> 
    <?php
        $query = "SELECT * FROM tbl_user where id='$userId' AND role='$userRole'";
        $getuser = $db->select($query);
        if($getuser){
            while($result = $getuser->fetch_assoc()){
    ?>
    <form action="" method="post">
        <table class="form">
            <tr>
                <td>
                    <label>Name</label>
                </td>
                <td>
                    <input type="text" class="medium" name="name" value="<?php echo $result['name'] ?>" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>Email</label>
                </td>
                <td>
                    <input type="text"  class="medium" name="email" value="<?php echo $result['email'] ?>"/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Username</label>
                </td>
                <td>
                    <input type="text" class="medium" name="username" value="<?php echo $result['username'] ?>"/>
                </td>
            </tr>
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" name="details">
                    <?php echo $result['details'] ?>     
                    </textarea>
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