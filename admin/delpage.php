<?php include "inc/header.php"; ?>
<?php include "inc/sidebar.php"; ?>
<?php
    if(!isset($_GET['delpageid']) || $_GET['delpageid'] == NULL){
        header("Location: pagelist.php");
    }else{
        $pageid = $_GET['delpageid'];

        // $query = "SELECT * FROM tbl_addpages WHERE id='$pageid'";
        // $getdata = $db->select($query);

        // if($getdata){
        //     while($delimg = $getdata->fetch_assoc()){
        //         $dellink = $delimg['image'];
        //         unlink($dellink);
        //     }
        // }

        $delquery = "DELETE FROM tbl_addpages WHERE id='$pageid'";
        $delData = $db->delete($delquery);

        if($delData){
            echo "<script> alert('Data deleted successfully')</script>";
            echo "<script>window.location = 'pagelist.php';</script>";
            //header("Location: postlist.php");
            
        }else{
            echo "<script> alert('Data does not deleted')</script>";
            //header("Location: postlist.php");
            echo "<script>window.location = 'pagelist.php';</script>";
        }
    }
?>