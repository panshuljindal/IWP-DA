<?php 
    session_start();
    include "config.php";
    echo "<p id='heading'>Bill Details</p>";
    if(isset($_POST['pid'])){
      $pid=$_POST['pid'];
      $uid=$_POST['uid'];
      $sql = "DELETE FROM billdetails WHERE pid= $pid AND uid=$uid";

      if (mysqli_query($db, $sql)) {
   
          echo "Item deleted successfully";
   
      } else {
       
          echo "Error deleting Item: " . mysqli_error($db);
      }
      mysqli_close($db);
      echo $pid;

  }
    
    ?>
<html>
    <head>
    <style>
      #heading{
        color: white;
        margin-left: 30px;
        font-size: 35px;
        text-align: center; 
        font-weight: bold;
        margin-top: 30px;
      }
      #f2{
        color: white;
        font-size: 17px;

      }
      #f3{
        color: white;
        font-size: 17px;
      }
      *{
        font-family: 'Poppins';
      }
      body{
        background-color: #0C0C0C;
      }
      .center{
        padding: 50px;
        max-width: 900px;
        margin: auto; 
        margin-top: 50px;
        background-color: #141316;
        border-radius: 25px;
      }
      table,th,tr,td{
        border-collapse: collapse;

      }
      tr,td,th{
        padding-left: 40px;
        padding-right: 40px;
        padding-top: 15px;
        padding-bottom: 15px;
        text-align: center;
        color: white;
  
}
      td{
        color: white;
        background: #000;
      }th{
        background: #0c0c0c;
        color: #fff;
      }
      .remove{
        padding-top: 10px;
        margin-bottom: 15px;
        margin-top: 30px;
        padding-bottom: 10px;
        padding-right: 15px;
        padding-left: 15px;
        border: none;
        border-radius: 5px;
        font-weight: bold;
        color: white;
        font-size: 13px;
        background-color: red;
      }
      .sendFeedback{
        font-size:18px; 
        color: white ;
        margin-top: 180px;
        background: #5F2EEA;
        padding-left: 20px;
        padding-right: 20px;
        padding-top: 8px;
        padding-bottom: 8px; 
        position: absolute; 
        right: 480px; 
        border: none;
        top: 30px; 
      }
    
    
    </style>
        <title>Result Page</title>
        <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    </head>
    <body>
    <div class="center" style="margin-top: 60px;">
    <button class="sendFeedback">Send Feedback</button>
        <?php
            $total=0;
            include("config.php");
            
            $fetchData= fetch_data($db);
            if(count($fetchData)>0){
              echo '<table>
                 <tr>
                     <th>S.No.</th>
                     <th>Product ID</th>
                     <th>Product Name</th>
                     <th>Product Description</th>
                     <th>Price</th>
                     <th></th>
                 </tr>';
               $sn=1;
               $total=0;
               foreach($fetchData as $data){ 
                  echo "<tr>
                   <td>".$sn."</td>
                   <td>".$data['pid']."</td>
                   <td>".$data['pname']."</td>
                   <td>".$data['pdesc']."</td>
                   <td>".$data['price']."</td>
                   <td><button class='remove' onclick='removeItem(".$_SESSION['userid'].",".$data['pid'].")'>Remove</button></tr>";
                   $total+=$data['price'];
                   $sn++; 
              }
              echo "<p id='f2'><b>Name:</b> ".$_SESSION['name']."</p>";
         echo "<p id='f3'><b>Email: </b>".$_SESSION['email']."</p>";
         echo "<p style='color: white; font-size: 17px;'><b>Bill Amount :  </b> Rs.  ".$total."</p></br>";
     
             
         }else{
              
           echo "<h2 id='f3' style='font-size: 30px;'>Cart is Empty</h2>"; 
         }
         echo "</table>";
         
            function fetch_data($db){
                $id = $_SESSION["userid"];
                //echo $id;
                $query="SELECT * from billdetails where uid = '$id'";
                $exec=mysqli_query($db, $query);
                if(mysqli_num_rows($exec)>0){
                  $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
                  return $row;  
                      
                }else{
                  return $row=[];
                }
            }
            
                
               
        ?>
        </br>
      </div>
       
              
    </body>
    <script>
    function removeItem(uid, pid){
          $.ajax({
            type: "POST",
            url: "result.php",
            data: {
              pid: pid,
              uid: uid
            },
            success: function(html){
          
                $("body").html(html). show();
        
            }

          })
    }
    $('.sendFeedback').click(function(){
      window.location="sendFeedback.php";
      // console.log("Hello");
    })

</script>
    
</html>