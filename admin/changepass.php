<?php
	include "../lib/Session.php";
	Session::checklogin();
?>
<?php 
	include "../config/config.php"; 
	include "../lib/Database.php"; 
    include "../helpers/format.php";
    
?>
<?php
	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<head>
<meta charset="utf-8">
<title>Password change</title>
    <link rel="stylesheet" type="text/css" href="css/stylelogin.css" media="screen" />
</head>
<body>
<div class="container">
	<section id="content">
<?php
	if($_SERVER['REQUEST_METHOD']=='POST'){
        $password = $fm->validation($_POST['password']);
        $cpassword = $fm->validation($_POST['cpassword']);
		$pass = mysqli_real_escape_string($db->link, md5($password));
		if(empty($password) || empty($cpassword)){
			echo "<span style='color:red;'>Field must not be Empty !</span>";			
		}elseif($cpassword != $password){
            echo "<span style='color:red;'>Password does not match !</span>"; 
        }
        else{
			$query = "UPDATE tbl_uesr SET name='$name' WHERE email='$id' ";
            $result = $db->update($query);
            if($result){
                echo "<span style='color:green;'>Category inserted succesfully !</span>";
            }else{
                echo "<span style='color:green;'>Category not inserted !</span>";
            }
		}
	}
?>
		<form action="" method="post">
			<h1>Change Password</h1>
			<div>
				<input type="password" placeholder="password"  name="password"/>
			</div>
            <div>
				<input type="password" placeholder="Confirm Password"  name="cpassword"/>
			</div>
			<div>
				<input type="submit" value="Next" />
			</div>
		</form><!-- form -->
		<div class="button">
			<a href="login.php">Log in</a>
		</div><!-- button -->
	</section><!-- content -->
</div><!-- container -->
</body>
</html>