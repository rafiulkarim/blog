<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">

<?php
    if(!isset($_GET['catid']) || $_GET['catid'] == NULL){
        header("Location: catlist.php");
    }else{
        $id = $_GET['catid'];
    }
?>

    <div class="box round first grid">
        <h2>View Category</h2>
        <div class="block copyblock"> 
        <?php
            $query = "SELECT * FROM tbl_category WHERE id='$id'";
            $category = $db->select($query);
            if($category){
            while($result = $category->fetch_assoc()){
        ?>
            <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" value="<?php echo $result['name']; ?>" class="medium" name="name" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
            <?php } } ?>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?> 