
var bin = document.getElementsByClassName('faqs')[0].getElementsByClassName('links')[0].getElementsByTagName('ul')[0];
var profC = bin.getElementsByTagName('a')[0];
var patC = bin.getElementsByTagName('a')[1];

var patient = true; //flag de profesional/paciente
var professional = false;

var readMoreBtn = document.getElementsByClassName('profesional')[0].getElementsByClassName('leermas')[0]; //arranca como profesional
readMoreBtn.addEventListener('click', showText); //si se toca el botón de leer más, muestra lo pertinente a clase profesional

profC.addEventListener('click', userType(professional)); //si sos profesional CLICK
patC.addEventListener('click',userType(patient)); //si buscas un profesional CLICK


function userType(isPatient){
	return function(){

		//primero viene profesional, después paciente en el html
		// var rmBtns = document.getElementsByClassName('leermas');
		// console.log(rmBtns);
		// console.log(rmBtns[0]);
		// console.log(rmBtns[1]);
		// rmBtns[0].classList.add("visibles"); 
		// rmBtns[1].classList.add("visibles"); 

		// rmBtns[0].previousElementSibling.className = "no-visible";
		// rmBtns[1].previousElementSibling.className = "no-visible";

		var professional =  this.parentNode.parentNode.children[0].children[0];
		var patient = this.parentNode.parentNode.children[2].children[0];

		var classPro = document.getElementsByClassName('profesional')[0];
		var classPat = document.getElementsByClassName('paciente')[0];

		var readMoreBtn;

		if(isPatient){

			console.log("paciente");
			//professional.className = element.className.replace(/\bselect\b/g, ""); //sirve para solucionar cross-browsing
			professional.classList.remove("select");
			animation2(classPat,classPro);

			readMoreBtn = classPro.getElementsByClassName('leermas')[0];
		}
		else{

			console.log("profesional");
			//client.className = element.className.replace(/\bselect\b/g, ""); //sirve para solucionar cross-browsing
			patient.classList.remove("select");
			animation2(classPro,classPat);

			readMoreBtn = classPat.getElementsByClassName('leermas')[0];
		}

		this.className = 'select';
		readMoreBtn.addEventListener('click', showText);

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

function showText(){

	var root = this.previousElementSibling;
	root.className = "visibles";
	this.className = "no-visible";
	this.removeEventListener('click',showText);

}