<?php
include_once 'Dbconnect.php';
session_start();

if(!isset($_SESSION['user']))
{
    header("Location: Index.php");
}
else if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}

if(isset($_GET['logout']))
{
    $arr=mysqli_query($link,"select * from dbtest.shangpin");
    foreach ($arr as $v){
        $a=mysqli_query($link,"UPDATE dbtest.shangpin SET price='{$v['xprice']}' WHERE mark='{$v['mark']}'");
    }
    session_destroy();
    unset($_SESSION['user']);#销毁
    unset($_SESSION['gwc']);#销毁
//    header("Location: Index.php");
    echo "<script language=JavaScript>window.location='Index.php'</script>";
    exit;
}
mysqli_close($link);
?>