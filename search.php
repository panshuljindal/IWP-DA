<?php
session_start();
include "config.php";

if (isset($_POST['search'])) {
   $Name = $_POST['search'];

   $Query = "SELECT * FROM products WHERE pname LIKE '%$Name%' LIMIT 5";

   $ExecQuery = MySQLi_query($db, $Query);
   //Fetching result from database.
   if(mysqli_num_rows($ExecQuery)>0){
   echo '<table class="divTable">
                        <tr>
                            <th>ID</th>
                            <th> Product Name</th>
                            <th>Product Description</th>
                            <th>Price</th>
                            <th> Add the Cart</th>
                        </tr>';
   while ($data = MySQLi_fetch_array($ExecQuery)) {
    echo "<tr>
    <td>".$data['id']."</td>
    <td>".$data['pname']."</td>
    <td>".$data['pdesc']."</td>
    <td>".$data['price']."</td>
    <td><button class='addCart' onclick='clickCart(".$_SESSION['userid'].",".$data['id'].")'>Add to Cart</Button>";?>
   <a>
   </a>
   <?php
}
    
    }
    else{
        echo "<center><h2 style='color: white;'>No Data found</h2></center>";
    }
}

if(isset($_POST['pid'])){
    $uid = $_POST['uid'];
    $pid=$_POST['pid'];
    $query1 = "select * from products where id = $pid";
    $result = mysqli_query($db,$query1);
    if(mysqli_num_rows($result)>0){
        $row = mysqli_fetch_assoc($result);
        $query2 = "insert into billdetails value(".$uid.",".$pid.",'".$row['pname']."','".$row['pdesc']."',".$row['price'].")";
        if(mysqli_query($db, $query2)){

            echo "<p class='addC'>Added to the cart</p>";
        }else{
            echo "<p class='addC' Error Occured</p>";
        }
    }
    mysqli_close($db);
}
?>