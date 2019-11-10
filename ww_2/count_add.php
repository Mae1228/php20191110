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

include_once 'Dbconnect.php';

$pmark=$_GET["mark"];
//echo $pmark;

$ress=mysqli_fetch_array(mysqli_query($link,"select email from users where user_id=".$_SESSION['user']));
//echo $ress[0];

$rprice=mysqli_fetch_array(mysqli_query($link,"select price from dbtest.shangpin where mark='$pmark'"));
//echo $rprice[0];

$r=mysqli_query($link,"select mark from client where selleremail='$ress[0]'");
$mark_arr=array();
while ($row=mysqli_fetch_array($r)){
    $mark_arr[]=$row[0];
}

$r2=mysqli_query($link,"select price from client where mark='$pmark' and selleremail='$ress[0]'");
$price_arr=array();
while ($row2=mysqli_fetch_array($r2)){
    $price_arr[]=$row2[0];
}

$r1=mysqli_query($link,"select selleremail from client where mark='$pmark'");
$selleremail_arr=array();
while ($row1=mysqli_fetch_array($r1)){
    $selleremail_arr[]=$row1[0];
}

if (in_array($pmark,$mark_arr)) {//存在则增加数量
    if (in_array($ress[0],$selleremail_arr)) {
        if(in_array($rprice[0],$price_arr)){
            $jsl = mysqli_query($link, "update client set kccount=kccount+1 where mark='$pmark' and selleremail='$ress[0]' and price='$rprice[0]'");
        }else{
            $re2=mysqli_fetch_array(mysqli_query($link,"select * from shangpin where mark='$pmark'"));
            $jxx2=mysqli_query($link,"insert into client(mark,pname,paizi,zhenguan,price,selleremail,kccount) value('{$re2['mark']}','{$re2['name']}','{$re2['paizi']}','{$re2['zhenguan']}','{$re2['price']}','$ress[0]',1)");
        }
    }else{//不存在则添加
        $re1=mysqli_fetch_array(mysqli_query($link,"select * from shangpin where mark='$pmark'"));
        $jxx1=mysqli_query($link,"insert into client(mark,pname,paizi,zhenguan,price,selleremail,kccount) value('{$re1['mark']}','{$re1['name']}','{$re1['paizi']}','{$re1['zhenguan']}','{$re1['price']}','$ress[0]',1)");
    }
}else{//不存在则添加
    $re=mysqli_fetch_array(mysqli_query($link,"select * from shangpin where mark='$pmark'"));
    $jxx=mysqli_query($link,"insert into client(mark,pname,paizi,zhenguan,price,selleremail,kccount) value('{$re['mark']}','{$re['name']}','{$re['paizi']}','{$re['zhenguan']}','{$re['price']}','$ress[0]',1)");
}
?>

<table width="100%" border="1" cellpadding="0" cellspacing="0">
    <tr>
        <td>中性笔代号</td>
        <td>中性笔名称</td>
        <td>中性笔牌子</td>
        <td>中性笔类型(针管)</td>
        <td>中性笔价格</td>
        <td>中性笔库存量</td>
    </tr>
    <?php

    //2.从数据库中找出数据

    $sql = "select * from client where selleremail='$ress[0]'";
    $arr = mysqli_query($link,$sql);

    foreach($arr as $v)
    {
        echo"<tr>
        <td>{$v['mark']}</td>
        <td>{$v['pname']}</td>
        <td>{$v['paizi']}</td>
        <td>{$v['zhenguan']}</td>
        <td>{$v['price']}</td>
        <td>{$v['kccount']}</td>
        </tr> 
        ";
    }

    ?>

</table>
<a href="count.php">进货</a>
<a href="home.php">返回用户</a>

</body>
</html>
