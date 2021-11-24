/**
 * File : addItem.js 
 * 
 * This file contain the validation of add item form
 * 
 * @author Marcelo Magnani
 */
$(document).ready(function(){
	
	var addItemForm = $("#addNewItem");
	
	var validator = addItemForm.validate({
		
		rules:{
			numitem :{ required : true, digits : true },
			requisicao :{ required : true },
			descricao : { required : true },
			quantidade : { required : true, digits : true },
			medida : { required: true },
			vunit : { required : true, currency : true },
			vtot : { required : true, currency : true },
			fcnpj : { required : true },
			frazao : { required : true },
			numata : { required : true }
		},
		messages:{
			numitem : { required : "Este campo é requerido", digits : "Entre apenas números" },
			requisicao : { required : "Este campo é requerido" },
			descricao : { required : "Este campo é requerido" },
			quantidade : { required : "Este campo é requerido", digits : "Entre apenas números" },
			medida : { required : "Este Campo é requerido" },
			descricao : {required : "Este campo é requerido" },
			vunit : { required : "Este campo é requerido", currency : "Entre apenas números" },
			vtot : { required : "Este campo é requerido", currency : "Entre apenas números" },
			fcnpj : { required : "Este campo é requerido" },
			frazao : { required : "Este campo é requerido" },
			numata : { required : "Este campo é requerido" }			
		}
	});
});