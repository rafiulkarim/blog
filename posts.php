<?php 
	include "inc/header.php"; 
?>
<?php 
	if(!isset($_GET['category']) || $_GET['category']==NULL){
		header("Location:404.php");
		//echo "<script>window.location = 'posts.php';</script>";
	}else{
		$id = $_GET['category'];
		
	}
?>

<div class="contentsection contemplete clear">
	<div class="maincontent clear">
	
		<?php
			$query = "SELECT * FROM tbl_post WHERE Category='$id' ";
			$post = $db->select($query);
			if($post){
				while($result = $post->fetch_assoc()){					
		?>
		<div class="samepost clear">
			<h2><a href="post.php?id=<?php echo $result['id'] ?>"><?php echo $result['title'] ?></a></h2>
			<h4><?php echo $fm->formatDate($result['date']);?>, By <a href="about.php"><?php echo $result['author'] ?></a></h4>
				<a href="post.php?id=<?php echo $result['id'] ?>"><img src="admin/<?php echo $result['image'] ?>" alt="post image"/></a>
			<p>
				<?php echo $fm->testShorten($result['body']); ?>
			</p>
			<div class="readmore clear">
				<a href="post.php?id=<?php echo $result['id'] ?>">Read More</a>
			</div>
		</div>
		<?php } ?>
		<?php } else{  
           echo "<h3 style='color: red;'>Not found any type of post</h3>";
        }?> 
		
	
    </div>	
		
<?php 
	include "inc/sidebar.php"; 
	include "inc/footer.php";
?>