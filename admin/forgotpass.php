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
		$email = $fm->validation($_POST['email']);

		$email = mysqli_real_escape_string($db->link, $email);
		
		$query = " SELECT * FROM tbl_user WHERE email='$email' ";

		$result = $db->select($query);

		if($result != false){
			//$value = mysqli_fetch_array($result);
			//$row = mysqli_num_rows($result);
			$value = $result->fetch_assoc();
			Session::set("login", true);
			Session::set("username", $value['username']);
			Session::set("userId", $value['id']);
			Session::set("userRole", $value['role']);
			//header("Location: changepass.php");
			
		}else{
			echo "<span style='color:red;'>username or password not match !!</span>";
		}
	}
?>

		<form action="" method="post">
			<h1>Change Password</h1>
			<div>
				<input type="text" placeholder="Email"  name="email"/>
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