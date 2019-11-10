<?php
include_once 'Dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
$email=@$_POST['email'];
$res=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);

if(isset($_POST['btn_sure'])){
    $email_arr=array();
    $res0=mysqli_query($link,"SELECT * FROM dbtest.users WHERE code=3");
    while ($row0=mysqli_fetch_array($res0)){
        $email_arr[]=$row0['email'];
    }
    if (in_array($email,$email_arr)) {
        $res1 = mysqli_query($link, "UPDATE dbtest.users SET code=2 WHERE email='$email' AND code=3");
        $row = mysqli_fetch_array($res1);
        if ($res1) {
//            $_SESSION['user'] = $row['user_id'];
            echo "<script language=JavaScript>window.alert('设置管理员成功！')</script>";
            echo "<script language=JavaScript>window.location='superhome.php'</script>";

        } else {
            echo "<script language=JavaScript>window.alert('设置管理员失败！')</script>";
        }
    }else{
        echo "<script language=JavaScript>window.alert('没有该普通用户！')</script>";
    }
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>设置管理员</title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<label>普通用户信息</label>
<table style='text-align:left;' border='1'>
    <tr><th>user_id</th><th>username</th><th>email</th><th>password</th><th>code</th></tr>
    <?php
    $result=mysqli_query($link,"SELECT * FROM users WHERE code=3");
    $data_count=mysqli_num_rows($result);//长度
    //循环遍历出数据表中的数据
    for($i=0;$i<$data_count;$i++){
        $result_arr=mysqli_fetch_assoc($result);
        $user_id = $result_arr['user_id'];
        $username = $result_arr['username'];
        $email = $result_arr['email'];
        $password = $result_arr['password'];
        $code = $result_arr['code'];
        echo "<tr><td>$user_id</td><td>$username</td><td>$email</td><th>$password</th><th>$code</th></tr>";
    }
    mysqli_close($link);
    ?>
</table>
<div id="login-form">
    <form method="post">
        <table align="text-align:left;" width="30%" border="0">
            <tr>
                <td><input type="email" name="email" placeholder="email" required/></td>
            </tr>
            <tr>
                <td><button type="submit" name="btn_sure">确定</button></td>
            </tr>
            <tr>
                <td><a href="superhome.php">返回</a></td>
            </tr>
        </table>
    </form>
</div>
</body>
</html>
