<?php 
include "../db.php";

if($_SERVER["REQUEST_METHOD"] == "GET"){
  $delete=$_GET['id'];
  $sql=$conn->prepare("DELETE FROM employees WHERE id='$delete'");
  $sql->execute();
  header("Location:http://localhost/JOBTASK/dashboard/tables.php");

}
?>
