/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

;
(function($){
    $(document).ready(function($){

        //CONTROLA O RELÓGIO DO SISTEMA
        function addZero(i) {

            if (i < 10) {
                i = "0" + i;
            }//if (i < 10)
            return i;

        }

        /*********/

        setInterval(function () {

            var date = new Date();
            var time = document.getElementById("timer");

            if (time) { 
                time.innerHTML = addZero(date.getHours())+":"+addZero(date.getMinutes())+":"+addZero(date.getSeconds());
            }//if (time)
            
        }, 1000);

        /**********************************************************************/

        //AJUSTA VISUAL DA TABELA INDEX (LISTAGENS) PARA CONDENSADO QUANDO A TELA POSSUIR TAMANHO PEQUENO
        function sizeOfThings() {

            var windowWidth  = window.innerWidth,
                windowHeight = window.innerHeight,
                screenWidth  = screen.width,
                screenHeight = screen.height,
                windowSize   = document.querySelector('.window-size'),
                screenSize   = document.querySelector('.screen-size');

            if (windowWidth < 1305) {
                $("#adjustable").addClass("table-condensed");
            } else {
                $("#adjustable").removeClass("table-condensed");
            }//else if (windowWidth < 1305)

            if (windowSize) { windowSize.innerHTML = windowWidth + 'x' + windowHeight; }
            if (screenSize) { screenSize.innerHTML = screenWidth + 'x' + screenHeight; }

        };

        /*********/

        sizeOfThings();

        /*********/

        window.addEventListener('resize', function () {
            sizeOfThings();
        });

        /**********************************************************************/

        //controle abrir modal
        $(document).on('click', '.btn_modal', function(e){
            var this_js = $(this),
                btn     = this_js.button('loading'),
                url     = this_js.attr('href'),
                titulo  = this_js.attr('data-title'),
                size    = this_js.attr('data-size');

            if (size == 'sm') {
                $('#modal_item .modal-lg').removeClass('modal-lg').addClass('modal-sm');
            } else {
                $('#modal_item .modal-sm').removeClass('modal-sm').addClass('modal-lg');
            }
            
            $('#modal_item_body').html(''); //limpar modal
            $('#modal_item_title').html(''); //limpar titulo do modal
            $('#modal_item_title').append(titulo); //colocar o novo titulo do modal

            $.get(url,
                    { titulo: titulo },
                    function(data){
                        $('.modal-body').append(data); //colocar no modal o formulario de edicao
                    }
                 )

            .done(function() {
                btn.button('reset'); //voltar estado do btn
                $('#modal_item').modal('toggle'); //abrir modal com o formulario
            })

            .fail(function() {
                confirm('Desculpe, ocorreu um erro. Por favor atualize a pagina e tente novamente.');
                location.reload();
            });

            e.preventDefault();
        });

        /*********/

        //controle abrir modal2
        $(document).on('click', '.btn_modal2', function(e){
            var this_js = $(this),
                btn     = this_js.button('loading'),
                url     = this_js.attr('href'),
                titulo  = this_js.attr('data-title'),
                size    = this_js.attr('data-size');

            if( size == 'sm' )
                $('#modal_item2 .modal-lg').removeClass('modal-lg').addClass('modal-sm');
            else
                $('#modal_item2 .modal-sm').removeClass('modal-sm').addClass('modal-lg');

            $('#modal_item_body2').html(''); //limpar modal
            $('#modal_item_title2').html(''); //limpar titulo do modal
            $('#modal_item_title2').append(titulo); //colocar o novo titulo do modal

            $.get(url,
                    { titulo: titulo },
                    function(data){
                        $('#modal_item_body2').append(data); //colocar no modal o formulario de edicao
                    }
                 )

            .done(function() {
                btn.button('reset'); //voltar estado do btn
                $('#modal_item2').modal('toggle'); //abrir modal com o formulario
            })

            .fail(function() {
                confirm('Desculpe, ocorreu um erro. Por favor atualize a pagina e tente novamente.');
                location.reload();
            });

            e.preventDefault();
        });
        
        /*********/
        
        //correção no scroll quando fecha o 2 modal
        $('#modal_item2').on('hidden.bs.modal', function (e) {
            $('body').addClass('modal-open');
        });
        
        /*********/
        
        //colocar o ponteiro no primeiro campo
        $('#modal_item').on('shown.bs.modal', function () {
            $('.focus').focus();
        });

        /**********************************************************************/

        // esconder|mostrar botao de resetar a busca
        var query     = location.search.slice(1),
            partes    = query.split('&'),
            dados_get = [];

        partes.forEach(function (parte) {

            var chaveValor = parte.split('='),
                     chave = chaveValor[0],
                     valor = chaveValor[1];

            dados_get[chave] = valor;

        });

        if (dados_get['iniciar_busca']) $('#btn-resetar-form').toggle('slow');

        /**********************************************************************/
        
        //funcao para envio de form via ajax (post)
        $(document).on('submit', '.ajax', function(e){
            
            var url   = context + $(this).attr('data-url'); //url para envio do form
            
            $.ajax({
                url: url,
                type: 'post',
                dataType: "JSON",
                data: new FormData(this),
                processData: false,
                contentType: false,
                success: function (data, status){
                    var btn_close_alert = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>';
                    
                    //caso já tenha dado algum erro, remover as class de erro
                    $('.has-error').removeClass('has-error');
                    
                    if (data['status'] == 'error') {

                        var retorno  = '<div class="alert alert-danger" role="alert">' + btn_close_alert + data['mensagem'] + '</div>';
                        
                        $('#ajax-retorno').html(''); //limpar a div que aparece os retornos
                        $('#ajax-retorno').append(retorno); //informar msg principal de erro
                        
                        console.log('/*******************/');
                        console.log(data['mensagem']);
                        
                        //ir buscar as msgs secundarias com os erros ocorridos
                        for( var key in data['errors'] ){
                            
                            $('[name=' + key + ']').focus().parent().addClass('has-error');
                            
                            for( var key2 in data['errors'][key] ){
                                $('[name=' + key + ']').parent().append('<span class="help-block"><small>' + data['errors'][key][key2] + '</small></span> ');
                                
                                console.log(data['errors'][key][key2]);
                            }
                        }
                        
                        console.log('/*******************/');
                        
                    } else {

                        var retorno = '<div class="alert alert-success" role="alert">' + btn_close_alert + data['mensagem'] + '</div>';
                        
                        window.location.href = window.location.href.replace( /[\?#].*|$/, "?action=ok" );

                    }//else if (data['status'] == 'error')

                },
                error: function (xhr, desc, err){
                    var btn_close_alert = '<button type="button" class="close" data-dismiss="alert" aria-label="Close">&times;</button>',
                        retorno  = '<div class="alert alert-danger" role="alert">' + btn_close_alert + xhr['responseText'] + '</div>';
                    
                    $('#ajax-retorno').html(''); //limpar a div que aparece os retornos
                    $('#ajax-retorno').append(retorno); //informar msg principal de erro
                    
                    console.log('/*******************/');
                    console.log(xhr);
                    console.log(desc);
                    console.log(err);
                    console.log('/*******************/');
                }
            });
            
            e.preventDefault();
        });
        
        /**********************************************************************/

        //PAGINAÇÃO
        $('#adjustable').DataTable({
            'order': [[ 0, 'desc' ]],
            'searching': false,
            'language': {
                'lengthMenu': 'Mostrando _MENU_ registros por página',
                'zeroRecords': 'Nada encontrado',
                'info': 'Mostrando página _PAGE_ de _PAGES_',
                'infoEmpty': 'Nenhum registro disponível',
                'infoFiltered': '(Filtrado de _MAX_ registros no total)',
                //'sSearch': 'Buscar',
                'oPaginate': {
                    'sNext': 'Próximo',
                    'sPrevious': 'Anterior'
                }
            }, 'lengthMenu': [10, 20, 30]
        });
        
        /**********************************************************************/
        
        //controlar start ajax
        $(document).ajaxStart(function() {
            $('.bg_ajax').removeClass('hide');
        });
        
        //controlar end ajax
        $(document).ajaxComplete(function() {
            $('.bg_ajax').addClass('hide');
			$('[data-toggle="tooltip"]').tooltip(); //ativar tooltip no modal
        });
        
        $('.bg_ajax').fadeOut('fast');
        
        //ativar tooltip
        $('[data-toggle="tooltip"]').tooltip();

        //** end code **//
    });
})(jQuery);