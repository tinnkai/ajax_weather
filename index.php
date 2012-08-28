<?php
/**
 * index page
 * 
 * @author  chenhaigang <chenhaigang@altech-it.cn>
 * @version 20110804
 */
// read user common file
require_once("include/User.inc.php");
header('Content-Type: text/html; charset=utf-8');
include('./simple_html_dom.php');
	
	if(!$_COOKIE["addCookie"])
	{
		$html = file_get_html('http://www.baidu.com/s?tn=site888_pg&ie=utf-8&bs=file_get_conten&f=8&rsv_bp=1&wd=ip%E5%9C%B0%E5%9D%80&inputT=4609'); //有道天气预报
		//$html = file_get_contents('http://iframe.ip138.com/city.asp');
		//$name = iconv('utf-8','gbk',htmlspecialchars($html))
		foreach($html->find("div[class=op_ip_content]") as $e)
		{
			$infoSrt = preg_replace("/<(\/?p.*?)>/si",'',$e->find("p",0));
		}
		$infoArr = explode("&nbsp;",strip_tags($infoSrt));
		//echo $infoArr[3];
		setcookie("addCookie",$infoArr[3]);
	}
	echo $_COOKIE["addCookie"];
	//exit;
if (isset($_POST['province']))
{
	$province = './xml/'.$_POST['province'].'_citys.xml';
	if(file_exists($province))
	{
		//读取一个xml文件作为操作的对象    
		//由于simplexml解析返回的信息是UTF8格式的，如果网站使用的是GBK的，则需要转码，你可以使用iconv函数或者其他的utf8与gbk转换函数进行操作，如：$name = iconv(’utf-8′,’gbk’,$name);
		$xml = simplexml_load_file($province);
		$object = $xml->getName();
		$cityArr = array();
		foreach($xml->children() as $child)
		{
			$child->getName;
			foreach($child->children() as $row)
			{
				$cityArr[] = $row;
			}
		}
	}
	
	$Smarty->assign("cityArr",$cityArr);
	$fetch = $Smarty->fetch('city.html');
	echo $fetch;
	exit;
}
elseif (isset($_POST['city']) && isset($_POST['isCity']))
{
	if($_POST['isCity']=="")
	{
		echo $_POST['isCity'];
		exit;
	}
	$city = urldecode($_POST['city']).urldecode('天气');
	// get DOM from URL or file
	$dir = date("Y/m/d");
	//文件路径
	$file_path = './cache/'.$dir.'/'.substr(urlencode($_POST['city']),-30,30).'.html';
	//文件存在的时候调用缓存文件不存在就获取有道天气预报
	if(!file_exists($file_path))
	{
		//调用生成多层目录函数
		MultiMkdir($dir);
		//调用获取天气预报函数
		$wearth = getWearth($city);
		
		$Smarty->assign("wearth",    $wearth);
	    $fetch = $Smarty->fetch('fetch.html');
	    echo $fetch;
	    
	    //创建缓存文件
	    $Smarty->assign("cache", $wearth);
		$discache = $Smarty->fetch('cache.html');
		$ft = @fopen($file_path,'w+'); 
		@fwrite($ft,$discache); 
		@fclose($ft);
		exit;
	}
	else
	{
		$file_handle = file_get_contents($file_path);
		$cache = explode(",",$file_handle);
		$Smarty->assign("wearth",    $cache);
	    $fetch = $Smarty->fetch('fetch.html');
	    echo $fetch;
		exit;
	}
}

/*
从从有道搜索获取天气信息
http://www.youdao.com/search?q=' .$city.'&ue=utf8&keyfrom=web.index
*/
function getWearth($city)
{
	$html = file_get_html('http://www.youdao.com/search?q=' .$city.'&ue=utf8&keyfrom=web.index'); //有道天气预报
	foreach($html->find('div[id=summary]') as $e)
	{
	    $arr0[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",0));
	    $arr1[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",1));
	    $arr2[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",2));
	    $arr3[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",3));
	}
	$strong = htmlspecialchars("</strong>");
	$pa  = htmlspecialchars("<p>");
	$pf  = htmlspecialchars("</p>");
	$today = explode($pa,str_replace($pf,"",str_replace("weather",'weather_s',htmlspecialchars($arr0[0]))));
	$today = array_merge($today,explode($pa,str_replace($pf,"",htmlspecialchars(preg_replace("/<(\/?span.*?)>/si",'',$arr1[0])))));

	$tomorrow = str_replace($strong,$pa,htmlspecialchars($arr2[0]));
	$tomorrow = explode($pa,str_replace($pf,"",$tomorrow));
	$acquired = str_replace($strong,$pa,htmlspecialchars($arr3[0]));
	$acquired = explode($pa,str_replace($pf,"",$acquired));
	//合并数组
	$wea = array_merge($today,$tomorrow,$acquired);
	$wearth = array();
	foreach($wea as $val)
	{
		$wearth[] = htmlspecialchars_decode($val);
	}
	return $wearth;
}
//创建多层目录
function MultiMkdir($dir) 
{
	$dir = explode('/',$dir);
	for($i=0;$i<count($dir);$i++)
	{
		$mkdir .= $dir[$i]."/";
		@mkdir("./cache/".$mkdir);
	}
}
$Smarty->display("index.html");
?>