<?php 
    include 'server.php';
    session_start();
    if(!empty($_SESSION['cart'])){
        foreach($_SESSION["cart"] as $k=>$v){
            if($v['NO_ITEM']==$_GET['minus']){
                if($v['QUA_ITEM']==1){
                    echo count($_SESSION['cart']);
                    //print_r( $_SESSION['cart'][$k]);
                    unset($_SESSION['cart'][$k]);
                    echo count($_SESSION['cart']);
                }else{
                    $newqua = $v['QUA_ITEM'] -1;
                    $item_array = array(
                        'NO_ITEM'=>$v['NO_ITEM'],
                        'Item_Name'=>$v['Item_Name'],
                        'PRICE'=>$v['PRICE'],
                        'QUA_ITEM'=>$newqua,
                    );
                    $_SESSION["cart"][$k]=$item_array;
                }

            }
            if(empty($_SESSION["cart"])){
                unset($_SESSION["cart"]);
            }
        }
    }
    
    //print_r(array_filter($_SESSION['cart'][1]));
    
    header('location:cart.php');
?>