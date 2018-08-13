
var bin = document.getElementsByClassName('faqs')[0].getElementsByClassName('links')[0].getElementsByTagName('ul')[0];
var profC = bin.getElementsByTagName('a')[0];
var patC = bin.getElementsByTagName('a')[1];

var patient = true; //flag de profesional/paciente
var professional = false;

var start = userType(professional).bind(profC); //inicializo como profesional...
start();

profC.addEventListener('click', userType(professional)); //si sos profesional CLICK
patC.addEventListener('click',userType(patient)); //si buscas un profesional CLICK


function userType(isPatient){
	return function(){

		//primero viene profesional, después paciente en el html

		////////////////////////////////
		//el siguiente fragmento de código es por si se está seleccionado paciente y se pasa a profesional, o viceversa...
		var rmBtns = document.getElementsByClassName('leermas'); //cargo botones de leer más

		for (var i = 0; i < rmBtns.length; i++) {
			rmBtns[i].classList.remove("no-visible"); //los muestro en ambos tipos de usuario por defecto
			rmBtns[i].classList.add("visibles"); 
			rmBtns[i].previousElementSibling.className = "no-visible"; //escondo el div que muestra el botón de  leer más
		}
		/////////////////////////////////

		var professional =  this.parentNode.parentNode.children[0].children[0];
		var patient = this.parentNode.parentNode.children[2].children[0];

		var classPro = document.getElementsByClassName('profesional')[0];
		var classPat = document.getElementsByClassName('paciente')[0];

		var readMoreBtn;

		if(isPatient){

			//console.log("paciente");
			//professional.className = element.className.replace(/\bselect\b/g, ""); //sirve para solucionar cross-browsing
			professional.classList.remove("select"); //deselecciono el otro tipo de usuario
			animation2(classPat,classPro); //animación

			readMoreBtn = rmBtns[1]; //dejo indicado cuál de los botón leermás se está manipulando
		}
		else{

			//console.log("profesional");
			//client.className = element.className.replace(/\bselect\b/g, ""); //sirve para solucionar cross-browsing
			patient.classList.remove("select"); //deselecciono el otro tipo de usuario
			animation2(classPro,classPat); //animación

			readMoreBtn = rmBtns[0]; //dejo indicado cuál de los botón leermás se está manipulando
		}

		this.className = 'select'; //dejo seleccionado el tipo de usuari clickeado
		readMoreBtn.addEventListener('click', showText); //muestro texto adicional cuando se presiona el botón leermás

	};

}


function animation2(userType, otherType){

	otherType.style.opacity = 0;

	setTimeout(function(){ 

		otherType.style.display = 'none';
		userType.style.display = 'block';

		setTimeout(function(){ 

			userType.style.opacity = 1;

		}, 50);
	}, 300);

}

function animation3(text){
	
	setTimeout(function(){ 

		text.style.display = 'block';

		setTimeout(function(){ 

			text.style.opacity = 1;

		}, 50);
	}, 300);

}

function showText(){

	var root = this.previousElementSibling;
	//animation3(root);
	root.className = "visibles"; //al elemento ubicado antes del botón leer más, lo hago visible
	this.classList.add("no-visible"); //escondo el botón de leer más
	this.removeEventListener('click',showText); //le quito el Listener al botón

}