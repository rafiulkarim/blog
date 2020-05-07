<?php include "inc/header.php"; ?>
<?php 
	if(!isset($_GET['id']) || $_GET['id']==NULL){
		header("Location: 404.php");
	}else{
		$id = $_GET['id'];
	}
?>

	<div class="contentsection contemplete clear">
		<div class="maincontent clear">
			<div class="about">
				<?php
					$query = "SELECT * FROM tbl_post WHERE id=$id";
					$post = $db->select($query);
					if($post){
						while($result = $post->fetch_assoc()){					
				?>
				<h2><?php echo $result['title'] ?></h2>
				<h4><?php echo $fm->formatDate($result['date']);?>, By <?php echo $result['author'] ?></h4>
				<img src="admin/<?php echo $result['image'] ?>" alt="MyImage"/>
				<?php echo $result['body'] ?>
				<br>
				<br>
				<?php
					if($_SERVER['REQUEST_METHOD']=='POST'){
						$name = mysqli_real_escape_string($db->link, $_POST['name']);
						$email = mysqli_real_escape_string($db->link, $_POST['email']);
						$comment = mysqli_real_escape_string($db->link, $_POST['comment']);
						$postid = mysqli_real_escape_string($db->link, $_POST['postid']);
						$modaration = mysqli_real_escape_string($db->link, $_POST['modaration']);
						if(empty($name) || empty($email) || empty($comment)){
							echo "<span style='color:red;'>Field must not be empty !</span>";
						}else{
							$query = "INSERT INTO tbl_comment(name, email, comment, postid, modaration) VALUES('$name', '$email', '$comment', '$postid', '$modaration')";
							$result = $db->insert($query);
							if($result){
								echo "<span style='color:green;'>succesfully submited and go for Modaration!</span>";
							}else{
								echo "<span style='color:green;'>Category not inserted !</span>";
							}
						}
					}
				?>
				<form action="" method="post">
					<b>Name:</b><br>
					<input type="text" name="name"><br>
					<b>Email:</b><br>
					<input type="email" name="email"><br>
					<b>Comment:</b><br>
					<textarea name="comment" id="comment" cols="30" rows="10"></textarea><br>
					<input type="hidden" value="<?php echo $result['id'] ?>" name="postid">
					<input type="hidden" value="0" name="modaration">
					<input type="hidden" value="0" name="reply">
					<input type="submit" value="Submit">
				</form>
				<div class="relatedpost clear">
				<h2>Related articles</h2>
				
				<?php
					$cat_id = $result['Category'];
					$query = "SELECT * FROM tbl_post WHERE Category='$cat_id' ORDER BY rand() LIMIT 6 ";
					$related_category_post= $db->select($query);
					if($related_category_post){
						while($result = $related_category_post->fetch_assoc()){	
				?>
					<a href="post.php?id=<?php echo $result['id'] ?>"><img src="admin/<?php echo $result['image'] ?>" alt="post image"/></a>
					<?php } } else{ echo "<strong>Sorry !</strong>No related pot available!"; }?> 
				</div>
				<?php } } else{ header("Location:404.php"); }?> 
				<div class="samesidebar clear">
					<h2>Comments</h2>
					<?php
						$query = "SELECT * FROM tbl_comment WHERE postid='$id' and modaration='1' "; 
						$comments = $db->select($query);
						if($comments){
							while($result = $comments->fetch_assoc()){					
					?>
					<div class="popular clear">
					<?php if($result['reply']=='0' AND $result['modaration']=='1'){ ?>
						<h3><?php echo $result['name'] ?></h3>	
						<p><?php echo $result['comment'] ?></p>
						<?php } ?>
					</div>	
					<?php if($result['reply']=='1' AND $result['modaration']=='1'){ ?>	
						<h3>Reply by <?php echo $result['name'] ?></h3>	
						<p><?php echo $result['comment'] ?></p>
					<?php } ?>	
					<?php } } ?>
				</div>
			</div>
		</div>
<?php 
	include "inc/sidebar.php"; 
	include "inc/footer.php";
?>