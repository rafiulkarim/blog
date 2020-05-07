<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<div class="grid_10">

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
                    $query = "INSERT INTO tbl_category(name) VALUES('$name')";
                    $result = $db->insert($query);
                    if($result){
                        echo "<span style='color:green;'>Category inserted succesfully !</span>";
                    }else{
                        echo "<span style='color:green;'>Category not inserted !</span>";
                    }
                }
            }
        ?>
            <form action="" method="post">
            <table class="form">					
                <tr>
                    <td>
                        <input type="text" placeholder="Enter Category Name..." class="medium" name="name" />
                    </td>
                </tr>
                <tr> 
                    <td>
                        <input type="submit" name="submit" Value="Save" />
                    </td>
                </tr>
            </table>
            </form>
        </div>
    </div>
</div>
<?php include "inc/footer.php"; ?> 