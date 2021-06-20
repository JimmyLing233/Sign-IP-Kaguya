<?php
header("Content-type: image/JPEG");//图片头
include 'function.php';
$im = imagecreatefromjpeg("xhxh.jpg"); 
$ip = $_SERVER["REMOTE_ADDR"];//获取远程ip
$weekarray=array("日","一","二","三","四","五","六"); //先定义一个数组
//$get=$_GET["s"];
//$get=base64_decode(str_replace(" ","+",$get));
//$wangzhi=$_SERVER['HTTP_REFERER'];这里获取当前网址
$url='https://xhboke.com/mz/ip.php?ip='.$ip; //这里生成ip查询链接
$data = get_curl($url);//这里从api获取ip数据
$data = json_decode($data, true);//解码json
$country = $data['site']['country']; //匹配country
$region = $data['site']['region']; //匹配region
//$adcode = $data['site']['adcode']; 
//定义颜色
$black = ImageColorAllocate($im, 0,0,0);//定义黑色的值
$red = ImageColorAllocate($im, 255,0,0);//红色
$blue = ImageColorAllocate($im, 0,0,225);//蓝色
$org = ImageColorAllocate($im, 255,69,0);//不知道是什么的橘色
$green = ImageColorAllocate($im, 0,225,0);//绿色
$violet = ImageColorAllocate($im, 168,0,211);//暗紫色
$font = '/ali88Regular.ttf';//加载字体(阿里巴巴公用字体)
//输出
imagettftext($im, 16, 0, 10, 40, $blue, $font,'来自'.$country.'-'.$region.'的朋友,欢迎您');//来自(国家)-(地区)的朋友,欢迎您
imagettftext($im, 16, 0, 10, 72, $org, $font, '今天是'.date('Y年n月j日').' 星期'.$weekarray[date("w")]);//当前时间添加到图片
imagettftext($im, 16, 0, 10, 104, $red, $font,'您的IP是:'.$ip);//ip地址
imagettftext($im, 16, 0, 10, 140, $green, $font,'您使用的是'.$os.'操作系统');//显示操作系统
imagettftext($im, 16, 0, 10, 175, $violet, $font,'您使用的是'.$bro.'浏览器');//显示当前浏览器
ImageGif($im);
ImageDestroy($im);
?>
