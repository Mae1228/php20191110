<?php
//session_start();
if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
include_once 'dbconnect.php';
$mark=@$_POST['mark'];
$name=@$_POST['name'];
$paizi=@$_POST['paizi'];
$zhenguan=@$_POST['zhenguan'];
$price=@$_POST['price'];

if(isset($_POST['btn_add']))
{
    $query="SELECT * FROM dbtest.shangpin WHERE mark='$mark'";
    $result=mysqli_query($link,$query);
    $row=mysqli_num_rows($result);
    if ($row>0){
        echo "<script language=JavaScript>window.alert('该商品代号已经存在！')</script>";
    }else{
        $query="INSERT INTO dbtest.shangpin(mark,name,paizi,zhenguan,price,xprice) VALUES('$mark','$name','$paizi','$zhenguan','$price','$price')";
        $result=mysqli_query($link,$query);
        $id=mysqli_insert_id($link);
        if($id>0){
            echo "<script language=JavaScript>window.alert('添加成功！')</script>";
            echo "<script language=JavaScript>window.location='guanhome.php'</script>";
        }else{
            echo "<script language=JavaScript>window.alert('添加失败！')</script>";
        }

    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>管理员添加商品信息</title>
    <link rel="stylesheet" href="style.css" type="text/css" />

</head>
<body>
<center>
    <div id="login-form">
        <form method="post">
            <table align="center" width="30%" border="0">
                <tr>
                    <td><input type="number" name="mark" placeholder="商品代号" required /></td>
                </tr>
                <tr>
                    <td><input type="text" name="name" placeholder="商品名" required /></td>
                </tr>
                <tr>
                    <td><input type="text" name="paizi" placeholder="商品牌子" required /></td>
                </tr>
                <tr>
                    <td><input type="text" name="zhenguan" placeholder="商品的针管" required /></td>
                </tr>
                <tr>
                    <td><input type="number" name="price" placeholder="商品价格" required /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn_add">添加</button></td>
                </tr>
                <tr>
                    <td><a href="guanhome.php">返回</a></td>
                </tr>
            </table>
        </form>
    </div>
</center>
</body>
</html>