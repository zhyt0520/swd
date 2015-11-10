// 默认选中当前日期
var mydate =new Date();
$("select[name='begin_year'] option[value="+(mydate.getFullYear()-1)+"]").attr("selected",true);
$("select[name='begin_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='begin_day'] option[value="+mydate.getDate()+"]").attr("selected",true);
$("select[name='end_year'] option[value="+mydate.getFullYear()+"]").attr("selected",true);
$("select[name='end_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='end_day'] option[value="+mydate.getDate()+"]").attr("selected",true);

// hint 的位置和显隐
// note jquery 里面输入框的取值是 val() 而不是 value
$("#hint").css("width",$("input#jinghao").css("width"));
$("#hint").css("left",$("input#jinghao").offset().left);
$("input#jinghao").keyup(function(){
	if($("input#jinghao").val()!=""){
		$.post("ajax.php",{mark:"hint",sub_jinghao:$("input#jinghao").val()},function(response){
			if(response.length>0){
				$("#hint").html(response);
				$("#hint").show();
				// $("#hint").children().first().css("background-color","rgb(218,233,254)");
				$("#hint").children().first().attr("class","li_selected");
			}else{
				$("#hint").hide();
			}
		})
	}else{
		$("#hint").hide();
	}
});

// hint li 的背景和选值
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
// 输入框内点击鼠标出现 hint，页面内点击鼠标隐藏 hint
$(document).on("click",function(){
	if($(event.target).closest("input#jinghao").length>0 && $("input#jinghao").val()!=""){
		$("#hint").show();
	}else{
		$("#hint").hide();
	}
});
// keyCode 左37 上是38 右39 下是40
$("input#jinghao").on({
	keydown:function(){
		// 上
		if($(event.keyCode)==38){

		// 下
		}else if($(event.keyCode)==40){

		}
	},
});