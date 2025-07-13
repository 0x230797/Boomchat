$(document).ready(function(){
	var cornerHeight = $('#corner_boom').height();
	var cornerWidth = $('#corner_boom').width();
	var cornerContent = cornerHeight - $('#corner_boom_top').outerHeight() - 4;
	var cornerName = $('#corner_boom_top p').text();
	var cornerClose = $('#corner_boom').attr('value');
	var embedConnect = $('#corner_boom_iframe').attr('value');
	var embedDisconnect = $('#corner_boom_iframe').attr('name');
	
	// on load page disconect the chat
	
	$('#corner_boom_iframe').attr("src", embedDisconnect);
	
	
	$('#corner_boom').on('click', '#corner_boom_top', function(){
		if($('#corner_boom').css('bottom') < "0"){
			$('#corner_boom_iframe').attr('src', embedConnect);
			$('#corner_boom').animate({bottom: "0"},100);
			$('#corner_boom_top p').text(cornerClose);
			$('#corner_boom_top img').show();
		}
		else {
			$('#corner_boom').animate({bottom: -cornerContent},100);
			$('#corner_boom_top p').text(cornerName);
			$('#corner_boom_top img').hide();
			$('#corner_boom_iframe').attr("src", embedDisconnect);
		}
	});
	startBoom = function()
	{ 
		$('#corner_boom').css({
			"position": "fixed",
			"border-radius": "10px 10px 0 0",
			"overflow": "hidden",
			"bottom": -cornerContent,
			"max-height": "100%",
			"max-width": "100%",
			"z-index": "9999",
			"margin": "0",
			"padding": "0",
			"cursor": "pointer",
			"border": "none"
		});
		$('#corner_boom_title').css({
			"text-align": "center",
			"padding": "6px 0 10px 0",
			"margin": "0",
			"font-weight": "bold",
		});	
		$('#corner_boom_top').css({
			"width": "100%",
			"display": "table",
			"margin": "0",
			"padding": "0",
		});
		$('#corner_boom_top img').css({
			"position": "absolute",
			"top": "8px",
			"right": "8px",
			"width": "20px",
			"height": "20px",
			"display": "none",
		});			
		$('#corner_boom_content').css({
			"width": "100%",
			"height": cornerContent,
			"background-repeat": "no-repeat",
			"background-position": "center center",
		});
		$('#corner_boom_iframe').css({
			"width": "100%",
			"height": cornerContent,
			"border": "none",
			"margin": "0",
			"padding": "0",
		});	
		
	}
	resizeBoom = function()
	{
		var boomHeight = $(window).height();
		var boomWidth = $(window).width();
		if(boomWidth < 320 || boomHeight < 480){
			$('#corner_boom').css('display', "none");
		}
		else {
			$('#corner_boom').css('display', "block");
		}
	} 
	
	$( window ).resize(function() {
		resizeBoom();
		startBoom();
	});
	
	startBoom();
});