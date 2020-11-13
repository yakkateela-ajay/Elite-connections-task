<?php 
session_start();
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT");
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); 
header("Cache-Control: no-store, no-cache, must-revalidate"); 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");
include ("controllers/home.php");
include ("config/config.php");
$manage= new home();
$conn = mysqli_connect(DB_SERVER, DB_USERNAME,DB_PASSWORD, DB_NAME);

?>
<!DOCTYPE html>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="Hoozor Tech Services">
  <meta name="theme-color" content="#ff6041">

  <title>Sample Project</title>
  <link rel="stylesheet" type="text/css" media="screen" href="jquery-ui.css" />
    <script src="jquery.js"></script>
    <script src="jquery-ui.js"></script>
  <!-- Bootstrap core CSS -->
  <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">
  <style>
      .bg-dark {
    background-color: #ff6041 !important;
}

.btn-primary {
    color: #fff;
    background-color: #009C98;
    border-color: #009C98;
}

  </style>
  
 
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
 
<script src="https://www.google.com/recaptcha/api.js" async defer></script>

</head>



<!-- <script>-->
<!-- $(function() {-->
<!--    $("#dob").datepicker({-->
<!--    onSelect: function(value, ui) {-->
<!--        var today = new Date(), -->
<!--            age = today.getFullYear() - ui.selectedYear;-->
<!--        $('#age').val(age);-->
<!--    },-->
      
<!--    dateFormat: 'dd-mm-yy',changeMonth: true,changeYear: true,yearRange:"c-100:c+0"-->
<!--    });-->
     
<!--});-->
<!--  </script>-->
 <script type = "text/javascript">
        $(document).ready(function () {
            var age = "";
            $('#dob').datepicker({
                onSelect: function (value, ui) {
                    var today = new Date();
                    age = today.getFullYear() - ui.selectedYear;
                    $('#age').val(age);
                },
                changeMonth: true,
                changeYear: true
            })
        })
    </script>
  <script>
      function editWin(e) {
window.open('edit.php?id='+e,'','height=400, width=600, top=100, left=400, scrollable=no, menubar=no', '');
}; 

      popup.focus();
      
  </script>
<body style="font-family: 'Lato', sans-serif;">

  <!-- Navigation -->
  <nav class="navbar fixed-top navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
      <a class="navbar-brand" href="/">Sample Project</a>
    
    </div>
  </nav>
 

  <div class="container" style="min-height:700px;padding-bottom:40px">

   

    <!-- Marketing Icons Section -->
    <div class="row">
      
    <?php
      if (isset($_POST['submit'])) 
             { 
     if(isset($_POST['g-recaptcha-response']) && !empty($_POST['g-recaptcha-response'])){ 
            // Google reCAPTCHA API secret key 
            $secretKey = '6LeubuIZAAAAAEjTf0saDkmgTTuZ3xdgps6Nmlx8'; 
             
            // Verify the reCAPTCHA response 
            $verifyResponse = file_get_contents('https://www.google.com/recaptcha/api/siteverify?secret='.$secretKey.'&response='.$_POST['g-recaptcha-response']); 
             
            // Decode json data 
            $responseData = json_decode($verifyResponse); 
             
            // If reCAPTCHA response is valid 
            if($responseData->success){ 
	$DOJ=date("Y-m-d");
	$sql="INSERT INTO `details`(`name`, `email`, `phone`, `dob`) VALUES ('".$_POST['name']."','".$_POST['email']."','".$_POST['phone']."','".$_POST['dob']."')";
	mysqli_query($conn, $sql);
}
else {
   echo"<script>alert('Recpatcha Validation Failed or Required');</script>";
}
}
}

    ?>
    <br>
    <div class="col-md-12">
        
        <br>
        <form id="frmContact" method="post" action="">
  <div class="form-row">
    <div class="form-group col-md-6">
      <label for="inputEmail4">Name</label>
      <input required name="name" type="text" class="form-control" id="inputEmail4" placeholder="Name">
    </div>
    <div class="form-group col-md-6">
      <label for="inputPassword4">Email</label>
      <input required name="email" type="email" class="form-control" id="inputPassword4" placeholder="Email">
    </div>
    <div class="form-group col-md-6">
      <label for="inputEmail4">Phone No</label>
      <input required name="phone" type="tel" class="form-control" id="inputEmail4" placeholder="Phone No">
    </div>
    <div class="form-group col-md-4">
      <label for="dob">Date of Birth</label>
      <input required name="dob" type="date" class="form-control" id="dob">
    </div>
    <div class="form-group col-md-2">
      <label for="age">Age</label>
      <input  name="age" type="text" class="form-control" id="age" placeholder="Age" readonly>
    </div>
    
  </div>
   <div class="g-recaptcha" data-sitekey="6LeubuIZAAAAANDXioZOi1gQXyhT__guxLYT0qPW"></div>

 <input name="submit" class="btn btn-primary" type="submit" value="Submit">
</form>

                </div>
                <br>
                <div class="col-md-12" style="padding-top:20px">
                    <?php
$sql = "SELECT * FROM `details` ORDER BY `id` DESC";
$row=$manage->get_records($sql);
if (empty($row)) {
 echo "No Students found here";
  echo "<div>";
 echo "<div>";
} 
else{
?>
                    <table class="table table-bordered">
  <thead>
    <tr>
      
      <th scope="col">Name</th>
      <th scope="col">Email</th>
      <th scope="col">Phone No</th>
      <th scope="col">Date of Birth</th>
      <th scope="col">Age</th>
      <th>Action</th>
    </tr>
  </thead>
  <tbody>
      	<?php
$x='0';
//print_r($row);
while($x<sizeof($row)){
	
                	?>
    <tr>
    
      <td><?php echo $row[$x]["name"];?></td>
      <td><?php echo $row[$x]["email"];?></td>
      <td><?php echo $row[$x]["phone"];?></td>
      <td><?php echo $row[$x]["dob"];?></td>
      <td><?php echo $row[$x]["age"];?></td>
      <td><a class="btn btn-info btn-sm" id="<?php echo $row[$x]["id"];?>" href='#' onclick='javascript:editWin(this.id); return(false);'>Edit</a>&nbsp;&nbsp;<a class="btn btn-danger btn-sm" href="delete.php?id=<?php echo $row[$x]["id"];?>">Delete</a></td>
    </tr>
    <?php
$x++;
            }
        }
            ?>
  </tbody>
</table></div>
                </div>
            </div>
        </div>
        <!-- About Page 1 Area End Here -->
        

<!-- Footer -->
  <footer class="bg-dark" style="padding:20px 0 20px 0">
    <div class="container">
      <p class="m-0 text-center text-white">Copyright &copy; 2020 | Developed by Ajay Yakkateela</p>
    </div>
    <!-- /.container -->
  </footer>

  <!-- Bootstrap core JavaScript -->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
<!--Start of Tawk.to Script-->

</body>

</html>
