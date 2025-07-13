$(document).ready(function(){
	$("#addon_panel_full").on('click', '#boom_generate1', function() {	
		var embed_open = $('#boom_embed_title_open').val();
		var embed_close = $('#boom_embed_title_close').val();
		var embed_width1 = $( "#boom_embed_width1" ).val();
		var embed_height1 = $( "#boom_embed_height1" ).val();
		var embed_color = $( "#boom_embed_color" ).val();
		var embed_text = $( "#boom_embed_text_color" ).val();
		var embed_margin = $( "#boom_embed_margin" ).val();
		var embed_side = $( "#boom_embed_side" ).val();
		var embed_type = 1;

		
		 var data = {
			embed_open: embed_open,
			embed_close: embed_close,
			embed_width1: embed_width1,
			embed_height1: embed_height1,
			embed_color: embed_color,
			embed_text: embed_text,
			embed_margin: embed_margin,
			embed_type: embed_type,
			embed_side: embed_side,
			
			}; 
			
			
			$.ajax({
			url: "addons/boom_embed/execute/generate.php",
			type: "POST",
			dataType: 'json',
			data: data,
			cache: false,
			success: function(response) {
					var embcode1 = response.code1;
					var embcode2 = response.code2;
					var embcode3 = response.code3;
					
					$('#boom_embed_jquery').val(embcode1);
					$('#boom_embed_code_zone1').val(embcode2);
				}
		
			});
		});
		
	$("#addon_panel_full").on('click', '#boom_generate2', function() {	

		var embed_width2 = $( "#boom_embed_width2" ).val();
		var embed_height2 = $( "#boom_embed_height2" ).val();
		var embed_type = 2;

		
		 var data = {
			embed_width2: embed_width2,
			embed_height2: embed_height2,
			embed_type: embed_type,
			
			}; 
			
			
			$.ajax({
			url: "addons/boom_embed/execute/generate.php",
			type: "POST",
			dataType: 'json',
			data: data,
			cache: false,
			success: function(response) {
					var embcode2 = response.code1;
					
					$('#boom_embed_code_zone2').val(embcode2);
				}
		
			});
		});
	$('#addon_panel_full').on('click', '#boom_embed_normal', function(){
			$('#boom_embed_form1, #boom_embed_form3, #boom_embed_code1').hide();
			$('#boom_embed_form2, #boom_embed_code2').show();
			$(this).addClass('selected_element');
			$('#boom_embed_special, #boom_embed_help').removeClass('selected_element');
	});
	$('#addon_panel_full').on('click', '#boom_embed_special', function(){
			$('#boom_embed_form2, #boom_embed_form3, #boom_embed_code2').hide();
			$('#boom_embed_form1, #boom_embed_code1').show();
			$(this).addClass('selected_element');
			$('#boom_embed_normal, #boom_embed_help').removeClass('selected_element');
	});
	$('#addon_panel_full').on('click', '#boom_embed_help', function(){
			$('#boom_embed_form2, #boom_embed_form1, #boom_embed_code2, #boom_embed_code1').hide();
			$('#boom_embed_form3').show();
			$(this).addClass('selected_element');
			$('#boom_embed_normal, #boom_embed_special').removeClass('selected_element');
	});
});