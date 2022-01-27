<?php
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['login_user'])){
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $password = mysqli_real_escape_string($conn,$_POST['password']);
        
       
        $password = md5($password);
        $query = "SELECT * FROM customers WHERE CUS_EMAIL='$email' AND CUS_Password='$password'" ;
        $result = mysqli_query($conn,$query);

        if(mysqli_num_rows($result)==1){
            $_SESSION['email'] = $email;
            $_SESSION['success'] = "Your are now logged in";
            header("location: user_homepage.php");

        }else{
            $_SESSION['error'] = "ตรวจสอบอีเมลล์และรหัสผ่าน";
            header("location: login.php");
        }
    
    }


?>