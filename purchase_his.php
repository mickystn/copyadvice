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
    $sql = "SELECT * FROM orderitem " ;
    $result_order = mysqli_query($conn,$sql);

    $emailuser = $_SESSION['email'];

    $sql = "SELECT * FROM customers WHERE CUS_EMAIL='$emailuser'" ;
    $result_user = mysqli_query($conn,$sql);
    $cusid = mysqli_fetch_assoc($result_user);
    
    $sql = "SELECT * FROM orderlist " ;
    $result_orderlist = mysqli_query($conn,$sql);

    $sql = "SELECT * FROM purchistory";
    $result_purchistory = mysqli_query($conn,$sql);
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
            <form class= "sg"action="cart.php?NO_ITEM=" method="post" > 
                <table style="width:1200px; border:0.1px solid black; border-collapse: collapse; border-spacing: 0.5rem;">
                    <tr class="text-left " style="border:1px solid black; padding:10px"> 
                        <td style="width:5%; font-size: 30px; font-weight: 900;border:1px solid black;">ครั้งที่ซื้อ</td>
                        <td style="width:15%; font-size: 30px; font-weight: 900;border:1px solid black; padding:10px">ชื่อ</td>
                        <td style="width:10%; font-size: 30px; font-weight: 900;border:1px solid black; padding:10px">ราคา</td>
                        <td style="width:10%; font-size: 30px; font-weight: 900;border:1px solid black; padding:10px">จำนวน</td>
                        <td style="width:10%; font-size: 30px; font-weight: 900;border:1px solid black; padding:10px">วันที่ซื้อ</td>
                        <td style="width:10%; font-size: 30px; font-weight: 900;border:1px solid black; padding:10px">ประกัน</td>
                    </tr>
                    <?php
                        /*$count=1;
                        $counta=1;
                        $noordertmp;
                        while($result = mysqli_fetch_assoc($result_order)){
                            
                            if($result['CUS_ID']==$cusid['CUS_ID']){
                                $noordertmp=$result['NO_ORDER'];
                                $norecep = $result['NO_RECEIPT'];
                                $sql = "SELECT * FROM orderlist WHERE NO_ORDER='$noordertmp'";
                                $result_orderlist = mysqli_query($conn,$sql);
                                ?><tr class="text-left"><?php
                                
                                
                                while($row = mysqli_fetch_assoc($result_orderlist)){
                                    ?><tr class="text-left" style="border:0.5px solid black;"><?php
                                    
                                    $tmpname = $row['NO_ITEM'];
                                    $sql = "SELECT * FROM item WHERE NO_ITEM='$tmpname'";
                                    $result_name = mysqli_query($conn,$sql);
                                    $sql = "SELECT * FROM receipt WHERE NO_RECEIPT='$norecep'";
                                    $result_recep = mysqli_query($conn,$sql);
                                    $row1 = mysqli_fetch_assoc($result_name);
                                    $row2 = mysqli_fetch_assoc($result_recep);

                                    if($counta==1){
                                        ?><td style="border:0.5px solid black;padding:10px "> <?php echo $count;?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row1['Item_Name'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row['PRICE'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row['QUA_ORDER'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row2['DATE_RECEIPT'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row2['DATE_WARRANTY'];?> </td><?php
                                    }else{
                                        ?><td style="border:0.01px solid black;padding:10px"><?php echo $count;?></td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row1['Item_Name'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row['PRICE'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row['QUA_ORDER'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row2['DATE_RECEIPT'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $row2['DATE_WARRANTY'];?> </td><?php
                                    }
                                    $counta+=1;
                                    
                                    
                                }
                                $count+=1;
                                $counta=1;
                                ?></tr><?php
                            }
                            
                        }*/
                        $count=1;
                        $counta=1;
                        while($result= mysqli_fetch_assoc($result_purchistory)){
                            
                            ?><tr class="text-left"><?php
                            if($result['CUS_ID']==$cusid['CUS_ID']){
                                $purcid = $result['Purchase_ID'];

                                $sql = "SELECT * FROM purcdetail WHERE Purchase_ID='$purcid'" ;
                                $result_detail = mysqli_query($conn,$sql);
                                while($re= mysqli_fetch_assoc($result_detail)){
                                    ?><tr class="text-left" style="border:0.5px solid black;"><?php
                                    if($counta==1){
                                        ?><td style="border:0.5px solid black;padding:10px "> <?php echo $count;?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $re['Item_Name'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $re['PRICE'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $re['QUA_ITEM'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $result['DATE_RECEIPT'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $result['DATE_WARRANTY'];?> </td><?php
                                    }else{
                                        ?><td style="border:0.01px solid black;padding:10px"> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $re['Item_Name'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $re['PRICE'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $re['QUA_ITEM'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $result['DATE_RECEIPT'];?> </td><?php
                                        ?><td style="border:0.5px solid black;padding:10px"> <?php echo $result['DATE_WARRANTY'];?> </td><?php
                                    }
                                    $counta+=1;
                                }
                                $count+=1;
                                $counta=1;
                                ?></tr><?php
                                    
                            }
                        }
                    ?>
                </table>
            </form>
        </div>
    </div>
    
</body>
</html>