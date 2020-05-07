<div class="slidersection templete clear">

	<div id="slider">
		<?php
			$query = "SELECT * FROM tbl_slider";
			$slider_list = $db->select($query);
			if($slider_list){
				while($result = $slider_list->fetch_assoc()){
		?>
		<a href="#"><img src="admin/<?php echo $result['image'] ?>" alt="nature 1" title="<?php echo $result['title'] ?>" /></a>
		<?php } }else{?>
			<h1>NO SLIDER FOUND</h1>
			
		<?php } ?>
	</div>
	
</div>