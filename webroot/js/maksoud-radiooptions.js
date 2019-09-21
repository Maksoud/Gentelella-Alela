/**
 * Desenvolvido por:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

;
(function($) {
    $(document).ready(function($) {

        //controle de mostrar/ocultar fornecedor e cliente na tela de Moviments
        $('input[name="radio_bc"]').on('change', function() {
            if ($(this).val() == 'banco') {
                $('.banco').addClass('show').removeClass('hidden');
                $('.caixa').addClass('hidden').removeClass('show');
                
                $('.show:not(.report)').children('select').attr('required', 'true');
                $('.hidden:not(.report)').children('select').removeAttr('required');

                $('#boxes_title').val("");
                $('#boxes_id').val("");
            } else {
                $('.caixa').addClass('show').removeClass('hidden');
                $('.banco').addClass('hidden').removeClass('show');
                
                $('.show:not(.report)').children('select').attr('required', 'true');
                $('.hidden:not(.report)').children('select').removeAttr('required');

                $('#banks_title').val("");
                $('#banks_id').val("");
            }
        });
   
        //** end code **//
    });
})(jQuery);