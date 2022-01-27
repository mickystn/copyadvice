<?php 
    include 'server.php';
    session_start();
    foreach($_SESSION["cart"] as $k=>$v){
        if($v['NO_ITEM']==$_GET['remove']){
            unset($_SESSION['cart'][$k]);
        }
        if(empty($_SESSION["cart"])){
            unset($_SESSION["cart"]);
        }
    }
    header('location:cart.php');
?>