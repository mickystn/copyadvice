<?php
    session_start();
    include('server.php');
    if(isset($_POST['add_item'])&&isset($_FILES['img'])){

        $nameitem = $_POST['name'];
        $cate = $_POST['cate'];
        $price = $_POST['price'];
        $qua = $_POST['qua'];

        $email = $_SESSION['email'];

        $sql = "SELECT * FROM dealer WHERE DEALER_EMAIL='$email' " ;
        $re = mysqli_query($conn,$sql);
        $result = mysqli_fetch_assoc($re);
        $dl_id = $result['DEALER_ID'];


        //$dl_id = $_SESSION['dl_id'];
        echo $_SESSION['email'];


        $img_name = $_FILES['img']['name'];
        $img_temp = $_FILES['img']['tmp_name'];
        $img_type = $_FILES['img']['type'];
        $filepath = 'image/'.$img_name;
        $filetitle = $_POST['name'];

        move_uploaded_file($img_temp,$filepath);

        $mysqliA = new mysqli('localhost','root','','advice') or die(mysqli_error($mysqli));
        $resultA = $mysqliA->query("SELECT * FROM category") or die($mysqli->error);
        while ($row=$resultA->fetch_assoc()){
            if($cate===$row['NAME_CATE']){
                $cate_id = $row['ID_CATE'];
            }
        }

        $sql = "INSERT INTO item(Item_Name,PRICE,QUA_ITEM,ITEM_IMG,DEALER_ID,ID_CATE) 
                VALUES('$nameitem','$price','$qua','$img_name','$dl_id','$cate_id')";
        mysqli_query($conn, $sql);
        header("location: item.php");
        

    }





?>