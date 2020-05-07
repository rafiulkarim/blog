<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['deleteid']) || $_GET['deleteid'] == NULL){
        header("Location: postlist.php");
    }else{
        $postid = $_GET['deleteid'];

        $query = "SELECT * FROM tbl_post WHERE id='$postid'";
        $getdata = $db->select($query);

        if($getdata){
            while($delimg = $getdata->fetch_assoc()){
                $dellink = $delimg['image'];
                unlink($dellink);
            }
        }

        $delquery = "DELETE FROM tbl_post WHERE id='$postid'";
        $delData = $db->delete($delquery);

        if($delData){
            echo "<script> alert('Data deleted successfully')</script>";
            echo "<script>window.location = 'postlist.php';</script>";
            //header("Location: postlist.php");
            
        }else{
            echo "<script> alert('Data does not deleted')</script>";
            //header("Location: postlist.php");
            echo "<script>window.location = 'postlist.php';</script>";
        }
    }
?>