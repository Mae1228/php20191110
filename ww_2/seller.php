<?php
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}

$res=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$uemail=$userRow['email'];

$email=@$_POST['email'];
$password=@$_POST['password'];
if(isset($_POST['btn_seller'])){
    if ($uemail==$email){
        $query="SELECT * FROM dbtest.users WHERE email='$email'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_array($result);
        $pwd=$row['password'];
        $sel=$row['seller'];
        if ($sel==0) {
            if ($password == $pwd) {
                $que = mysqli_query($link, "UPDATE dbtest.users SET seller=1 WHERE email='$email'");
                $que_seller = mysqli_query($link, "INSERT INTO seller(semail,jhcount,xscount,kccount) VALUES('$email',0,0,0)");
                echo "<script language=JavaScript>window.alert('注册商家成功！')</script>";
            } else {
                echo "<script language=JavaScript>window.alert('输入密码失败！')</script>";
            }
        }else{
            echo "<script language=JavaScript>window.alert('该普通用户已经是商家，注册失败！')</script>";
        }
    }else{
            echo "<script language=JavaScript>window.alert('输入邮箱错误！')</script>";
    }

}
if(isset($_POST['btn_client'])){
    if ($uemail==$email){
        $query="SELECT * FROM dbtest.users WHERE email='$email'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_array($result);
        $pwd=$row['password'];
        $sel=$row['seller'];
        if ($sel==1) {
            if ($password == $pwd) {
                $que = mysqli_query($link, "UPDATE dbtest.users SET seller=0 WHERE email='$email'");
//                $que_seller = mysqli_query($link, "DELETE  FROM seller WHERE semail='$email'");
                echo "<script language=JavaScript>window.alert('取消商家成功！')</script>";
            } else {
                echo "<script language=JavaScript>window.alert('输入密码失败！')</script>";
            }
        }else{
            echo "<script language=JavaScript>window.alert('该普通用户不是商家，取消失败！')</script>";
        }
    }else{
        echo "<script language=JavaScript>window.alert('输入邮箱错误！')</script>";
    }

}
mysqli_close($link);

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $userRow['email']; ?>注册商家</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="login-form">
    <form method="post">
        <table align="center" width="30%" border="0">
            <tr>
                <td><input type="email" name="email" placeholder="email" required/></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="input password" required /></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn_seller">注册商家</button></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn_client">取消商家</button></td>
            </tr>
            <tr>
                <td><a href="home.php">返回</a></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>