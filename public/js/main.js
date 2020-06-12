$(document).ready(function(){
	console.log('Success!');
	$('#addtask_button').submit(
		function () {
			$('#addtaskform').slideToggle();
			$('#addtask_button').hide();
			return false;
		}
	)
});

