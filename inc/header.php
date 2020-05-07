<?php
  //set headers to NOT cache a page
  header("Cache-Control: no-cache, must-revalidate"); //HTTP 1.1
  header("Pragma: no-cache"); //HTTP 1.0
  header("Expires: Sat, 26 Jul 1997 05:00:00 GMT"); 
  // Date in the past
  //or, if you DO want a file to cache, use:
  header("Cache-Control: max-age=2592000"); 
//30days (60sec * 60min * 24hours * 30days)
?>
<?php 
	include "config/config.php"; 
	include "lib/Database.php"; 
	include "helpers/format.php";
?>
<?php
	$db = new Database();
	$fm = new Format();
?>
<!DOCTYPE html>
<html>
<head>
	<title><?php echo $fm->title(); ?></title>
	<meta name="language" content="English">
	<meta name="description" content="It is a website about education">
	<meta name="keywords" content="blog,cms blog">
	<meta name="author" content="Delowar">
	<link rel="stylesheet" href="font-awesome-4.5.0/css/font-awesome.css">	
	<link rel="stylesheet" href="css/nivo-slider.css" type="text/css" media="screen" />
	<link rel="stylesheet" href="style.css">
	<script src="js/jquery.js" type="text/javascript"></script>
	<script src="js/jquery.nivo.slider.js" type="text/javascript"></script>

<script type="text/javascript">
$(window).load(function() {
	$('#slider').nivoSlider({
		effect:'random',
		slices:10,
		animSpeed:500,
		pauseTime:5000,
		startSlide:0, //Set starting Slide (0 index)
		directionNav:false,
		directionNavHide:false, //Only show on hover
		controlNav:false, //1,2,3...
		controlNavThumbs:false, //Use thumbnails for Control Nav
		pauseOnHover:true, //Stop animation while hovering
		manualAdvance:false, //Force manual transitions
		captionOpacity:0.8, //Universal caption opacity
		beforeChange: function(){},
		afterChange: function(){},
		slideshowEnd: function(){} //Triggers after all slides have been shown
	});
});
</script>
</head>

<body>
	<div class="headersection templete clear">
		<a href="index.php">
			<div class="logo">
			<?php
				$query = "SELECT * FROM tbl_slogan";
				$slogan = $db->select($query);
				if($slogan){
					while($result = $slogan->fetch_assoc()){
			?>
				<img src="admin/<?php echo $result['logo'] ?>" alt="Logo"/>
				<h2><?php echo $result['title'] ?></h2>
				<p><?php echo $result['slogan'] ?></p>
				<?php 	} } else{ ?>
					<p>No slogan found !</p>
			<?php	} ?>
			</div>
		</a>
		<div class="social clear">
			<div class="icon clear">
			<?php
				$query = "SELECT * FROM tbl_social WHERE id='1'";
				$slogan = $db->select($query);
				if($slogan){
					while($presult = $slogan->fetch_assoc()){
			?> 
				<a href="<?php echo $presult['facebook'] ?>" target="_blank"><i class="fa fa-facebook"></i></a>
				<a href="<?php echo $presult['twitter'] ?>" target="_blank"><i class="fa fa-twitter"></i></a>
				<a href="<?php echo $presult['linkedin'] ?>" target="_blank"><i class="fa fa-linkedin"></i></a>
				<a href="<?php echo $presult['gp'] ?>" target="_blank"><i class="fa fa-google-plus"></i></a>
				<?php } }?>
			</div>
			<div class="searchbtn clear">
			<form action="search.php" method="get">
				<input type="text" name="search" placeholder="Search keyword..."/>
				<input type="submit" name="submit" value="Search"/>
			</form>
			</div>
		</div>
	</div>
<div class="navsection templete">
	<ul>
	<?php 
		$path = $_SERVER['SCRIPT_FILENAME'];
        $currentpage = basename($path, '.php');
	?>
		<li><a <?php if($currentpage=='index'){ echo 'id="active"'; } ?> href="index.php">Home</a></li>
		<li><a <?php if($currentpage=='about'){ echo 'id="active"'; } ?> href="about.php">About Us</a></li>
		<li><a <?php if($currentpage=='contact'){ echo 'id="active"'; } ?>href="contact.php">Contact Us</a></li>
	</ul>
</div>