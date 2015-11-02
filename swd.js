console.time("js总执行时间")

// 默认选中当前日期
var mydate =new Date();
$("select[name='begin_year'] option[value="+(mydate.getFullYear()-1)+"]").attr("selected",true);
$("select[name='begin_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='begin_day'] option[value="+mydate.getDate()+"]").attr("selected",true);
$("select[name='end_year'] option[value="+mydate.getFullYear()+"]").attr("selected",true);
$("select[name='end_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='end_day'] option[value="+mydate.getDate()+"]").attr("selected",true);

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
	for(var i=0;i<all_column.length;i++){
		$("."+all_column[i]).css("width",(parseInt(all_column_width[all_column[i]])+1)+"px");
	}
	$(window).scroll(function(){
		var scrolls=$(this).scrollTop();
		if(scrolls>thetop+x){
			element.css({position:'fixed',top:0});
		}else{
			element.css({position:pos,top:thetop});
		}
	});
};
$("#th").smartFloat(0);

// 滚动到文档最底部
// scroll(0,$(document).height());

console.timeEnd("js总执行时间")