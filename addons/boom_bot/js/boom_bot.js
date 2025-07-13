$(document).ready(function(){
	$('#addon_panel').on('click', '.boom_bot_reply', function(){
	
		$( ".boom_bot_reply" ).each(function() {
			$(this).removeClass('selected_element');
		});
		$(this).addClass('selected_element');
	});
	
	$('#addon_panel').on('click', '#add_bot_ads', function(){
			
		var bot_reply = $("#boom_bot_input").val();
		
		if(bot_reply == ''){
			event.preventDefault();
		}
		else if (/^\s+$/.test($('#boom_bot_input').val())){
			$("#boom_bot_input").val('');
			event.preventDefault();
		}
		else {
			$.post('addons/boom_bot/execute/boom_bot_add.php', {add_reply: bot_reply}, function(response) {	
				$("#boom_bot_input").val('');
				if(response == 1){
					reloadAdsbot();
				}
			});	
		}
	
	
	});

	$('#addon_panel').on('click', '#boom_bot_clear', function(){
			
		var clearThis = $("#boom_bot_ul .selected_element").attr('value');
		if(clearThis != null){
			$.post('addons/boom_bot/execute/boom_bot_delete.php', {ads_delete: clearThis}, function(response) {	
				if(response == 1){
					reloadAdsbot();
				}
			});	
		}
		else {
			return false;
		}
	});
	
	$('#addon_panel').on('click', '#boom_bot_clearall', function(){
			var clearAll = 1;
			$.post('addons/boom_bot/execute/boom_bot_clear.php', {ads_clear: clearAll}, function(response) {	
				if(response == 1){
					reloadAdsbot();
				}
			});	
	});
	
$("#addon_panel").on('click', '#boom_bot_update', function() {
		
		var bot_name = $('#boom_bot_name').val();
		var bot_delay = $('#set_bot_delay').val();
		var bot_status = $( "#set_bot_status" ).val();
		var bot_type = $( "#set_bot_type" ).val();
		var bot_room = $( "#set_bot_room" ).val();
		
		$.post('addons/boom_bot/execute/boom_bot_setting.php', { 
			bot_name: bot_name,
			bot_delay: bot_delay,
			bot_type: bot_type,
			bot_room: bot_room,
			bot_status: bot_status
			
			}, function(response) {
				if(response == 1){
					$("#boom_bot_update").html("<span class=\"success\">update complete</span>").delay(3000).queue(function(n) {$(this).html('update bot settings');
						n();
					});
				}
				else {
					return false;
				}
		});
		
		return false;
		
	});
	
	adsBotspeak = function(){
		$.ajax({
			url: "addons/boom_bot/execute/boom_bot_speak.php",
			cache: false,
			success: function(response){
				if(response == 2){
					// Ciclo reiniciado, volver a ejecutar
					setTimeout(adsBotspeak, 5000);
				}
				else if(response == 3){
					// No es tiempo aún, continuar el ciclo normal
					return false;
				}
				else if(response == 1){
					// Mensaje enviado exitosamente
					return false;
				}
				else if(response == 0){
					// Error al enviar mensaje
					console.error('Error al enviar mensaje del bot');
					return false;
				}
				else {
					// Respuesta desconocida
					return false;
				}
			},
			error: function(xhr, status, error) {
				console.error('Error en la comunicación con el bot:', error);
				return false;
			}
		});
	}
	
	reloadAdsbot = function(){
		$.ajax({
			url: "addons/boom_bot/execute/boom_bot_reload.php",
			cache: false,
			success: function(response){
				$("#boom_bot_ul").html(response);
			},
		});
	}
	
	// Función para inicializar el bot automáticamente
	initializeBot = function(){
		$.ajax({
			url: "addons/boom_bot/execute/boom_bot_auto_activate.php",
			cache: false,
			success: function(response){
				console.log('Bot inicializado:', response);
			},
			error: function(xhr, status, error) {
				console.error('Error al inicializar el bot:', error);
			}
		});
	}
	
	// Inicializar el bot al cargar la página
	initializeBot();
	
	adsBotspeak();
	
   var adsBottalk = setInterval(adsBotspeak, 62000);
});