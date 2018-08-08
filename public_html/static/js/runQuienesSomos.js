window.onload = function codigo(){

	//Hay dos contenedores.  “SI SOS PROFESIONAL” (“.faqs > .links > ul > li:first-of-type > a”) 
	//y “SI BUSCAS UN PROFESIONAL  (“.faqs > .links > ul > li:nth-of-type(3) > a”).

	var bin = document.getElementsByClassName('faqs').getElementsByClassName('links').getElementsByTagName('ul');
	var prof = bin[0].getElementsByTagName('a')[0];
	var client = bin[3].getElementsByTagName('a')[0];

	//como accedo a todo lo que pide no me queda claro

	var client = true;
	var professional = false;

	prof.addEventListener('click', userType(professional));
	client.addEventListener('click',usertype(client));

}

function userType(isClient){
	return function(){

		var professional =  this.parentNode[0];
		var client = this.parentNode[3];

		if(isClient){

			//professional.className = element.className.replace(/\bselect\b/g, ""); //sirve para solucionar cross-browsing
			professional.classList.remove("select");
			animation2(client,professional);

		}
		else{

			//client.className = element.className.replace(/\bselect\b/g, ""); //sirve para solucionar cross-browsing
			client.classList.remove("select");
			animation2(professional,client);

		}

		this.className = 'select';


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