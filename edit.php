<?php
session_start();

include ("controllers/home.php");
include ("config/config.php");
$manage= new home();
 $sql = "SELECT * FROM `details` WHERE id='".$_GET['id']."'";
             $row=$manage->get_records($sql);
?>
<html>
    <head>
        <title>Edit</title>
        <link href="vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://fonts.googleapis.com/css?family=Lato&display=swap" rel="stylesheet">

  <!-- Custom styles for this template -->
  <link href="css/modern-business.css" rel="stylesheet">
  
  <script type="text/javascript">
        function RefreshParent() {
            if (window.opener != null && !window.opener.closed) {
                window.opener.location.reload();
            }
        }
        window.onbeforeunload = RefreshParent;
    </script>
    </head>
    <body>
           <?php 

             if (isset($_POST['submit'])) 
             { 
             
                $date_create=date("Y-m-d");
                $update="UPDATE `details` SET `email`='".$_POST['email']."' WHERE id='".$_GET['id']."'";
                if ($manage->db->query($update))
                             {
                            echo"<script>alert('Successful');</script>";
                               echo"<script type='text/javascript'>
                               window.close();</script>";
                             
                            }
              
              
             }
             ?>
        <div class="container">
        <form action="" method="post">
            <label>Email</label>
            <input value="<?php echo $row[0]['email'];?>" class="form-control" type="email" name="email" class="form-control">
            <br>
            <input type="submit" name="submit" value="Update">
        </form>
        </div>
    </body>
</html>
