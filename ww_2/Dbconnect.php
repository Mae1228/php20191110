<?php
////if(!mysqli_connect("localhost","root","root"))
////{
////   die('oops connection problem ! --> '.mysqli_error());
////}
////if(!mysqli_select_db("dbtest"))
////{
////   die('oops database selection problem ! --> '.mysqli_error());
////}
?>
<?php
session_start();
$host = 'localhost'; //主机地址
$database = 'dbtest';   //数据库名
$username = 'root'; //数据库的用户名
$password = 'root'; //数据库的密码
/*
 连接数据库
 */
$link = mysqli_connect($host, $username, $password);
mysqli_select_db($link, "dbtest");
if (!$link) {

    die("could not connect to the database.\n" . mysqli_error($link));//诊断连接错误
}
?>
