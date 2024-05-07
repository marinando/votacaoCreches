<?php
if(isset($_GET["id"])){
    $id = $_GET["id"];

    $servername = "localhost";
    $username = "root";
    $password = "";
    $datebase = "creche";

    $connection = new mysqli($servername,$username,$password,$datebase);


$sql = " DELETE FROM usuarios  WHERE id=$id";
$connection -> query($sql);
}

     header("location: /creche/index.php");
     exit;

?>