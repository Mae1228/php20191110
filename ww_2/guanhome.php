<?php
include_once 'Dbconnect.php';

if(!isset($_SESSION['user']))
{
    header("Location: index.php");
}
$res=mysqli_query($link,"SELECT * FROM users WHERE user_id=".$_SESSION['user']);
$userRow=mysqli_fetch_array($res);

?>

<!DOCTYPE html>
<html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>欢迎 - <?php echo $userRow['email']; ?></title>
    <link rel="stylesheet" href="style.css" type="text/css" />
</head>
<body>
<?php echo '用户名：';echo $userRow['username']; ?><br>
<?php echo '用户邮箱：';echo $userRow['email']; ?><br>
<?php echo '用户余额：';echo $userRow['account']; ?><br>
<label>普通用户信息</label>
    <table style='text-align:left;' border='1'>
        <tr><th>user_id</th><th>username</th><th>email</th><td>password</td></tr>
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
//            $code = $result_arr['code'];
            echo "<tr><td>$user_id</td><td>$username</td><td>$email</td><td>$password</td></tr>";
        }
        mysqli_close($link);
        ?>
    </table>
            <a href="updata_password.php">修改密码</a>
            <a href="account.php">设置账户余额</a>
            <a href="forget_guan.php">重置普通用户密码</a>
            <a href="add_shangpin.php">添加商品</a>
            <a href="find.php">删除商品</a>
            <a href="logout.php?logout">退出登陆</a>
            <a href="ws.php">温湿度</a>
</body>
</html>