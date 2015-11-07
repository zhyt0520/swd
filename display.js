// 数据列的 class
// note 注意 js 里面定义数组的方法 （关联数组貌似就直接用的对象）
var all_column=["RiQi","JingHao","BanZu","MuQianJingBie","QuKuaiDanYuan","KaiCaiCengWei","ChongCheng","ChongCi","YouZui","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","ShengChanShiJian","BengJing","BengShen","YeMianShiJian","YeMian","ChenMoDu","LiLunPaiLiang","BengXiao","YouYa","TaoYa","HuiYa","RiChanYe","RiChanYou","RiChanQi","HanShui","BeiZhu"];
var hidden_column=["BanZu","MuQianJingBie","QuKuaiDanYuan","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","YeMianShiJian","HuiYa"];
var dis_colum=["RiQi","JingHao","KaiCaiCengWei","ChongCheng","ChongCi","YouZui","ShengChanShiJian","BengJing","BengShen","YeMian","ChenMoDu","LiLunPaiLiang","BengXiao","YouYa","TaoYa","RiChanYe","RiChanYou","RiChanQi","HanShui","BeiZhu"];

// 隐藏 hidden_column 数组内标记的数据列
for(var i=0;i<hidden_column.length;i++){
	$("."+hidden_column[i]).css("display","none");
};

// 获取数据列的列宽
var all_column_width={};
for(var i=0;i<dis_colum.length;i++){
	all_column_width[dis_colum[i]]=$("th."+dis_colum[i]).css("width").substring(0,$("th."+dis_colum[i]).css("width").length-2);
}

// 表格的表头浮动固定
$.fn.smartFloat=function(x){
	var element=$(this);
	var thetop=element.position().top;
	var pos=element.css('position');
	var wid=element.css('width');
	var offsetleft=element.offset().left;
	var offsettop=element.offset().top;
	for(var i=0;i<all_column.length;i++){
		$("."+all_column[i]).css("width",(parseInt(all_column_width[all_column[i]])+1)+"px");
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

// 给 #rigth 的内容添加单独的滚动条
$("#right").css("max-height",window.innerHeight-$("#top").css("height").substring(0,$("#top").css("height").length-2)-14+"px");

// 从网上抄来的图片显示效果——鼠标滑过预览大图
this.imagePreview = function(){	
	/* CONFIG */
		xOffset = 200;
		yOffset = -720;
		// these 2 variable determine popup's distance from the cursor
		// you might want to adjust to get the right result
	/* END CONFIG */
	$("a.preview").hover(function(e){
		this.t = this.title;
		this.title = "";	
		var c = (this.t != "") ? "<br/>" + this.t : "";
		$("body").append("<div id='preview'><img src='"+ this.rel +"' alt='Image preview' />"+ c +"</div>");								 
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px")
			.fadeIn("fast");						
    },
	function(){
		this.title = this.t;	
		$("#preview").remove();
    });	
	$("a.preview").mousemove(function(e){
		$("#preview")
			.css("top",(e.pageY - xOffset) + "px")
			.css("left",(e.pageX + yOffset) + "px");
	});			
};
// starting the script on page load
$(document).ready(function(){
	imagePreview();
});

// 滚动到文档最底部
// scroll(0,$(document).height());