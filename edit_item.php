
<?php
    session_start();
    include('server.php');
    if(!isset($_SESSION['email'])){
        $_SESSION['msg'] = "Login frist!";
        header('location: login_dealer.php');
    }

    if(isset($_GET['logout'])){
        session_destroy();
        unset($_SESSION['email']);
        header('location:login_dealer.php');
    }
    $id = $_GET['NO_ITEM'];
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
    <div class="user-login-box" style="margin:auto;">
        <div class="container-form" style="margin-top:150px;">
            <form class= "form-reg"action="edit_item_db.php" method="post" >                          
                <div>
                    <h1>แก้ไขสินค้า</h1>
                    <table style="width:750px">
                        <tr class="text-left">
                            <th><h3>Name</h3></th>
                            <th><h3>Price</h3></th>
                        </tr>
                        
                        <?php
                            $query = "SELECT * FROM item WHERE NO_ITEM ='$id'";
                            $_SESSION['id_tmp']=$id;
                            $re = mysqli_query($conn,$query);
                            $row = mysqli_fetch_assoc($re);
                           ?>
                           
                            <tr class="text-left">
                                <th><?=$row['Item_Name']?></th>
                                <th><?=number_format($row['PRICE'])?></th>
                            </tr>
                            <tr class="text-left input-boxx" >
                                <th><input style="margin-top:30px; "  type="text" name="itemname" placeholder="ชื่อ" required></th>
                                <th><input style="margin-top:30px; "  type="text" name="itemprice" placeholder="ราคา" required></th>
                            </tr>
                            <tr class="text-left input-boxx">
                                <th><button style="margin-top:70px;" class="btn-reg text-left " name="edit_item">Submit</button></th>
                            </tr>
                            <?php
                            
                        ?>
                    </table>
                </div>
            </form>
        </div>
    </div>
    
</body>
</html>