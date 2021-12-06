<?php

require_once "config.php";
 
if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['signUpBtn'])){
 
    $name = trim($_POST['name']);
    $phno = trim($_POST['phno']);
    $email = trim($_POST['email']);
    $pswd = trim($_POST['pswd']);
    $con_pswd = trim($_POST['con_pswd']);
   // $password_has = password_hash($pswd, PASSWORD_BCRYPT);
    

    if($query = $db->prepare("SELECT * FROM users WHERE email =?")){
        $error = '';
        $query->bind_param('s', $email);
        $query->execute();
        $query->store_result();
        if($query->num_rows>0){
            $error .= '<p> Email address is already registered! </p>';

        }
        else{
            if(strlen($pswd)<6){
                $error.='<p> Password must have atleast 6 characters. </p>';
            }
            if(empty($con_pswd)){
                $error.='<p> Please enter confirm password. <p>';
            }
            else{
                if(empty($error) && ($pswd != $con_pswd)){
                        $error.='<p> Password did not match. </p>';
                }
            }

            if(empty($error)){
                $insetquery = $db->prepare("INSERT into users (name, email, password, contact) VALUES (?,?,?,?);");
                $insetquery->bind_param("ssss",$name,$email,$pswd,$phno);
                $result =$insetquery->execute();
                if($result){
                    $error.='<p> Registration Successful! </p>';
                }
                else{
                    $error.='<p> Something went wrong </p>';
                }
                $insetquery->close();
            }
        }
        echo $error;
    }


    $query->close();
    
    mysqli_close($db);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="index.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signup</title>
</head>
<body>
    <div class="center">
    <div class="signup">Sign Up</div>
    <div class="fillDetails">
        Please fill the details to create an account.
    </div>
    <div id="authForm" >
    <form action='signup.php' method="post">
        <label class="inputLabel" for="name">Name:</label></br>
        <input class="editField" type="text" id = "name" name="name" required><br/>

        <label class="inputLabel" for="phno">Mobile Number:</label></br>
        <input type="number" class="editField" id = "phno" name="phno" required><br/>

        <label class="inputLabel" for="email">Email ID:</label></br>
        <input type="email" id = "email" class="editField" name="email" required><br/>

        <label for="pswd" class="inputLabel">Password:</label></br>
        <input type="password" id = "pswd" class="editField" name="pswd" required><br/>

        <label for="con_pswd" class="inputLabel">Confirm password:</label></br>
        <input type="password" id = "con_pswd" name="con_pswd" class="editField" required><br/>

        <input type="submit" name="signUpBtn" id="btn" value="Submit"">
    </form></div>

    <div class="fillDetails">
        Already have an account? <span><a href="login.php" style="text-decoration: underline; color: #fff;">Login here</a></span>
    </div>
    </div>
</body>
</html>