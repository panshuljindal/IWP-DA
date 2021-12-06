<?php

// session_start();
 

// if(isset($_SESSION["userid"]) && $_SESSION["userid"] === true){
//     header("location: items.php");
//     exit;
// }
    require_once "session.php";
    require_once "config.php";

    $error= '';
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['loginBtn'])){
        $email = trim($_POST['email']);
        $pswd= trim($_POST['pswd']);
       // $pswhas = password_hash($pswd, PASSWORD_BCRYPT);

        if(empty($email)){
            $error.='<p> Please enter email. </p>';
        }
        if(empty($pswd)){
            $error.='<p> Please enter password. </p>';
        }

        if(empty($error)){
            $query = "select * from users where email = '$email'";
            $result = mysqli_query($db,$query);
            if($result){
                if (mysqli_num_rows($result) > 0) {
               
                $row = mysqli_fetch_assoc($result);
                    if($row['password'] == $pswd ){
                        session_start();
                        $_SESSION["userid"] = $row['id'];
                        $_SESSION["name"] = $row['name'];
                        $_SESSION["email"] = $row['email'];
                        echo "Login Successful";
                        header("location: items.php");
                        exit;
                    }
                    else{
                        $error.= '<p> The password is incorrect!<p/>';
                        echo $error;
                    }
                       
                }
                else{
                    $error .= '<p> No user exists with this email address. </p>';
                   echo $error;
                   }
               }
       }
       echo $error;
       mysqli_close($db);
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="index.css">
    <title>Login</title>
</head>
<body>
    <a class="adminLogin" href="adminLogin.php">Admin Login</a>
    <div class="center" style="margin-top: 180px;">
    <div class = "signup">Login</div>
    <div>
        <p class="fillDetails">
            Please enter your email and password to login
        </p>
        <form action='login.php' method='post'>
            <label class ="inputLabel"for="email">Email ID</label>
            <input class="editField" type="email" name="email" id = "email"><br/>

            <label class ="inputLabel" for="pswd">Password</label>
            <input class="editField" type="password" name="pswd" id = "pswd"><br/>

            <input type="submit" id="btn"name="loginBtn">

        </form>
    </div>

    <div  class="fillDetails"> Do not have an account? 
        <a href="signup.php"style="text-decoration: underline; color: #fff; text-align: center;">Signup </a>
    </div>
    </div>

</body>
</html>