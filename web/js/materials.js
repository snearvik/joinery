$(document).ready(function(){
	$(".quantity").change(function() {
		
		$.ajax({
			 type: "POST",
			 url: Routing.generate(''),
			 contentType: 'application/json; charset=UTF-8',
			 data: {
				  id: title,                
				  name: description,
				  quantity: questions,              
				 }
		  });
		
		alert(v2.num + ' ' + v2.date);
	});
	
	
	/*
	$div = $("#appbundle_book").attr("class","col-md-auto");
	$texts = $(":text").attr("class","form-control");
	$numbers = $("[type='number']").attr("class","form-control");
	$selects = $("select").attr("class","form-control");
	$file = $(":file").attr("class","custom-file-input");
	
	$divFile = $file.parent().attr("class","custom-file");
	$divFile.attr("style","margin-top: 10px");
	$labelFile = $("[for='appbundle_book_cover']").attr("class","custom-file-label");
	
	$file.change(function() {		
		$labelFile.text($(this).val());		
	});
	*/
});