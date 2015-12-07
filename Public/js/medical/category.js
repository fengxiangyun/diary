$(function(){
	$("#show_categories").click(function(){		
		showArea("navbox");
		$(this).parents("li").addClass("cur");
		return false;
	});
	$("#show_district").click(function(){		
		showArea("navbox_district");
		$(this).parents("li").addClass("cur");
		return false;
	});
	$("#show_sort").click(function(){		
		showArea("navbox_sort");
		$(this).parents("li").addClass("cur");
		return false;
	});
	$("#fullbg").click(function(){
		hideArea("navbox");
		hideArea("navbox_district");
		hideArea("navbox_sort");
		return false;
	});
	$("#fullbg_f").click(function(){
		show_float();
		return false;
	});
	
	$(".cf li a").each(function(){
		if($(this).attr("class") == "cur"){
			$("#cate_3_a").addClass("down");
		}
	})
	
	
	
	
	$(".tit").click(function(){
		var cla = $(this).attr("class");
		if(cla.indexOf("click")>=0){
				
			 var pos = $(this).offset().top-47;
			 $("html,body").scrollTop(pos);
		}
	    return false;
	});
	


    $('#fullbg_f').bind("touchmove", function(e){
    	hide_float();
    });
  
    
 
})

function show_float() {

	$(".circle").toggle();
	if ($(".plusbtn i").hasClass("iconplus")) {
		$(".plusbtn i").removeClass("iconplus");
	} else {
		$(".plusbtn i").addClass("iconplus")
	}
	$('#fullbg_f').toggle();
}
function hide_float() {

	$(".circle").hide();
	if ($(".plusbtn i").hasClass("iconplus")) {
		$(".plusbtn i").removeClass("iconplus");
	}
	$('#fullbg_f').hide();
}
function show_cate2(cate_id,event){
	
	$("#navbox dd a").removeClass("down");
	


	//$('#cate_'+cate_id).toggle();
	$(".category-box").each(function(){
		if($(this).attr("id") == "cate_"+cate_id){
			var cla = $('#'+$(this).attr("id")+"_a").attr("class");
			
			if(cla.indexOf("click")<0)
				$('#'+$(this).attr("id")+"_a").attr("class",cla+" click");
			else
				$('#'+$(this).attr("id")+"_a").attr("class",cla.substr(0,cla.indexOf("click")));
			
			$(this).toggle();
		}else{
			var cla = $('#'+$(this).attr("id")+"_a").attr("class");

			if(cla.indexOf("click") >= 0)
				$('#'+$(this).attr("id")+"_a").attr("class",cla.substr(0,cla.indexOf("click")));
			
			$(this).hide();
		}
		
	})
	$("#cate_"+cate_id+"_a").addClass("down");
	resetHeight();
	
}
function show_cate3(cate_id){
	$('.cf').hide();
	$(".category-box h3 a").removeClass("cur");
	$(".category-box h3 a").removeClass("cur_1");
	$("#cate_"+cate_id+"_a").addClass("cur");
	$('#cate_'+cate_id).toggle();
	resetHeight();
}
function show_zone(district_id){	
	$("#navbox_district dd a").removeClass("down");
	
	$(".category-box").each(function(){
		if($(this).attr("id") == "district_"+district_id){
			var cla = $('#'+$(this).attr("id")+"_a").attr("class");
			
			if(cla.indexOf("click")<0)
				$('#'+$(this).attr("id")+"_a").attr("class",cla+" click");
			else
				$('#'+$(this).attr("id")+"_a").attr("class",cla.substr(0,cla.indexOf("click")));
			
			$(this).toggle();
		}else{
			var cla = $('#'+$(this).attr("id")+"_a").attr("class");

			if(cla.indexOf("click") >= 0)
				$('#'+$(this).attr("id")+"_a").attr("class",cla.substr(0,cla.indexOf("click")));
			
			$(this).hide();
		}
		
	})
	$('#district_'+district_id+"_a").addClass("down");
	resetHeight();
}

function showArea(areaName){

	$('#'+areaName).show();
	$('#fullbg').show();
	resetHeight();
}
function hideArea(areaName){
	$('#'+areaName).removeAttr("style");
	$('#'+areaName).hide();

	$('#fullbg').hide();
	$('#'+areaName).removeAttr("style");
	$(".mall-cate li").removeClass("cur");
}

function resetHeight(){
	//页面高度随菜单高度变化
	var cate_height = $("#navbox_inner").height();
	
	var district_height = $("#navbox_district_inner").height();
	
	var min_height = cate_height;
	if(cate_height < district_height)
		min_height = district_height;
	
	var v3_height = parseInt($(".v3").css("height"));

	if(min_height > v3_height){
		$(".v3").css("height",min_height+'px');
	}
}


function dynload_img(dynload_img_offset){
	var dynload_obj = $(".dynload");
	dynload_obj.each(function(i,vlaue){
	    var dynload_offset_first = $(".dynload").offset().top;
		var cur_dynload_offset = $(this).offset().top;
		if(dynload_offset_first > dynload_img_offset){
			offset = cur_dynload_offset - $(document).scrollTop();
		}else{
			offset = cur_dynload_offset;
		}
        if($(this).attr("title") != '' && (offset < ($(document).scrollTop() + $(window).height()))){
        	$(this).attr("src", $(this).attr("title"));
        	$(this).removeAttr("title");
        }
    })
}