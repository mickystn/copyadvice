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
                                    <?php if(isset($_SESSION['email'])):?>
                                        <p>Welcome <?php echo $_SESSION['email'];?></p>
                                        <p><a href="index.php?logout='1">Logout</a></p>
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
    <div class="user-login-box " style="max-width: 500px; margin: auto;">
        <div class="container-form" >
            <form class= "form-reg"action="add_item_db.php" method="post" enctype="multipart/form-data" >
                <?php  
                    $mysqli = new mysqli('localhost','root','','advice') or die(mysqli_error($mysqli));
                    $result = $mysqli->query("SELECT * FROM category") or die($mysqli->error);
                ?>
                <h1>ลงทะเบียนสินค้า</h1>
                <div class="user-details text-left">
                    <div class="input-box">
                        <span class="details">Name</span>
                        <input type="text"  name="name" placeholder="ชื่อสินค้า" required>
                    </div>
                    <div class="input-box">
                    </div>
                    <div class="input-box">
                        <span class="details">Price</span>
                        <input type="text"  name="price"placeholder="ราคา" required>
                    </div>
                    <div class="input-box">
                        <span class="details">Quatity</span>
                        <input type="text"  name="qua"placeholder="จำนวน" required>
                    </div>
                    
                    <div style="margin-top :15px;">
                        <span class="details">Category</span>
                        <div >
                            <select name="cate"class="form-control" style="width:300px; height:52px">
                                <?php
                                    while ($row=$result->fetch_assoc()){
                                        $namecate=$row['NAME_CATE'];
                                        echo "<option>$namecate</option>";
                                    }?>
                            </select>
                        </div>
                    </div>
                    
                    <div style="margin-top :15px;">
                        <span class="details">Upload Picture</span><br>
                        <input type="file" class= "upload-box" name="img" required>
                    </div>
                </div>
                <button class="btn-reg text-left" name="add_item">Submit</button>
            </form>
        </div>
    </div>
</body>
</html>