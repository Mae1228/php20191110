<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
    <title>中性笔购物网站</title>
</head>

<body>
<h1>中性笔列表</h1>

<?php
header("content-type:text/html;charset=utf-8");
//header("Content-type: image/jpg;");
include_once 'Dbconnect.php';


//1.找出购物车中多少种商品和总价
$uid = $_SESSION["user"];
$attr = array();
//如果购物车有商品，取出值
if(!empty($_SESSION["gwc"]))
{
    $attr = $_SESSION["gwc"];
}

$gs = count($attr);//$gs 商品数量
$sum = 0;//$sum 总价格,默认总价格为0
foreach($attr as $v)
{
    $v[0];//p_id
    $v[1]; //数量
//    $v[3];//商家
//    echo "<script language=JavaScript>window.alert($v[0])</script>";
//    $sql = "select price from client where mark ='{$v[0]}'";//查询单价
    $sql = "select price from client where p_id ='{$v[0]}'";//查询单价
    $ajg = mysqli_fetch_array(mysqli_query($link,$sql));
    $dj = $ajg[0][0];//单价
    $sum += $dj * $v[1];//总价=单价*数量
}
echo"<div>购物车中有:{$gs}种商品，商品总价为:{$sum}元</div>";
?>



<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td>中性笔代号</td>
        <td>中性笔名称</td>
        <td>中性笔牌子</td>
        <td>中性笔类型(针管)</td>
        <td>中性笔价格</td>
        <td>商家</td>
        <td>中性笔库存量</td>
        <td>&nbsp;&nbsp;</td>
    </tr>
    <?php

    //2.从数据库中找出数据

    $sql = "select * from client";
    $arr = mysqli_query($link,$sql);

    foreach($arr as $v)
    {

        echo"<tr>
        <td>{$v['mark']}</td>
        <td>{$v['pname']}</td>
        <td>{$v['paizi']}</td>
        <td>{$v['zhenguan']}</td>
        <td>{$v['price']}</td>
        <td>{$v['selleremail']}</td>
        <td>{$v['kccount']}</td>
        <td><a href=\"add.php?mark={$v['p_id']}\">购买</a></td>
        </tr> 
        ";
    }

    ?>

</table>
<a href="shopping_cart.php?mark={$v['p_id']}">查看购物车</a>
<a href="home.php">返回用户</a>

</body>
</html>