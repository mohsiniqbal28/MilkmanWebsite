
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
            include_once('config.php');
            $mid = $ps=$loginerror= "";

            if ($_SERVER["REQUEST_METHOD"] == "POST") {

                if(!empty($_POST['admin_id'] && $_POST['password'])) {

                    $mid = $_POST['admin_id'];
                    $ps = $_POST['password'];
                    $sql = "SELECT Admin_id, Admin_pass FROM tbladmin WHERE Admin_id='$mid'";
                    $result = mysqli_query($conn, $sql);

                    if(!$result) {
                            echo " Error: " . mysqli_error($conn);
                    }
                    else {
                        $row = mysqli_fetch_assoc($result);
                        $match_id = $row["Admin_id"];
                        $match_pass = $row["Admin_pass"];

                        if(($match_id==$mid) && ($match_pass==$ps)) {
    
                            header("location:Admin_view_page.php");
                        }
                        else {
                            $loginerror =" Incorrect ManagerID or Password!";
                        }
                    }
                mysqli_close($conn);

                }
                  else{
                    $loginerror="Empty ManagerID or Password!";
                }
            }
        ?>
    
    <div class="container">
	<div class="header">
		<h2>Admin Login</h2>
	</div>
	<form id="form" class="form" method="POST">
		<div class="form-control" style="background-color: #0a1332;border:none">
			<label for="username">Admin ID</label>
			<input name="admin_id" type="text" placeholder="Enter your id"/>
    </div>
		<div class="form-control" style="background-color: #0a1332;border:none">
			<label for="username">Password</label>
			<input name="password" type="text" placeholder="Enter your Password."/>
		</div>
		<input type="submit" value="Login" name="submit">
        <span style="color: red;margin-left:140px;" > <?php echo $loginerror;?></span>
        
	</form>
</div>
</body>
</html>

   

    



























