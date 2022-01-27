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
    $sql = "SELECT * FROM item ";
    if(isset($_GET['ID_CATE']) ){
        $sql.= " WHERE ID_CATE = '".$_GET['ID_CATE']."'";
    }



    $result_item = mysqli_query($conn,$sql);
    
    $query = "SELECT * FROM category ";
    $result_cate = mysqli_query($conn,$query);



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
                        <a href="item.php">
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
                                <li class="item" style="padding-top:10px; margin-left:20px"><a href="item.php" style="color:white;">สินค้า</a></li>
                                <li class="item" style="padding-top:10px; margin-left:15px"><a href="add_item.php" style="color:white;">เพิ่มสินค้า</a></li>
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
                <div class="full-menu-with-category ">
                    <div class="vertical-menu-category">
                        <ul class="cate-list text-left">
                            <a href="item.php">Home</a>
                            <?php
                                while($row=mysqli_fetch_assoc($result_cate)){
                                    ?>
                                        <li class="sub-cate">
                                            <a href="?ID_CATE=<?=$row['ID_CATE']?>"><?=$row['NAME_CATE']?></a>
                                        </li>
                                    <?php
                                } 
                            ?>
                        </ul>
                    </div>
                    <div class="landing-product-block">
                        <div class="product-column-4">
                            <div class="product-grid">
                                <?php
                                    $count=0;
                                    while($row=mysqli_fetch_assoc($result_item)){
                                        $count = $count+1;
                                        ?>  
                                            
                                            <div class="photo-grid-item text-left">
                                                <img src="image/<?=$row['ITEM_IMG']?>" alt="">
                                                <div class="itemname"><?=$row['Item_Name']?></div>

                                                <div style="color: #0095da; padding-top:10px; padding-bottom:5px"><?=number_format($row['PRICE'],2)?> </div>
                                                <a style= "padding:7px; margin-top:30px;" class="btn-del"href="delete_item_db.php?NO_ITEM=<?=$row['NO_ITEM']?>">ลบ</a>
                                                <a style= "padding:7px" class="btn-del"href=" edit_item.php?NO_ITEM=<?=$row['NO_ITEM']?>">แก้ไขสินค้า</a>
                                            </div>
                                        <?php
                                    } 
                                    if($count===0){
                                        ?> 
                                        <div class="photo-grid-item text-left">
                                            <h2>No Items Available</h2>
                                        </div>
                                        <?php   
                                    }

                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>