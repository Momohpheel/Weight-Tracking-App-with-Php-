<?php
$connect = mysqli_connect('localhost','root','');
mysqli_select_db($connect, 'wta');
session_start();

if ((isset($_POST['name'])) &&  (isset($_POST['token']))){
    if ((!empty($_POST['name'])) && (!empty($_POST['token']))){ 
        $name = $_POST['name'];
        $token = $_POST['token'];
        $_SESSION['name'] = $name;
        $row_check = "SELECT * FROM `users` where `name` = '$name'";
        $row = mysqli_query($connect,$row_check);
        if (mysqli_num_rows($row) < 1){
        $query = "INSERT INTO `users`(`name`,`token`) VALUES('$name','$token')";
         $query_run = mysqli_query($connect,$query);  
         $idc = "SELECT `id` FROM `users` where `name` = '$name'";
         $ree = mysqli_query($connect,$idc);
        if ($get = mysqli_fetch_assoc($ree)){
            $id = $get['id'];
            $_SESSION['id'] = $id;
        }
         
         Header("Location:addWeight.php");
           
        }else{
            
            Header("Location:addWeight.php");
        }
       
}
}
?>

<!DOCTYPE HTML>
<html>
<head>
    <title>Weight Tracker APP</title>
    <link href="bootstrap.min.css" rel="stylesheet"/>
    <link href="app.css" rel="stylesheet"/>
</head>
<body> 
    <header class="header">Weight Tracker</header>
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-sm-4 col-xs-4"></div>
            <div class="col-md-4 col-sm-4 col-xs-4">
                <form class="form-group" action="app.php" method="post">
                    <label>Name: </label>
                    <input type="text" name="name" class="form-control"/></br>
                    </label>Token:</label>
                    <input type="password" name="token" class="form-control"/></br>

                    <input type="submit" value="Submit" class="btn btn-primary"/>
                </form>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4"></div>
        </div>
    </div>
</body>
</html>