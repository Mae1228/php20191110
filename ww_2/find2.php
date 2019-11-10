<html>
<body>
<form action="" method="get">
    关键字：	<input type="text" name="key" />
    <input type="submit" name="sub" value="搜索" />

</form>
<form method="post">
    <td><button type="submit" name="btn_find">查看全部信息</button></td>

</form>
<a href="home.php">返回用户</a>
<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td>顾客邮箱</td>
        <td>中性笔代号</td>
        <td>中性笔名称</td>
        <td>中性笔牌子</td>
        <td>中性笔类型(针管)</td>
        <td>中性笔价格</td>
        <td>顾客购买量</td>
        <td>中性笔下单时间</td>
    </tr>

    <?php
    header("Content-type:text/html;charset=utf-8");
    include_once "Dbconnect.php";

    $uemail=$_SESSION['uemail'];

    if(isset($_POST['btn_find'])){
        $res=mysqli_query($link,"select * from dbtest.order where selleremail='{$uemail}'");
        foreach($res as $v)
        {
            echo"<tr>
            <td>{$v['email']}</td>
            <td>{$v['mark']}</td>
            <td>{$v['pname']}</td>
            <td>{$v['paizi']}</td>
            <td>{$v['zhenguan']}</td>
            <td>{$v['price']}</td>
            <td>{$v['count']}</td>
            <td>{$v['time']}</td>
            </tr> 
            ";
        }
    }

    if(@$_GET['key']) {
        $sql = "SELECT * FROM dbtest.order WHERE selleremail='{$uemail}' and mark LIKE '%$_GET[key]%'";
        $query = mysqli_query($link,$sql);
        while($r=mysqli_fetch_array($query)) {
            echo "<tr>
            <td>$r[email]</td>
            <td>$r[mark]</td>
            <td>$r[pname]</td>
            <td>$r[paizi]</td>
            <td>$r[zhenguan]</td>
            <td>$r[price]</td>
            <td>$r[count]</td>
            <td>$r[time]</td>
            </tr>
            ";
        }
    }

    ?>
</table>

</body>
</html>
