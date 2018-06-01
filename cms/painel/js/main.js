$(function(){

	var open  = true;
	var windowSize = $(window)[0].innerWidth;
	var targetSizeMenu = (windowSize <= 400) ? 200: 250;
	if(windowSize <= 768) {
			$('.menu').css('width','0').css('padding','0');
			$('.content,header').css('width','100%!important').css('left','0');
			open = false;
	}

	$('.menuBtn').click(function(){
			if(open) {
				//Se estiver aberto, fecha o menu e adapta o layout
				$('.menu').animate({'width':0,'padding':0},function(){
						open = false;
				});
				$('.content,header').css('width','100%');
				$('.content,header').animate({'left':0},function(){
							open = false;
				});
			}else {
				$('.menu').css('display','block');
				$('.menu').animate({'width':targetSizeMenu+'px','padding':'10px'},function(){
						open = true;
				});
				if(windowSize > 768){
			     $('.content,header').css('width','calc(100% - 250px)');
			  }
				$('.content,header').animate({'left':targetSizeMenu+'px'},function(){
							open = true;
				});
			}
	});

	$(window).resize(function(){
		windowSize = $(window)[0].innerWidth;
		targetSizeMenu = (windowSize <= 400) ? 200 : 250;
		if(windowSize <= 768){
			$('.menu').css('width','0').css('padding','0');
			$('.content,header').css('width','100%').css('left','0');
			open = false;
		}else{
			$('.menu').animate({'width':targetSizeMenu+'px','padding':'10px 0'},function(){
				open = true;
			});

			$('.content,header').css('width','calc(100% - 250px)');
			$('.content,header').animate({'left':targetSizeMenu+'px'},function(){
			open = true;
			});
		}

	})



				setTimeout(function(){
					$('.success').fadeOut();
				},4000);
				//window.location.replace('main.php');

				setTimeout(function(){
					$('.error').fadeOut();
				},4000);

 //Mostrando janela de confirmação antes de deletar
 $('[actionBtn=delete]').click(function(){
	 	var txt;
		var r = confirm("Deseja Excluir Este Depoimento?");
		if(r == true) {
			//Se a resposta for sim, deleta o item selecionado
			return true;
		}else {
			//Se o usuário clicar no "não" cancela a operação
			return false;
		}
 });


})
