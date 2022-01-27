<?php
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['login_dealer'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);

        $mysqliA = new mysqli('localhost','root','','advice') or die(mysqli_error($mysqli));
        $resultA = $mysqliA->query("SELECT * FROM dealer") or die($mysqli->error);
       
        $password = md5($password);
        $query = "SELECT * FROM dealer WHERE DEALER_EMAIL='$email' AND DEALER_PASS='$password' " ;
        $result = mysqli_query($conn,$query);

        
        while ($row=$resultA->fetch_assoc()){
            if($email===$row['DEALER_EMAIL']){
                $dl_id = $row['DEALER_ID'];
                $_SESSION['dl_id']=$dl_id;
                
            }
        }

        if(mysqli_num_rows($result)==1){
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Your are now logged in";
            header("location: item.php");

        }else{
            $_SESSION['error'] = "ตรวจสอบอีเมลล์และรหัสผ่าน";
            header("location: login_dealer.php");
        }
    
    }


?>