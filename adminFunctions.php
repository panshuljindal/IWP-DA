<?php
    session_start();

    require_once "config.php";
    

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['type'])){
        $type=$_POST['type'];
        if($type=="insert"){
            
            echo '
            <div class="center">
            <p style="color: white; text-align: center;font-weight: bold; font-size: 30px; margin-top: 0px;">Enter Product Details</p>
            <label class="inputLabel">Product Id: </label>
            <input class="editField" type="number" name ="pid" id="pid"><br/>
            <label class="inputLabel">Product Name: </label>
            <input type="text" class="editField" name ="pname" id="pname"><br/>
            <label class="inputLabel">Product Description: </label>
            <input type="text" class="editField" name ="pd" id="pd"><br/>
            <label class="inputLabel">Product Price: </label>
            <input type="number" class="editField" name ="pp" id="pp"><br/><br/>
            <input type="submit" class="btn" name ="addbtn" id="addBtn" onclick="addBtn()" value = "Add Product in database"><br/></div>';

        }else if($type=="update"){
            echo '
            <div class="center">
            <p style="color: white; text-align: center;font-weight: bold; font-size: 30px;">Update Form</p>
            <p style="color: white; text-align: center; padding-top: 15px;">Enter the product id of the product you want to update.</p>
            <label class="inputLabel">Product Id: </label>
            <input class="editField" type="number" name ="pid" id="updatePid"><br/><br/>
            <input type="submit" class="btn" name ="addbtn" id="addBtn" onclick="updateShow()" value = "Fetch Details"><br/></div>';

        }else if($type=="delete"){
            echo '
            <div class="center">
            <p style="color: white; text-align: center;font-weight: bold; font-size: 30px;">Delete Form</p>
            <p style="color: white; text-align: center; padding-top: 15px;">Enter the product ID of the product to be deleted.</p>
            <label class="inputLabel">Product Id: </label>
            <input class="editField" type="number" name ="pid" id="deletePid"><br/><br/>
            <input type="submit" class="btn" name ="addbtn" id="addBtn" onclick="deleteI()" value = "Delete"><br/></div>';    
        }

    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['addBtn'])){

    $pid = $_POST['id'];
    $pname = $_POST['name'];
    $pdesc = $_POST['desc'];
    $price = $_POST['price'];
    
    $sql = "INSERT INTO products (id,pname,pdesc,price) VALUES ('$pid','$pname','$pdesc','$price')";
 
     if (mysqli_query($db, $sql)) {
        echo "<p class='input'>New record has been added successfully !</p>";
     } else {
        echo "<p class='input'>Error: " . $sql . ":-" . mysqli_error($db)."</p>";
     }
    }

    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['deletePid'])){
        $pidd = $_POST['deletePid'];
        $sql = "DELETE FROM products WHERE id= $pidd";
 
        if (mysqli_query($db, $sql)) {
     
            echo "<p class='input'>Record deleted successfully</p>";
     
        } else {
         
            echo "<p class='input'>Error deleting record:" . mysqli_error($db)."</p>";
        }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updatePid'])){
        $id = $_POST['updatePid'];
        $query = "SELECT * FROM products WHERE id = $id";
        $result = mysqli_query($db,$query);
            if($result){
                if (mysqli_num_rows($result) > 0) {
               
                $row = mysqli_fetch_assoc($result);
                
                        echo "
                        <div class='center'>
                        <p style='color: white; text-align: center;font-weight: bold; font-size: 30px; margin-top: 0px;'>Update Form</p>
                        <label class='inputLabel'>Product Id: </label>
                        <input class='editField' type='number' name ='pid' id='pid' value='".$row['id']."'><br/>
                        <label class='inputLabel'>Product Name: </label>
                        <input type='text' class='editField' name ='pname' id='pname' value='".$row['pname']."'><br/>
                        <label class='inputLabel'>Product Description: </label>
                        <input type='text' class='editField' name ='pd' id='pd' value='".$row['pdesc']."'><br/>
                        <label class='inputLabel'>Product Price: </label>
                        <input type='number' class='editField' name ='pp' id='pp' value='".$row['price']."'><br/><br/>
                        <input type='submit' class='btn' name ='addbtn' id='addBtn' onclick='updateFunc()' value = 'Update'><br/></div>";
                }
                else{
                    $error = '<p class="input">No product exists with this product id</p>';
                   echo $error;
                   }
               }
               else{
                   echo "no";
               }
    }
    if($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['updateForm'])){
            $productId=$_POST['id'];
            $pname = $_POST['name'];
            $pdesc=$_POST['desc'];
            $price=$_POST['price'];
            echo $productId;
            $sql = "UPDATE products SET pname ='".$pname."',pdesc='".$pdesc."',price=".$price." WHERE id=".$productId."";
            if (mysqli_query($db, $sql)) {
                echo "<p class='input'>Record updated successfully !</p>";
            } 
            else {
                echo json_encode(array("statusCode"=>201));
            }
	mysqli_close($db);
    }
?>