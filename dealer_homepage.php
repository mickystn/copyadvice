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

?>
<?php include 'server.php'?>

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
                        <a href="index.php">
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
                                    <?php if(isset($_SESSION['email'])):?>
                                        <p>Welcome <?php echo $_SESSION['email'];?></p>
                                        <p><a href="index.php?logout='1">Logout</a></p>
                                    <?php endif;?>
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="header-icon">
                                <li class="item" style="padding-top:10px; margin-left:20px"><a href="dealer_homepage.php" style="color:white;">สินค้า</a></li>
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
            <div class="full-menu-with-category ">
                <div class="vertical-menu-category">
                    <div>Allitem</div>
                </div>
                <div class="landing-product-block">
                    <div class="product-column-4">
                        <div class="product-grid">
                            <?php
                                $query = "SELECT * FROM item ";
                                $result = mysqli_query($conn,$query);
                                while($row=mysqli_fetch_assoc($result)){
                                    ?>
                                        <div class="photo-grid-item text-left">
                                            <img src="image/<?=$row['ITEM_IMG']?>" alt="">
                                            <div class="itemname"><?=$row['Item_Name']?></div>

                                            <div style="color: #0095da; padding-top:10px;"><?=$row['PRICE']?> -</div>
                                            <button class="btn-cart " name="add_item">ใส่ตระกร้า</button>
                                        </div>
                                    
                                    
                                    <?php
                                } 
                            
                            ?>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
</body>
</html>