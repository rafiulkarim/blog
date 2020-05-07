</div>

<div class="footersection templete clear">
  <div class="footermenu clear">
    <ul>
        <li><a href="index.php">Home</a></li>
        <li><a href="about.php">About Us</a></li>
        <li><a href="contact.php">Contact Us</a></li>
    </ul>
  </div>
  <?php
      $query = "SELECT * FROM tbl_copyright WHERE id='1'";
      $slogan = $db->select($query);
      if($slogan){
          while($presult = $slogan->fetch_assoc()){
		?> 
  <p>&copy; <?php echo $presult['copyright'] ?>. <?php echo date('Y') ?></p>
<?php } } ?>
</div>
<div class="fixedicon clear">
      <?php
				$query = "SELECT * FROM tbl_social WHERE id='1'";
				$slogan = $db->select($query);
				if($slogan){
					while($presult = $slogan->fetch_assoc()){
			?> 
    <a href="<?php echo $presult['facebook'] ?>" target="_blank"><img src="images/fb.png" alt="Facebook"/></a>
    <a href="<?php echo $presult['twitter'] ?>" target="_blank"><img src="images/tw.png" alt="Twitter"/></a>
    <a href="<?php echo $presult['linkedin'] ?>" target="_blank"><img src="images/in.png" alt="LinkedIn"/></a>
    <a href="<?php echo $presult['gp'] ?>" target="_blank"><img src="images/gl.png" alt="GooglePlus"/></a>
    <?php } }?>
</div>
<script type="text/javascript" src="js/scrolltop.js"></script>
</body>
</html>