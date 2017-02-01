function fill(Value) {
	$('#name').val(Value);
	$('#display').hide();
}

$(document).ready(function(){
	$("#name").keyup(function() {
		var name = $('#name').val();
		if(name=="") {
			$("#display").html("");
		} else {
			$.ajax({
				type: "POST",
				url: "include/search_ajax.php",
				data: "name="+ name ,
				success: function(html){
					$("#display").html(html).show();
				}
			});
		}
	});
});