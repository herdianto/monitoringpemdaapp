$(document).ready(function(){
	$("#search_web").select2({
		placeholder:'Mencari Website Pemda',
		ajax:{
			url: "lib/autoComplete.php",
			dataType: 'json',
			delay: 250,
			data: function(params){
				return{
					q:params.term
				};

			},
			processResults:function(data){
				
				return{
					results: data
				};
			},
			cache:true
		},
		minimumInputLength: 2
	});
});

