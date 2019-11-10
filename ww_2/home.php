<?php
//session_start();
include_once 'dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
$res=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);

mysqli_close($link);
?>
<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>欢迎 - <?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<div id="header">
    <div id="left">
        <label>个人信息</label>
    </div>
    <div id="right">
        <div id="content">
            <?php echo '用户名：';echo $userRow['username']; ?><br>
            <?php echo '用户邮箱：';echo $userRow['email']; ?><br>
            <?php echo '用户余额：';echo $userRow['account']; ?><br>
            <?php echo '用户身份：';
            if($userRow['seller']==1){
                $_SESSION['uemail'] = $userRow['email'];
                echo '商家';
                echo "<tr><a href='count.php'>商家进货</a></tr>";
                echo "<tr><a href='find2.php'>商家查找订单信息</a></tr>";

            }
            if($userRow['seller']==0){
                echo '顾客';
                echo "<tr><a href='main.php'>购物网站</a></tr>";
            }?>
            <br>
            <a href="updata_password.php">修改密码</a>
            <a href="account.php">设置账户余额</a>
            <a href="seller.php">注册或者取消商家</a>
            <a href="logout.php?logout">退出登陆</a>
            <a href="ws.php">温湿度</a>
        </div>
    </div>
</div>
</body>
</html>