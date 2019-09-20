/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

//EVITA MULTIPLOS CADASTROS AO SER PRESSIONADO DIVERSAS VEZES O BOTÃO GRAVAR
function MultiClick() {
    try {

        var    submit = $('button[onclick="MultiClick()"]');
        const oldtext = submit[0].innerText;

        setTimeout(function(){

            //Muda o texto do botão
            if (oldtext == "Gravar") { submit.html("Gravando..."); }
            if (oldtext == "Save") { submit.html("Saving..."); }
            if (oldtext == "Gerar Relatório") { submit.html("Gerando...") }
            if (oldtext == "Report") { submit.html("Baking...") }

            //Muda de submit para button para evitar 
            submit.attr('type', 'button');

        }, 50);

        setTimeout(function(){ 

            //Retorna o parâmetro de submit
            submit.attr('type', 'submit');

            //Retorna o texto anterior
            submit.html(oldtext);

        }, 4000);

    } catch (e) {
        console.log(e);
    }
};

//** end code **//