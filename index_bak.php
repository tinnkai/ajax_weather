<?php
/**
 * index page
 * 
 * @author  chenhaigang <chenhaigang@altech-it.cn>65465465465456324165463132
 * @version 20110804
 */
// read user common file
require_once("include/User.inc.php");
header('Content-Type: text/html; charset=utf-8');
//header('Content-Type: text/xml; charset=utf-8');
//example of how to modify HTML contents
include('./simple_html_dom.php');

if (isset($_GET['province']))
{
	$province = 'xml/'.$_GET['province'].'_citys.xml';
	$content = file_get_contents($province);
	//读取一个xml字符串作为操作的对象    
	//由于simplexml解析返回的信息是UTF8格式的，如果网站使用的是GBK的，则需要转码，你可以使用iconv函数或者其他的utf8与gbk转换函数进行操作，如：$name = iconv(’utf-8′,’gbk’,$name);
	$xml = simplexml_load_string($content);

	$object = $xml->xpath('//data');

	function objectToArray(&$object)
	{
		$object = (array)$object;
		foreach ($object as $key => $value)
		{
			//$value = (array)$value;
			//var_dump($value);
			//exit;
			if (is_object($value)||is_array($value))
			{
				objectToArray($value);
				$object[$key] = $value;
			}
		}
		return $object;
	}
	objectToArray($object);
	//var_dump($object);
	
	echo "<select name='ajaxcity' id='ajaxcity'  onchange='ajax_City()'>";
	echo '<option value="0">请选择</option>';
	foreach($object as $citys)
	{
		foreach($citys as $va)
		{
			foreach($va as $ci)
			{
				if($ci == '苏州')
				echo "<option value=$ci selected>$ci</option>";
				else
				echo "<option value=$ci>$ci</option>";
			}
		}
	}
	echo "</select>";exit;
}
/*
从从有道搜索获取天气信息----陈海刚
http://www.youdao.com/search?q=' .$city.'&ue=utf8&keyfrom=web.index
*/
if (isset($_GET['city']))
{
	$city = urldecode($_GET['city']).urldecode('天气');
	// get DOM from URL or file
	$dir = date("Y/m/d");
	//调用生成多层目录函数
	MultiMkdir($dir);
	//文件路径
	$file_path = './cache/'.$dir.'/'.$_GET['city'].'.html';
	//文件存在的时候调用缓存文件不存在就获取有道天气预报
	if(file_exists($file_path))
	{
		$html = file_get_html($file_path);
	}
	else
	{
		$html = file_get_html('http://www.youdao.com/search?q=' .$city.'&ue=utf8&keyfrom=web.index'); //有道天气预报
	}
	foreach($html->find('td[class=todaycontent]') as $e)
	{
	    $arr0[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",0));
	    $arr1[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",1));
	    $arr2[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",2));
	    $arr3[] = preg_replace("/<(\/?td.*?)>/si",'',$e->find("td",3));
	}
	$ca = array_merge($arr0,$arr1,$arr2,$arr3);
	/*foreach($ca as $val)
	{
		$cahe[] = htmlspecialchars($val);
	}*/
	//文件不存在的时候创建和写入文件
	if(!file_exists($file_path))
	{
		$Smarty->assign("cache", $ca);
		$discache = $Smarty->fetch('cache.html');
		$ft = @fopen($file_path,'w+'); 
		@fwrite($ft,$discache); 
		@fclose($ft);
	}
	//print_r($ca);
	$br = htmlspecialchars("<br>");
	$ba  = htmlspecialchars("<b>");
	$bf  = htmlspecialchars("</b>");
	$arr0 = explode($br,htmlspecialchars(str_replace("30",'20',$arr0[0])));
	$arr1 = array_merge($arr0,explode($br,htmlspecialchars(preg_replace("/<(\/?span.*?)>/si",'',$arr1[0]))));
	$arr2 = explode($br,htmlspecialchars($arr2[0]));
	$arr22 = explode($bf,str_replace($ba,"",$arr2[0]));
	$arr3 = explode($br,htmlspecialchars($arr3[0]));
	$arr33 = explode($bf,str_replace($ba,"",$arr3[0]));
	$wea = array_merge($arr1,$arr22,$arr2,$arr33,$arr3);
	foreach($wea as $val)
	{
		$wearth[] = htmlspecialchars_decode($val);
	}
	//print_r($wea);
    $Smarty->assign("wearth",    $wearth);
    $fetch = $Smarty->fetch('fetch.html');
    echo $fetch;
	exit;
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