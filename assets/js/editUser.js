/**
 * File : editUser.js 
 * 
 * This file contain the validation of edit user form
 * 
 * @author Marcelo Magnani
 */
$(document).ready(function(){
	
	var editUserForm = $("#editUser");
	
	var validator = editUserForm.validate({
		
		rules:{
			fname :{ required : true },
			lname :{ required : true },
			email : { required : true, email : true, remote : { url : baseURL + "index.php/checkEmailExists", type :"post", data : { userId : function(){ return $("#userId").val(); } } } },
			cpassword : {equalTo: "#password"},
			mobile : { required : true, digits : true },
			role : { required : true, selected : true}
		},
		messages:{
			fname :{ required : "Este campo é requerido" },
			lname :{ required : "Este campo é requerido" },
			email : { required : "Este campo é requerido", email : "Informe um endereço de email válido", remote : "Email já está em uso" },
			cpassword : {equalTo: "Entre com a mesma senha" },
			mobile : { required : "Este campo é requerido", digits : "Entre apenas números" },
			role : { required : "Este campo é requerido", selected : "Selecione ao menos uma opção" }			
		}
	});
});