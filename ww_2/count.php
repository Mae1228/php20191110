<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>中性笔购物网站</title>
</head>

<body>
<h1>中性笔进货列表</h1>

<?php
include_once 'dbconnect.php';

$ress=mysqli_fetch_array(mysqli_query($link,"select email from users where user_id=".$_SESSION['user']));

?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td>中性笔代号</td>
        <td>中性笔名称</td>
        <td>中性笔牌子</td>
        <td>中性笔类型(针管)</td>
        <td>中性笔进货价</td>
        <td>中性笔价格</td>
        <td>修改中性笔价格</td>
    </tr>
    <?php

//    $set_price=$_SESSION['set_price'];

    //2.从数据库中找出数据

    $re=mysqli_query($link,"select * from shangpin");

    foreach($re as $v)
    {
        echo"<tr>
        <td>{$v['mark']}</td>
        <td>{$v['name']}</td>
        <td>{$v['paizi']}</td>
        <td>{$v['zhenguan']}</td>
        <td>{$v['xprice']}</td>
        <td>{$v['price']}</td>
        <td><a href='count_add_set_price.php?mark={$v['mark']}'>修改价格</a></td>
        <td><a href='count_add.php?mark={$v['mark']}'>进货</a></td>
        </tr> 
        ";
    }
    ?>

</table>
<a href="home.php">返回用户</a>
</body>
</html>

