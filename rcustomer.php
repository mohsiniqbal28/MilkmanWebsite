<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <title>Door Milk -  Milk Man Website App</title>
    <meta content="width=device-width, initial-scale=1.0" name="viewport">

    <!-- Favicon -->
    <link href="img/favicon.ico" rel="icon">

    <!-- Google Web Fonts -->
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css2?family=Open+Sans:wght@400;600&family=Roboto:wght@500;700&display=swap" rel="stylesheet"> 

    <!-- Icon Font Stylesheet -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.0/css/all.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.4.1/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Libraries Stylesheet -->
    <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
    <style>
.errorColor {color: #D30000;}
#cust{
    margin: 40px;
}

</style>

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    
    <link rel="stylesheet" href="css/rcustomer.css">
    
</head>

<body>

    <div class="container-fluid sticky-top bg-dark bg-light-radial shadow-sm px-5 pe-lg-0">
        <nav class="navbar navbar-expand-lg bg-dark bg-light-radial navbar-dark py-3 py-lg-0">
            <a href="index.html" class="navbar-brand">
                <h1 class="m-0 display-4 text-uppercase text-white"><i class="bi bi-binoculars text-primary me-2"></i>Door Milk</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0">
                      
                   
                </div>
            </div>
        </nav>
    </div>
    <?php 
    
     $n=$cnic=$ph=$add=$date=$rol=$user_cnic=$pass="";
     $cnicError = $phoneError =  $nameError= $addError= $dateError= $roleError=$result=$passError="";
     $validationError="";
     session_start();
      if(isset($_POST['name'])) 
      {$n= $_POST['name'];}

      if(isset($_POST['cnic']))
      {$cnic= $_POST['cnic'];}

      if(isset($_POST['phone']))
      {$ph= $_POST['phone'];}

      if(isset($_POST['address']))
      {$add= $_POST['address'];}

      if(isset($_POST['date']))
      {$date= $_POST['date'];}
      
      if(isset($_POST['role']))
      {$rol= $_POST['role'];}

      if(isset($_POST['password']))
      {$pass= $_POST['password'];}

        if (isset($_POST['submit'])) 
        {
          $is_valid = 1;

          function test_input($data) {
              $data = trim($data);
              $data = stripslashes($data);
              $data = htmlspecialchars($data);
                return $data;
           }           
        
            if (empty($_POST["name"])) {
                $nameError = "* Name is mandatory";
                $is_valid = 0;
              } 
              else{
                $n = test_input($_POST['name']);
                
              }

              if (empty($_POST["cnic"])) {
                $cnicError = "* Cnic is mandatory";
              } 
              
              else {
                $cnic = test_input($_POST["cnic"]);
                $cnic_pattern = '/[0-9]{5}[-][0-9]{7}[-][0-9]{1}/';
                if (!preg_match( $cnic_pattern,$cnic)) {
                  $cnicError = "* Please Enter a valid CNIC";
                  $is_valid = 0;
                }
                else{
                  include('config.php');
                    $sql = "SELECT Cust_cnic FROM customer WHERE Cust_cnic='$cnic'";
                    $result = mysqli_query($conn, $sql);
                    $row = mysqli_fetch_assoc($result);
                    $_SESSION['cnic']=$row['Cust_cnic'];
                    if($_POST["cnic"]==$_SESSION['cnic'])
                    {
                        $cnicError = "CNIC: $cnic Already Exist";
                        $is_valid = 0;
                    } 
                }

              }
              if (empty($_POST["phone"])) {
                $phoneError = "* Phone is mandatory";
                $is_valid = 0;
              } 
              else {
                $ph = test_input($_POST["phone"]);
               $ph_pattern= '/^(\+92|0|92)[0-9]{10}$/';
                if (!preg_match($ph_pattern,$ph)) {
                    $phoneError = "* Please Enter a valid Phone number";
                    $is_valid = 0;
                  }
                }
                if (empty($_POST["address"])) {
                    $addError = "* Address is mandatory";
                    $is_valid = 0;
                  } 
                  else{
                    $add = test_input($_POST['address']);
                  }

                  if (empty($_POST["date"])) {
                    $dateError = "* Date is mandatory";
                    $is_valid = 0;
                  } 
                  else{
                    $date=test_input($_POST['date']);
                  }
                  if (empty($_POST["role"])) {
                    $roleError = "* Role is mandatory";
                    $is_valid = 0;
                  } 
                  else{
                    $rol=test_input($_POST['role']);
                  }
                  if (empty($_POST["password"])) {
                    $passError = "* Password is mandatory";
                    $is_valid = 0;
                  } 
                  else{
                    $pass=test_input($_POST['password']);
                  }
                  if($is_valid == 1 )
                  {
                    include('config.php');
                  $sql = "INSERT INTO customer VALUES ('','$n','$cnic','$ph', '$add','$date','$rol','$pass')";
                  $result=mysqli_query($conn, $sql);     
                 if($result=true)
                    {
                      echo "<strong>You are Registered</strong>"; 
                      header("location:clogin.php");
                               
                    } 
                  }
                  else{
                    $validationError= "<h4><strong> Validation Errors </strong></h4>";
                  }
            }
               
                ?>
  <div class="container">
	<div class="header">
		<h2>Please Fill Out This Form</h2>
	</div>
	<form id="form" class="form" method="POST">
		<div class="form-control" style="background-color: #0a1332;border:none">
			<label for="username">Name</label>
			<input type="text" name="name"placeholder="user1"/>
			<span class="error-message"> <?php echo $nameError;?></span>
    </div>
		<div class="form-control" style="background-color: #0a1332;border:none">
			<label for="username">CNIC</label>
			<input type="text" name="cnic"  placeholder="12345-6789012-3" id="CNIC" />
			<span class="error-message"> <?php echo $cnicError;?></span>
		</div>
		<div class="form-control"style="background-color: #0a1332 ;border:none">
			<label for="username">Phone Number</label>
			<input type="text" name="phone" placeholder="9212345678900" id="phvalue" type = "number" maxlength = "13"/>
			<span class="error-message"><?php echo $phoneError;?></span>
		</div>
		<div class="form-control" style="background-color: #0a1332;border:none">
    <label for="username">Permanent Address</label>
			<input type="text" name="address" placeholder="Block D,Garden Town Lahore" />
			<span class="error-message"><?php echo $addError;?></span>
		</div>
    <div class="form-control" style="background-color: #0a1332 ;border:none">
    <label for="username">Registration Date</label>
    <input type="text" name="date" id="datepicker" placeholder="Pick date">
			<span class="error-message"><?php echo $dateError;?></span>
		</div>
    <div class="form-control" style="background-color: #0a1332;border:none">
    <label for="username">Password</label>
    <input type="text" name="password" placeholder="1234abc@" >
			<span class="error-message"><?php echo $passError;?></span>
		</div>
    <div class="form-control" style="background-color: #0a1332;border:none">
    <label for="username">Your Role:</label>
    <select name="role" style="margin-left:375px ;" >
    <option value="0" >Select</option>
    <option value="customer" >Customer</option>
    <option value="milkman">Milk man</option>
  </select>
			<span class="error-message"><?php echo $roleError;?></span>
		</div>
		<input type="submit" value="Register" name="submit">
	</form>
</div>
</body>
<script type="text/javascript">
    $(function() {
        
        $( "#datepicker" ).datepicker({ maxDate: new Date(),
            minDate:new Date(),
            showAnim:'drop',
            autoclose: true,
            orientation:"bottom left",
            numberOfMonths:1,
            dateFormat:'dd/mm/yy'
           
          });
    });
</script>
</html>