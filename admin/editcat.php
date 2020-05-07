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
        <h2>Add New Category</h2>
        <div class="block copyblock"> 
        <?php
            if($_SERVER['REQUEST_METHOD']=='POST'){
                $name = $fm->validation($_POST['name']);  
                $name = mysqli_real_escape_string($db->link, $name);
                if(empty($name)){
                    echo "<span style='color:red;'>Field must not be empty !</span>";
                }else{
                    $query = "UPDATE tbl_category SET name='$name' WHERE id='$id' ";
                    $result = $db->update($query);
                    if($result){
                        echo "<span style='color:green;'>Category inserted succesfully !</span>";
                    }else{
                        echo "<span style='color:green;'>Category not inserted !</span>";
                    }
                }
            }
        ?>
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