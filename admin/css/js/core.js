$(document).ready(function() {
$("select.select").change(function(){
	var vv=$(this).find("option:selected").text();
	$(this).parent("div").children("input").val(vv);
});
$(".inputSelectarea input.textInput2").each(function() {
	if($(this).val()==''){	
	 var vv=$(this).parent("div").children("select").find("option:selected").text();
	 $(this).val(vv);
 }
});

$(".inputCheck").each(function(index, element) {
      var v=$(this).children("input").prop("checked");
	  if(v){
		  $(this).children("span").css({'background':'url(css/img/checked.jpg)'});
	  }
	  else{
		$(this).children("span").css({'background':'url(css/img/check.jpg)'});  
	}
    });
	
	$(".inputCheck span").click(function(){
	if(!$(this).parent('div').children('input').prop('checked')){
	$(this).css({'background':'url(css/img/checked.jpg)'});
	$(this).parent('div').children('input').prop("checked", true);
	}
	else{
	$(this).css({'background':'url(css/img/check.jpg)'});
	$(this).parent('div').children('input').removeAttr('checked');
	}
   });
   $(".set_date").click(function(){
   $(this).parent("div").parent("div").find("input[type='text']").val($(this).attr("val"));
   });
});
