/**
 * @author Kishor Mali
 */


jQuery(document).ready(function(){
	
	jQuery(document).on("click", ".deleteUser", function(){
		var userId = $(this).data("userid"),
			hitURL = baseURL + "index.php/deleteUser",
			currentRow = $(this);
		
		var confirmation = confirm("Tem certeza que deseja desativar este usuário?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { userId : userId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Usuário desativado com sucesso"); }
				else if(data.status = false) { alert("Desativação de usuário falhou"); }
				else { alert("Acesso negado..!"); }
			});
		}
	});
	
	
		jQuery(document).on("click", ".deleteBidding", function(){
		var biddingId = $(this).data("biddingid"),
			hitURL = baseURL + "index.php/deleteBidding",
			currentRow = $(this);
		
		var confirmation = confirm("Tem certeza que deseja apagar esta licitação?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { biddingId : biddingId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Licitação apagada com sucesso"); }
				else if(data.status = false) { alert("Exclusão de licitação falhou"); }
				else { alert("Acesso negado..!"); }
			});
		}
	});
	
		jQuery(document).on("click", ".deleteAta", function(){
		var ataId = $(this).data("ataid"),
		    urlAta = $(this).data("urlata"),
			hitURL = baseURL + "index.php/deleteAta",
			currentRow = $(this);
		
		var confirmation = confirm("Tem certeza que deseja apagar esta ata?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { ataId : ataId, urlAta : urlAta } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Ata apagada com sucesso"); }
				else if(data.status = false) { alert("Exclusão de ata falhou"); }
				else { alert("Acesso negado..!"); }
			});
		}
	});
	
		jQuery(document).on("click", ".deleteItem", function(){
		var itemId = $(this).data("itemid"),
			hitURL = baseURL + "index.php/deleteItem",
			currentRow = $(this);
		
		var confirmation = confirm("Tem certeza que deseja apagar este item?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { itemId : itemId } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Item apagado com sucesso"); }
				else if(data.status = false) { alert("Exclusão de item falhou"); }
				else { alert("Acesso negado..!"); }
			});
		}
	});
	
	jQuery(document).on("click", ".deleteArquivo", function(){
		var arqId = $(this).data("arqid"),
		    urlArq = $(this).data("urlarq"),
			hitURL = baseURL + "index.php/deleteArquivo",
			currentRow = $(this);
		
		var confirmation = confirm("Tem certeza que deseja apagar este arquivo?");
		
		if(confirmation)
		{
			jQuery.ajax({
			type : "POST",
			dataType : "json",
			url : hitURL,
			data : { arqId : arqId, urlArq : urlArq } 
			}).done(function(data){
				console.log(data);
				currentRow.parents('tr').remove();
				if(data.status = true) { alert("Arquivo apagado com sucesso"); }
				else if(data.status = false) { alert("Exclusão de arquivo falhou"); }
				else { alert(data.erro); }
			});
		}
	});
	
	jQuery(document).on("click", ".searchList", function(){
		
	});
	
});
