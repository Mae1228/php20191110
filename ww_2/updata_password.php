<?php

include_once 'Dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
$rrr=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$ur=mysqli_fetch_array($rrr);
$uremail=$ur[2];

$email=@$_POST['email'];
$oldpassword=@$_POST['oldpassword'];
$newpassword=@$_POST['newpassword'];

if(isset($_POST['btn_xiugaiup'])){
//    $res=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
    if($email==$uremail){
        $res=mysqli_query($link,"SELECT * FROM dbtest.users WHERE email='$email'");
        $userRow=mysqli_fetch_array($res);
        $uoldpassword=$userRow[3];
        $uemail=$userRow[4];
        if ($oldpassword==$uoldpassword){
            $query="UPDATE dbtest.users SET password='$newpassword'WHERE email='$email'";
            $result=mysqli_query($link,$query);
            $row=mysqli_fetch_array($result);
            if($result){
//            $_SESSION['user'] = $row['user_id'];
                if ($uemail==3) {
                    echo "<script language=JavaScript>window.alert('普通用户修改密码成功！')</script>";
                    echo "<script language=JavaScript>window.location='home.php'</script>";
                }
                if ($uemail==2) {
                    echo "<script language=JavaScript>window.alert('管理员修改密码成功！')</script>";
                    echo "<script language=JavaScript>window.location='guanhome.php'</script>";
                }
                if ($uemail==1) {
                    echo "<script language=JavaScript>window.alert('超级管理员修改密码成功！')</script>";
                    echo "<script language=JavaScript>window.location='superhome.php'</script>";
                }
            }
        }else{
            echo "<script language=JavaScript>window.alert('输入密码错误！')</script>";
        }
    }else{
        echo "<script language=JavaScript>window.alert('输入邮箱错误！')</script>";
    }

    mysqli_close($link);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $userRow['email']; ?>修改密码</title>
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
                    <td><input type="password" name="oldpassword" placeholder="Old Password" required /></td>
                </tr>
                <tr>
                    <td><input type="password" name="newpassword" placeholder="New Password" required /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn_xiugaiup">修改密码</button></td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>
