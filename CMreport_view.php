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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></script>
    <!-- Customized Bootstrap Stylesheet -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link rel="stylesheet" href="css/indexorder.css">
    <link href="https://code.jquery.com/ui/1.13.1/themes/smoothness/jquery-ui.css" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.1.js"></script>
    <script src="https://code.jquery.com/ui/1.13.2/jquery-ui.js"></script>
    <script src="http://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

    

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
<form style="margin-top:50px; margin-bottom:100px;margin-left:260px;" action="" method="GET" id="form_id">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6>From Date</h6>
                                        <input type="text" id="from" name="from_date" value="<?php echo $_GET['from_date'] ?? '' ?>"  class="form-control form-class" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <h6>To Date</h6>
                                        <input type="text" id="to" name="to_date" value="<?php echo $_GET['to_date'] ?? '' ?>"  class="form-control to-class" >
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label></label> <br>
                                      <button type="submit" id="btn_date" class="btn btn-primary ">Filter</button>
                                    </div>
                                </div>
                            </div>
                        </form>




                        <?php
                 require_once "config.php"; 
                 $count=1;
                  $from_date=$to_date="";
                 if(isset($_GET['from_date']) && isset($_GET['to_date']))
             {
                  $from_date = $_GET['from_date'];
                  $to_date = $_GET['to_date'];
                 
                 //Query For Naga 
             
                 $sql = "SELECT * FROM tbl_order where Order_date BETWEEN '$from_date'AND'$to_date' group by Cust_name";                               
                 $result = mysqli_query($conn, $sql);
            ?>
                    <table id="datatableid" class="table table-bordered table-dark darkTable ">
                        <thead>
                            <tr>
                                <th scope="col"> ID</th>
                                <th scope="col">Customer Name</th>
                                <th scope="col">Report</th>
            
                            </tr>
                        </thead>
                        <?php
                if($result)
                {
                    foreach($result as $row)
                    {
            ?>
                        <tbody>
                            <tr>
                                <td> <?php echo $count; ?> </td>
                                <td> <?php echo $row['Cust_name']; ?> </td>
                                <td>   
                                <input class="cust_id" type="hidden" value="<?php echo $row['Order_id']; ?>">
                                <button type="button" class="btn btn-primary view_btn" data-toggle="modal" data-target="#exampleModal"> View </button>
                                </td>
                            </tr>
                        </tbody>
                        <?php   
                        $count++;        
                    }
                }
                else 
                {
                    echo "No Record Found";
                }
            }
            ?>
                    </table>
<div class="modal fade" id="customerVIEWModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Monthly Report</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
    <div class="customer_viewing_data">

    </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="button" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>

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

    $('#myModal').on('shown.bs.modal', function () {
  $('#myInput').trigger('focus')
})
</script>
<script>
   
    $(document).ready(function(){
        $('.view_btn').click(function (e){
        e.preventDefault();
        var Order_id= $(this).closest('td').find('.cust_id').val();
        var from_date = $(".form-class").val();
        var to_date = $(".to-class").val();
        console.log(from_date,"from date:");
        console.log(to_date,"to date:");
        var to=$(this).closest('td').find('.cust_id').val();
        //console.log(Cust_id);
        //alert('hello');
        $.ajax({ //create an ajax request to display.php
                    type: "POST",
                    url: "Display_monthly_report.php",
                    data:{

                        'Checking_viewbtn':true,
                        'Order_ID':Order_id,
                        'Start_date':from_date,
                        'End_date':to_date
                        

                    },              
                    success: function (response) {
                        console.log(response);
                        $('.customer_viewing_data').html(response);
                        $('#customerVIEWModal').modal('show');
                        //alert(response);
                    }
                });
        })
    });
</script>
</html>