<?php
session_start();
$q=$_SESSION['quantity of milk'];
$d=$_SESSION['Date of Order'];
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

    <!-- Libraries Stylesheet -->
    <link href="lib/owlcarousel/assets/owl.carousel.min.css" rel="stylesheet">
    <link href="lib/tempusdominus/css/tempusdominus-bootstrap-4.min.css" rel="stylesheet" />
    <link href="lib/lightbox/css/lightbox.min.css" rel="stylesheet">

    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

    <!-- Template Stylesheet -->
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/order.css">
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
    $price=$total=$orderid="";
      include('config.php');
      $sql = "SELECT Uprice FROM milk_product WHERE Milk_id=1";
      $result = mysqli_query($conn, $sql);
      $row = mysqli_fetch_assoc($result);
      $price=$row['Uprice'];
      $total=$q*$price;
      $sql="SELECT Order_id FROM tbl_order WHERE Order_date='$d'";
      $run=mysqli_query($conn,$sql);
      $result=mysqli_fetch_assoc($run);
      $oid=$result['Order_id'];
if (isset($_POST['submit'])) {
include('config.php');
$sql = "INSERT INTO Payment VALUES ('','$total','$oid','$d','$cn')";
$result=mysqli_query($conn, $sql);     
if($result=true)
  {
    header("location:DoneOrder.php");
             
  } 

else{
  echo "<h4><strong> Validation Errors </strong></h4>";
}


                 
}                
        
               
                ?> 
    
<div class="container">
	<div class="header">
		<h2>Add Payment</h2>
	</div>
	<form id="form" class="form" method="POST">
		<div class="form-control" style="background-color: #0a1332;border:none">
			<label for="username">Total payment</label>
			<input name="payment" type="text" placeholder="Rs." value="<?php echo $total ." Rs." ?>"/>
    </div>
		<input type="submit" value="Pay" name="submit">
        
        
	</form>
</div>

</body>
</html>
<!-- JavaScript Libraries -->
<script src="https://code.jquery.com/jquery-3.4.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="lib/easing/easing.min.js"></script>
    <script src="lib/waypoints/waypoints.min.js"></script>
    <script src="lib/owlcarousel/owl.carousel.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script src="https://s3-us-west-2.amazonaws.com/s.cdpn.io/3/jquery.inputmask.bundle.js"></script>

    <!-- Template Javascript -->
    <script src="js/main.js"></script>
