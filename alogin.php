<!DOCTYPE html>
<html lang="en">
<head>
     <meta charset="utf-8">
     <title> Door Milk -  Milk Man Website App</title>
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
    <link href="css/alogin.css" rel="stylesheet">
   
</head>
<body>

    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="circle"></div>
    <div class="form-sec">
        <h1>Admin Login</h1>

        <form method="post">

        <input type="text" name="admin_id" placeholder="AdminID" required>
        <br>
        <input type="password" name="password" placeholder="Password" required>
        <br>
        <input type="submit" value="Login">
        </form>
        <?php
            include_once('config.php');
            $mid = $ps= "";

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
                            echo "<img src='checked.png'>"." Login Success!";
                            header("location:Admin_view_page.php");
                        }
                        else {
                            echo "<img src='images/cancel.png' width=20px>"." Incorrect ManagerID or Password!";
                        }
                    }
                mysqli_close($conn);

                }
                  else{
                    echo "Empty ManagerID or Password!";
                }
            }
        ?>
    </div>
</body>
</html>