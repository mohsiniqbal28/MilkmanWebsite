<?Php
global $counter;
$quan= $pay="";
if(isset($_POST['Checking_viewbtn']))
{
$o_id=$_POST['Order_ID'];
$from_date=$_POST['Start_date'];
$to_date=$_POST['End_date'];
    require_once "config.php"; 
    $sql_cust = "SELECT Cust_name FROM tbl_order where Order_date BETWEEN '$from_date'AND'$to_date' AND Order_id='$o_id'"; 
    $result_cust = mysqli_query($conn, $sql_cust);
    $row_cust=mysqli_fetch_assoc($result_cust);
    $cust= $row_cust["Cust_name"];  
    //Query For Naga 
if(true){


    $sql_naga = "SELECT Order_date FROM tbl_order where Order_date BETWEEN '$from_date'AND'$to_date' AND Cust_name='$cust'";                               
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

    // $sql = "SELECT  Order_quan FROM tbl_order where Order_date BETWEEN '$from_date' AND '$to_date' Cust_name='$cust'"; 
    // $result = mysqli_query($conn, $sql);
    // $row=mysqli_fetch_assoc($result);
    // $quan= $row["Order_quan"]." Kilos";    
       
    //  $Psql = "SELECT sum(Pay_total) as Pay_total FROM payment where Order_date BETWEEN '$from_date' AND '$to_date' Cust_name='$cust'"; 
    //  $Presult = mysqli_query($conn, $Psql);
    //  $row=mysqli_fetch_assoc($Presult); 
    //  $pay= $row["Pay_total"]." Rs."; 
     
     echo $return='
     <h2>Name:'.$cust.'</h2>
     <h5>Total Quantity:</h5>
     <h5>Total Naga:</h5>
    <h5>Total Payment:</h5>
     
     ';
    } else{
        echo "No Record Available!";
    }
}

?>
