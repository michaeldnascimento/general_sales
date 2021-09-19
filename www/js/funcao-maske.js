jQuery(function($){
		$("#codigo").mask("999/99999999-9");
		$("#campoData").mask("99/99/9999");
		$("#campoTelefoneteste").mask("(99) 9999-9999");
		$("#campoTelefoneteste").mask("(99) 9999-9999");
		$("#campoCelularteste").mask("(99) 99999-9999");
		$("#campoSenha").mask("***-****");
		$("#campoCEP").mask("99999-999");
        $("#campoTelefone").mask("(99) 9999-9999?9").on("focusout", function () {
        var len = this.value.replace(/\D/g, '').length;
        $(this).mask(len > 10 ? "(99) 99999-999?9" : "(99) 9999-9999?9");
        });
        $("#campoTelefone2").mask("(99) 9999-9999?9").on("focusout", function () {
        var len = this.value.replace(/\D/g, '').length;
        $(this).mask(len > 10 ? "(99) 99999-999?9" : "(99) 9999-9999?9");
        });
        $("#campoTelefone3").mask("(99) 9999-9999?9").on("focusout", function () {
        var len = this.value.replace(/\D/g, '').length;
        $(this).mask(len > 10 ? "(99) 99999-999?9" : "(99) 9999-9999?9");
        });
        $("#campoCelular").mask("(99) 9999-9999?9").on("focusout", function () {
        var len = this.value.replace(/\D/g, '').length;
        $(this).mask(len > 10 ? "(99) 99999-999?9" : "(99) 9999-9999?9");
        });


		$("#cpfCnpj").unmask();
		$("#cpfCnpj").focusout(function() {
		$("#cpfCnpj").unmask();
		var tamanho = $("#cpfCnpj").val().replace(/\D/g, '').length;
		if (tamanho == 11) {
		$("#cpfCnpj").mask("999.999.999-99");
		} else if (tamanho == 14) {
		$("#cpfCnpj").mask("99.999.999/9999-99");
		}
		});
		$("#cpfCnpj").focusin(function() {
		$("#cpfCnpj").unmask();
		});



		$("#rgEi").unmask();
		$("#rgEi").focusout(function() {
		$("#rgEi").unmask();
		var tamanho = $("#rgEi").val().replace(/\D/g, '').length;
		if (tamanho == 9) {
		$("#rgEi").mask("99.999.999-9");
		} else if (tamanho == 12) {
		$("#rgEi").mask("999.999.999.999");
		}
		});
		$("#rgEi").focusin(function() {
		$("#rgEi").unmask();
		});

});

