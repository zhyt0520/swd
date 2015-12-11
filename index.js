$("input[name='login']").click(function(){
	event.preventDefault();
	$.post("login.php",{"username":$("input[name='username']").val(),"password":$("input[name='password']").val(),"is_save_login_status":$("input[name='is_save_login_status']").prop("checked")},function(response,status,xhr){
		if(response=="login_yes"){
			// 页面跳转
			// alert(response);
			window.location.href="query.php";
		}else{
			// 登录错误提示
			$("#p_wrong_warning").text("账户或密码错误，请重试");
		}
	});
});