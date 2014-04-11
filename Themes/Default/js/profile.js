$('#profile-link').hover(function(){
	$('#profilemenu').show();
});
$('#profilemenu').hover(function(){
    $('#profilemenu').show();
},function(){
    $('#profilemenu').hide();
});

function dotimeoutprofile() {
	$('#profilemenu').hide();
}

$(function() {
	$( "#menuprofilemenu" ).menu({ icons: { submenu: "ui-icon ui-icon-triangle-1-e" } });
});