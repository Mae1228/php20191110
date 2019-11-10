<?php
//session_start();
if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
include_once 'dbconnect.php';
$price=@$_POST['price'];
$pmark=$_GET["mark"];

if(isset($_POST['btn_price']))
{
    $query="SELECT * FROM dbtest.shangpin WHERE mark='$pmark'";
    $result=mysqli_query($link,$query);
    if ($result){
        $q=mysqli_query($link,"UPDATE dbtest.shangpin SET price='$price'WHERE mark='$pmark'");
        echo "<script language=JavaScript>window.alert('修改成功！')</script>";
        echo "<script language=JavaScript>window.location='count.php'</script>";
    }else{
            echo "<script language=JavaScript>window.alert('修改失败！')</script>";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>商家修改商品价格</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
    <div id="login-form">
        <form method="post">
            <table align="center" width="30%" border="0">
                <tr>
                    <td><input type="number" name="price" placeholder="价格" required /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn_price">修改</button></td>
                </tr>
                <tr>
                    <td><a href="count.php">返回</a></td>
                </tr>
            </table>
        </form>
    </div>
</center>
</body>
</html>