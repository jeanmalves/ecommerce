// JavaScript Document

$(document).ready( function(){
	//$('#banner').jqFancyTransitions({ width: 978, height: 348 });
	$("#cep").mask("99.999-999");
	$("#foneFixo, #foneCell, #fone").mask("99 9999-9999");
	$("#data_nasc").mask("99/99/9999");
	    
    jQuery(function(){
	    if($("#cnpjCliente").is(':checked')){
	    	$("#documentoCliente").mask("99.999.999/9999-99");
	    }
    });
	    
    $("input:radio").click(function(){
    	if($("#cpfCliente").is(':checked')){
    		$("#documentoCliente").unmask();
    		$("#documentoCliente").mask("999.999.999-99");
    	}
    	if($("#cnpjCliente").is(':checked')){
    		$("#documentoCliente").unmask();
	    	$("#documentoCliente").mask("99.999.999/9999-99");
	    }
    });
	
    //carrossel
	jQuery('#mycarousel').jcarousel({
        visible: 4,
		auto: 2,
		scroll:1,
        wrap: 'last',
        initCallback: mycarousel_initCallback
    }); 
	
	//slideshow
	/* $(window).load(function() {
         $('#featured').orbit();
     });*/
	
	$('#featured').orbit({
	     animation: 'horizontal-slide',                  // fade, horizontal-slide, vertical-slide, horizontal-push
	     animationSpeed: 400,                // how fast animtions are
	     timer: true, 			 // true or false to have the timer
	     advanceSpeed: 4000, 		 // if timer is enabled, time between transitions 
	     pauseOnHover: false, 		 // if you hover pauses the slider
	     startClockOnMouseOut: false, 	 // if clock should start on MouseOut
	     startClockOnMouseOutAfter: 1000, 	 // how long after MouseOut should the timer start again
	     directionalNav: false, 		 // manual advancing directional navs
	     captions: true, 			 // do you want captions?
	     captionAnimation: 'fade', 		 // fade, slideOpen, none
	     captionAnimationSpeed: 800, 	 // if so how quickly should they animate in
	     bullets: false,			 // true or false to activate the bullet navigation
	     bulletThumbs: false,		 // thumbnails for the bullets
	     bulletThumbLocation: '',		 // location from this file where thumbs will be
	     afterSlideChange: function(){} 	 // empty function 
	});
	
	
	$("#cep").completaCep({
		remoto:    system_vars.base_url+'cep',
		campos:    { 
			logradouro	: 'rua',
			bairro		: 'bairro',
			cidade		: 'cidade',
			estado		: 'estado',
			//numero		: 'numero',
			//complemento : 'complemento'			
		},
		onSuccess: function() {
			$("#area_profissional").focus();
		}
	});
	
	// validação jquery
	$("#FormPlano").validate({
		errorElement: "span",
		rules: {
			dominio: "required",
			documentoCliente: {required: true, documento: true},
			nomeCliente: "required",
			sexo: "required",	
			data_nasc: { required: false, validadata: true },
			foneFixo: {required: true, validaFone:true},
			foneCell: {validaFone:true},
			email: { required: true, email: true },
			cep: {
				required: true,
				validaCEP: true,
				remote: {
					url: system_vars.base_url+'validaCep',
					type: "post",
					data: { campo: "cep" } 
				}
			},
			rua: "required",
			numero:"required",
			bairro:"required",
			estado: "required",
			cidade: "required",
			senha: { required: true, minlength: 6 },
			confirmaSenha: {
				required: true,
				minlength: 6,
				equalTo: "#senha"
			},
			//concorda_termos: "required"
			
		},
		messages: {
			documento: { documento: 'Documento inválido.'},
			CEP:{remote: "CEP Inválido"},
			concorda_termos: "<br /><br />Você deve concordar com os termos e políticas do site",
			confirma_senha_candidato: { equalTo: "Senha de confirmação incorreta." }
		}
	});
	
	$("#formContato").validate({
		errorElement: "span",
		rules: {
			nomeremetente: "required",
			emailremetente:{ required: true, email: true },
			fone:		   {required: true, validaFone:true},
			assunto:	   "required",
			mensagem:	   "required"
		}
	});

	$("#FormPlano").submit(function(){
		
		if( $(this).valid() ) {
			$.blockUI({ message: '<span class="loading_page">Gravando informações ...</span>' });
		}

		$("#estado").bloqueiaCampos(false);
		$("#cidade").bloqueiaCampos(false);
		$("#bairro").bloqueiaCampos(false);
		$("#rua").bloqueiaCampos(false);
		
	});	
});


/*=====================================================*/
/*				EXTENSÃO DO JQUERY.VALIDATE			   */
/*=====================================================*/

	jQuery.extend(jQuery.validator.messages, {
	    required: "Informação obrigatória.",
	    remote: "Informação inválida.",
	    email: "Email inválido.",
	    url: "URL inválida.",
	    date: "Data inválida.",
	    dateISO: "Data ISO inválida.",
	    number: "Digite um número válido.",
	    digits: "Apenas dígitos.",
	    creditcard: "Número de cartão de crédito inválido.",
	    equalTo: "Informação diferente da anterior.",
	    accept: "Please enter a value with a valid extension.",
	    maxlength: jQuery.validator.format("Este campo deve conter no máximo {0} caracteres."),
	    minlength: jQuery.validator.format("Este campo deve conter no mínimo {0} caracteres."),
	    rangelength: jQuery.validator.format("Este campo deve conter no mínimo {0} e no máximo {1} caracteres."),
	    range: jQuery.validator.format("Valor deve estar entre {0} e {1}."),
	    max: jQuery.validator.format("Valor deve ser menor ou igual a {0}."),
	    min: jQuery.validator.format("Valor deve ser maior ou igual a {0}.")
	});
	
	$.validator.addMethod("validacnpj", function(value) { 
		return validaCnpj(value.replace(/__\.___\.___\/____-__/g, "")); 
	}, "CNPJ inválido");
	
	$.validator.addMethod("validacpf", function(value) { 
		return validaCpf(value.replace(/___\.___\.___-__/g, "")); 
	}, "CPF inválido");
	
	$.validator.addMethod("validadata", function(value) { 
		return valida_data(value.replace(/__\/__\/____/g, "")); 
	}, "Data inválida");
	
	$.validator.addMethod("validaCEP", function(value) { 
		return validaCEP(value);
	}, "CEP inválido");
	
	$.validator.addMethod("validaFone", function(value) { 
		return validaFone(value);
	}, "Fone inválido");
	
	$.validator.addMethod("notEqual", function(value, element, param) {
		return this.optional(element) || value != param;
	}, "Por favor, defina outro valor");
	
	$.validator.addMethod("notNull", function(value, element, param) {
		return value != null || value != "null";
	}, "Campo obrigatório");
	$.validator.addMethod("salarioMinimo", function(value, element){
		return salarioMinimo(value, element);
	}, "O salário informado é menor que R$500,00");


/*=====================================================*/

/*=====================================================*/
/*		 VARIÁVEIS GLOBAIS DO JQUERY.BLOCKUI		   */
/*=====================================================*/
	
	$.blockUI.defaults.message = '<span class="loading_page">Carregando ...</span>';
	$.blockUI.defaults.css = {
		padding         		: 0, 
        margin          		: 0,
		width 					: 'auto',
		top             		: '40%', 
        left            		: '45%', 
        textAlign       		: 'center', 
        color           		: '#fff',
		border 					: 'none',
		padding					: '10px 20px', 
		backgroundColor			: '#000', 
		opacity					: .8, 
        cursor          		: 'wait',
        'font-size'				: '14px',
        '-webkit-border-radius' : '8px', 
        '-moz-border-radius'	: '8px',
        'border-radius'			: '8px'
	}	
	
/*=====================================================*/
/* Valida Documento - Identiica CPF e CNPJ			   */
/*=====================================================*/
	
	jQuery.validator.addMethod("documento", function(value, element) {

		  // remove pontuações
		  value = value.replace('.','');
		  value = value.replace('.','');
		  value = value.replace('-','');
		  value = value.replace('/','');

		  if (value.length <= 11) {
		    if(jQuery.validator.methods.cpf.call(this, value, element)){
		      return true;
		    } else {
		      this.settings.messages.documento.documento = "Informe um CPF válido.";
		    }

		  }
		  else if (value.length <= 14) {
		    if(jQuery.validator.methods.cnpj.call(this, value, element)){
		      return true;
		    } else {
		      this.settings.messages.documento.documento = "Informe um CNPJ válido.";
		    }

		  }

		  return false;

		}, "Informe um documento válido.");

	
	// validação do CPF
	jQuery.validator.addMethod("cpf", function(value, element) {
	   value = jQuery.trim(value);
		
		value = value.replace('.','');
		value = value.replace('.','');
		cpf = value.replace('-','');
		while(cpf.length < 11) cpf = "0"+ cpf;
		var expReg = /^0+$|^1+$|^2+$|^3+$|^4+$|^5+$|^6+$|^7+$|^8+$|^9+$/;
		var a = [];
		var b =0;
		var c = 11;
		for (i=0; i<11; i++){
			a[i] = cpf.charAt(i);
			if (i < 9) b += (a[i] * --c);
		}
	        if ((x = b % 11) < 2) { a[9] = 0; } else { a[9] = 11-x; }          
		b = 0;
		c = 11;
		for (y=0; y<10; y++) b += (a[y] * c--);
		if ((x = b % 11) < 2) { a[10] = 0; } else { a[10] = 11-x; }
		
		var retorno = true;
		if ((cpf.charAt(9) != a[9]) || (cpf.charAt(10) != a[10]) || cpf.match(expReg)) retorno = false;
		
		return this.optional(element) || retorno;

	}, "Informe um CPF válido."); 


	// validação do CNPJ
	jQuery.validator.addMethod("cnpj", function(cnpj, element) {
	   cnpj = jQuery.trim(cnpj);// retira espaços em branco
	   // DEIXA APENAS OS NÚMEROS
	   cnpj = cnpj.replace('/','');
	   cnpj = cnpj.replace('.','');
	   cnpj = cnpj.replace('.','');
	   cnpj = cnpj.replace('-','');
	 
	   var numeros, digitos, soma, i, resultado, pos, tamanho, digitos_iguais;
	   digitos_iguais = 1;
	 
	   if (cnpj.length < 14 && cnpj.length < 15){
	      return false;
	   }
	   for (i = 0; i < cnpj.length - 1; i++){
	      if (cnpj.charAt(i) != cnpj.charAt(i + 1)){
	         digitos_iguais = 0;
	         break;
	      }
	   }
	 
	   if (!digitos_iguais){
	      tamanho = cnpj.length - 2;
	      numeros = cnpj.substring(0,tamanho);
	      digitos = cnpj.substring(tamanho);
	      soma = 0;
	      pos = tamanho - 7;
	 
	      for (i = tamanho; i >= 1; i--){
	         soma += numeros.charAt(tamanho - i) * pos--;
	         if (pos < 2){
	            pos = 9;
	         }
	      }
	      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	      if (resultado != digitos.charAt(0)){
	         return false;
	      }
	      tamanho = tamanho + 1;
	      numeros = cnpj.substring(0,tamanho);
	      soma = 0;
	      pos = tamanho - 7;
	      for (i = tamanho; i >= 1; i--){
	         soma += numeros.charAt(tamanho - i) * pos--;
	         if (pos < 2){
	            pos = 9;
	         }
	      }
	      resultado = soma % 11 < 2 ? 0 : 11 - soma % 11;
	      if (resultado != digitos.charAt(1)){
	         return false;
	      }
	      return true;
	   }else{
	      return false;
	   }
	}, "Informe um CNPJ válido."); // Mensagem padrão 


	/*=====================================================*/
	/*				       VALIDAR CNPJ		        	   */
	/*=====================================================*/

		function validaCnpj(cnpj) {
			var valida = new Array(6,5,4,3,2,9,8,7,6,5,4,3,2);
	        var dig1= new Number;
	        var dig2= new Number;
	        cnpj = cnpj.toString().replace( /\.|\-|\//g, "" ); 
	        
	        if( cnpj == '' ) return true;
	        
	        var digito = new Number(eval(cnpj.charAt(12)+cnpj.charAt(13)));
	                
	        for(i = 0; i<valida.length; i++){
	            dig1 += (i>0? (cnpj.charAt(i-1)*valida[i]):0);  
	            dig2 += cnpj.charAt(i)*valida[i];       
	        }
	        dig1 = (((dig1%11)<2)? 0:(11-(dig1%11)));
	        dig2 = (((dig2%11)<2)? 0:(11-(dig2%11)));
	        
	        if(((dig1*10)+dig2) != digito) {        
	        	return false;  
	        }
			
	        return true;
		}

	/*=====================================================*/	
		
		
	/*=====================================================*/
	/*				       VALIDAR CPF		        	   */
	/*=====================================================*/

		function validaCpf(cpf) {
			
			cpf = cpf.toString().replace( /([.-])/g, "" );
			
			if( cpf == '' ) return true;
			
			if (cpf.length != 11 || cpf == "00000000000" || cpf == "11111111111" ||
				cpf == "22222222222" ||	cpf == "33333333333" || cpf == "44444444444" ||
				cpf == "55555555555" || cpf == "66666666666" || cpf == "77777777777" ||
				cpf == "88888888888" || cpf == "99999999999")
				return false;
			soma = 0;
			for (i=0; i < 9; i ++)
				soma += parseInt(cpf.charAt(i)) * (10 - i);
			resto = 11 - (soma % 11);
			if (resto == 10 || resto == 11)
				resto = 0;
			if (resto != parseInt(cpf.charAt(9)))
				return false;
			soma = 0;
			for (i = 0; i < 10; i ++)
				soma += parseInt(cpf.charAt(i)) * (11 - i);
			resto = 11 - (soma % 11);
			if (resto == 10 || resto == 11)
				resto = 0;
			if (resto != parseInt(cpf.charAt(10)))
				return false;
			return true;
		 }

	/*=====================================================*/
		
		
	/*=====================================================*/
	/*				       VALIDAR CEP		        	   */
	/*=====================================================*/
		
		function validaCEP(cep) {
			var cepvalsplit = cep.toString().replace(/([.-])/g, "");
			format = /^[0-9]{2}\.[0-9]{3}-[0-9]{3}$/;
			if(cep.match(format)){
				for(var i=0;i<10;i++) {
					regex = new RegExp('^['+i+']{8}', 'g');
					if( regex.test(cepvalsplit) ) {
						return false;
					}	
				}
				return true;
			}else{
				return false;
			}
		}

	/*=====================================================*/

	/*=====================================================*/
	/*				       VALIDAR FONE		        	   */
	/*=====================================================*/
		
		function validaFone(str) {
			if( str != '' ) {
				str = str.substr(3,str.length);
				var fonesplit = str.replace(/([.-])/g, "");
				
				for(var i=0;i<10;i++) {
					regex = new RegExp('^['+i+']{8}', 'g');
					if( regex.test(fonesplit) ) {
						return false;
					}	
				}
			}
			return true;
		}
			
	/*=====================================================*/

	/*=====================================================*/
	/*				       VALIDAR DATA		        	   */
	/*=====================================================*/
		
		function valida_data(data){
			
			var exp_reg1 = /[0-9]{4}-[0-9]{2}-[0-9]{2}/; 
			var exp_reg2 = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
			
			if( data != '' ) {
				
				if((data == '0000-00-00') || (data == '00/00/0000')){
					return false;		
				}
				
				//validando o formato da data
				if(data.match(exp_reg1)){
					var data_split = data.split('-');
					var dia = data_split[2]
					var mes = data_split[1]
					var ano = data_split[0]
				} 
				else if(data.match(exp_reg2)){
					var data_split = data.split('/');
					var dia = data_split[0]
					var mes = data_split[1]
					var ano = data_split[2]
				} 
				else {
					return false;
				}
				
				// validando se a data está dentro do range de dias esperados para o mês
				if (mes == '02'){
					if ((dia < '01') || (dia > '29')){ 
						return false;
					}	
				}	
				else{
					
					if ((dia < '01') || (dia > '31')){
						return false;			
					}
					if ((mes < '01') || (mes > '12')){ 
						return false;				
					}
					if ((ano > '2100') || (ano < '1900')){ 
						return false;
					}
					
				}		
				
				// validando se ano é realmente bissexto e se a data está correta
				if( !(((ano%4)=='0' && (ano%100)!='0') || (ano%400)=='0') && (mes=='02') ){
					if(dia > '28')
						return false;
				}
				
				if(((mes=='4') && (dia>'30')) || ((mes=='6') && (dia>'30')) || ((mes=='9') && (dia>'30')) || ((mes=='11') && (dia>'30'))){
			         return false;
				}
				
				return true;
			}
			return true; // true pq não existe data para validar
		}

	/*=====================================================*/	
	
	/*=====================================================*/
	/*				       VALIDAR FONE		        	   */
	/*=====================================================*/
		
		function validaFone(str) {
			if( str != '' ) {
				str = str.substr(3,str.length);
				var fonesplit = str.replace(/([.-])/g, "");
				
				for(var i=0;i<10;i++) {
					regex = new RegExp('^['+i+']{8}', 'g');
					if( regex.test(fonesplit) ) {
						return false;
					}	
				}
			}
			return true;
		}
			
	/*=====================================================*/

			
	/*=====================================================*/
	/*				       VALIDAR DATA		        	   */
	/*=====================================================*/
		
		function valida_data(data){
			
			var exp_reg1 = /[0-9]{4}-[0-9]{2}-[0-9]{2}/; 
			var exp_reg2 = /^\d{1,2}\/\d{1,2}\/\d{4}$/;
			
			if( data != '' ) {
				
				if((data == '0000-00-00') || (data == '00/00/0000')){
					return false;		
				}
				
				//validando o formato da data
				if(data.match(exp_reg1)){
					var data_split = data.split('-');
					var dia = data_split[2]
					var mes = data_split[1]
					var ano = data_split[0]
				} 
				else if(data.match(exp_reg2)){
					var data_split = data.split('/');
					var dia = data_split[0]
					var mes = data_split[1]
					var ano = data_split[2]
				} 
				else {
					return false;
				}
				
				// validando se a data está dentro do range de dias esperados para o mês
				if (mes == '02'){
					if ((dia < '01') || (dia > '29')){ 
						return false;
					}	
				}	
				else{
					
					if ((dia < '01') || (dia > '31')){
						return false;			
					}
					if ((mes < '01') || (mes > '12')){ 
						return false;				
					}
					if ((ano > '2100') || (ano < '1900')){ 
						return false;
					}
					
				}		
				
				// validando se ano é realmente bissexto e se a data está correta
				if( !(((ano%4)=='0' && (ano%100)!='0') || (ano%400)=='0') && (mes=='02') ){
					if(dia > '28')
						return false;
				}
				
				if(((mes=='4') && (dia>'30')) || ((mes=='6') && (dia>'30')) || ((mes=='9') && (dia>'30')) || ((mes=='11') && (dia>'30'))){
			         return false;
				}
				
				return true;
			}
			return true; // true pq não existe data para validar
		}

	/*=====================================================*/
			
function mycarousel_initCallback(carousel)
{
    // Disable autoscrolling if the user clicks the prev or next button.
    carousel.buttonNext.bind('click', function() {
        carousel.startAuto(0);
    });

    carousel.buttonPrev.bind('click', function() {
        carousel.startAuto(0);
    });

    // Pause autoscrolling if the user moves with the cursor over the clip.
    carousel.clip.hover(function() {
        carousel.stopAuto();
    }, function() {
        carousel.startAuto();
    });
};

