$(function() {
		$( "#dialog" ).dialog({
			autoOpen: false,
			width: 400,
			buttons: []
		});
		
		$( "#profile" ).dialog({
			autoOpen: false,
			width: 800,
			buttons: []
		});

		// Link to open the dialog
		$( "#editprofile" ).click(function( event ) {
			$( "#profile" ).dialog( "open" );
			event.preventDefault();
		});
		
		// Link to open the dialog
		$( "#dialog-link" ).click(function( event ) {
			$( "#dialog" ).dialog( "open" );
			event.preventDefault();
		});
		
		// Hover states on the static widgets
		$( "#dialog-link, #icons li" ).hover(
			function() {
				$( this ).addClass( "ui-state-hover" );
			},
			function() {
				$( this ).removeClass( "ui-state-hover" );
			}
		);
		
		$( "#editprofiletabs" ).tabs();
		
		function chooseFile() {
			$("#file").click();
		}
		
		$( "#button-1" ).button();
		$( "#button-2" ).button();
		$( "#button-3" ).button();
		$( "#button-4" ).button();
	});