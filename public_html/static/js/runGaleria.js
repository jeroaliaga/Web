var ulGallery = document.getElementsByClassName('ulGallery')[0];
var ulGalleryLI = ulGallery.getElementsByTagName('li');

for (var i = 0; i < 3; i++) {

	var element = ulGalleryLI[i];

	element.setAttribute("number", i+1); //offset para que cuente de 1 a 3
	element.addEventListener('click', changeDisp); //cuando clickeo un LI, 
																//la primera imagen se esfuma y aparece la nueva
}


function changeDisp(){

	var contGallery = document.getElementsByClassName('contGallery')[0];
	var contImgs = contGallery.getElementsByClassName('contImgs')[0].getElementsByTagName('div');

	var gallery_view = contImgs[0]; //div de lo que se muestra en pantalla
	var currentContent = contImgs[this.getAttribute("number")]; //div del li seleccionado

	var ulGallery = document.getElementsByClassName('ulGallery')[0];
	var ulGalleryLI = ulGallery.getElementsByTagName('li');

	//cambio h2, background por el seleccionado

	$(gallery_view).fadeOut("slow","", function(){
		setContent(gallery_view,currentContent,this);
	});
	$(gallery_view).fadeIn("slow");


	for (var i = 0; i < ulGalleryLI.length; i++) {

		if (this.getAttribute("number") == ulGalleryLI[i].getAttribute("number")){

			ulGalleryLI[i].getElementsByTagName('a')[0].className = 'selected'; //al elegido le doy la clase selected

		}
		else{

			ulGalleryLI[i].getElementsByTagName('a')[0].className = ''; //a los demás se las saco
			//ulGalleryLI[i].getElementsByTagName('a').classList.remove('selected');

		}
	}


}

function setContent(location,newContent,element){

	location.getElementsByTagName('h2')[0].innerHTML = newContent.getElementsByTagName('h2')[0].innerHTML;
	location.style.backgroundImage = "url(static/img/gallery"+ element.getAttribute("number") +".jpg)"; //JEROOOOOOOOOOOOOO

}