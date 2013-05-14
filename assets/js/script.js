$(document).ready( function(){
	
	$("#formLogin").validate({
		validClass:'success',
		errorClass:'error',
		//errorElement: "span",
		
		rules: {
			inputLogin: "required",
			inputPassword: {required:true, minlength:6}
		}
		,highlight: function(element)
	    {
	        $(element).parents('.control-group').addClass("error");
	    }
	    ,unhighlight: function(element)
	    {
	        $(element).parents('.control-group').removeClass("error");
	    }
	});
	
	//mascara campo 
	$('#inputPreco').priceFormat({
        prefix: '',
        centsSeparator: ',',
        thousandsSeparator: '.',
            limit: 7,
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