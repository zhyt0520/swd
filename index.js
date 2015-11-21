// 默认选中部分 checkbox
var checked_checkbox=["RiQi","JingHao","QuKuaiDanYuan","ChongCheng","ChongCi","YouZui","ShangXingDianLiu","XiaXingDianLiu","ShengChanShiJian","BengJing","BengShen","YeMian","ChenMoDu","BengXiao","YouYa","TaoYa","RiChanYe","RiChanYou","RiChanQi","HanShui","BeiZhu"];
for(var i=0;i<checked_checkbox.length;i++){
	$("input#"+checked_checkbox[i]).attr("checked","checked");
}

// 默认选中当前日期
var mydate =new Date();
$("select[name='begin_year'] option[value="+(mydate.getFullYear()-1)+"]").attr("selected",true);
$("select[name='begin_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='begin_day'] option[value="+mydate.getDate()+"]").attr("selected",true);
$("select[name='end_year'] option[value="+mydate.getFullYear()+"]").attr("selected",true);
$("select[name='end_month'] option[value="+(mydate.getMonth()+1)+"]").attr("selected",true);
$("select[name='end_day'] option[value="+mydate.getDate()+"]").attr("selected",true);

// hint 的位置
$("#hint").css("width",$("input#jinghao").css("width"));
$("#hint").css("left",$("input#jinghao").offset().left);

// hint 的内容和显隐
// note jquery 里面输入框的取值是 val() 而不是 value
// note 需要用 keyup ，否则执行 post 的时候输入的值还没赋给 input
$("input#jinghao").keyup(function(){
	if($("input#jinghao").val()!="" && event.keyCode!=38 && event.keyCode!=40){
		$.post("ajax.php",{mark:"hint",sub_jinghao:$("input#jinghao").val()},function(response){
			if(response.length>0){
				$("#hint").html(response);
				$("#hint").children().first().attr("class","li_selected");
				$("#hint").show();
			}else{
				$("#hint").hide();
			}
		})
	}else if($("input#jinghao").val()==""){
		$("#hint").hide();
	}
});

// 键盘控制 hint 条目的选择
// note 需要用 keydown ，否则 event.preventDefault(); 无法阻止回车键提交表单
$("input#jinghao").keydown(function(){
	// 上
	if(event.keyCode==38){
		if($(".li_selected").prev().length>0){
			$(".li_selected").attr("class","tmp");
			$(".tmp").prev().attr("class","li_selected");
			$(".tmp").attr("class","li_unselected");
		}
	// 下
	}else if(event.keyCode==40){
		console.log("zzz")
		if($(".li_selected").next().length>0){
			$(".li_selected").attr("class","tmp");
			$(".tmp").next().attr("class","li_selected");
			$(".tmp").attr("class","li_unselected");
		}
	// 回车
	}else if(event.keyCode==13){
		// 若输入框内字符串不等于选中的 hint，把值填入输入框
		if($("input#jinghao").val()!=$(".li_selected").text()){
			event.preventDefault();
			$("input#jinghao").val($(".li_selected").text());
			$("input#jinghao").focus();
			$("#hint").hide();
		}
		// 否则输入框内字符串等于选中的 hint ，不阻止默认动作，即提交表单进行查询
	}
});

// hint li 的背景和选值
$("#hint").on({
	mouseover:function(){
		$(".li_selected").attr("class","li_unselected");
		$(this).attr("class","li_selected");
	},
	mouseleave:function(){
		if($(this).attr("data-tmp","li_selected")){
			$(this).attr("data-tmp","");
		}else{
			$(this).attr("class","li_unselected");
		}
	},
	// note 用 mousedown 会影响 .focus() ，猜 focus 是根据 mouseup 判断执行的
	click:function(){
		$(this).attr("class","li_selected");
		$(this).attr("data-tmp","li_selected")
		$("input#jinghao").val($(this).text());
		$("input#jinghao").focus();
		$("#hint").hide();
	},
},"li");

// 输入框内点击鼠标出现 hint，页面内点击鼠标隐藏 hint
$(document).on("click",function(){
	if($(event.target).closest("input#jinghao").length>0 && $("input#jinghao").val()!=""){
		$("#hint").show();
		// 全选 input 内部的文字
		$("input#jinghao").select();
	}else{
		$("#hint").hide();
	}
});