<?php

    require_once "session.php";
    require_once "config.php";

    $error= '';
?>
<?php
        if($_SERVER['REQUEST_METHOD']=="POST" && isset($_POST['SendFeedback'])){
                $targetFilePath="./upload/".$_FILES['file']['name'];
                $isUploaded=0;
                if(!empty($_POST['name']) && !empty($_POST['subject'])){
                    if(($_FILES['file']['size']<1000000)){
                    if(move_uploaded_file($_FILES['file']['tmp_name'],$targetFilePath))
                    $isUploaded=1;
                    
                }
                }
                if($isUploaded==1){
                    $toEmail = "panshuljindal@gmail.com";
                    $fromEmail="panshuljindal@gmail.com";
                    $name=$_POST['name'];
                    $subject = $_POST['subject'];
                    $message = $_POST['feedback'];
                    $fo=fopen($targetFilePath,"rb");
                    $data=fread($fo,filesize($targetFilePath));
                    fclose($fo);
                    $data1=chunk_split(base64_encode($data));
                    $header="Content-Type:multipart/mixed\r\n";
                    $header.="Content-Disposition:attachment;filename=".$_FILES['file']['name']."\r\n";
                    $header.="Content-Transfer-Encoding:base64".$data1."\r\n";
                    $retval = mail ($toEmail,$subject,$message,$header);
                    if( $retval == true ) {
                        echo "<h3>Message sent successfully...</h3>";
                    }else {
                        echo "<h3>Message could not be sent...</h3>";
                    }
                }
            }
    ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="index.css">
    <title>Send Feedback</title>
    <style>
        .file{
            color: white;
            font-size: 15px;
        }
        h3{
            color: white;
            padding-top: 30px;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="center" style="margin-top: 50px;max-width: 700px;">
    <div class = "signup">Send Feeback</div>
    <div>
        <form action="sendFeedback.php" method="POST" enctype="multipart/form-data">
          <label class ="inputLabel">Enter Name: </label></br>
          <input type="text" style="margin-top: 10px;padding-left: 10px;"class="editField" placeholder="Enter name" value="" name="name"></br>
          <label class ="inputLabel">Enter Subject: </label></br>
          <input type="text" style="margin-top: 10px;padding-left: 10px;"class="editField" placeholder="Enter subject" value="" name="subject"></br></br>
          <label class ="inputLabel">Feedback: </label>
              </br><textarea style="color: white; border-radius: 15px; padding-left: 10px; margin-top: 10px; margin-bottom: 30px;"rows = "10" cols="70" class ="inputLabel" placeholder="Few words you want us to know..." value="" name="feedback"></textarea></br>
            <label class ="inputLabel" style="font-size: 17px;">Attach a file: &emsp;</label> 
              <input class="file" type="file" name="file">  
          <input type="submit" id="btn" value="Send Feedback" name="SendFeedback">
          
        </form>
    </div>

   
    </div>
    
</body>
</html>