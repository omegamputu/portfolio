$(function (){
	$('#duplicatebtn').click(function (e){
		e.preventDefault();
		var $clone = $('#duplicate').clone().attr('id', '').removeClass('d-none');
		$('#duplicate').before($clone);
	});
})