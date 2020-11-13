<?php
include("config/config.php");
include_once("controllers/home.php");
$manage= new home();
$id= $_GET['id'];
$sql = "DELETE FROM details WHERE id='".$id."'";

if ($manage->db->query($sql)) {
     header('Location:index.php');
} 
?>