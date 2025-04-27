$(function (){
	
	$('.filtro').click (function(){
	$('.mostraFiltro').slideToggle();
	$(this).toggleClass('active');
		return false;
	});
	
	$('.mobmenu').click (function(){
	$('.menutopo').slideToggle();
	$(this).toggleClass('active');
		return false;
	});	
	
	$('.senha').click (function(){
		$('.mostraCampo').slideToggle();
		$(this).toggleClass('active');
		return false;
	});
				
	$( "#accordion" ).accordion({
		collapsible: true,
		autoHeight: false,
		active: false,
		heightStyle: "content" 
    });    

});

function excluir(obj){
	var entidade  = $(obj).attr('data-entidade');
	var id  = $(obj).attr('data-id');	
	if(confirm('Deseja realmente excluir ?')){
		window.location.href = base_url + entidade +"/excluir/" + id;	
	}
}

// função que exibe um diálogo de confirmação da exclusão
function deleteDialog(obj){
	// obtendo o controler e o id a serem considerados
	var controller  = $(obj).attr('data-controller');
	var id  = $(obj).attr('data-id');	
	// criando o diálogo
	if(confirm('Deseja realmente excluir?')){
		// redirecionando para a rota
		window.location.href = base_url + controller +"/delete/" + id;	
	}
}

function fecharMsg(obj){	
	$(".msg").hide();
}
