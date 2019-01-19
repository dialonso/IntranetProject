jQuery(document).ready(function($) {
	$("#blocFormulaireEDT").hide();
	$("#blocContaintEDT").hide();
	var idPlanning = null;
	var idNiveau = null;
	var Selects = null;
	var tablecps = new Array();
	var compter = 0;
	$("#select-classe").change(function(event) {
		var id = $(this). val();
		if (id !='rien') {
			var tt = id.split('-');
		var Id = tt[0];
		var idniveau = tt[1];
		idNiveau = idniveau;
		getList({action:'getgroupe',id:Id},$("#select-groupe"),"groupe");
		$("#select-groupe").removeAttr("disabled");
		

		}
	});
	$("#select-groupe").change(function(event) {
		var id = $(this). val();
		if (id !='vide') {
		$("#blocFormulaireEDT").show();
		

		$.ajax({
			url: '/pfe/controller/admin/pubEDT.php',
			type: 'POST',
			dataType:  'html',
			data: {
				action:'getDetailsContenuPlanning',
				niveau : idNiveau
			},
		})
		.done(function(data) {
			Selects = data;
				//alert(Selects)
		})
		.fail(function() {console.log("error");}).always(function() {console.log("complete");});
		
		}
	})
	$("#bouttonaddformEDT").click(function(event) {
	var formulaire= $(this).parent().parent();
	
	var nom= formulaire.find('.panel-body .form-group .nom').val();
	var datedebut= formulaire.find('.panel-body .form-group .datedebut').val();
	var datefin= formulaire.find('.panel-body .form-group .datefin').val();
	var donnee={
		nom:nom, datedebut:datedebut, datefin:datefin, groupe:$("#select-groupe").val(), action:"EDT"
	}
	console.log(donnee);
	//*
	$.post('/pfe/controller/admin/pubEDT.php', donnee, function(data, textStatus, xhr) {

	idPlanning = data;

	$("#blocFormulaireEDT").hide();
	$("#blocContaintEDT").show();

	});
	//*/
	});

	$.each($('.addContent'), function(index, val) {
		 $(val).click(function(event) {
		 	$(this).parent().html(Selects);
		 });
	});

	$('#endAddContentBtn').click(function(event) {

		 tablecps = new Array();
		$.each($('.contenu_planning'), function(index, val) {
			var div = $(val);
			 var sm = div.find('.matiere');
			 if(sm.length > 0 && sm.val() != 'null'){
			 	var jour = div.attr('jour');
			 	var horaire = div.attr('horaire');
			 	var matiere = sm.val();
			 	var prof = div.find('.professeur').val();
			 	var salle = div.find('.salle').val();

			 	var d = {
			 		action:'saveContentEDT',
			 		jour:jour,
			 		horaire:horaire,
			 		matiere:matiere,
			 		professeur:prof,
			 		salle:salle,
			 		planning: idPlanning
			 	};
			 	tablecps.push(d);
			 }
		});
		if(tablecps.length > 0){
			$('#endAddContentBtn').attr('disabled','disabled');
			saveCp(tablecps[compter]);
		}
	});

	function saveCp(datas){
		
			$('#avancementLoading').text((compter+1)+' / '+tablecps.length);
			
		$.post('/pfe/controller/admin/pubEDT.php', datas, function(data, textStatus, xhr){
			
			if($.isNumeric(data)){
				compter +=1;
				if(tablecps.length > compter ){
					saveCp(tablecps[compter]);
				}else{
					$('#avancementLoading').text("Enregistrement terminé avec succès");
					setTimeout(function(){
							location.reload();
					},8000);
				}
			}
		});
		
	
		
}
});


function getList(object,container,type){
	console.log(object);
	$.post('/pfe/controller/admin/adminaddetud.php',object,function(data,xhr,statut){
		//console.log(data);
		container.html("");
		container.append($('<option value="vide">'+type+'</option>'));
		
		data = $.parseJSON(data);
		//console.log(data);
		for (var i = 0; i < data.length; i++) {
			var d = data[i];
			var option = $('<option value="'+d.id+'">'+d.nom+'</option>');
			container.append(option);


		};
		container.next().remove();
	});
}