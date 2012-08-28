var xmlHttp=null;
function GetXmlHttpRequest()
{
	var xmlHttp=null;
	try
	{
		xmlHttp=new XMLHttpRequest();
	}
	catch(e)
	{
		try
		{
			xmlHttp=new ActiveXObject("Msxml2.XMLHTTP");
		}
		catch(e)
		{
			try
			{
				xmlHttp=new ActiveXObject("Microsoft.XMLHTTP");
			}
			catch(e)
			{
				xmlHttp=false;
			}
		}
	}
	return xmlHttp;
}

function ajax_Province()
{
	var province=document.getElementById("province").value;
	//alert(get_customer);
	xmlHttp=GetXmlHttpRequest();
	if(xmlHttp==null)
	{
		alert("您的浏览器不支持XmlHttpRequest!");
		return;
	}
	var url="index.php?province="+encodeURI(province);
	xmlHttp.open("GET",url,true);
	
	xmlHttp.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
	
	//带参数执行projectUpdatePage函数
	xmlHttp.onreadystatechange=projectUpdatePage;
	
	xmlHttp.send("province="+encodeURI(province));
	//xmlHttp.send("id="+encodeURI(get_customer));

}

function projectUpdatePage()
{
	if(xmlHttp.readyState==4 && xmlHttp.status==200)
	{
		var response=xmlHttp.responseText;
		document.getElementById("ajaxcity").innerHTML=response;
	}
}