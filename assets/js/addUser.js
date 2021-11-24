/**
 * File : addUser.js
 * 
 * This file contain the validation of add user form
 * 
 * Using validation plugin : jquery.validate.js
 * 
 * @author Kishor Mali
 */

$(document).ready(function(){
	
	var addUserForm = $("#addUser");
	
	var validator = addUserForm.validate({
		
		rules:{
			fname :{ required : true },
			lname :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "index.php/checkEmailExists", type :"post"} },
			password : { required : true },
			cpassword : {required : true, equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "Este campo é requerido" },
			lname :{ required : "Este campo é requerido" },
			email : { required : "Este campo é requerido", email : "Informe um endereço de email válido", remote : "Email já está em uso" },
			password : { required : "Este campo é requerido" },
			cpassword : {required : "Este campo é requerido", equalTo: "Entre com a mesma senha" },
			mobile : { required : "Este campo é requerido", digits : "Entre apenas números" },
			role : { required : "Este campo é requerido", selected : "Selecione ao menos uma opção" }			
		}
	});
});
