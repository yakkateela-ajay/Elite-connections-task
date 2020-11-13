<?php
session_start();
include ("controllers/home.php");
include ("config/config.php");
$manage= new home();
$conn = mysqli_connect(DB_SERVER, DB_USERNAME,DB_PASSWORD, DB_NAME);
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
    alert('recaptcha failed');
}
}
?>