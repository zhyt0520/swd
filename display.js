// 数据列的 class
// note 注意 js 里面定义数组的方法 （关联数组貌似就直接用的对象）
var dis_column=[];
for(var i=0;i<$("th").length;i++){
	dis_column[i]=$("th").eq(i).attr("class");
}

// 获取数据列的列宽
var dis_column_width={};
for(var i=0;i<dis_column.length;i++){
	dis_column_width[dis_column[i]]=$("th."+dis_column[i]).css("width").substring(0,$("th."+dis_column[i]).css("width").length-2);
}

// 表格的表头浮动固定
$.fn.smartFloat=function(x){
	var element=$(this);
	var thetop=element.position().top;
	var pos=element.css('position');
	var wid=element.css('width');
	var offsetleft=element.offset().left;
	var offsettop=element.offset().top;
	for(var i=0;i<dis_column.length;i++){
		$("."+dis_column[i]).css("width",(Number(dis_column_width[dis_column[i]])+1)+"px");
	}
	$(window).scroll(function(){
		var scrolls=$(this).scrollTop();
		if(scrolls>thetop+x){
			element.css({position:'fixed',top:0,/*width:wid,*/});
			element.offset({/*top:null,*/left:offsetleft,});
		}else{
			element.css({position:pos,/*top:thetop,width:wid,*/});
		}
	});
};
// 判断元素是否存在
if($("#th").length>0){
	$("#th").smartFloat(0);
}
if($("#right").length>0){
	$("#right").smartFloat(0);
}
if($("#div_tube_rod").length>0){
	$("#div_tube_rod").smartFloat(0);
}

// 控制 #right的最大高度，给 #rigth 的内容添加单独的滚动条
// $("#right").css("max-height",window.innerHeight-$("#top").css("height").substring(0,$("#top").css("height").length-2)-14+"px");
$("#right").css("max-height",window.innerHeight-10);

// 从网上抄来的图片显示效果——鼠标滑过预览大图
this.imagePreview = function(){	
		var dx=0;
		var dy=0;
		var x;
		var y;
	$("a.preview").hover(
	function(e){
		this.t = this.title;
		this.title = "";
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<div id='preview'><img src='"+ this.rel +"' alt='Image preview' />"+ c +"</div>");
		dx=-$("#preview").width()-40;
		dy=-$("#preview").height()/2;
		if(e.clientX+dx<=0){
			x=0;
		}else if(e.clientX+dx>=document.documentElement.clientWidth-$("#preview").outerWidth()){
			x=document.documentElement.clientWidth-$("#preview").outerWidth();
		}else{
			x=e.clientX+dx;
		}
		if(e.clientY+dy>=document.documentElement.clientHeight-$("#preview").outerHeight()){
			y=document.documentElement.clientHeight-$("#preview").outerHeight();
		}else if(e.clientY+dy<=0){
			y=0;
		}else{
			y=e.clientY+dy;
		}
		$("#preview")
			.css("top",y+"px")
			.css("left",x+"px")
			.fadeIn("fast");
	},
	function(){
		this.title = this.t;
		$("#preview").remove();
	});
	// 控制浮动图片的显示位置，不要超出窗口边界
	$("a.preview").mousemove(function(e){
		if(e.clientX+dx<=0){
			x=0;
		}else if(e.clientX+dx>=document.documentElement.clientWidth-$("#preview").outerWidth()){
			x=document.documentElement.clientWidth-$("#preview").outerWidth();
		}else{
			x=e.clientX+dx;
		}
		if(e.clientY+dy>=document.documentElement.clientHeight-$("#preview").outerHeight()){
			y=document.documentElement.clientHeight-$("#preview").outerHeight();
		}else if(e.clientY+dy<=0){
			y=0;
		}else{
			y=e.clientY+dy;
		}
		$("#preview")
			.css("top",y+"px")
			.css("left",x+"px");
	});
};
// starting the script on page load
$(document).ready(function(){
	imagePreview();
});

// 右侧标签页切换
$(".tab_head").click(function(){
	$(this).attr("class","tmp");
	$(".tab_selected").attr("class","tab_head tab_unselected");
	$(this).attr("class","tab_head tab_selected");
	var this_id=$(this).attr("id");
	var pos=this_id.lastIndexOf("_");
	var num=this_id.substr(pos+1,this_id.length);
	$(".tab_content").hide();
	$("#tab_content_"+num).show();
});

// 双击功图和液面的图片在新窗口打开
// note 用逗号隔开两个选择器
$(".indicator_diagram,.liquid_level,.tube_rod").dblclick(function(){
	var url=$(this).attr("src");
	url=url.substr(2,url.length);
	var a=$('<a href="'+url+'" target="_blank"></a>')[0];
	var e=document.createEvent('MouseEvents');
	e.initEvent('click',true,true);
	a.dispatchEvent(e);
});

// 滚动到文档最底部
// scroll(0,$(document).height());

// 绘制曲线图
// 获取php查询结果数据
var res=[];
$.ajax({
	type:"POST",
	url:"ajax.php",
	// dataType:"json",
	data:{"res":"res"},
	async:false,
	complete:function(xhr,status){
		// console.log(status);
	},
	success:function(response){
		res=eval(response);
	}
});
// 设置长宽
$("div#div_chart").css({"width":"100%","height":"300px"});
// 从 res 中获取数据列
var richanye=new Array();
var richanyou=new Array();
var hanshui=new Array();
for(var i=0;i<res.length;i++){
	richanye[i]=new Object();
	richanye[i].x=new Date(res[i].RQ);
	richanye[i].y=Number(res[i].RCYL1);

	richanyou[i]=new Object();
	richanyou[i].x=new Date(res[i].RQ);
	richanyou[i].y=Number(res[i].RCYL);

	hanshui[i]=new Object();
	hanshui[i].x=new Date(res[i].RQ);
	hanshui[i].y=Number(res[i].HS);
}
// 把绘图基本参数设置成全局变量
var dataName=["日产液","日产油","含水"];
var color=["brown","red","green"];
// 开始绘图
var chart=new CanvasJS.Chart("div_chart",
	{
		zoomEnabled:true,
		title:{
			text:"生产曲线"
		},
		legend:{
			horizontalAlign:"center", // left, center ,right 
			verticalAlign:"top",  // top, center, bottom
		},
		toolTip: {
			shared:true,
			borderColor: "#aaa",
			fontFamily:"Microsoft YaHei",
			contentFormatter:function(e){
				// var fullYear=e.entries[0].dataPoint.x.getFullYear();
				var month=e.entries[0].dataPoint.x.getMonth()+1;
				var date=e.entries[0].dataPoint.x.getDate();
				var content=month+"月"+date+"日<br/>";
				for(var i=0;i<e.entries.length;i++){
					content+="<span style='color:"+color[i]+"'>"+dataName[i]+"：<strong>"+e.entries[i].dataPoint.y+"</strong></span><br/>";
				}
				return content;
			}
		},
		axisX:{
			valueFormatString:"YYYY-M-D"
		},
		data:[
			{
				type:"line",
				showInLegend: true,
				name:dataName[0],
				color:color[0],
				dataPoints:richanye
			},
			{
				type:"line",
				showInLegend: true,
				name:dataName[1],
				color:color[1],
				dataPoints:richanyou
			},
			{
				type:"line",
				showInLegend: true,
				name:dataName[2],
				axisYType:"secondary",
				color:color[2],
				dataPoints:hanshui
			},
		]
	}
);
chart.render();
// 隐藏广告链接
$("a.canvasjs-chart-credit").css("display","none");