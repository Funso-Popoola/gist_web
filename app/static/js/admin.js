$(document).ready(function(){
	$('#addPost').click(function(e){
		$('#post-form').toggleClass('hidden');
		$('#addPost').toggleClass('hidden');
	});

	$('#cancelPost').click(function(e){
		e.preventDefault();
		$('#post-form').toggleClass('hidden');
		$('#addPost').toggleClass('hidden');
	});

});