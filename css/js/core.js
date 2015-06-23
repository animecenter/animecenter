$(document).ready(function(e) {
	var url="http://www.animecenter.tv/";
	$(".date").datepicker({
	changeMonth: true,
	changeYear: true
	});
	var current=new Date().getFullYear();
	var start=current-80;
	$(".date").datepicker( "option", "yearRange", start+":"+current );
	$(".date").datepicker( "option", "dateFormat","yy-mm-d");
	var vvalue=$(".date").attr("vvalue");
	if(typeof vvalue == "undefined"){vvalue='';}
	if(vvalue.length>0){
	$(".date").datepicker( "setDate",vvalue);
	}
	
	$(window).scroll(function(){
	  if($(this).scrollTop()>50){
		  $("#header").css("padding",'5px 0');
		  $("#logo img").css({"height":"30px","width":"180px","margin-top":'5px'});
		  $("#logo .text").hide();
		   $("#search,#nav").css({"margin-top":'5px'});
	  }
	  else if($(this).scrollTop()<=50){
		   $("#header").css("padding",'10px 0 20px');
		  $("#logo img").css({"height":"38px","width":"260px","margin-top":'auto'});
		  $("#logo .text").show();
		   $("#search,#nav").css({"margin-top":'15px'});
	  }
  	});
	
	/* Tabs */
	//$(".embbed_content").html($(".tabs .block:first .content").html());
	//$(".tabs .block:first .tab").addClass("active");
	/*$(".tabs .block .tab").click(function(e) {
		$(".tabs .block .tab").removeClass("active");
        $(this).addClass("active");
		$(".embbed_content").html($(this).parent("div").find(".content").html());
    });*/
	
	//End tabs
	
	
	$("#genres .clicks").click(function(e) {
       var cont=$(this).parent("div").find(".cont");
	   var thiss=$(this);
	   if(cont.is(":visible")){cont.slideUp();thiss.parent("div").css({'border-width':'1px 0 0 0'});
	   thiss.addClass("deactive");}
	   else{cont.slideDown();thiss.parent("div").css({'border-width':'1px 1px 1px 1px'});
	   thiss.removeClass("deactive");}
    });
    $("#genres input[type='reset']").click(function(){
        $("#genres .box_block span").removeClass("active").removeClass("deactive");
        $("#genres .radio_block span").removeClass("active");
        $("#genres .radio_block:first span").addClass("active");
    });
    
	
	/* Login code */
	
	$("input.add-user").click(function(e) {
		var err=0;
		var parent=$(this).closest("form");
		
		parent.find("input[type='text']").each(function(index, element) {
			var val=$(this).val().length;
            if(val==0){$(this).css("border-color","#f00");err=1;}
			else{$(this).css("border-color","#B9B9B9");}
        });
		
		var pass1=parent.find("input[name='password']").val();
		var pass2=parent.find("input[name='re_password']").val();
		if(pass1!=pass2 || pass1.length==0)
		{parent.find("input[name='password']").css("border-color","#f00");parent.find("input[name='re_password']").css("border-color","#f00");err=1;}
		else{parent.find("input[name='password']").css("border-color","#B9B9B9");parent.find("input[name='re_password']").css("border-color","#B9B9B9");}
		
		var loc=parent.find("input[name='email']").val().indexOf("@");
		if(loc<0){parent.find("input[name='email']").css("border-color","#f00");err=1;}
		if(err==0){$(this).attr("type","submit").trigger("click");
		}
    });
	
	$("input.up-user").click(function(e) {
		var err=0;
		var parent=$(this).closest("form");
		
		var pass1=parent.find("input[name='password']").val();
		var pass2=parent.find("input[name='re_password']").val();
		if(pass1!=pass2)
		{parent.find("input[name='password']").css("border-color","#f00");parent.find("input[name='re_password']").css("border-color","#f00");err=1;}
		else{parent.find("input[name='password']").css("border-color","#B9B9B9");parent.find("input[name='re_password']").css("border-color","#B9B9B9");}
		
		if(err==0){$(this).attr("type","submit").trigger("click");
		}
    });
	var co=$("select.country").attr("val");
	$("select.country").find("option").each(function(index, element) {
        if($(this).attr("value")==co){$(this).attr("selected","selected")}
    });;
	
	$("input.login-user").click(function(e) {
		var err=0;

		var parent=$(this).closest("form");
		
		parent.find("input").each(function(index, element) {
			var val=$(this).val().length;
            if(val==0){$(this).css("border-color","#f00");err=1;}
			else{$(this).css("border-color","#B9B9B9");}
        });
		if(err==0){$("#login_form").submit();}
		else alert(err);
		
    });
	
	$("select.member-select").click(function(e) {
		if($(this).hasClass("episodess")){
		var val=$(this).val();
		if(val=="0"){}
		else{
			if(val.indexOf("episode_auto_add.php")>=0){
				var num=prompt("Type numbers of Episodes to be add");
				var id=$(this).find("option:selected").attr("val");
				$.post(val,{id:id,num:num},function(data){
				location.reload();
				});
			}
			else{window.location.href=val;}
		}
		}
		else{
        var val=$(this).val();
		if(val=="0"){}
		else{window.location.href=val;}
		}
    });
	
	/*-------------------------------------------------------------*/
	
	/*  Fav and watchlist */
	
	$("div.delete_fav").click(function(e) {
        var id=$(this).attr("val");
		$.post(url+"del-fav.php",{id:id},function(data){
		location.reload();
		});
    });
	$("div.del-watch").click(function(e) {
        var id =$(this).attr("val");
		$.post(url+"del-watch.php",{id:id},function(data){
		location.reload();
		});
    });
	$("div.add-watch").click(function(e) {
	if(!($(this).hasClass("cancel"))){
            var id =$(this).attr("val");
		$.post(url+"add-watch.php",{id:id},function(data){
		location.reload();
		});
	}//end if	
	
    });
    	
	$("div.add-fav").click(function(e) {
	if(!($(this).hasClass("cancel"))){
        var id =$(this).attr("val");
		$.post(url+"add-fav.php",{id:id},function(data){
		if($(".pop_nav")[0]){	
		$(".add-fav .pop_nav").show();	
		}
		else{location.reload();}
		});
	}//end if	
    });
	$(".pop_nav .close").click(function(){
		$(this).parent("div").hide();
		location.reload();
	});
	
	$(".not_watched").click(function(e) {
        var id =$(this).attr("val");
		$.post(url+"add-watched.php",{id:id},function(data){
		location.reload();
		});
    });
	
	$(".report_vid").click(function(e) {
      var id =$(this).attr("val");
	  $.post(url+"report-mail.php",{id:id},function(data){
		alert("Thanks");  
		location.reload();
		});
    });
    
    $("a.profile").click(function(){
    $(this).toggleClass("active");
    if($(this).hasClass("active")){
      $(this).parent("div").find("ul").show();
    }
    else{
    $(this).parent("div").find("ul").hide();
    }
    });
    
    /*change profile image*/
    $(".prof_img span").click(function(){
      $("#change_img").show();
    });
     $("#change_img span").click(function(){
      $("#change_img").hide();
    });
     $("#change_img input[type='button']").click(function(){
     var parent= $("#change_img");
     var formData = new FormData(parent.find("form")[0]);
           /* Uploader */
	     $.ajax({
                        url: './includes/upload-image-profile.php',  //server script to process data
                        type: 'POST',
                        xhr: function() {  // custom xhr
                            myXhr = $.ajaxSettings.xhr();
                            if(myXhr.upload){ // if upload property exists
                                //myXhr.upload.addEventListener('progress', progressHandlingFunction, false); // progressbar
                            }
                            return myXhr;
                        },
                        //Ajax events
			success: completeHandler = function(data) {
			parent.hide();
			location.reload();
                        },
                        error: errorHandler = function() {
                            alert(" Error upload file ");
							
                        },
                        // Form data
                        data:formData,
                        //Options to tell JQuery not to process data or worry about content-type
                        cache: false,
                        contentType: false,
                        processData: false
                    }, 'json');
		/* End Uploader */
    });
    
    $("a.edit_list").click(function(){
    var id=$(this).attr("val");
    $.post("./includes/edit_animelist.php",{id:id},function(data){
    $("body").append(data);
    });
    });
    $("a.del_list").click(function(){
    var id=$(this).attr("val");
    $.post("./includes/del_animelist.php",{id:id},function(data){
    location.reload();
    });
    });
    $("body").delegate("#add-animi div.close","click",function(){
    $(this).parent("div").remove();
    });
    $("body").delegate("#add-animi a.edit_anime_btn","click",function(){
    var parent=$(this).parent("form");
    var list_id=$(this).attr("val");
    var status=parent.find("select#status").val();
    var watched=parent.find("input#watched").val();
    var score=parent.find("select#score").val();
    var tags=parent.find("textarea#tags").val();
    
	     $.post("./includes/edit_animelist.php",{list_id:list_id,status:status,watched:watched,score:score,tags:tags},function(data){
	     location.reload();
	     });
    });
    $("body").delegate("select[name='msg_actions']","change",function(){
    var parent=$(this).parent("div");
    var type=$(this).val();
    if(type!=0){
    var ids=new Array();
    parent.find("input[type='checkbox']:checked").each(function(){
    ids.push(parseInt($(this).val()));
    });
	    $.post("./includes/edit_msg.php",{type:type,ids:ids},function(data){
	       location.reload(1);
	    });
      }//end if
    });
    
    $("body").delegate("#profileLinks a.rej_friend","click",function(){
    var id=$(this).attr("val");
    $.post("req-up.php",{id:id,type:'del2'},function(data){location.reload();});
    });
    /*-----------------------------------------*/
	$("iframe[width=0]").each(function(){$(this).remove();});
});