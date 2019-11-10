<?php

include_once 'Dbconnect.php';

//$mname=@$_POST['mname'];
//$mpwd=@$_POST['mpwd'];
$email=@$_POST['email'];

if(isset($_POST['btn_xiugaiup'])){
//    $res=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
    $res=mysqli_query($link,"SELECT * FROM dbtest.users WHERE email='$email' AND code=2");
    $userRow=mysqli_fetch_array($res);
    $uemail=$userRow[2];
    if ($email==$uemail){
        $query="UPDATE dbtest.users SET password=000000 WHERE email='$email'";
        $result=mysqli_query($link,$query);
        $row=mysqli_fetch_array($result);
        if($result){
//            $_SESSION['user'] = $row['user_id'];
            echo "<script language=JavaScript>window.alert('该管理用户重置密码成功！密码是：000000')</script>";
            echo "<script language=JavaScript>window.location='superhome.php'</script>";
        }
    }else{
        echo "<script language=JavaScript>window.alert('没有该管理用户！')</script>";
    }
    mysqli_close($link);
}

?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>超级管理员重置管理员密码</title>
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
                <td><button type="submit" name="btn_xiugaiup">重置密码</button></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
