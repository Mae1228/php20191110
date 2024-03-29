<!DOCTYPE HTML>
<html>
<head>
<meta charset="utf-8">
<meta name="renderer" content="webkit|ie-comp|ie-stand">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width,initial-scale=1,minimum-scale=1.0,maximum-scale=1.0,user-scalable=no" />
<meta http-equiv="Cache-Control" content="no-siteapp" />
<!--[if lt IE 9]>
<script type="text/javascript" src="lib/html5shiv.js"></script>
<script type="text/javascript" src="lib/respond.min.js"></script>
<![endif]-->
<link rel="stylesheet" type="text/css" href="static/h-ui/css/H-ui.min.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/H-ui.admin.css" />
<link rel="stylesheet" type="text/css" href="lib/Hui-iconfont/1.0.8/iconfont.css" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/skin/default/skin.css" id="skin" />
<link rel="stylesheet" type="text/css" href="static/h-ui.admin/css/style.css" />
<!--[if IE 6]>
<script type="text/javascript" src="lib/DD_belatedPNG_0.0.8a-min.js" ></script>
<script>DD_belatedPNG.fix('*');</script>
<![endif]-->
<title>折线图</title>
</head>
<body>
<nav class="breadcrumb"><i class="Hui-iconfont">&#xe67f;</i> 首页 <span class="c-gray en">&gt;</span> 统计管理 <span class="c-gray en">&gt;</span> 折线图 <a class="btn btn-success radius r" style="line-height:1.6em;margin-top:3px" href="javascript:location.replace(location.href);" title="刷新" ><i class="Hui-iconfont">&#xe68f;</i></a></nav>
<div class="page-container">
	<div class="f-14 c-error"><span class="select-box" style="width:150px">
			<select class="select" id="select" name="brandclass" size="1">
				<option value="1">温度</option>
				<option value="2">湿度</option>
			</select>
			</span></div>
	<div id="container" style="min-width:700px;height:400px"></div>
	
</div> 
<!--请在下方写此页面业务相关的脚本-->
<script type="text/javascript" src="./echarts.min.js"></script>
<script type="text/javascript" src="./jquery-1.8.0.min.js"></script>
<script type="text/javascript">
$(function () {
        var myChart = echarts.init(document.getElementById('container'));
		var wen_xAxis =[];
		var shi_xAxis =[];
		var wen_series_data=[];
		var shi_series_data=[];
	     option = {
			title: {
				text: '温度湿度折线图'
			},
			
			xAxis: {
				type: 'category',
				data: wen_xAxis
			},
			yAxis: {
				type: 'value'
			},
			series: [{
				data: wen_series_data,
				type: 'line'
			}]
		};
		myChart.showLoading();
        // 使用刚指定的配置项和数据显示图表。
        //myChart.setOption(option);
		setInterval(getData,1000);
		
		$('#select').change(function(){
			var v=$(this).val();
			if(v == 1){
				 option = {
					title: {
						text: '温度湿度折线图'
					},
					
					xAxis: {
						type: 'category',
						data: wen_xAxis
					},
					yAxis: {
						type: 'value'
					},
					series: [{
						data: wen_series_data,
						type: 'line'
					}]
				};
				myChart.clear();
				myChart.setOption(option);
				
			}
			if(v == 2){
				 option = {
					title: {
						text: '温度湿度折线图'
					},
					
					xAxis: {
						type: 'category',
						data: shi_xAxis
					},
					yAxis: {
						type: 'value'
					},
					series: [{
						data: shi_series_data,
						type: 'line'
					}]
				};
				myChart.clear();
				myChart.setOption(option);
				
			}
		});
		function getData(){
			$.ajax({
				url:'./ws_ajax.php',
				dataType:'json',
				success:function(msg){
					wen_xAxis.push(msg.wen.xAxis);
					shi_xAxis.push(msg.shi.xAxis);
					wen_series_data.push(msg.wen.data);
					shi_series_data.push(msg.shi.data);
				}
			});
			
			myChart.setOption(option);
			myChart.hideLoading();
		}
});

</script>
</body>
</html>