<?php
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
header("Location: index.php");
}

$res=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);
$remail=$userRow['email'];
$rcode=$userRow['code'];

$email=@$_POST['email'];
$account=@$_POST['account'];
if(isset($_POST['btn_account'])){
    if ($remail==$email){
        $query="UPDATE dbtest.users SET account='$account'WHERE email='$email'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_array($link,$result);
        if ($result){
            echo "<script language=JavaScript>window.alert('金钱设置成功！')</script>";
            if ($rcode==1){
                echo "<script language=JavaScript>window.location='superhome.php'</script>";
            }
            if ($rcode==2){
                echo "<script language=JavaScript>window.location='guanhome.php'</script>";
            }
            if ($rcode==3){
                echo "<script language=JavaScript>window.location='home.php'</script>";
            }
        }
    }else{
        echo "<script language=JavaScript>window.alert('输入邮箱错误！')</script>";
    }

}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title><?php echo $userRow['email']; ?>设置余额</title>
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
                <td><input type="number" name="account" placeholder="input account" required /></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn_account">ok</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
