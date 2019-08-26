<?php
session_start();
$connect = mysqli_connect('localhost','root','');
mysqli_select_db($connect, 'wta');


if ((isset($_POST['weight']))){
    if ((!empty($_POST['weight']))){ 
        $weight = $_POST['weight'];
        $id =  $_SESSION['id'];
        
        $date = date('y:m:d:h:i:s');
        $cook = setcookie('date', $date, time()+(86400 *30),'/');
        $query = "INSERT INTO `weight`(`weight`,`uid`,`date_created`) VALUES('$weight','$id','$date')";
         if (mysqli_query($connect,$query)){
             
         } 
         else{
             echo mysqli_error($connect);
         }
         Header("Location:addWeight.php");
           
        
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
                <form class="form-group" action="addWeight.php" method="post">
                    <label>Hello, <?php echo $_SESSION['name']; ?></label></br>
                    <div id="weight">
                    <?php
                     $id =  $_SESSION['id'];
                     
                    $query = "SELECT `weight` FROM `weight` WHERE `uid` ='$id'";
                    
                    $run = mysqli_query($connect,$query);
                    $row = mysqli_num_rows($run);
                    
                    while ($get = mysqli_fetch_array($run, MYSQLI_BOTH)){
                        error_reporting(0);
                        echo "
                            
                           <p style='border: 1px solid; background-color:grey; color:white; padding-top: 20px;'> 
                           $get[0]kg
                            </p>";
                    
                        
                      
                        }
                    mysqli_free_result($run);
                    ?>
                    </div>
                    <button class = "btn btn-information" id="addw">Add New Weight</button>
                    <input type="submit" class = "btn btn-information" value="Check Evaluation" name="cme"/>
                    <div id="addwee">
                    
                    </div>
                    <div id="eval">
                    <?php
                        if ((isset($_POST["cme"]))){
                            $che = $_COOKIE['date'];
                            
                            $query = "SELECT `weight` FROM `weight` WHERE `uid` ='$id'";
                            $query1 = "SELECT `weight` FROM `weight` WHERE `date_created` ='$che'";
                            
                    $run = mysqli_query($connect,$query);
                    $run1 = mysqli_query($connect,$query1);
                    $row = mysqli_num_rows($run);
                    $get1 = mysqli_fetch_assoc($run1);
                    $last_weight = $get1['weight'];
                    if ($get = mysqli_fetch_array($run, MYSQLI_BOTH)){
                        
                         $eval =  ($last_weight - $get[0]);
                         
                        if (($last_weight) > ($get[0])) {
                         echo "<p class='text-primary'> Good Job! You've lost 
                         $eval kg already
                          </p>";
                        }else{
                            echo "<p class='text-danger'>Oops! You've added 
                         $eval kg 
                          </p>";
                        }
                  

                        }
                    }
                    
                    ?>
                    </div>
                </form>
            </div>
            <div class="col-md-4 col-sm-4 col-xs-4"></div>
        </div>
    </div>

    <script src="main.js"></script>
    
</body>
</html>