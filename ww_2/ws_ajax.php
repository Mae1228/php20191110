<?php
	require "./SqlHelper.php";
	$pdo = new SqlHelper("root","root","localhost","dbtest");
	$sql="select zhi,time from ws where status = 1 order by id desc limit 1";
	$data=$pdo->getOne($sql);
	$wen_data=array();
	$shi_data=array();
	$wen_data['xAxis']=$data['time'];
	$wen_data['data']=$data['zhi'];
	$re_data=array();
	$re_data['wen']=$wen_data;
	$sql="select zhi,time from ws where status = 2 order by id desc limit 1";
	$data=$pdo->getOne($sql);
	$shi_data['xAxis']=$data['time'];
	$shi_data['data']=$data['zhi'];
	$re_data['shi']=$shi_data;
	echo json_encode($re_data);