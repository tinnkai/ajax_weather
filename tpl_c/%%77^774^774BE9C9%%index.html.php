<?php /* Smarty version 2.6.16, created on 2012-08-17 16:44:17
         compiled from index.html */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>天气</title>
<?php echo '
<style>
body{ margin:0 auto; font-size:12px; color:green; line-height:25px; background-color:#}
A{COLOR: green; FONT-FAMILY: "宋体"; TEXT-DECORATION:none;}
A:hover {COLOR:#379D37; FONT-FAMILY: "宋体"; TEXT-DECORATION: underline;}
.todaycontentdiv {
    display: block;
    float: left;
    width: 219px;
}
.nextdaycontent {
    /*border-left: 1px solid #DFDFDF;*/
    display: block;
    /*float: left;*/
    text-align:center;
    width: 400px;
}
</style>
'; ?>

<script type="text/javascript" src="js/ajax.js"></script>
<script type="text/javascript" src="js/jquery.min.js"></script>
<?php echo '
<script type="text/javascript">

$(document).ready(function(){

  /*$("tr.hid").hide();
  
  $("div").click(function(){
  var name = "tr#"+$(this).attr("value");
  $(name).toggle();
  });*/
      /*$.ajax({
            type:"POST",
            url: "index.php",
            cache: false,
            data: {province:"jiangsu"},
            error: function() {alert(arguments[1]);},
            success: function(result)
            {
            	var name = "#city";
            	$(name).html(result);
            	$("#province").val("jiangsu");
            	$("#ajaxcity").val(\'苏州\');
            	//$("#ajaxcity").prepend("<option value=\'苏州\'>苏州</option>");
            }
        });
            $.ajax({
            type:"POST",
            url: "index.php",
            cache: false,
            data: {city:"江苏省苏州",isCity:"苏州"},
            error: function() {alert(arguments[1]);},
            success: function(result)
            {
            	var name = "#wearth";
            	$(name).html(result);
            	//alert(result);
            }
        });*/
});
</script>
'; ?>

</head>
<body>
<label id="wearth">
<table cellspacing="0" cellpadding="0" border="0" align="center" width="90%">
<tbody>
<tr>
<td class="todaycontent" colspan="2">
<div class="nextdaycontent">
<table class="nexttaycontenttable" cellspacing="0" cellpadding="0" border="0" width="98%">
<tbody>
<tr>
<td class="nextdaycontentnei" width="134px">
<b>今天</b>
</td>
<td class="nextdaycontentnei" width="134px">
<img height="20" border="0" width="20" src="http://shared.ydstatic.com/images/smartresult/weather/04.gif">
</td>
<td class="nextdaycontentnei" width="134px"> 雷阵雨 </td>
<td class="nextdaycontentnei" width="134px"> 26℃~32℃ </td>
<td class="nextdaycontentnei" width="134px"> 东南风3-4级 </td>
</tr>
</tbody>
</table>
</div>
<div class="nextdaycontent">
<table class="nexttaycontenttable" cellspacing="0" cellpadding="0" border="0" width="98%">
<tbody>
<tr>
<td class="nextdaycontentnei" width="134px">
<b> 周五</b>
</td>
<td class="nextdaycontentnei" width="134px">
<img height="20" border="0" align="absmiddle" width="20" src="http://shared.ydstatic.com/images/smartresult/weather_s/03.gif">
</td>
<td class="nextdaycontentnei" width="134px"> 阵雨 </td>
<td class="nextdaycontentnei" width="134px"> 26℃~32℃ </td>
<td class="nextdaycontentnei" width="134px"> 东风4-5级 </td>
</tr>
</tbody>
</table>
</div>
<div class="nextdaycontent">
<table class="nexttaycontenttable" cellspacing="0" cellpadding="0" border="0" width="98%">
<tbody>
<tr>
<td class="nextdaycontentnei" width="134px">
<b> 周六</b>
</td>
<td class="nextdaycontentnei" width="134px">
<img height="20" border="0" align="absmiddle" width="20" src="http://shared.ydstatic.com/images/smartresult/weather_s/04.gif">
</td>
<td class="nextdaycontentnei" width="134px"> 雷阵雨 </td>
<td class="nextdaycontentnei" width="134px"> 25℃~30℃ </td>
<td class="nextdaycontentnei" width="134px"> 东北风7-8级 </td>
</tr>
</tbody>
</table>
</div>
</td>
</tr>
</tbody>
</table>
</label>
<table width="90%" border="0" cellspacing="0" cellpadding="0" align="center"style=" background-color:#eeeeee;border:1px solid green; margin-top:100px">
  <tr>
    <td width="43%">&nbsp;ajax无刷新获取天气预报：<a href=""><?php echo $this->_tpl_vars['row']['re_con']; ?>
</a>
			<select name="province" id="province" onchange="ajax_Province()">
				<option value="" >请选择</option>
				<option value="zhixia" >直辖市</option>
				<option value="tebie" >特别行政区</option>
				<option value="hebei" >河北省</option>
				<option value="shanxi" >山西省</option>
				<option value="neimenggu" >内蒙古自治区</option>
				<option value="liaoning" >辽宁省</option>
				<option value="jiling" >吉林省</option>
				<option value="heilongjiang" >黑龙江省</option>
				<option value="jiangsu" >江苏省</option>
				<option value="zhejiang" >浙江省</option>
				<option value="anhui" >安徽省</option>
				<option value="fujian" >福建省</option>
				<option value="jiangxi" >江西省</option>
				<option value="shandong" >山东省</option>
				<option value="henan" >河南省</option>
				<option value="hubei" >湖北省</option>
				<option value="hunan" >湖南省</option>
				<option value="guangdong" >广东省</option>
				<option value="guangxi" >广西壮族自治区</option>
				<option value="hainan" >海南省</option>
				<option value="sichuan" >四川省</option>
				<option value="guizhou" >贵州省</option>
				<option value="yunnan" >云南省</option>
				<option value="xizang" >西藏自治区</option>
				<option value="shanxi2" >陕西省</option>
				<option value="qinghai" >甘肃省</option>
				<option value="qinghai" >青海省</option>
				<option value="ningxia" >宁夏回族自治区</option>
				<option value="xinjiang" >新疆维吾尔自治区</option>
				<option value="taiwan" >台湾省</option>
			</select>
			<label id="city" >
				<select name="ajaxcity" id="ajaxcity"  onchange="ajax_City()">
					<option value="请选择" >请选择</option>
				</select>
			</label>
    </td>
  </tr>
</table>
</body>
</html>