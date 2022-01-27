<?php
    session_start();
    include('server.php');
    $id = $_GET['NO_ITEM'];

    $sql = "SELECT * FROM orderlist WHERE NO_ITEM ='$id'";
    $re = mysqli_query($conn,$sql);
    $result = mysqli_fetch_assoc($re);
    $no_order = $result['NO_ORDER'];

    $sql = "DELETE FROM orderlist WHERE NO_ITEM='$id'";
    mysqli_query($conn, $sql);
    $sql = "DELETE FROM orderitem WHERE NO_ORDER='$no_order'";
    mysqli_query($conn, $sql);

    $sql = "DELETE FROM item WHERE NO_ITEM ='$id'";
    
    if(mysqli_query($conn, $sql)){
        echo $id;
    }
    header('location:item.php');

?>