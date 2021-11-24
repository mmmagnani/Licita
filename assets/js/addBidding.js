/**
 * File : addBidding.js 
 * 
 * This file contain the validation of add bidding form
 * 
 * @author Marcelo Magnani
 */
$(document).ready(function(){
	
	var addBiddingForm = $("#addBidding");
	
	var validator = addBiddingForm.validate({
		
		rules:{
			modalidade :{ required : true, selected : true },
			tipo :{ required : true, selected : true },
			numero : { required : true, digits : true },
			om : { required : true },
			descricao : { required: true },
			srp : { required : true },
			anolicita : { required : true, digits : true }
		},
		messages:{
			modalidade :{ required : "Este campo é requerido", selected : "Selecione ao menos uma opção" },
			tipo :{ required : "Este campo é requerido", selected : "Selecione ao menos uma opção" },
			numero : { required : "Este campo é requerido", digits : "Entre apenas números" },
			om : { required : "Este Campo é requerido" },
			descricao : {required : "Este campo é requerido" },
			srp : { required : "Este campo é requerido" },
			anolicita : { required : "Este campo é requerido", digits : "Entre apenas números" }			
		}
	});
});