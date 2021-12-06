<?php
    session_start();
    $adminId = 'panshuljindal@gmail.com';
    $adminPswd= "1234";

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['adminLoginBtn'])){
        $ckid = $_POST['adId'];
        $ckpd = $_POST['adpd'];

        $error='';

        if(empty($ckid)){
            $error.='<p> Please enter email. </p>';
            
        }
        if(empty($ckpd)){
            $error.='<p> Please enter password. </p>';
        }

      
        
        if(empty($error)){
            if($adminId == $ckid){
                if($adminPswd == (string)$ckpd){
                    echo "Succes2";
                    header("location: admin.php");
                            exit;
                }
                else{
                    $error.= "Incorrect Paassword";
                }
                
            }
            else{
                $error.= "You are not Admin";
            }
        }
        echo $error;
        
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href = "index.css">
    <title>Admin Login</title>
</head>
<body>
    <div class="center" style="margin-top: 160px;">
    <div class="signup">Admin Login</div>
    <div>
        <p class="fillDetails">
            Please enter your email and password to login
        </p>
        <form action='adminLogin.php' method='post'>
            <label  class = "inputLabel" for="adId">Email Id: </label></br>
            <input class = "editField" type="text" name="adId" id = "adId"><br/>

            <label class = "inputLabel" for="adpd">Password: </label></br>
            <input class = "editField" type="password" name="adpd" id = "adpd"><br/>

            <input type="submit" id="btn" name="adminLoginBtn">

        </form>
    </div>

    </div>
    

</body>
</html>