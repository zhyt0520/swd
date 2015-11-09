// 默认选中当前日期
var mydate =new Date();
$("select[name='begin_year'] option[value="+(mydate.getFullYear()-1)+"]").attr("selected",true);
$("select[name='begin_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='begin_day'] option[value="+mydate.getDate()+"]").attr("selected",true);
$("select[name='end_year'] option[value="+mydate.getFullYear()+"]").attr("selected",true);
$("select[name='end_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='end_day'] option[value="+mydate.getDate()+"]").attr("selected",true);

// 井号输入框下面显示下拉建议框
// note jquery 里面输入框的取值是 val() 而不是 value
$("#hint").css("width",$("input#jinghao").css("width"));
$("#hint").css("left",$("input#jinghao").offset().left);
$("input#jinghao").keyup(function(){
	if($("input#jinghao").val()!=""){
		$.post("ajax.php",{mark:"hint",sub_jinghao:$("input#jinghao").val()},function(response){
			if(response.length>0){
				$("#hint").html(response);
				$("#hint").show();
			}else{
				$("#hint").html();
				$("#hint").hide();
			}
		})
	}else{
		$("#hint").hide();
	}
});

// 控制 hint 的显示和选取
$("#hint").on({
	mouseover:function(){
		$(this).css("background","rgb(218,233,254)");
	},
	mouseleave:function(){
		$(this).css("background","rgb(255,255,255)");
	},
	// note 用 mousedown 会影响 .focus() ，猜 focus 是根据 mouseup 判断执行的
	click:function(){
		$("input#jinghao").val($(this).text());
		$("input#jinghao").focus();
		$("#hint").hide();
	},
},"li");
$(document).on("click",function(){
	if($(event.target).closest("input#jinghao").length>0&&$("input#jinghao").val()!=""){
		$("#hint").show();
	}else{
		$("#hint").hide();
	}
});