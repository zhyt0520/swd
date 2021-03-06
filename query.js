// 退出登录
$("#div_user_info a").click(function(){
	$.post("login.php",{"logout":"logout"},function(response,status,xhr){
		if(response=="login_no"){
			window.location.href="index.php";
		}
	});
});

// 默认选中部分 checkbox
var custom_checked_checkbox="";
var all_cookie="";
all_cookie=document.cookie;
if(all_cookie.indexOf("save_checkbox_chose")!=-1){
	// note substr参数为开始index和长度；substring参数为开始index和结尾index
	custom_checked_checkbox=all_cookie.substr(all_cookie.indexOf("save_checkbox_chose")+20,$("input[type='checkbox']").length);
}
// 默认的油井选择
var default_checked_checkbox_oil=["RQ","JH","CC","CC1","YZ","SCSJ","BJ","YY","TY","RCYL1","RCYL","RCQL","HS","BZ"];
// 默认的水井选择
var default_checked_checkbox_water=["RQ","JH","SCSJ","ZSFS","GXYL","YY","TY","RPZSL","RZSL","PZCDS","BZ",];
if(custom_checked_checkbox==""){
	// cookie 为空
	for(var i=0;i<default_checked_checkbox_oil.length;i++){
		$("#field_checkbox_oil input#"+default_checked_checkbox_oil[i]).prop("checked",true);
	}
	for(var i=0;i<default_checked_checkbox_water.length;i++){
		$("#field_checkbox_water input#"+default_checked_checkbox_water[i]).prop("checked",true);
	}
}else{
	// 输入cookie的选择
	// note $("input[type='checkbox']")[i].prop()报错
	// ！！！ 需添加水井部分
	var i=0;
	$("input[type='checkbox']").each(function(){
		if(custom_checked_checkbox.substr(i,1)==1){
			$(this).prop("checked",true);
		}else{
			$(this).prop("checked",false);
		}
		i++;
	});
}

// checkbox 功能按钮
// note 区分 attr 和 prop
$("#select_all").click(function(){
	$("input[type='checkbox']").prop("checked",true);
});
$("#unselect_all").click(function(){
	$("input[type='checkbox']").prop("checked",false);
});
$("#reset_default").click(function(){
	$("input[type='checkbox']").prop("checked",false);
	// 给油井checkbox恢复默认选择
	for(var i=0;i<default_checked_checkbox_oil.length;i++){
		$("input#"+default_checked_checkbox_oil[i]).prop("checked",true);
	}
	// 给水井checkbox恢复默认选择
	for(var i=0;i<default_checked_checkbox_water.length;i++){
		$("input#"+default_checked_checkbox_water[i]).prop("checked",true);
	}
});
$("#save_checkbox_chose").click(function(){
	// 用只包含0和1的字符串保存checkbox选择的数据
	var save_checkbox_chose="";
	$("input[type='checkbox']").each(function(){
		if($(this).prop("checked")){
			save_checkbox_chose+="1";
		}else{
			save_checkbox_chose+="0";
		}
	});
	// 用javascript（非query）设置cookie
	var today=new Date();
	var expireDay=new Date();
	var msPerYear=1000*60*60*24*365;
	expireDay.setTime(today.getTime()+msPerYear);
	document.cookie="save_checkbox_chose="+save_checkbox_chose+";expires="+expireDay.toGMTString();
});
$("#clear_checkbox_save").click(function(){
	var today=new Date();
	document.cookie="save_checkbox_chose=;expires="+today.toGMTString();
});

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
	if($("input#jinghao").val()!="" && event.keyCode!=13 && event.keyCode!=37 && event.keyCode!=38 && event.keyCode!=39 && event.keyCode!=40){
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

// 获取油水井井号
$.post("ajax.php",{mark:"JINGHAO_OIL_ARRAY"},function(response){
	if(response.length>0){
		JINGHAO_OIL_ARRAY=eval(response);
	}
});
$.post("ajax.php",{mark:"JINGHAO_WATER_ARRAY"},function(response){
	if(response.length>0){
		JINGHAO_WATER_ARRAY=eval(response);
	}
});

// 键盘控制 hint 条目的选择
// note 需要用 keydown ，否则 event.preventDefault(); 无法阻止回车键提交表单

$("input#jinghao").keydown(function(){
	// 上
	if(event.keyCode==38){
		if(event && event.preventDefault){
			event.preventDefault();
		}else{
			window.event.returnValue=false;
		}
		if($(".li_selected").prev().length>0){
			$(".li_selected").attr("class","tmp");
			$(".tmp").prev().attr("class","li_selected");
			$(".tmp").attr("class","li_unselected");
		}
	// 下
	}else if(event.keyCode==40){
		if(event && event.preventDefault){
			event.preventDefault();
		}else{
			window.event.returnValue=false;
		}
		if($(".li_selected").next().length>0){
			$(".li_selected").attr("class","tmp");
			$(".tmp").next().attr("class","li_selected");
			$(".tmp").attr("class","li_unselected");
		}
	// 回车
	}else if(event.keyCode==13){
		// 阻止默认的回车提交表单
		if(event && event.preventDefault){
			event.preventDefault();
		}else{
			window.event.returnValue=false;
		}
		// 判断是油井还是水井
		var is_oil_or_water="";
		for(var i=0;i<JINGHAO_OIL_ARRAY.length;i++){
			if($("input#jinghao").val()==JINGHAO_OIL_ARRAY[i]){
				is_oil_or_water="oil";
			}
		}
		for(var i=0;i<JINGHAO_WATER_ARRAY.length;i++){
			if($("input#jinghao").val()==JINGHAO_WATER_ARRAY[i]){
				is_oil_or_water="water";
			}
		}
		// 判断是自动填入井号，还是提交表单
		if($("input#jinghao").val()!=$(".li_selected").text()){
			// 若输入框内字符串不等于选中的 hint，把值填入输入框
			$("input#jinghao").val($(".li_selected").text());
			$("input#jinghao").focus();
			$("#hint").hide();
		}
		// 否则输入内容等于 选中的hint
		else if(is_oil_or_water=="oil"){
			$("form").attr("action","display_oil.php");
			$("form").submit();
		}else if(is_oil_or_water=="water"){
			$("form").attr("action","display_water.php");
			$("form").submit();
		}
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
	// ！！！ event.target 貌似 IE 不支持
	if($(event.target).closest("input#jinghao").length>0 && $("input#jinghao").val()!=""){
		$("#hint").show();
		// 全选 input 内部的文字
		$("input#jinghao").select();
	}else{
		$("#hint").hide();
	}
});

// 查询按钮
$("#input_chaxun").click(function(){
	// 需判断油井还是水井
	var is_oil_or_water="";
	for(var i=0;i<JINGHAO_OIL_ARRAY.length;i++){
		if($("input#jinghao").val()==JINGHAO_OIL_ARRAY[i]){
			is_oil_or_water="oil";
		}
	}
	for(var i=0;i<JINGHAO_WATER_ARRAY.length;i++){
		if($("input#jinghao").val()==JINGHAO_WATER_ARRAY[i]){
			is_oil_or_water="water";
		}
	}
	if(is_oil_or_water=="oil"){
		$("form").attr("action","display_oil.php");
		$("form").submit();
	}
	if(is_oil_or_water=="water"){
		$("form").attr("action","display_water.php");
		$("form").submit();
	}
});

// 清除按钮
$("#input_qingchu").click(function(){
	$("input#jinghao").val("");
});