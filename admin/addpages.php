<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">

<div class="box round first grid">
    <h2>Add New Page</h2>
    <div class="block">      
    <?php
        if($_SERVER['REQUEST_METHOD']=='POST'){
            $pageName = mysqli_real_escape_string($db->link, $_POST['pageName']);
            $body = mysqli_real_escape_string($db->link, $_POST['body']);
            

            if(empty($pageName) || empty($body) ){
                echo "<span style='color:red; '>Field must not be empty !</span>";
            }else{
                $query = "INSERT INTO tbl_addpages(pageName, body) VALUES('$pageName', '$body')";
                $result = $db->insert($query);
                if($result){
                    echo "<span style='color:green;'>Page created succesfully !</span>";
                }else{
                    echo "<span style='color:green;'>page does not created !</span>";
                }
            }
        }
    ?>

        <form action="addpages.php" method="post">
        <table class="form">
            
            <tr>
                <td>
                    <label>Title</label>
                </td>
                <td>
                    <input type="text" placeholder="Enter Post Title..." class="medium" name="pageName" />
                </td>
            </tr>
          
            <tr>
                <td style="vertical-align: top; padding-top: 9px;">
                    <label>Content</label>
                </td>
                <td>
                    <textarea class="tinymce" name="body"></textarea>
                </td>
            </tr>
            
            <tr>
                <td></td>
                <td>
                    <input type="submit" name="submit" Value="Create" />
                </td>
            </tr>
        </table>
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