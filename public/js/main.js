$(document).ready(function() {
   $(".close").click(function(e){
   	e.preventDefault();
   	$(".registro-section").addClass('hide');
   });

   $(".registro_id").click(function(e){
   	e.preventDefault();
   	var id = $(this).attr('id');
   	var base = $(this).attr('base');
   	$.ajax({
   			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
			url: '/registro',
			type: 'POST',
			data: {
				id: id,
			},
			success: function(response){
				var date = formatDate(response['registros'][0].created_at);
				var archivos = [];
				$.each(response['archivos'], function(index, val) {
					archivos.push(val.url);
				});
				$(".title").html(response['registros'][0].nombre);
				$(".image_registro").attr("src",base+response['registros'][0].imagen);
				$(".description").html(response['registros'][0].descripcion);
				$(".date span").html(date);
				$(".info span").html(response['count']);
				$(".download").attr("files",archivos);
				$(".registro-section").removeClass('hide');
			}
		});
   });
    $.ajaxSetup({
		headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
		}
	});

	function formatDate(date) {
	     var d = new Date(date),
	         month = '' + (d.getMonth() + 1),
	         day = '' + d.getDate(),
	         year = d.getFullYear();

	     if (month.length < 2) month = '0' + month;
	     if (day.length < 2) day = '0' + day;

	     return [year, month, day].join('-');
	 }
	
   $('.download').click(function(e) {
	    e.preventDefault();
	    var files = $(this).attr('files');
	    var base = $(this).attr('base');
	    var files_array = files.split(',');
	    $.each(files_array, function(index, val) {
	    	 window.open(base+val);
	    });
	});
   var url = window.location.href;
   var url_split = url.split('/')[4];
   if(typeof(url_split) != "undefined" && url_split !== null) {
	    $(".registro-section").removeClass('hide');
	}else{
		console.log("Es nulo");
	}
});