<?php

/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/View/Helper/UsersParametersHelper.php */

namespace App\View\Helper;
use Cake\View\Helper\HtmlHelper;

class UsersParametersHelper extends HtmlHelper 
{
    public function initialize(array $config) {
        //
    }
    
    public function rules($rules) {
        $string = "";
        
        switch($rules){
            case '1':
                $string = __('Super-Administrador');
                break;
            case '2':
                $string = __('Administrador');
                break;
            case '3':
                $string = __('Usuário');
                break;
            case '4':
                $string = __('Limitado');
                break;
            case '5':
                $string = __('Visitante');
                break;
            case '6':
                $string = __('Contador');
                break;
            case '7':
                $string = __('Especial');
                break;
            default:
                $string = '-';
        }
        
        return $string;
    }
    
}

?>