<?php 
	include "inc/header.php"; 
?>
	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<h2>Contact us</h2>
				<?php
					if($_SERVER['REQUEST_METHOD']=='POST'){
						
						$firstname = mysqli_real_escape_string($db->link, $_POST['firstname']);
						$lastname = mysqli_real_escape_string($db->link, $_POST['lastname']);
						$email = mysqli_real_escape_string($db->link, $_POST['email']);
						$body = mysqli_real_escape_string($db->link, $_POST['body']);
						
						if(empty($firstname) || empty($lastname) || empty($email) || empty($body)){
							echo "<strong style='color: red;'> Field must not be empty !!</strong>";
						}else{
							$query = "INSERT INTO tbl_contact(firstname,lastname,email,body) 
							VALUES('$firstname', '$lastname','$email', '$body')";
							$result = $db->insert($query);
							if($result){
								echo "<strong style='color: green;'>Your message send succesfully !!</strong>";
							}else{
								echo "<strong style='color: green;'>Have some problem !!</strong>";
							}
						}
					}
				?>
			<form action="" method="post">
				<table>
				<tr>
					<td>Your First Name:</td>
					<td>
					<input type="text" name="firstname" placeholder="Enter first name" />
					</td>
				</tr>
				<tr>
					<td>Your Last Name:</td>
					<td>
					<input type="text" name="lastname" placeholder="Enter Last name" />
					</td>
				</tr>
				
				<tr>
					<td>Your Email Address:</td>
					<td>
					<input type="email" name="email" placeholder="Enter Email Address" />
					</td>
				</tr>
				<tr>
					<td>Your Message:</td>
					<td>
					<textarea name="body"></textarea>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
					<input type="submit" name="submit" value="Send"/>
					</td>
				</tr>
		</table>
	<form>				
 </div>

		</div>

			
			<?php include "inc/sidebar.php"; 
	include "inc/footer.php";
?>