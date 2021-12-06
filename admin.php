

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href='https://fonts.googleapis.com/css?family=Poppins' rel='stylesheet'>
    <script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
    <style>
        *{
            font-family: 'Poppins';
        }
        .adminLogout{
            padding-left: 25px;
            padding-right: 25px;
            padding-top: 13px;
            padding-bottom: 13px;
            font-size: 18px;
            background-color: #5F2EEA;
            border: none;
            color: white;
            position: absolute;
            top: 45px;
            right: 40px;
        }
        button{
            padding-top: 10px;
            padding-bottom: 10px;
            padding-right: 20px;
            padding-left: 20px;
            margin-right: 100px;
            margin-left: 40px;
            background-color: #5f2EEA;
            border: none;
            color: white;
            font-size: 18px;
        }
        .inputLabel{
            color: white;
            padding-top: 20px;
            padding-bottom: 20px;
            padding-left: 0px;
            font-size: 17px;
        }

        .editField{
            padding-top: 12px;
            margin-bottom: 15px;
            font-size: 17px;
            padding-bottom: 12px;
            padding-right: 5px;
            padding-left: 5px;
            margin-top: 15px;
            width: 100%;
            border: none;
            border-radius: 10px;
        }
        .center{
            padding: 50px;
            max-width: 500px;
            margin: auto; 
            margin-top: 50px;
            background-color: #141316;
            border-radius: 25px;
        }
        .btn{
            padding-top: 15px;
            margin-bottom: 15px;
            margin-top: 30px;
            padding-bottom: 15px;
            padding-right: 5px;
            padding-left: 5px;
            width: 100%;
            border: none;
            border-radius: 10px;
            font-weight: bold;
            color: white;
            font-size: 17px;
            background-color: #5F2EEA;
        }
        .input{
            color: white;
            text-align: center;
            font-size: 30px;
        }
    </style>
    <title>Admin Page</title>
</head>

<body style="background-color: #0C0C0C;">
<h1 style = "color: white; text-align: center; font-size: 50px; margin-top: 30px;">Admin</h1><br/>
   <div class="buttons">
       <button class="updateBtn" onclick="update()">Update Button</button>
       <button class="insertBtn" onclick="insert()">Insert Button</button>
       <button class="deleteBtn" onclick="deleteItem()">Delete Button</button>
       <button class="adminLogout" onclick="logout()"style="margin-right: 0px;" >Logout</button>
    </div></br>
    <div class="result"></div>

</body>
<script>
    function logout(){
        window.location="logout.php"
    }
    function update(){
        $.ajax({
          type: "POST",
          url: "adminFunctions.php",
          data: {
            type: "update"
          },
          success: function(html){
            $('.result').html(html);
          }
        })
    }
    function insert(){
        $.ajax({
          type: "POST",
          url: "adminFunctions.php",
          data: {
            type: "insert"
          },
          success: function(html){
            $('.result').html(html);
          }
        })
    }
    function deleteItem(){
        $.ajax({
          type: "POST",
          url: "adminFunctions.php",
          data: {
            type: "delete"
          },
          success: function(html){
            $('.result').html(html);
          }
        })
    }
    function addBtn(){
        var id = $("#pid").val();
        var name = $("#pname").val();
        var desc = $("#pd").val();
        var price=$("#pp").val();
        $.ajax({
          type: "POST",
          url: "adminFunctions.php",
          data: {
            id: id,
            name: name,
            desc: desc,
            price: price,
            addBtn: "Addbtn"
          },
          success: function(html){
            $('.result').html(html);
          }
        })
    }
    function updateShow(){

        var id= $('#updatePid').val();
        $.ajax({
          type: "POST",
          url: "adminFunctions.php",
          data: {
            updatePid: id,
          },
          success: function(html){
            $('.result').html(html);
          }
        })
    }
    function deleteI(){
        var id= $('#deletePid').val();
        $.ajax({
        type: "POST",
        url: "adminFunctions.php",
        data: {
            deletePid: id,
        },
        success: function(html){
            $('.result').html(html);
        }
        })
        }
    function updateFunc(){
        var id = $("#pid").val();
        var name = $("#pname").val();
        var desc = $("#pd").val();
        var price=$("#pp").val();
        $.ajax({
          type: "POST",
          url: "adminFunctions.php",
          data: {
            id: id,
            name: name,
            desc: desc,
            price: price,
            updateForm: "update"
          },
          success: function(html){
            $('.result').html(html);
          }
        })
    }
</script>
</html>
