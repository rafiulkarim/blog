<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['replayid']) || $_GET['replayid'] == NULL){
        header("Location: inbox.php");
    }else{
        $id = $_GET['replayid'];
    }

?>
<?php
    if($_SERVER['REQUEST_METHOD']=='POST'){
        $to = mysqli_real_escape_string($db->link, $_POST['tomail']);
        $from = mysqli_real_escape_string($db->link, $_POST['frommail']);
        $subject = mysqli_real_escape_string($db->link, $_POST['subject']);
        $body = mysqli_real_escape_string($db->link, $_POST['body']);

        $sendmail = mail($to, $subject, $body, $from);

		if($sendmail){
			echo "<span style='color:red;'>No result found !</span>";
		}else{
			echo "<span style='color:red;'>Mail does not sent !</span>";
		}
	}
?>
<div class="grid_10">

<div class="box round first grid">
    <h2>Reply message</h2>
    <div class="block">      
    <form action="" method="post">
        <?php
            $query = "SELECT * FROM tbl_contact where id='$id'";
            $conlist = $db->select($query);
            if($conlist){
                while($result = $conlist->fetch_assoc()){
        ?>
        <table class="form">
            <tr>
                <td>
                    <label>To: </label>
                </td>
                <td>
                    <input type="text" readonly value="<?php echo $result['email']?>" class="medium" name="tomail" />
                </td>
            </tr>
            <tr>
                <td>
                    <label>From: </label>
                </td>
                <td>
                    <input type="text" value="rafiulkarim51@gmail.com" class="medium" name="frommail" readonly/>
                </td>
            </tr>
            <tr>
                <td>
                    <label>Subject</label>
                </td>
                <td>
                    <input type="text" placeholder="Enter your Subject" class="medium" name="subject" />
                </td>
            </tr>
          
            <tr>
                <td style="vertical-align: top; padding-top: 9px;" name="body">
                    <label>Message</label>
                </td>
                <td>
                    <textarea class="tinymce" >
                      
                    </textarea>
                </td>
            </tr>
            
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="OK" />
                </td>
            </tr>
        </table>
        <?php } } ?>
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