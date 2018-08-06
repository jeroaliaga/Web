window.onload = function codigo(){

	//todo esto es pseudocódigo, después reemplazo...

	/////////////Header////////////////////////

	var menu_head = document.getElementById("menu_head"); //“.menu_head > li:first-of-type > a”
	var searchContainer = document.getElementById("searchContainer");

	var start = showItem(850,1400,menu_head,searchContainer);
	start();

	window.addEventListener("resize",showItem(850,1400,menu_head,searchContainer));
	//en qué momento aparece closeSearch? es parte de searchContainer?

	/////////////Galería////////////////////////

	
	var ulGallery = document.getElementById('ulGallery');
	var ulGalleryLI = ulGallery.getElementByTagName('li');

	for (var i = 0; i < 3; i++) {

		var element = ulGalleryLI[i];

		element.setAttribute("number", i+1);
		element.addEventListener('click', changePic); //cuando clickeo un LI, 
																//la primera imagen se esfuma y aparece la nueva
	}

	/////////////Quienes somos////////////////////////

	//Hay dos contenedores.  “SI SOS PROFESIONAL” (“.faqs > .links > ul > li:first-of-type > a”) 
	//y “SI BUSCAS UN PROFESIONAL  (“.faqs > .links > ul > li:nth-of-type(3) > a”).

	var bin = document.getElementById('faqs').getElementById('links').getElementByTagName('ul');
	var prof = bin[0].getElementByTagName('a');
	var client = bin[3].getElementByTagName('a');

	//como accedo a todo lo que pide no me queda claro



}


/////////////Quienes somos////////////////////////




/////////////Galería////////////////////////

function changePic(){

	var contGallery = document.getElementById('contGallery');
	var contImgs = contGallery.getElementById('contImgs');

	contImgs[0] = this; //ESTO DEBERÍA SER UNA TRANSICIÓN

	var ulGallery = document.getElementById('ulGallery');
	var ulGalleryLI = ulGallery.getElementByTagName('li');

	for (var i = 0; i < ulGallery.length; i++) {h
		if (thisgetAttribute("number") == ulGalleryLI[i].getAttribute("number")){
			ulGalleryLI[i].getElementByTagName('a').className = 'selected';
		}
		else{

			ulGalleryLI[i].getElementByTagName('a').className = '';
		}
	}

}

/////////////Header////////////////////////

//fija que en esta función hay errores porque tiene cosas de CSS
function showItem(Lwidth,Hwidth,item,item2){
	return function (){

		if((window.innerWidth < Hwidth)&&(window.innerWidth > Lwidth)){ 

			item2.style.opacity=0;
			item2.style.width=0;
			item2.style.overflow='hidden';
			item2.style.display='none';

			item.style.display='block';
			item.style.opacity=1;
			item.style.width='auto';
			item.style.overflow='visible';

			item.addEventListener('click',searcherHandler(item,item2));

		} 
		else{

			item.style.attr='none';
			item2.style.attr='none';

		}

	};
}

function searcherHandler(item, item2){
	return function(){

		var closeSearch = item.getElementById('closeSearch');
		animation1(item,item2); //muestro el buscador

		var timer; //defino timer 
		var isFocusIn = false; //flag de is hay focus o no
		timer=setTimeout(animation1(item2,item),4000); //pongo un timer para que se cierre el buscador en 4 segs
	
		item.addEventListener("mouseover", function(){
			clearTimeout(timer); //si pongo el mouse encima, mato el timer
		});
		item.addEventListener("mouseout", function(){
			if(!isFocusIn){ //si no hay focus
				timer=setTimeout(animation1(item2,item),4000); //saco mouse de encima y pasan 4 segs, cierro buscador
			}
		});
		item.addEventListener("focusin", function(){
			clearTimeout(timer); //si hay focus, mato el timer
			isFocusIn = true;
		});
		item.addEventListener("focusout", function(){
			isFocusIn = false; 
			timer=setTimeout(animation1(item2,item),4000); //si no hay focus, vuelvo a poner los 4 segs
		});
		closeSearch.addEventListener("click", function(){
			clearTimeout(timer); //si clickeo en CS, mato el timer
			animation1(item2,item); //y cierro el buscador
		});

	};

}

//fija que en esta función hay errores porque tiene cosas de CSS
function animation1(item,item2){

	item.style.opacity=0;
	item.style.width=0;
	item.style.overflow='hidden';

	setTimeout(function(){ 
		item.style.display='none';

		item2.style.display='block';
		setTimeout(function(){ 
			item2.style.opacity=1;
			item2.style.width='auto';
			item2.style.overflow='visible';
		}, 0.1);
	}, 0.3);

}
