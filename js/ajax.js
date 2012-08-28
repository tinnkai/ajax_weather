function ajax_Province()
{
	var name = "#city";
	//alert($("#province").val());
    $.ajax({
	        type:'POST',
	        url: 'index.php',
	        cache: false,
	        data: {province:$("#province").val()},
	        error: function() {alert(arguments[1]);},
	        success: function(result)
	        {
	            $(name).html(result);
	            //alert(result);
	         }
	});
}
function ajax_City()
{
	var ajaxcity = $("#ajaxcity").val();
	if(ajaxcity != "")
	{
		$("#wearth").html("<div style='margin:25px 0 0 0;width:500px;height:50px;text-align:center;' id='load'><img src='img/load.gif' border=0></div>");
	}
    $.ajax({
            type:'POST',
            url: 'index.php',
            cache: false,
            data: {city:$("#province").find('option:selected').text()+ajaxcity,isCity:ajaxcity},
            error: function() {alert(arguments[1]);},
            success: function(result)
            {
            	var name = "#wearth";
            	if(result != "")
            	{
            		$(name).html(result);
            	}
            	//alert(result);
            }
        });
}