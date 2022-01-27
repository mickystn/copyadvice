<?php 
    session_start();
    include('server.php');

    $errors = array();

    if(isset($_POST['reg_user'])){
        $name1 = mysqli_real_escape_string($conn,$_POST['name1']);
        $name2 = mysqli_real_escape_string($conn,$_POST['name2']);
        $name = $name1.' '.$name2;
        $email = mysqli_real_escape_string($conn,$_POST['email']);
        $address = mysqli_real_escape_string($conn,$_POST['address']);
        $birth = mysqli_real_escape_string($conn,$_POST['bd']);
        $number = mysqli_real_escape_string($conn,$_POST['number']);
        $pass1 = mysqli_real_escape_string($conn,$_POST['pass1']);
        $pass2 = mysqli_real_escape_string($conn,$_POST['pass2']);

        if($pass1!==$pass2){
            array_push($errors,"Two password dont match");
        }
        $user_check_query = "SELECT * FROM customers WHERE CUS_EMAIL = '$email' ";
        $query = mysqli_query($conn,$user_check_query);
        $result = mysqli_fetch_assoc($query);

        if($result){
            if($result['CUS_EMAIL']===$email){
                array_push($errors,"Email already exists");
            }
        }
        if(count($errors)==0){
            $password=md5($pass1);
            
            $sql = "INSERT INTO customers(CUS_NAME,CUS_ADD,CUS_BD,CUS_TEL,CUS_EMAIL,CUS_Password) VALUES ('$name','$address','$birth','$number','$email', '$password')";   
            mysqli_query($conn,$sql);

            $_SESSION['email']=$email;
            $_SESSION['success']= "Login complete!";
            header('location: login.php');
        }else{
            $_SESSION['error'] = "wrong";
            header('location: register.php');
        }
    }

?>