<?php
    session_start();
    include('server.php');


    if(isset($_POST['edit_item'])){
        $id = $_SESSION['id_tmp'];

        $itemname = $_POST['itemname'];
        $itemprice = $_POST['itemprice'];

        $sql = "UPDATE item SET Item_Name='$itemname', PRICE='$itemprice' WHERE NO_ITEM='$id'";
        mysqli_query($conn, $sql);
        unset($_SESSION['id_tmp']);
        header('location:item.php');

    }

?>