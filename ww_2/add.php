<?php
//session_start();
include_once 'Dbconnect.php';

//找出点击"购买"的ids
$ids = $_GET["mark"];

//1.第一次点击添加购物车
//2.如果购物车中没有该商品
//3.如果购物车中有该商品


//第一步，判断购物车为空，则第一次点击把商品添加到购物车
if(empty($_SESSION["gwc"]))
{
    $arr = array(array($ids,1));
    $_SESSION["gwc"] = $arr;
}
//如果不为空，则有2种判断，1：该商品为空，则需添加进去，2：该商品有，则需数量上+1；
else
{
    //不是第一次点击
    //判断购物车中是否存在该商品
    $arr = $_SESSION["gwc"];//先存一下

    $chuxian = false;
    foreach($arr as $v)
    {
        if($v[0]==$ids)
        {
            $chuxian =true;
        }
    }

    if($chuxian)
    {
        //如果购物车中有该商品
        for($i=0;$i<count($arr);$i++)
        {
            if ($arr[$i][0]==$ids){
                $arr[$i][1]+=1;
                break;
            }
//            $arr[$i][1]+=1;
        }


        $_SESSION["gwc"] =$arr;
    }

    else
    {
        //如果购物车中没有该商品
        $asg = array($ids,1);
        $arr[] =$asg;
        $_SESSION["gwc"] = $arr;
    }
}

header("location:main.php");

//session_start();
////取到传过来的主键值，并且添加到购物车的SESSION里面
//$ids = $_GET["mark"];
//
////如果是第一次添加购物车,造一个二维数组存到SESSION里面
////如果不是第一次添加，有两种情况
////1.如果该商品购物车里面不存在，造一个一维数组扔到二维里面
////2.如果该商品在购物车存在，让数量加1
//
//if(empty($_SESSION["gwd"])){
//    //如果是第一次添加购物车,造一个二维数组存到SESSION里面
//    $arr = array( array($ids,1));
//    $_SESSION["gwd"]=$arr;
//}else{
//
//    $arr=$_SESSION["gwd"];
//    if(deep_in_array($ids,$arr)){
//        //如果该商品在购物车存在，让数量加1
//        foreach($arr as $k=>$v){
//            if($v[0]==$ids){
//                $arr[$k][1]++;
//            }
//        }
//        $_SESSION["gwd"]=$arr;
//    }else{
//        //如果该商品购物车里面不存在，造一个一维数组扔到二维里面
//        $arr=$_SESSION["gwd"];
//        $attr=array($ids,1);
//        $arr[]=$attr;
//        $_SESSION["gwd"]=$arr;
//    }
//}
//header("location:main.php");
//
//function deep_in_array($value, $array) {
//    foreach($array as $item) {
//        if(!is_array($item)) {
//            if ($item == $value) {
//                return true;
//            } else {
//                continue;
//            }
//        }
//
//        if(in_array($value, $item)) {
//            return true;
//        } else if(deep_in_array($value, $item)) {
//            return true;
//        }
//    }
//    return false;
//}