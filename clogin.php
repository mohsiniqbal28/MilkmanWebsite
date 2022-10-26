<!DOCTYPE html>
<html>
<head>
  <link href="https://fonts.googleapis.com/css?family=Ubuntu" rel="stylesheet">
  <link rel="stylesheet" href="css/clogin.css">
  <title>Log in</title>
</head>

<body>
 
    <?php
     include_once('config.php');
        session_start();
        $cnic=$pass="";
        $role="";
        $loginmessage="";
        $match_cnic=$match_pass="";
        if ($_SERVER["REQUEST_METHOD"] == "POST") {

            if(!empty($_POST['cnic'] && $_POST['password']))
            {
                $cnic = $_POST['cnic'];
                $pass= $_POST['password'];
                $sql = "SELECT Cust_cnic,Cust_Role,Cust_pass FROM customer WHERE Cust_cnic='$cnic'&& Cust_pass='$pass'";
                $result = mysqli_query($conn, $sql);

                if(!$result) {
                        echo "Error: " . mysqli_error($conn);
                }
                else {
                    $row = mysqli_fetch_assoc($result);
                    if($row>0)
                    {
                    $match_cnic = $row["Cust_cnic"];
                    $match_pass = $row["Cust_pass"];
                    $_SESSION['role']=$row['Cust_Role'];
                    }
                    if(($match_cnic==$cnic) && ($_SESSION['role']=="customer")) {
                        header("location:index_order.php");
                        $loginmessage="<h4>You Are Loged in Successfully!</h4>";
                    }
                    else if(($match_cnic==$cnic) && ($_SESSION['role']=="milkman")) {
                       
                        $loginmessage="<h4>You Are Loged in Successfully!</h4>";
                        header("location:index.php");
            
                    }
                    else{
                        $loginmessage= "<h4>Incorrect CNIC Or Password</h4>";
                    }
                
                    }
                    
                }
                else{
                    $loginmessage="<h4>Please Enter CNIC!</h4>";
                }
               
        }
        ?>
         <div class="main">
    <p class="login" align="center">Log in</p>
    <form class="form1" method="post">
      <input class="cnic" name="cnic" type="text" placeholder="Enter your CNIC no.">
      <input class="cnic" name="password" type="text" placeholder="Enter your Password.">
      <input type="submit" value="Log in">
      <span style="color: orange;"> <?php echo $loginmessage;?></span>
    </form>
                       
    </div>
</body>
</html>

