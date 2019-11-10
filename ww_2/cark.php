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
    $uid=file_get_contents("./uid.txt");
    $uid=substr($uid,0,strlen($uid)-1);
    $result=mysqli_query($link,"SELECT * FROM users WHERE uid='$uid'");
    $num=mysqli_num_rows($result);
    if($num>0){
        $row=mysqli_fetch_array($result);#查找符合条件的所有数据
        $uname=$row[1];
        $email=$row[2];
        $upass=$row[3];
        $code=$row['code'];

        $_SESSION['user'] = $row['user_id'];
        $_SESSION['email'] = $row['email'];
        //$captcha=@$_POST["captcha"];

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
    }

    else{
        echo "<script language=JavaScript>window.alert('刷卡失败！请录入信息')</script>";
        echo "<script language=JavaScript>window.location='liru.php'</script>";
    }
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>登陆注册系统</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="login-form">
    <form method="post">
        <table align="center" width="30%" border="0">
            <tr>
                <td><button type="submit" name="btn_login">刷卡登陆</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>