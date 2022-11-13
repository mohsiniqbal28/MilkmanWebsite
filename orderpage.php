<?php
session_start();
 $cn=$_SESSION['cname'];
?>
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

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/order.css">
    <link href="http://code.jquery.com/ui/1.9.2/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="http://code.jquery.com/jquery-1.8.3.min.js"></script>
    <script src="http://code.jquery.com/ui/1.9.2/jquery-ui.js"></script>
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
$dateError=$quanError="";
$date=$quan="";
      if(isset($_POST['quantity'])) 
      {$quan= $_POST['quantity'];}

      if(isset($_POST['date']))
      {$date= $_POST['date'];}

        if (isset($_POST['submit'])) 
        {
          $is_valid = 1;
        
            if (empty($_POST["quantity"])) {
                $quanError = "* Quantity is Required!";
                $is_valid = 0;
              } 
              else{
                $quan=$_POST["quantity"];
              }

                if (empty($_POST["date"])) {
                    $dateError = "* Date is Mandatory";
                    $is_valid = 0;
                  } 
                  else{
                    $date = $_POST['date'];
                  }

                  if($is_valid == 1 )
                  {
                    include('config.php');
                  $sql = "INSERT INTO tbl_order VALUES ('','$quan','$date','$cn')";
                  $result=mysqli_query($conn, $sql);     
                 if($result=true)
                    {
                      header("location:Payment.php");
                               
                    } 
                  }
                  else{
                    echo "<h4><strong> Validation Errors </strong></h4>";
                  }
                  $_SESSION['quantity of milk'] = $_POST['quantity'];
                  $_SESSION['Date of Order'] = $_POST['date'];
                  var_dump($_SESSION['Date of Order']);
            }
        
            
       
                ?>
<div class="container">
	<div class="header">
		<h2>Order Milk</h2>
	</div>
	<form id="form" class="form" method="POST">
		<div class="form-control" style="background-color: #0a1332;border:none">
			<label for="username">Quantity Of Milk</label>
			<input name="quantity" type="number" placeholder="Kilos" oninput="validity.valid||(value='');"/>
    </div>
		<div class="form-control" style="background-color: #0a1332;border:none">
			<label for="username">Order Date</label>
			<input id="datepicker" name="date" type="text" placeholder="Pick date"/>
		</div>
		<input type="submit" value="Request for milk" name="submit">
        
        
	</form>
</div>
</body>
 <!-- Javascript For Date Picker -->
<script type="text/javascript">
    $(function() {
        
        $( "#datepicker" ).datepicker({ maxDate: new Date(),
           
            showAnim:'drop',
            autoclose: true,
            orientation:"bottom left",
            numberOfMonths:1,
            dateFormat:'dd/mm/yy'
           
          });
    });
</script>
</html>

   

    
