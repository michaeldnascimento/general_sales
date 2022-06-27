//Esconder divs especificas do select
$(document).ready(function() {

    $('#select').on('change', function(){

        var selectValor = '#'+$(this).val();

        $('#mestre').children('div').hide();
        $('#mestre').children(selectValor).show();
    

    });
    
});


/*
//imagem do tratar cliente, imagem vem escondida, e tem que clicar para imagem aparecer e passar o mouse para sumir a mesma.
$(document).ready(function(){

    $('#print-box').animate({opacity:0.0})
    $('#print-box').mousedown(function(){
    $(this).animate({opacity:1})
    })

    $('#print-box').mouseover(function(){
    $(this).animate({opacity:0.0})
    });

});
*/

function ativa(){ 
var div = document.getElementById('div') 
/* se conteúdo está escondido, mostra e troca o valor do botão para: esconde */ 
if (div.style.display == 'none') { 
document.getElementById("botao").value='esconde' 
div.style.display = 'block' 
} else { 
/* se conteúdo está a mostra, esconde o conteúdo e troca o valor do botão para: mostra */ 
div.style.display = 'none' 
document.getElementById("botao").value='mostra' 
} 
} 

function ativa2(){ 
var div = document.getElementById('div2') 
/* se conteúdo está escondido, mostra e troca o valor do botão para: esconde */ 
if (div.style.display == 'none') { 
document.getElementById("botao2").value='esconde' 
div.style.display = 'block' 
} else { 
/* se conteúdo está a mostra, esconde o conteúdo e troca o valor do botão para: mostra */ 
div.style.display = 'none' 
document.getElementById("botao2").value='mostra' 
} 
} 

        
function marcarTodos(marcar){
        var itens = document.getElementsByName('excluir[]');

        if(marcar){
            document.getElementById('acao').innerHTML = 'Desmarcar Todos';
        }else{
            document.getElementById('acao').innerHTML = 'Marcar Todos';
        }

        var i = 0;
        for(i=0; i<itens.length;i++){
            itens[i].checked = marcar;
      }

  }


// nice form step wizard - TELA DE CADASTRO CLIENTE
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='email']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});


$(document).ready(function(){
        // pra buscar a value do button tem que usar .variavel pra buscar o id tem que se usar #iddooponete
        $('.excluir').click(function(){
          var idContato = $(this).attr('id-do-contato');

          $('#id_contato').val(idContato);
        });

});

//GET SELECT OPERADORA MODAL
function selectOP(){
        let select = document.getElementById('name_operadora');
        let name_operadora = select.options[select.selectedIndex].value;

        if (name_operadora !== '') {
            document.location.href = "nova_venda.php?operadora=" + name_operadora;
        }
}

//GET SELECT OPERADORA MODAL
function selectOPSupervisor(){
    let select = document.getElementById('name_operadora_super');
    let name_operadora = select.options[select.selectedIndex].value;

    if (name_operadora !== '') {
        document.location.href = "criacao-produto.php?operadora=" + name_operadora;
    }
}

/*
//JQuery de atualizacao de formulario, sem atualizar a pagina
 $(document).ready(function(){
      $("#meuForm").ajaxForm({

        });

});
*/

/*
//imagem do tratar cliente, para esconder a imagem, e quando passar o mouse ela aparecer
$(document).ready(function(){

    $('#client-info').animate({opacity:0.0})
    $('#client-info').mouseover(function(){
    $(this).animate({opacity:1})
    })

    $('#client-info').mouseout(function(){
    $(this).animate({opacity:0.0})
    });


    $('#client-contact').animate({opacity:0.0})
    $('#client-contact').mouseover(function(){
    $(this).animate({opacity:1})
    })

    $('#client-contact').mouseout(function(){
    $(this).animate({opacity:0.0})
    });




});

*/

