//O código abaixo cria um slide em vanilla js
//The code below create a slideshow in Vanilla JS
var i = 0; 			// Start Point // Ponto Inicial
var images = [];
var time = 4000;	// Time Between Switch // Tempo que cada imagem será exibida

// definindo as imagens
//Defining images
images[0] = "img/slide1.jpg";
images[1] = "img/slide2.jpg";
images[2] = "img/slide3.jpg";
//images[3] = "http://lorempixel.com/400/200/people";

// Change Image
//Muda imagem
function changeImg(){
	//Atribuindo as imagens do array a tag img
	//Defining the images from the array to the img tag
	document.slider.src = images[i];
	// Check If Index Is Under Max
	//Verificando se o index é menor que o array images
	if(i < images.length - 1){
	  // Add 1 to Index
		//Adiciona 1 ao Index
	  i++;
	} else {
		// Reset Back To O
		//Define o valor zero para o i de novo
		i = 0;
	}

	// Run function every x seconds
	// Executa a função a cada x segundos
	setTimeout("changeImg()", time);
}

// Run function when page loads
//Executa a função quando a pagina carrega
window.onload=changeImg;
