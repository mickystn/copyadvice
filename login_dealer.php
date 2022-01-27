
<?php 
    session_start();
    include('server.php'); ?>


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
    
</head>
<body>
    <header class="header">
        <div class="bg-header">
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
                            <div class="col" style="left:15%">
                                <div class="header-icon">
                                    <ul class="item" style="width: 30%;">
                                        <li></li>
                                    </ul>
                                    <ul class="item">
                                        <li>เข้าสู่ระบบ
                                            <ul>
                                                <li>
                                                    <a href="login.php">เข้าสู่ระบบ</a>
                                                </li>
                                                <li>
                                                    <a href="register.php">สมัครสมาชิก</a>
                                                </li>
                                            </ul>
                                        </li>
                                        
                                    </ul>
                                    
                                    
                                </div>
                                
                            </div>
                            
                        </div>
                        <div class="row">
                            <div class="header-icon">
                                <li class="item" style="padding-top:10px; margin-left:20px"><a href="item.php" style="color:white;">สินค้า</a></li>
                                <li class="item" style="padding-top:10px; margin-left :15px; color:;"><a href="login_dealer.php "style="color:white;">ดีลเลอร์</a></li>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <form class="form-login"action="login_dealer_db.php" method="post" style="margin: auto" >
        <div class="container">
            <div class="col-12 col-md-6 wrapper .container">
                
                <div class="user-login-box">
                        <?php include 'errors.php'; ?>
                        <?php if(isset($_SESSION['error'])) :?>
                            <div class="error">
                                <?php unset($_SESSION['error']); ?>
                                <script type='text/javascript'>alert('Email Already Exist');</script>
                            </div>
                        <?php endif?>
                        <div class="col-12 text-left mb-3">
                            <h1 class="mb-0">เข้าสู่ระบบ</h1>
                            <b>ยินดีต้อนรับเข้าสู่ระบบ Dealer ทุกท่าน</b>
                        </div>
                        <div class="col-12 text-left mb-3">
                            <b>Email</b>
                            <input type="email" class = "form-control" name="email" placeholder="Email" required>
                        </div>
                        <div class="col-12 text-left">
                            <b>Password</b>
                            <input type="password" class = "form-control" name="password" placeholder="Password" required>
                        </div>
                        <div class="col-12 text-left">
                            <a href="reg_dealer.php">สมัครเป็นตัวแทนขายสินค้า</a>
                            <button name="login_dealer" class="btn-login text-left">Login</button>
                        </div>
                </div>
            </div>
        </div>
    </form>
</body>
</html>