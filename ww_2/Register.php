<?php
//session_start();
if(isset($_SESSION['user'])!="")
{
    header("Location: home.php");
}
include_once 'dbconnect.php';
$uname=@$_POST['uname'];
$email=@$_POST['email'];
$upass=@$_POST['upass'];

if(isset($_POST['btn_signup']))
{
    $query="SELECT * FROM user WHERE email='$email'";
    $result=mysqli_query($link,$query);
    $row=mysqli_num_rows($result);
    if ($row>0){
        echo "<script language=JavaScript>window.alert('邮箱不存在！')</script>";
    }else{
        $query="INSERT INTO users(username,email,password,code,account,seller) VALUES('$uname','$email','$upass',3,'0.00',0)";
        $result=mysqli_query($link,$query);
        $id=mysqli_insert_id($link);
        if($id>0){
            echo "<script language=JavaScript>window.alert('注册成功！')</script>";
            echo "<script language=JavaScript>window.location='Index.php'</script>";
        }else{
            echo "<script language=JavaScript>window.alert('邮箱已存在，注册失败！')</script>";
        }

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
<center>
    <div id="login-form">
        <form method="post">
            <table align="center" width="30%" border="0">
                <tr>
                    <td><input type="text" name="uname" placeholder="User Name" required /></td>
                </tr>
                <tr>
                    <td><input type="email" name="email" placeholder="Your Email" required /></td>
                </tr>
                <tr>
                    <td><input type="password" name="upass" placeholder="Your Password" required /></td>
                </tr>
                <tr>
                    <td><button type="submit" name="btn_signup">注册</button></td>
                </tr>
                <tr>
                    <td><a href="Index.php">返回登陆</a></td>
                </tr>
            </table>
        </form>
    </div>
</center>
</body>
</html>