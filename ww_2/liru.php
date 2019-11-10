<?php
//session_start();
include_once 'Dbconnect.php';

$email=@$_POST['email'];
$pass=@$_POST['password'];

if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}

//$mark=mysqli_query($link,"SELECT * FROM client WHERE mark='$email'");

if(isset($_POST['btn_login']))
{
    $result=mysqli_query($link,"SELECT * FROM users WHERE email='$email'");
    $num=mysqli_num_rows($result);
    if($num>0){
        $row=mysqli_fetch_array($result);#查找符合条件的所有数据
        $uname=$row[1];
        $email=$row[2];
        $upass=$row[3];
        $code=$row['code'];
        if($pass==$upass){
            $uid=file_get_contents("./uid.txt");
            $uid=substr($uid,0,strlen($uid)-1);
            $luru=mysqli_query($link,"UPDATE dbtest.users SET uid='$uid'WHERE email='$email'");
            $_SESSION['user'] = $row['user_id'];
            $_SESSION['email'] = $row['email'];
            if ($code == 3) {
                echo "<script language=JavaScript>window.alert('普通用户登陆成功！')</script>";
                echo "<script language=JavaScript>window.location='home.php'</script>";
            }
            if ($code == 2) {
                echo "<script language=JavaScript>window.alert('管理用户登陆成功！')</script>";
                echo "<script language=JavaScript>window.location='guanhome.php'</script>";
            }
            if ($code == 1) {
                echo "<script language=JavaScript>window.alert('超级用户登陆成功！')</script>";
                echo "<script language=JavaScript>window.location='superhome.php'</script>";
            }
        }else{
            echo "<script language=JavaScript>window.alert('登陆失败(密码错误)！')</script>";
        }
    }else{
        echo "<script language=JavaScript>window.alert('请添加用户')</script>";
        echo "<script language=JavaScript>window.location='Register.php'</script>";
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>录入注册系统</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="login-form">
    <form method="post">
        <table align="center" width="30%" border="0">
            <tr>
                <td><input type="email" name="email" placeholder="Your Email" required /></td>
            </tr>
            <tr>
                <td><input type="password" name="password" placeholder="Your Password" required /></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn_login">ok</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>