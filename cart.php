<?php include 'server.php'?>

<?php
    session_start();
    if(!isset($_SESSION['email'])){
        $_SESSION['msg'] = "Login frist!";
        header('location: login_dealer.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['email']);
        header('location:login_dealer.php');
    }
    
    
    
    if(isset($_GET['pc'])){
        if(!empty($_SESSION["cart"])){
            $date = date('Y-m-d');
            $date1 = str_replace('-','/',$date);
            $warranty = date('Y-m-d',strtotime($date1 ."2 years"));
            $timestamp = strtotime("now");
            $sql = "INSERT INTO receipt(DATE_RECEIPT,DATE_WARRANTY,Timestamp) VALUES ('$date','$warranty','$timestamp')";  
                
            mysqli_query($conn,$sql);

            $sql = "SELECT * FROM receipt " ;
            $re = mysqli_query($conn,$sql);
            
            while($result = mysqli_fetch_assoc($re)){
                if($result['Timestamp']==$timestamp){
                    $receipt = $result['NO_RECEIPT'];
                }
            }
            $sql = "SELECT * FROM customers " ;
            $re = mysqli_query($conn,$sql);
            while($result = mysqli_fetch_assoc($re)){
                if($result['CUS_EMAIL']==$_SESSION['email']){
                    $cusid = $result['CUS_ID'];
                }
            }
            $sql = "SELECT * FROM orderitem ORDER BY NO_ORDER DESC  " ;
            $re = mysqli_query($conn,$sql);
            $result = mysqli_fetch_assoc($re);
            $str = $result['NO_TRACK'];
            $no_track = "nt".(int)substr($str,2)+1;
            $total = $_SESSION['price'];
            $sql = "INSERT INTO orderitem(NO_TRACK,NO_RECEIPT,CUS_ID,PRICE) VALUES ('$no_track','$receipt','$cusid','$total')";
            mysqli_query($conn,$sql);
            

            unset($_SESSION['price']);

            $sql = "SELECT * FROM purchistory ORDER BY Purchase_ID DESC  " ;
            $re = mysqli_query($conn,$sql);
            $result = mysqli_fetch_assoc($re);
            $str = $result['Purchase_ID'];
            $purcid = (int)$str + 1;
            $sql = "INSERT INTO purchistory(Purchase_ID,DATE_RECEIPT,DATE_WARRANTY,CUS_ID) VALUES ('$purcid','$date','$warranty','$cusid')";
            mysqli_query($conn,$sql);


            $sql = "SELECT * FROM orderitem WHERE NO_TRACK='$no_track' AND NO_RECEIPT='$receipt' AND CUS_ID='$cusid'";
            $re = mysqli_query($conn,$sql);
            $result = mysqli_fetch_assoc($re);



            $no_order = $result['NO_ORDER'];
            foreach($_SESSION["cart"] as $k=>$v){
                $no_item = $v['NO_ITEM'];
                $qua =  $v['QUA_ITEM'];
                $pricet = $v['PRICE'] * $v['QUA_ITEM'];
                $sqls = "INSERT INTO orderlist(NO_ORDER,NO_ITEM,QUA_ORDER,PRICE) VALUES ('$no_order','$no_item','$qua','$pricet')";
                mysqli_query($conn,$sqls);

                $sql = "SELECT * FROM item WHERE NO_ITEM='$no_item'";
                $re = mysqli_query($conn,$sql);
                $result = mysqli_fetch_assoc($re);
                    
                $nameitem = $result['Item_Name'];
                $sql = "INSERT INTO purcdetail(Purchase_ID,Item_Name,PRICE,QUA_ITEM) VALUES ('$purcid','$nameitem','$pricet','$qua')";
                mysqli_query($conn,$sql);
                
            }

            

            
            
            

            unset($_SESSION['cart']);
        }else{
            header('location:user_homepage.php');
            
        }
    }
    if(isset($_GET['rm'])){
        unset($_SESSION['cart']);
    }


    if(isset($_GET['atc'])){

        $id = $_GET['atc'];
        $sql = "SELECT * FROM item ";
        if(isset($_GET['atc']) ){
            $sql.= " WHERE NO_ITEM = '".$_GET['atc']."'";
        }
        $result_item = mysqli_query($conn,$sql);
        $qua_start=1;
        $row=mysqli_fetch_assoc($result_item);
        if(isset($_SESSION["cart"])){
            $item_arr_id=array_column($_SESSION["cart"],"NO_ITEM");
            if(!in_array($_GET['atc'],$item_arr_id)){
                $count = count($_SESSION["cart"]);
                $item_array = array(
                    'NO_ITEM'=>$row['NO_ITEM'],
                    'Item_Name'=>$row['Item_Name'],
                    'PRICE'=>$row['PRICE'],
                    'QUA_ITEM'=>1,
                );
                array_push($_SESSION['cart'],$item_array);
                //$_SESSION["cart"][$count]=$item_array;
            }

        }else{
            $item_array = array(
                'NO_ITEM'=>$row['NO_ITEM'],
                'Item_Name'=>$row['Item_Name'],
                'PRICE'=>$row['PRICE'],
                'QUA_ITEM'=>1,
            );
            $_SESSION["cart"][0]=$item_array;
        }
    }

    $total=0;

    //unset($_SESSION["cart"]);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Kanit:wght@100;200;300&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="style.css">
    <script src="https://kit.fontawesome.com/b99e675b6e.js"></script>
</head>
<body> 
    <header class="header"><div class="bg-header">
            <div class="container">
                
                <div class="header-all">
                    <div class="col-2 logo p-0">
                        <a href="user_homepage.php">
                            <img src="https://img.advice.co.th/images_nas/advice/oneweb/assets/images/logo.png" class="img-fluid">
                        </a>
                    </div>
                    <div class="col-10 head-func">
                        <div class="row" style="height:38px">
                            <div class="col-7">
                                <form class="form-search-new">
                                    <div class="form-group search-block">
                                        <div class="btn btn_common">
                                            <i class="fa fa-search"></i>
                                        </div>
                                        <div class="easy-autocomplete" style="width:569px;">
                                            <input type="text" class="form-control search-txtbox" placeholder="ค้นหาสินค้า ประเภทสินค้า แบรนด์" label="keyword">

                                        </div>
                                        
                                    </div>
                                </form>
                            </div>
                            <div class="col">
                                <div class="header-icon">
                                    <?php if(isset($_SESSION['email'])): ?>
                                        <p>Welcome <?php echo $_SESSION['email'];?></p>
                                        <p><a href="index.php?logout">Logout </a></p>
                                        
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="header-icon">
                                <li class="item" style="padding-top:10px; margin-left:20px"><a href="user_homepage.php" style="color:white;">สินค้า</a></li>
                                <li class="item" style="padding-top:10px; margin-left:20px"><a href="cart.php" style="color:white;">ตระกร้า</a></li>
                                <li class="item" style="padding-top:10px; margin-left:20px"><a href="purchase_his.php" style="color:white;">ประวัติการซื้อขาย</a></li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <div class="user-login-box" style="margin:auto;">
        <div class="container-form" >
            <form class= "sg"action="delete_item_db.php , edit_item_db.php" method="post" > 
                <table style="width:750px">
                    <tr class="text-left"> 
                        <td style="width:40%; font-size: 30px; font-weight: 900;">ชื่อ</td>
                        <td style="width:20%; font-size: 30px; font-weight: 900;">ราคา</td>
                        <td style="width:20%; font-size: 30px; font-weight: 900;">จำนวน</td>
                    </tr>
                    
                    <?php
                        if(!empty($_SESSION["cart"])){
                            
                            foreach($_SESSION["cart"] as $k=>$v){
                                ?>
                                <tr class="text-left">
                                    <td style="font-size: 20px;font-weight: 400;"><?php echo $v["Item_Name"]?></td>
                                    <td style="font-size: 20px;font-weight: 400;"><?php echo $v["PRICE"]?></td>
                                    <td style="font-size: 20px;font-weight: 400;"><?php echo $v["QUA_ITEM"]?></td>
                                    <td style="font-size: 20px;font-weight: 400;"><a class="btn-pm" href="add.php?add=<?=$v['NO_ITEM']?>">+</a></td>
                                    <td style="font-size: 20px;font-weight: 400;"><a class="btn-pm" href="minus.php?minus=<?=$v['NO_ITEM']?>">-</a></td>
                                    <td style="font-size: 20px;font-weight: 400;"><a class="btn-pm" href="remove.php?remove=<?=$v['NO_ITEM']?>">Remove</a></td>
                                </tr>
                                <?php
                                $total = $total + ($v['PRICE']*$v['QUA_ITEM']);
                                
                                $_SESSION['price']=$total;
                            }
                        }else{
                            
                        }

                        
                    ?>
                </table>
                <table style="width:750px; margin-top:100px">
                    <tr >
                        <td></td>
                        <td style="font-size: 20px;font-weight: 700; width:10% ">ราคารวม</td>
                        <td style="font-size: 20px;font-weight: 700; width:10%  "><?php echo $total?></td>
                        <td style="font-size: 20px;font-weight: 700; width:10% ">บาท</td>
                        
                    </tr>
                </table>
                <table style="width:750px; margin-top:20px">
                    <tr>
                        <td></td>
                        <td style="width:10% "><a style= "padding:7px;" name="add" class="btn-del"href="cart.php?pc">ซื้อสินค้า</a></td>
                        <td style="width:20% "><a style= "padding:7px; " name="add" class="btn-del"href="cart.php?rm">ลบสินค้าทั้งหมด</a></td>
                        
                    </tr>
                </table>
                
                
            </form>
        </div>
    </div>
    
</body>
</html>