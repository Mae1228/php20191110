<?php
//session_start();
if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
include_once 'dbconnect.php';
$mark=@$_POST['mark'];
$p_id=$_GET['p_id'];

$query=mysqli_query($link,"DELETE FROM dbtest.shangpin WHERE mark='$p_id'");
header("location:find.php");
