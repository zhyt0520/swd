//<script type="text/javascript" src="jquery-1.11.3.min.js"></script><script type="text/javascript" src="help.js"></script>
$(document).ready(function(){
	$("title").text("使用帮助");
	var toc=$(".toc");
	$(".toc").remove();
	$("body").prepend(toc);
	$(".markdown-body").css("marginLeft",Number($(".toc").css("marginLeft").substring(0,$(".toc").css("marginLeft").length-2))+Number($(".toc").css("width").substring(0,$(".toc").css("width").length-2))+Number($(".toc").css("marginRight").substring(0,$(".toc").css("marginRight").length-2))+"px");

	$.fn.smartFloat=function(x){
		var element=$(this);
		var thetop=element.position().top;
		var pos=element.css('position');
		$(window).scroll(function(){
			var scrolls=$(this).scrollTop();
			if(scrolls>thetop+x){
				element.css({position:'fixed',top:0,});
			}else{
				element.css({position:pos,top:thetop,});
			}
		});
	};
	$(".toc").smartFloat(0);
});