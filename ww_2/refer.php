
<?php
header("Content-Type: text/html; charset=utf-8");
include_once 'Dbconnect.php';
date_default_timezone_set('PRC') ;
$uid=$_SESSION["user"];
//echo $uid;
//echo "<script language=JavaScript>window.alert($uid)</script>";
$res=mysqli_fetch_array(mysqli_query($link,"select email from users where user_id=".$_SESSION['user']));
$sye="select account from users where user_id=".$_SESSION['user'];
$aye=mysqli_fetch_array(mysqli_query($link,$sye));
$aye[0];//余额
//echo $aye[0];
//echo "<script language=JavaScript>window.alert($aye[0])</script>";

$attr =array();
if(!empty($_SESSION["gwc"]))
{
    $attr =$_SESSION["gwc"];
}

$sum = 0;//总价
foreach($attr as $v)
{
    $v[0];//水果代号
    $v[1];//数量
//    $sql = "select price from client where mark='{$v[0]}'";
    $sql = "select price from client where p_id='{$v[0]}'";
    $ajg = mysqli_fetch_array(mysqli_query($link,$sql));
    $dj = $ajg[0][0];//单价
    $sum +=$dj*$v[1];

}

//判断余额是否满足购买
if($aye[0]>=$sum)
{
    //余额满足,判断库存
    foreach($attr as $v)
    {
//        $skc = "SELECT pname,kccount FROM client WHERE mark='{$v[0]}'";
        $skc = "SELECT pname,kccount FROM client WHERE p_id='{$v[0]}'";
        $akc = mysqli_fetch_array(mysqli_query($link,$skc));
        $akc[1];//库存
//        echo $akc[0][1];
//        echo 'pname',$akc[0];
//        echo 'kccount',$akc[1];

        //判库存是否满足
        if($akc[1]<$v[1])
        {
            echo"{$akc[1]}库存不足";
            exit;
        }


    }

    //提交订单
    //账户扣除余额
//    $skcye = "update users set account=account-{$sum} where user_id ='{$user}'";

    $skcye = "update users set account=account-{$sum} where user_id =".$_SESSION['user'];
    mysqli_query($link,$skcye,0);


    //扣除库存
    foreach($attr as $v)
    {

//        $skckc = "update client set kccount = kccount-{$v[1]} where mark ='{$v[0]}'";
        $skckc = "update client set kccount = kccount-{$v[1]} where p_id ='{$v[0]}'";
        mysqli_query($link,$skckc,0);
        $skckc1 = mysqli_query($link,"update client set xscount = xscount+{$v[1]} where p_id ='{$v[0]}'",0);

    }

    //添加订单
//    $ddh = date("YmdHis");
//    $time = time();
    $dt = new DateTime();
    $time=$dt->format('Y-m-d H:i:s');
//    $sdd = "insert into orders values('{$ddh}','{$res[0]}','{$time}')";
//    mysqli_query($link,$sdd,0);

    //添加订单详情
    foreach($attr as $v)
    {
        //    $selleremail=mysqli_fetch_array(mysqli_query($link,"select selleremail from client where mark='{$v[0]}'"));
        $sxinxi=mysqli_fetch_array(mysqli_query($link,"select * from client where p_id='{$v[0]}'"));
        $sddxq ="insert into dbtest.order(email,selleremail,mark,pname,paizi,zhenguan,price,pencilcode,count,time) values('{$res[0]}','{$sxinxi['selleremail']}','{$sxinxi['mark']}','{$sxinxi['pname']}','{$sxinxi['paizi']}','{$sxinxi['zhenguan']}','{$sxinxi['price']}','{$v[0]}','{$v[1]}','{$time}')";
//        $sddxq ="insert into dbtest.order(email,selleremail,mark,pname,paizi,zhenguan,price,pencilcode,count,time) values('{$res[0]}','{$sxinxi[6]}','{$sxinxi[0]}','{$sxinxi[1]}','{$sxinxi[2]}','{$sxinxi[3]}','{$sxinxi[4]}','{$v[0]}','{$v[1]}','{$time}')";
        mysqli_query($link,$sddxq,0);
    }
    echo "<script language=JavaScript>window.alert('提交订单成功')</script>";
}
else
{
//    echo"余额不足";
    echo "<script language=JavaScript>window.alert('Lack of money!')</script>";
    header("location:home.php");
    exit;
}
header("location:main.php");