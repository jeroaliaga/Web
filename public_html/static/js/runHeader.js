
var menu_head = document.getElementsByClassName("menu_head")[0]; //barra del header
var searchContainer = document.getElementsByClassName("searchContainer")[0]; //contenedor de búsqueda

var searchBtn = menu_head.getElementsByTagName('li')[0].getElementsByTagName('a')[0]; //botón de buscador

var start = setStyles(850,1400,menu_head,searchContainer); //defino estilos ni bien se muestra el header
start();

window.addEventListener("resize",setStyles(850,1400,menu_head,searchContainer)); //si cambio tamaño de ventana
																	//me fijo que pasa con 'style'
searchBtn.addEventListener('click',searcherHandler(menu_head,searchContainer));	//si clickean el botón del buscador
														//lo abro, muestro animación, etc....


function setStyles(Lwidth,Hwidth,item,item2){
	return function (){

		if((window.innerWidth > Hwidth)||(window.innerWidth < Lwidth)){ 

			item.removeAttribute("style");
			item2.removeAttribute("style");

		} 

	};
}

function searcherHandler(item, item2){
	return function(){

		var closeSearch = document.getElementsByClassName('closeSearch')[0]; //traigo botón de Cerrar Búsqueda
		
		animation1(item,item2); //muestro el buscador

		var timer; //defino timer 
		var isFocusIn = false; //flag de is hay focus o no

		timer=setTimeout(function(){ animation1(item2,item); }, 4000); //pongo un timer para que se cierre el buscador en 4 segs
	
		item2.addEventListener("mouseover", function(){
			clearTimeout(timer); //si pongo el mouse encima, mato el timer
		});
		item2.addEventListener("mouseout", function(){
			if(!isFocusIn){ //si no hay focus
				timer=setTimeout(function(){ animation1(item2,item); }, 4000); //saco mouse de encima y pasan 4 segs, cierro buscador
			}
		});
		item2.addEventListener("focusin", function(){
			clearTimeout(timer); //si hay focus, mato el timer
			isFocusIn = true;
		});
		item2.addEventListener("focusout", function(){
			isFocusIn = false; 
			timer=setTimeout(function(){ animation1(item2,item); }, 4000); //si no hay focus, vuelvo a poner los 4 segs
		});
		closeSearch.addEventListener("click", function(){
			clearTimeout(timer); //si clickeo en CS, mato el timer
			animation1(item2,item); //y cierro el buscador
		});
		

	};

}

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
		}, 100);
	}, 300);

}
