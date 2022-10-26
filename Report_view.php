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
    <link href="css/style.css" rel="stylesheet">
    
    <link rel="stylesheet" href="css/indexorder.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="//cdn.datatables.net/1.10.25/css/jquery.dataTables.min.css" rel="stylesheet">
    
</head>

<body>

    <!-- Navbar Started -->
    <div class="container-fluid sticky-top bg-dark bg-light-radial shadow-sm px-5 pe-lg-0">
        <nav class="navbar navbar-expand-lg bg-dark bg-light-radial navbar-dark py-3 py-lg-0">
            <a href="index.html" class="navbar-brand">
                <h1 class="m-0 display-4 text-uppercase text-white"><i class="bi bi-binoculars text-primary me-2"></i>Door Milk</h1>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarCollapse">
                <div class="navbar-nav ms-auto py-0"> </div>
            </div>
        </nav>
    </div>
   <!-- Navbar Ended -->

<h1 style="margin-top:20px; color:orangered;">All Records</h1>
<?Php
require_once "config.php"; 
$sql = "SELECT a.Order_id,Order_quan,Order_date,Pay_total FROM tbl_order a, payment b  WHERE a.Order_id=b.Order_id";
$result = mysqli_query($conn, $sql);
if(!$result)
{
    echo "Error: " . mysqli_error($conn);
}
else{
    global  $date;
    echo "<table class='table table-striped '>";
    echo "<thead>
    <tr>
    <th>Oredr ID </th>
    <th>Milk Quantity</th>
    <th>Order Date</th>
    <th>Milk Payment</th>
    </tr>
    </thead>";
    echo "<tbody>";
    while($row=mysqli_fetch_assoc($result)) {
        
       //var_dump($date, $row["Order_date"]);
       $differenceOfDays = 0;
       $i = 1;
        $lastRowDate    = $date;
        $currentRowDate = $row["Order_date"];
        if ($lastRowDate != null) {
            $lastRowDate = date_create($lastRowDate);
        }
        $currentRowDate = date_create($currentRowDate);
        //var_dump($lastRowDate, $currentRowDate);die();
        if ($lastRowDate != null) {
            $diff = date_diff($lastRowDate, $currentRowDate);
            $differenceOfDays= $diff->format("%a");
        }
        
        if ($differenceOfDays <= 1) {
            echo "<tr>
            <td> ".$row["Order_id"]."</td>
            <td>".$row["Order_quan"]."</td>       
            <td>".$row["Order_date"]."</td>
            <td>".$row["Pay_total"]."</td>
            </tr>";
       echo "";
       echo "</td>";
            
        } else if ($differenceOfDays >= 2) {
            for ($i=1; $i<$differenceOfDays ;$i++) {     
                $lsd = $lastRowDate->format('Y-m-d');
                $rty = date('Y-m-d', strtotime('+1 day', strtotime($lsd)));          
                echo "<tr>
                        <td> Nill </td>
                        <td> Nill</td>       
                        <td>  $rty </td>
                        <td> Nill</td>
                    </tr>";

                $date = new DateTime($rty);
                $lastRowDate=$date;
              }

             echo "<tr>
                    <td> ".$row["Order_id"]."</td>
                    <td>".$row["Order_quan"]."</td>       
                    <td>".$row["Order_date"]."</td>
                    <td>".$row["Pay_total"]."</td>
                  </tr>";
            
        }
       $date = $row["Order_date"];      
    }    
    echo "</tbody>";
    echo "</table>";
}

?>
 <script src="https://code.jquery.com/jquery-3.6.0.min.js" ></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/js/bootstrap.min.js" ></script>
  <script src="//cdn.datatables.net/1.10.25/js/jquery.dataTables.min.js"></script>
  <script>
  $(document).ready( function () {
		$('.table').DataTable();
  });
  </script>
</body>
</html>


