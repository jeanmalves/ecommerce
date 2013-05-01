///////////////////////// MAKROSIS COMMON //////////////////////////
// jquery.mkscommon.js
// Conjunto das fun��es/plugins em jquery desenvolvidos 
// para os produtos MakroSIS
// 
// Autor:     Rafael Dantas
// Criado em: 10/11/2011
////////////////////////////////////////////////////////////////////

/**
 * Fun��o para auto complete de CEP
 */

$.fn.liberaCampo = function(options) {
	
		var defaults = {

		campos:    { 
			campoBloqueado	: 'tipo_deficiencia'	
		}
	};
		
	var opts 		= $.extend(defaults, options);	
	
	$(this).click(function(e){
		var thisElement = $(this);
		
		if($(thisElement).is(":checked"))
		{
			$("#"+opts.campos.campoBloqueado).bloqueiaCampos(false);
		}
		else
			{
				$("#"+opts.campos.campoBloqueado).val("");
				$("#"+opts.campos.campoBloqueado).bloqueiaCampos(true);
			}
	});
};	

$.fn.completaCep = function(options) {
	var defaults = {
		remoto: 'cep',
		parametro: 'cep',
		loadergifpath: null,
		campos:    { 
			logradouro	: 'id_logradouro',
			bairro		: 'id_bairro',
			cidade		: 'id_cidade',
			estado		: 'id_estado',
			numero		: 'id_numero',
			complemento : 'id_complemento',
		},
		onSuccess: null
	};
	
	var opts = $.extend(defaults, options);	
		
		$(this).blur(function(e) {
			var cep = $(this);
			var cepval = $(cep).val();
			var cepvalsplit = cepval.replace(/([.-])/g, "");
			var flag;
			
			// mata a execu��o se o cep n�o estiver sido digitado inteiro
			regex = new RegExp('^[0-9]{2}\.[0-9]{3}-[0-9]{3}', 'g');
			if( !regex.test(cepval) ) {
				return false;
			}
			
			// valida��o cep
			for(var i=0;i<10;i++) {
				regex = new RegExp('^['+i+']{8}', 'g');
				if( regex.test(cepvalsplit) ) {
					return false;
				}	
			}
			
			$.blockUI({ message: '<span class="loading_page">Carregando ...</span>' });			
			
			$.ajax({
				type: 'POST',
				url: opts.remoto,
				data: { cep: cep.val() },
				contentType: 'application/x-www-form-urlencoded;charset=ISO-8859-15',
				dataType: 'html',
				beforeSend: function() {
					if( opts.loadergifpath != null )
						$(cep).after('<img class="loading" src="'+opts.loadergifpath+'" />');
					$("#"+opts.campos.logradouro).bloqueiaCampos(true);
					$("#"+opts.campos.numero).bloqueiaCampos(true);
					$("#"+opts.campos.complemento).bloqueiaCampos(true);
					$("#"+opts.campos.bairro).bloqueiaCampos(true);
					$("#"+opts.campos.cidade).bloqueiaCampos(true);
					$("#"+opts.campos.estado).bloqueiaCampos(true);
				},
				complete: function(){
					if( opts.loadergifpath != null )
						$(cep).next('img').remove();
					/*$("#"+opts.campos.logradouro).bloqueiaCampos(false);
					$("#"+opts.campos.numero).bloqueiaCampos(false);
					$("#"+opts.campos.complemento).bloqueiaCampos(false);
					$("#"+opts.campos.bairro).bloqueiaCampos(false);
					$("#"+opts.campos.cidade).bloqueiaCampos(false);
					$("#"+opts.campos.estado).bloqueiaCampos(false);*/
				},
				success: function(data){
					if( data != '0' ) {
						var dados = data.split(',');
						$("#"+opts.campos.logradouro).val(dados[1]);
						$("#"+opts.campos.bairro).val(dados[2]);
						$("#"+opts.campos.cidade).val(dados[3]);
						$("#"+opts.campos.estado).val(dados[4]);
						$("#"+opts.campos.numero).val("");
						$("#"+opts.campos.complemento).val("");
						flag = true;
					} else {
						$("#"+opts.campos.logradouro).val("");
						$("#"+opts.campos.numero).val("");
						$("#"+opts.campos.complemento).val("");
						$("#"+opts.campos.bairro).val("");
						$("#"+opts.campos.cidade).val("");
						$("#"+opts.campos.estado).val("");
						flag = false;
					}
					
					/*if( flag ) $("#"+opts.campos.numero).focus();
					else $("#"+opts.campos.logradouro).focus();*/
					
					$.unblockUI();
					
					// executa fun��o onSuccess do plugin cep
					if( flag && opts.onSuccess ) {
						return opts.onSuccess.call();
					}
				}				
			});	
			
		});
};
 
 
$.fn.addTabelaDados = function(options) {
	
	var defaults = {
		listagem	: '.escolhidos', // class do container onde ser� mostrado a tabela com os itens escolhidos
		form		: '.form-escolher', // class do container onde fica o form com os campos para escolher
		btnGravar	: '.gravar', // class do bot�o que ser� o gatilho para gravar no html os dados escolhidos
		btnCancelar	: '.cancelar', // class do bot�o para cancelar a a��o
		msg			: '<div class="help"></div>', // html prefixo e sufixo para alguma mensagem
		colRemover	: true,	// se haver� coluna de removar para os itens escolhidos
		colEditar	: true,	// se haver� coluna de editar para os itens escolhidos
		campos		: null, // dever� ser um objeto com as informa��es necess�rias para montar cada campo
		antesGravar : null  // a��o para ser realizada imediatamente depois de clicar no btnGravar para valida��o
		/* formato do objeto "campos"
		 * campos: [{ 
		 * 		idCampoForm: 'nivel_leitura_idioma_candidato',
		 *		nameCampoHidden: 'nivel_leitura_idioma_candidato_escolhido',
		 *		tituloCampoTabela: 'Leitura',
		 *		obrigatorio: true ou false ou function retornando um boolean,
		 *		apenasHidden: true ou false
		 *	}]
		 */
	};

	var opts = $.extend(defaults, options);	
	var thisElement = $(this);
		
	$(thisElement).find(opts.btnGravar).live('click', function(e) {
		e.preventDefault();
		
		// est� editando?
		var editing = $(thisElement).find('.form-escolher').attr('editing');
		
		// executa fun��o de valida��o passada por par�metro
		if( opts.antesGravar ) {
			if( !opts.antesGravar.call() ) return false;
		}
		
		var thHtml		= '';
		var tdHtml 		= '';		
		var tableHtml 	= '';
		var camposHidden= '';
		
		$(thisElement).find('.msg').remove(); // limpa msgs se houver
		
		for( i=0; i<opts.campos.length; i++ ) {
			
			// faz uma r�pida valida��o
			// neste caso � poss�vel que opts.campos[i].obrigatorio seja ou boolean ou uma function
			// se for function a valida��o tem q ser feita colocando () na vari�vel para que d�
			// certo a execu��o da fun��o, sendo ent�o o resultado dela boolean
			if( (typeof opts.campos[i].obrigatorio == "boolean" ? opts.campos[i].obrigatorio : opts.campos[i].obrigatorio())  
			&& $("#"+opts.campos[i].idCampoForm).val() == '' ) {
				$(thisElement).find(opts.form).prepend( $(opts.msg).addClass('msg').html('<div class="icon"></div><span>&nbsp;&nbsp;Campo "'+ opts.campos[i].tituloCampoTabela +'" obrigat�rio</span>') );
				return false;
			}
			
			// s� monta a coluna para determinado campo se apenasHidden n�o existir ou for falso
			// pois se este campo estiver definido como true apenas vai montar o seu hidden 
			// para envio do form
			if( typeof opts.campos[i].apenasHidden == "undefined" || !opts.campos[i].apenasHidden ) {
				
				// se for select pega o html do option selecionado, sen�o pega o val
				if( $("#"+opts.campos[i].idCampoForm).prop('tagName') == 'SELECT' )
					var valorCampo = $("#"+opts.campos[i].idCampoForm).find('option:selected').html();
				else
					var valorCampo = $("#"+opts.campos[i].idCampoForm).val();
				
				thHtml += '<th>'+ opts.campos[i].tituloCampoTabela +'</th>';
				tdHtml += '<td>'+ valorCampo +'</td>';
				
			}		
			
			// monta campos hidden
			camposHidden += '<input type="hidden" class="'+ opts.campos[i].nameCampoHidden +'" name="'+ opts.campos[i].nameCampoHidden +'[]" linked="'+opts.campos[i].idCampoForm+'" value="'+ $("#"+opts.campos[i].idCampoForm).val() +'" />'
			
		}
		
		// zera todos os campos
		$(".form-escolher", thisElement).find(':text, textarea, select').val('').bloqueiaCampos(false);
		$(".form-escolher", thisElement).find(':checkbox').attr('checked', false).bloqueiaCampos(false);
		
		// montando coluna de a��o (editar e remover)
		thHtml += '<th width="50">A��o</th>';
		tdHtml += '<td><a style="float:left;" href="#" class="edita-escolhido" title="Editar" alt="Editar"><center><i class="icon-pencil"></i></center></a>';
		tdHtml += '<a style="float:left;" href="#" class="remove-escolhido" title="Remover" alt="Remover"><center><i class="icon-trash"></i></center></a>'+camposHidden+'</td>';
		
		if( editing ) {
			
			$(thisElement).find(opts.listagem).find('table tr:gt(0):eq('+editing+')').replaceWith( '<tr>'+ tdHtml +'</tr>' );
			
		} else {
		
			// adiciona escolhido no html
			if( $(thisElement).find(opts.listagem).html().length == 0 ) {
				tableHtml += '<table>';
				tableHtml += '<tr>'+ thHtml +'</tr>';
				tableHtml += '<tr>'+ tdHtml +'</tr>';
				tableHtml += '</table>';
				
				$(thisElement).find(opts.listagem).html( tableHtml );
			} else {
				tableHtml += '<tr>'+ tdHtml +'</tr>';
				
				$(thisElement).find(opts.listagem).find('table').append( tableHtml );
			}	
		}
		
		// trigger no bot�o cancelar
		$(thisElement).find(opts.btnCancelar).trigger('click');
		
	});
	
	// for�a reset ao fechar/abrir o elemento
	$(thisElement).find('.titulo-toggle').click(function() {
		
		// limpa msgs se houver
		$(thisElement).find('.msg').remove();
		
		// zera todos os campos
		$(".form-escolher", thisElement).find(':text, textarea, select').val('').bloqueiaCampos(false);
		$(".form-escolher", thisElement).find(':checkbox').attr('checked', false).bloqueiaCampos(false);
		
		// remove editing se houver
		$(thisElement).find('.form-escolher').removeAttr('editing');
	});
	
	$(thisElement).find(opts.btnCancelar).live('click', function(e) {
		e.preventDefault();
		
		// limpa msgs se houver
		$(thisElement).find('.msg').remove();
		
		// zera todos os campos
		$(".form-escolher", thisElement).find(':text, textarea, select').val('').bloqueiaCampos(false);
		$(".form-escolher", thisElement).find(':checkbox').attr('checked', false).bloqueiaCampos(false);
		
		// remove editing se houver
		$(thisElement).find('.form-escolher').removeAttr('editing');
	});
	
	$(thisElement).find('.remove-escolhido').live('click', function(e) {
		e.preventDefault();
		$(this).parents('tr').remove();
		$(thisElement).find('.form-escolher').removeAttr('editing');
	});
	
	$(thisElement).find('.edita-escolhido').live('click', function(e) {
		e.preventDefault();
		var index = $(thisElement).find('.edita-escolhido').index( $(this) );
		$(thisElement).find('.form-escolher').attr('editing', index).slideDown();
		
		var linked;
		var value;
		$(this).siblings('input').each(function() {
			linked = $(this).attr('linked');
			value = $(this).val();
			if($(thisElement).find('#'+linked).is('input[type="checkbox"]')){
				if(value == 'S'){
					$(thisElement).find('#'+linked).attr('checked', 'checked');
				}
				else{
					$(thisElement).find('#'+linked).attr('checked', false);
				}
			}
			else{
				$(thisElement).find('#'+linked).val( value );
			}
		});
		
	});
};

/**
 * Fun��o que permite digitar apenas n�meros
 */
$.fn.sonumeros = function() {
	$(this).keypress(function(e) {
		if(e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
			return false;
		}
	});
};

/**
 * Fun��o que permite bloquear campos do formul�rio
 */
$.fn.bloqueiaCampos = function(options) {
	
	var defaults = {
		acao     		: true,
		readonly 		: false,	// se true, ao inv�s de desabilitar vai apenas incluir prop readonly
		//style_block     : { 'background-color' : '#f0f0f0', 'background-image' : 'none' },
		//style_normal	: { 'background' : 'url(\'./_imagens/bgInput.jpg\') repeat-x 0 0 #fff' },
		css_class		: 'disabled', // vem do classes.css
		botoes			: [ 'button', 'submit', 'reset' ]
	};
	
	// Verifico se foi mandado como par�metro um 'atalho' p/ a op��o 'acao'
	// Sendo afirmativo converte p/ {acao:true/false}
	if( typeof(options) == "boolean" ) {
		var atalho_acao = options;
		options = { acao: atalho_acao };
	}
	
	var opts = $.extend(defaults, options);
	
	// Bloqueia
	if( opts.acao == true ) {
		
		return this.each(function() {
			var type = $(this).attr("type");
			
			if( type != 'hidden' ) {
				if( opts.readonly ) {
					$(this).attr("readonly", true);
				} else {
					$(this).attr("disabled", true);
				}
				if( $.inArray(type, opts.botoes) > -1 ) {
					$(this).css("cursor", "auto");
				} else {
					//$(this).css(opts.style_block);
					$(this).addClass(opts.css_class);
				}
			}
		});
		
	} 
	
	// Desbloqueia
	else {
		
		return this.each(function() {
			var type = $(this).attr("type");
			
			if( type != 'hidden' ) {
				if( opts.readonly ) {
					$(this).attr("readonly", false);
				} else {
					$(this).attr("disabled", false);
				}
				if( $.inArray(type, opts.botoes) > -1 ) {
					$(this).css("cursor", "pointer");
				} else {
					//$(this).css(opts.style_normal);
					$(this).removeClass(opts.css_class);
				}
			}
		});
		
	}
	
};

/**
 * Fun��o que permite esconder campos do formul�rio
 */
$.fn.esconde = function(options) {
	
	var defaults = {
		acao     		: true
	};
	
	// Verifico se foi mandado como par�metro um 'atalho' p/ a op��o 'acao'
	// Sendo afirmativo converte p/ {acao:true/false}
	if( typeof(options) == "boolean" ) {
		var atalho_acao = options;
		options = { acao: atalho_acao };
	}
	
	var opts = $.extend(defaults, options);
	
	// Esconde
	if( opts.acao == true ) {
		return this.each(function() {
			$(this).addClass("hide");
		});
	} 
	
	// Mostra
	else {
		return this.each(function() {
			$(this).removeClass("hide");
		});
	}
	
};

/**
 * Fun��o de valida��o de cpf
 */
$.fn.validaCpf = function(options) {
	
	var defaults = {
		// manipula o bloqueio ou desbloqueio de campos dependendo do resultado do cpf
		ev : null,	// evento: bind, keypress, keyup; se null, executa somente keypress
		cb : {
			cps : null, // campos que ser�o bloqueados ou desbloqueados
			val : null, // se null n�o faz nada; se true bloqueia; se false desbloqueia
			inv : null, // se null n�o faz nada; se true bloqueia; se false desbloqueia
			inc : null  // se null n�o faz nada; se true bloqueia; se false desbloqueia
		},
		fv : null, // executa caso o cpf for v�lido ( function() ou null )
		fi : null,  // executa caso o cpf for inv�lido ( function() ou null )
		fn : null  // executa caso o cpf for incompleto ( function() ou null )
	};
	
	var opts = $.extend(defaults, options);
	
	if( opts.ev == null ) {
		$(this).keyup(function(e) {
			executaAcao($(this));
		});
	} else {
		if( opts.ev == 'blur' ) {
			$(this).bind('keyup blur',function(e) {
				executaAcao($(this));
			});
		}
	}
	
	function executaAcao(campocpf) {
		var cpf = $(campocpf).val();
		// CPF completo
		if( estaCompleto( cpf ) ) {
			// CPF inv�lido
			if( !valida( cpf ) ) {
				// Escreve mensagem de inv�lido
				$("#cpf-result").html("CPF inv�lido").css("color","#dd3c33");
				// Manipula o bloqueio ou desbloqueio dos campos para cpf inv�lido
				manipulaBloqueioCampos(opts.cb.inv);
				// Executa a fun��o passada caso cpf seja inv�lido 
				if( typeof(opts.fi) == "function" ) {
					opts.fi.call();
				}
			} 
			// CPF v�lido
			else {
				// Mostra icone de cpf v�lido
				$("#cpf-valid").css('display','inline');
				// Manipula o bloqueio ou desbloqueio dos campos para cpf v�lido
				manipulaBloqueioCampos(opts.cb.val);
				// Executa a fun��o passada caso cpf seja v�lido 
				if( typeof(opts.fv) == "function" ) {
					opts.fv.call();
				}
			}
		} 
		// CPF incompleto
		else {
			// Remove qualquer mensagem ou icone que existir
			$("#cpf-result").html("");
			$("#cpf-valid").css('display','none');			
			// Manipula o bloqueio ou desbloqueio dos campos para cpf incompleto
			manipulaBloqueioCampos(opts.cb.inc);
			// Executa a fun��o passada caso cpf seja incompleto
			if( typeof(opts.fn) == "function" ) {
				opts.fn.call();
			}
		}
	}
	
	function manipulaBloqueioCampos(t) {
		if( opts.cb.cps != null && t != null ) {
			if( t == true ) {
				$(opts.cb.cps).bloqueiaCampos();
			} else {
				$(opts.cb.cps).bloqueiaCampos(false);
			}
		}
	}
	
	function estaCompleto(cpf) {
		var regexp = /^[\d]{3}\.[\d]{3}\.[\d]{3}\-[\d]{2}$/;
		return regexp.test(cpf);
	}
	
	function valida(cpf) {
		
		var nulos, er, soma, resto, dv;
		
		// Array de nulos
		nulos = [ '12345678909', '11111111111','22222222222','33333333333',
		               '44444444444','55555555555','66666666666','77777777777',
		               '88888888888','99999999999','00000000000' ];
		
		// Tira tudo que n�o � n�mero
		er = /[^0-9]/g;
		cpf = cpf.replace(er,"");
		if( er.test( cpf ) ) {
			return false;
		}
		
		// Inv�lido caso tenha corresponda a algum nulo
		if( $.inArray(cpf, nulos) > -1 ) {
			return false;
		}
		
		// Calculo do primeiro d�gito verificador
		soma = 0;
		
		for( i=0; i<9; i++ ) {
			soma += parseInt(cpf.charAt(i)) * ( 10 - i );
		}
		resto = soma % 11;
		dv = ( resto < 2 ) ? 0 : ( 11 - resto );
		
		if( dv != parseInt(cpf.charAt(9)) ){
		  return false;
		}
		
		// Calcula segundo d�gito verificador
		soma = 0;
		for( i=0; i<10; i++ ) {
			soma += parseInt(cpf.charAt(i)) * ( 11 - i );
		}
		resto = soma % 11;
		dv = ( resto < 2 ) ? 0 : ( 11 - resto );
		if( dv != parseInt(cpf.charAt(10)) ){
		  return false;
		}  
		
		return true;
	}
	
};

$(function() {
    /*if(!$.support.placeholder) {
    	$('[placeholder]').each(function(){
    		var ph = $(this).attr('placeholder');
    		if( $(this).val() == '' ) {
    			$(this).val(ph).focus(function(){
    				if( $(this).val() == ph) $(this).val('');
    			}).blur(function(){
    				if( !$(this).val() ) $(this).val(ph)
    			})
    		}
    	});
    }*/
    
    if(!$.support.placeholder) {
        var active = document.activeElement;
        $('[placeholder]').each(function(){
        	var ph = $(this).attr('placeholder');
        	$(this).focus(function() {                 
        		if( ph != '' && ph == $(this).val() ) {
        			$(this).val('').removeClass('hasPlaceholder');
                }
	        })
	        .blur(function() {
	        	if( ph != '' && ($(this).val() == '' || $(this).val() == ph) ) {
	        		$(this).val( ph ).addClass('hasPlaceholder');
	            }
	        });
	        $(this).blur();
	        
	        $(active).focus();
	        $('form').submit(function () {
	                $(this).find('.hasPlaceholder').each(function() { $(this).val(''); });
	        });
        });
    }
});