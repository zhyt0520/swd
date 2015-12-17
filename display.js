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
		$("."+dis_column[i]).css("width",(parseInt(dis_column_width[dis_column[i]])+1)+"px");
	}
	$(window).scroll(function(){
		var scrolls=$(this).scrollTop();
		if(scrolls>thetop+x){
			element.css({position:'fixed',top:0,width:wid,});
			// element.offset({top:null,left:offsetleft,});
		}else{
			element.css({position:pos,top:thetop,width:wid,});
		}
	});
};
$("#th").smartFloat(0);
$("#right").smartFloat(0);
// $("#tab_ul").smartFloat(10)

// 控制 #right的最大高度，给 #rigth 的内容添加单独的滚动条
// $("#right").css("max-height",window.innerHeight-$("#top").css("height").substring(0,$("#top").css("height").length-2)-14+"px");
$("#right").css("max-height",window.innerHeight-7);

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
$(".indicator_diagram,.liquid_level").dblclick(function(){
	var url=$(this).attr("src");
	url=url.substr(2,url.length);
	var a=$('<a href="http://localhost'+url+'" target="_blank"></a>')[0];
	var e=document.createEvent('MouseEvents');
	e.initEvent('click',true,true);
	a.dispatchEvent(e);
});

// 滚动到文档最底部
// scroll(0,$(document).height());