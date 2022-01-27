<?php 
    include 'server.php';
    session_start();
    
    foreach($_SESSION["cart"] as $k=>$v){
        if($v['NO_ITEM']==$_GET['add']){
            $newqua = $v['QUA_ITEM'] +1;
            $item_array = array(
                'NO_ITEM'=>$v['NO_ITEM'],
                'Item_Name'=>$v['Item_Name'],
                'PRICE'=>$v['PRICE'],
                'QUA_ITEM'=>$newqua,
            );
            $_SESSION["cart"][$k]=$item_array;
        }
    }
    header('location:cart.php');
?>