console.time("js总执行时间")

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

console.timeEnd("js总执行时间")