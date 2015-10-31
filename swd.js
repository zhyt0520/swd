var all_column= new Array("RiQi","JingHao","BanZu","MuQianJingBie","QuKuaiDanYuan","KaiCaiCengWei","ChongCheng","ChongCi","YouZui","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","ShengChanShiJian","BengJing","BengShen","YeMianShiJian","YeMian","ChenMoDu","LiLunPaiLiang","BengXiao","YouYa","TaoYa","HuiYa","RiChanYe","RiChanYou","RiChanQi","HanShui","BeiZhu");
var hidden_column= new Array("BanZu","MuQianJingBie","QuKuaiDanYuan","ShangXingDianLiu","XiaXingDianLiu","PingHengLv","YeMianShiJian");
// 隐藏 hidden_column 数组内标记的数据列
for(var i=0;i<hidden_column.length;i++){
	$("."+hidden_column[i]).css("display","none");
};
// 默认选中当前日期
var mydate =new Date();
$("select[name='begin_year'] option[value="+(mydate.getFullYear()-1)+"]").attr("selected",true);
$("select[name='begin_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='begin_day'] option[value="+mydate.getDate()+"]").attr("selected",true);
$("select[name='end_year'] option[value="+mydate.getFullYear()+"]").attr("selected",true);
$("select[name='end_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='end_day'] option[value="+mydate.getDate()+"]").attr("selected",true);
// 滚动到文档最底部
scroll(0,$(document).height());