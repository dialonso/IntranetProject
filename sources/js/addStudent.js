jQuery(document).ready(function($){

	var classe={};
	var img = $('<img src="/pfe/sources/img/ajax.gif" class="img-ajax"/>');
	$('#select-filiere').change(function(e){
		var value = $(this).val();
		$("#select-niveau").attr("disabled","disabled").html("");
		$("#select-classe").attr("disabled","disabled").html("");
		$("#select-groupe").attr("disabled","disabled").html("");
		if(value != "vide"){
			classe['filiere']= "filiere ID: "+value;
			$("#select-niveau").removeAttr("disabled");
			img.insertAfter("#select-niveau");

			getList({action:'getniveau',id:value},$("#select-niveau"),"niveau");

		}else{
			$("#select-niveau").attr("disabled","disabled").html("");
			$("#select-classe").attr("disabled","disabled").html("");
			$("#select-groupe").attr("disabled","disabled").html("");
		}
	});

	$('#select-niveau').change(function(e){
		var value = $(this).val();

			$("#select-classe").attr("disabled","disabled").html("");
			$("#select-groupe").attr("disabled","disabled").html("");
		if(value != "vide"){
			classe['niveau']= "niveau ID: "+value;
			$("#select-classe").removeAttr("disabled");
			
			img.insertAfter("#select-classe");

			getList({action:'getclasse',id:value},$("#select-classe"),"classe");
		}else{
			$("#select-classe").attr("disabled","disabled");
			$("#select-groupe").attr("disabled","disabled");
		}
	});

	$('#select-classe').change(function(e){
		var value = $(this).val();
			$("#select-groupe").attr("disabled","disabled").html("");
		if(value != "vide"){
			classe['classe']= "classe ID: "+value;
			$("#select-groupe").removeAttr("disabled");
			
			img.insertAfter("#select-groupe");
			getList({action:'getgroupe',id:value},$("#select-groupe"),"groupe");

		}else{
			
			$("#select-groupe").attr("disabled","disabled");
		}
	});
	$('#select-groupe').change(function(e){
		var value = $(this).val();
		if(value != "vide"){
			classe['groupe']= "groupe ID: "+value;
			console.log(classe);
		}else{
			
			
		}
	});


});
function getList(object,container,type){
	console.log(object);
	$.post('/pfe/controller/admin/adminaddetud.php',object,function(data,xhr,statut){
		console.log(data);
		container.html("");
		container.append($('<option value="vide">'+type+'</option>'));
		
		data = $.parseJSON(data);
		console.log(data);
		for (var i = 0; i < data.length; i++) {
			var d = data[i];
			var option = $('<option value="'+d.id+'">'+d.nom+'</option>');
			container.append(option);


		};
		container.next().remove();
	});
}
