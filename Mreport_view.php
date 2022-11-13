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
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/indexorder.css">
    <link href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>

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
                <div class="navbar-nav ms-auto py-0"></div>
            </div>
        </nav>
    </div>
     <!-- Navbar Ended -->

<h1 style="margin-top:20px; color:orangered;">Monthly Report</h1>
<form style="margin-top:50px; margin-bottom:100px;margin-left:260px;" action="" method="GET">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6>From Date</h6>
                                        <input type="text" id="from" name="from_date" value="" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6>To Date</h6>
                                        <input type="text" id="to" name="to_date" value="" class="form-control" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label></label> <br>
                                      <button type="submit" class="btn btn-primary">Report</button>
                                    </div>
                                </div>
                            </div>
                        </form>
<?Php
global $counter;
$quan= $pay="";

    require_once "config.php"; 
    if(isset($_GET['from_date']) && isset($_GET['to_date']))
{
    $from_date = $_GET['from_date'];
    $to_date = $_GET['to_date'];

    //Query For Naga 

    $sql_naga = "SELECT Order_date FROM tbl_order where Order_date BETWEEN '$from_date'AND'$to_date'";                               
    $result_naga = mysqli_query($conn, $sql_naga);
	$row_naga = $result_naga -> fetch_all(MYSQLI_ASSOC);                                       
    global $last;
	
	foreach ($result_naga as $key => $item) {

	    $current = $item['Order_date'];
	    if($key !== 0) {
	        $diff = date_diff(date_create($current),date_create($last));
            
	        $int_diff = $diff->format("%a")-1;
	        if ($int_diff==0){
                $counter=$counter+$int_diff;
               }
           else if($int_diff >= 1) {
            $counter=$counter+$int_diff;
        }
	    }
        
	    $last = $item['Order_date'];
	}                                   
      //Query For Total Quantity and Payment

    $sql = "SELECT sum(Order_quan) as Order_quan FROM tbl_order where Order_date BETWEEN '$from_date' AND '$to_date' and "; 
    $result = mysqli_query($conn, $sql);
    $row=mysqli_fetch_assoc($result);
    $quan= $row["Order_quan"]." Kilos";    
       
     $Psql = "SELECT sum(Pay_total) as Pay_total FROM payment where Order_date BETWEEN '$from_date' AND '$to_date'"; 
     $Presult = mysqli_query($conn, $Psql);
     $row=mysqli_fetch_assoc($Presult); 
     $pay= $row["Pay_total"]." Rs.";    
       
     echo "<table class='darkTable'>";
echo "<thead>
<tr>

<th>Total Quantity</th>
<th>Total Naga</th>
<th>Total Payment</th>

</tr>
  </thead>";
          echo "<tbody>";
          echo "<tr>
                  <td>$quan</td>       
                  <td>$counter</td>
                  <td>$pay</td>
                  </tr>";
         echo "";
echo "</tbody>";
echo "</table>";
    } 
?>

</body>
<script type="text/javascript">
    $(function() {
        
        $( "#from" ).datepicker({ maxDate: new Date(),
            
           
            dateFormat:'dd/mm/yy',
            beforeShow: function() {
            $(this).datepicker('option', 'maxDate', $('#to').val());
            if ($('#from').val() === '') $(this).datepicker('option', 'maxDate', 0);
          }
            
        });
        $("#to").datepicker({
            
            
            dateFormat:'dd/mm/yy',
            beforeShow: function() {
            $(this).datepicker('option', 'minDate', $('#from').val());
if ($('#to').val() === '') $(this).datepicker('option', 'maxDate', 0);                             
         }
            });
       
    });
</script>
</html>