<?php
session_start();
header("Content-Type:text/html;charset=utf-8");
header("Content-Type:image/png");
$image=imagecreatetruecolor(100,30);
//imagecolorallocate(int im,int red,int green,int blue);
$bgcolor=imagecolorallocate($image, 255, 255, 255);
//int imagefill(int im,int x,int y,int col);
imagefill($image,0,0,$bgcolor);
$content="ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789";
$captcha="";
for($i=0;$i<4;$i++)
{
	$fontsize=10;
	$fontcolor=imagecolorallocate($image, rand(0,120), rand(0,120), rand(0,120));
	$fontcontent=substr($content,mt_rand(0,strlen($content)),1);
	$captcha.=$fontcontent;
	$x=($i*100/4)+mt_rand(5,10);
	$y=mt_rand(5,10);
	imagestring($image,$fontsize,$x,$y,$fontcontent,$fontcolor);
}
$_SESSION["captcha"]=$captcha;
for($i=0;$i<200;$i++)
{
	$pointcolor=imagecolorallocate($image, mt_rand(50,200), mt_rand(50,200), mt_rand(50,200));
	imagesetpixel($image,mt_rand(1,99),mt_rand(1,29),$pointcolor);
}
for($i=0;$i<3;$i++)
{
    $linecolor=imagecolorallocate($image, rand(80,220), rand(80,220), rand(80,220));
    imageline($image,rand(1,99),rand(1,29),rand(1,99),rand(1,29),$linecolor);
}
ob_clean();
imagepng($image);
imagedestroy($image);
?>