// 数据列的 class
// note 注意 js 里面定义数组的方法 （关联数组貌似就直接用的对象）
var all_column=["RiQi","JingHao","BanZu","MuQianJingBie","QuKuaiDanYuan","KaiCaiCengWei","ChongCheng","ChongCi","YouZui","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","ShengChanShiJian","BengJing","BengShen","YeMianShiJian","YeMian","ChenMoDu","LiLunPaiLiang","BengXiao","YouYa","TaoYa","HuiYa","RiChanYe","RiChanYou","RiChanQi","HanShui","BeiZhu"];
var hidden_column=["BanZu","MuQianJingBie","QuKuaiDanYuan","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","YeMianShiJian","HuiYa"];
// 数据列的列宽
var all_column_width={"RiQi":65,"JingHao":63,"BanZu":28,"MuQianJingBie":32,"QuKuaiDanYuan":70,"KaiCaiCengWei":39,"ChongCheng":28,"ChongCi":28,"YouZui":32,"ShangXingDianLiu":30,"XiaXingDianLiu":30,"PingHengLv":30,"ShengChanShiJian":53,"BengJing":28,"BengShen":30,"YeMianShiJian":28,"YeMian":43,"ChenMoDu":41,"LiLunPaiLiang":28,"BengXiao":34,"YouYa":28,"TaoYa":28,"HuiYa":28,"RiChanYe":41,"RiChanYou":41,"RiChanQi":41,"HanShui":29,"BeiZhu":130};

// 隐藏 hidden_column 数组内标记的数据列
for(var i=0;i<hidden_column.length;i++){
	$("."+hidden_column[i]).css("display","none");
};

// 设定列宽
for(key in all_column_width){
	$("."+key).css("width",all_column_width[key]);
}

// 默认选中当前日期
var mydate =new Date();
$("select[name='begin_year'] option[value="+(mydate.getFullYear()-1)+"]").attr("selected",true);
$("select[name='begin_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='begin_day'] option[value="+mydate.getDate()+"]").attr("selected",true);
$("select[name='end_year'] option[value="+mydate.getFullYear()+"]").attr("selected",true);
$("select[name='end_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='end_day'] option[value="+mydate.getDate()+"]").attr("selected",true);

// 表格的表头浮动固定
$.fn.smartFloat=function(x){
	var element=$(this);
	var thetop=element.position().top;
	var pos=element.css('position');
	var wid=element.css('width');
	var offsetleft=element.offset().left;
	var offsettop=element.offset().top;
	$(window).scroll(function(){
		var scrolls=$(this).scrollTop();
		if(scrolls>thetop+x){
			element.css({position: 'fixed',top: 0,width: wid,});
			element.offset({top:null,left:offsetleft});
		}else{
			element.css({position: pos,top: thetop,width: wid,});
		}
	});
};
$("#th").smartFloat(0);

// 滚动到文档最底部
scroll(0,$(document).height());