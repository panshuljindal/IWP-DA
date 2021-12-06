<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    
   <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
   <script type="text/javascript" src="script.js"></script>
   <link rel="stylesheet" href=index.css>
    <style>
* {
  box-sizing: border-box;
  font-family: 'Poppins';
}
.divTable{
  margin-left: 80px;
  margin-top: 20px;
  width: 90%;
}
table,tr,td.th{
  border-collapse: collapse;
}
th{
  padding-left: 120px;
  padding-right: 120px;
  padding-top: 20px;
  padding-bottom: 20px;
  color: white;
  
}
tr,td{
  padding-left: 120px;
  padding-right: 20px;
  padding-top: 20px;
  padding-bottom: 20px;
  color: white;
  
}
tr,td{
  background: #000;
}
th{
  background: #141316;
  color: #fff;
  
}
.cartIcon{
  font-size:30px; 
  color: white ;
  background: #5F2EEA;
  padding-left: 20px;
  padding-right: 20px;
  padding-top: 8px;
  padding-bottom: 8px; 
  position: absolute; 
  right: 50px; 
  top: 30px; 
  border-radius: 10px;
}
.logoutBtn{
  padding-left: 40px;
  padding-right: 40px;
  padding-top: 15px;
  padding-bottom: 15px;
  font-size: 15px;
}
#search{
    padding-top: 15px;
    padding-bottom: 15px;
    padding-right: 15px;
    padding-left: 15px;
    width: 89%;
    border-radius: 15px;
    margin-left: 80px;
    margin-top: 50px
}
.logoutBtn{
  padding-top: 15px;
  margin-bottom: 15px;
  margin-top: 30px;
  padding-bottom: 15px;
  padding-right: 5px;
  padding-left: 5px;
  width: 150px;
  border: none;
  font-weight: bold;
  color: white;
  font-size: 17px;
  background-color: #5F2EEA;
  display: inline-block;
}
.addCart{
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
  background-color: #5F2EEA;
  margin-left: 10px;
}
.buyNow{
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
  background-color: darkgreen;

}
.addC{
  margin-left: 500px;
  margin-right: auto;
  color: black;
  background-color: #fff;
  width: 300px;
  text-align: center;
  padding-top: 20px;
  padding-bottom: 20px;
  padding-right: 15px;
  padding-left: 15px;
  margin-bottom: 20px;
  position: relative;
}
</style>
</head>
<body style="background-color: #0C0C0C;">
<a class="cartIcon" href="result.php"><i class="fa fa-shopping-cart"></i></a></br>
    <div>
    <h1 style = "color: white; text-align: center; font-size: 35px;">Products View</h1>
    </div>
    <div class="search">
    <input type="text" id="search" placeholder="Enter the text to Search" /></br></br>
    <div id="display"></div>

    </div>
            <?php
                include("config.php");
                $fetchData= fetch_data($db);
                show_data($fetchData);
                // fetch query
                function fetch_data($db){
                    $query="SELECT * from products ORDER BY id";
                    $exec=mysqli_query($db, $query);
                    if(mysqli_num_rows($exec)>0){
                        $row= mysqli_fetch_all($exec, MYSQLI_ASSOC);
                        return $row;  
        
                    }else{
                        return $row=[];
                    }
                }
                function show_data($fetchData){
                echo '<table id="table" class="divTable">
                        <tr>
                            <th>ID</th>
                            <th> Product Name</th>
                            <th>Product Description</th>
                            <th>Price</th>
                            <th> Add the Cart</th>
                        </tr>';
                if(count($fetchData)>0){
                      foreach($fetchData as $data){ 
                  echo "<tr>
                          <td>".$data['id']."</td>
                          <td>".$data['pname']."</td>
                          <td>".$data['pdesc']."</td>
                          <td>".$data['price']."</td>
                          <td style='padding-left: 80px;'><button class='buyNow' onclick='clickCart(".$_SESSION['userid'].",".$data['id'].",1)'>Buy Now</button><button class='addCart' onclick='clickCart(".$_SESSION['userid'].",".$data['id'].",2)'>Add to Cart</Button>";
                    }
                }else{
                    
                  echo "<center><h2>No Data found</h2></center>"; 
                }
                  echo "</table>";
                }
?>
     <br/>

    <form  style="display: inline-block;" action="logout.php" method="post">
        <input type="submit" style="margin-left: 80px;" name="logoutBtn" class="logoutBtn"value="Log out">
    </form>
    <div  style="display: inline-block;"id="addC"></div>     
</body>
<script>
  function clickCart(uid, id,type){
        $.ajax({
          type: "POST",
          url: "search.php",
          data: {
            pid: id,
            uid: uid
          },
          success: function(html){
            if(type==2){
              $("#addC").html(html). show();
            setTimeout(function() {
              $("#addC").hide();
            }, 1000);
            }
            else{
              window.location="result.php";
            }
          }

        })
    }

</script>
</html>


