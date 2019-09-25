<?php

/**
 * Developed by:
 *     Renée Maksoud
 * 
 * All rights reserved - 2015-2019
 */

/* File: src/View/Helper/MyHtmlHelper.php */

namespace App\View\Helper;

use Cake\View\Helper\HtmlHelper;
use Cake\I18n\Time;
use Cake\I18n\Date;

class MyHtmlHelper extends HtmlHelper 
{
    public function initialize(array $config) 
    {
        // initialize
    }
    
    public function fullDate($date)
    {
        if (!empty($date)) {
            
            if (!$date = strtotime($date)) {
				
                //Cake\I18n\FrozenTime
                $date = new Time($date->format('Y-m-d'));
				
            } else {
				
                //Cake\I18n\FrozenDate
                $date = new Time($date);
				
            }
			
            return $date->i18nFormat("dd '".__('de')."' MMMM '".__('de')."' yyyy");
			
            
        }//if (!empty($date))
        
    }
    
    public function date($date)
    {
        
        if (!empty($date)) {
            
            $string = $date;
			
            if (strpos($string, '/') && strlen($string) == 14) { 
                
                $dt = explode('/', substr($string, 0, 8));
                $date = $dt[1].'/'.$dt[0].'/'.$dt[2];

            }//if (strpos($string, '/') && strlen($string) == 14)
			
            if (!$date = strtotime($date)) {
				
                //Cake\I18n\FrozenTime
                $date = new Time($string->format('Y-m-d'));
				
            } else {
				
                //Cake\I18n\FrozenDate
                $date = new Time($date);
				
            }//else if (!$date = strtotime($date))
			
			if ($this->request->Session()->read('locale') == 'pt_BR') {
				
				if ($date->isToday()) {
					$string = __("Hoje ");
				} elseif ($date->isYesterday()) {
					$string = __("Ontem ");
				} else {
					$string = $date->i18nFormat("dd 'de' ");
					$string .= ucwords($date->i18nFormat("MMMM"));
					$string .= $date->i18nFormat(" 'de' yyyy");
				}
				
			} else {
				
				if ($date->isToday()) {
					$string = __("Today ");
				} elseif ($date->isYesterday()) {
					$string = __("Yesterday ");
				} else {
					$string = ucwords($date->i18nFormat("MMMM, "));
					$string .= $date->i18nFormat("dd ");
					$string .= $date->i18nFormat(" 'of' yyyy");
                }
                
			}//else if ($this->request->Session()->read('locale') == 'pt_BR')
			
            return $string;
            
        }//if (!empty($date))
        
    }

    public function imgThumb($src, $thumb = [],$tags = [])
    {
        if (!$src) {
            return false;
		}//if (!$src)
		
        $tags_array = [];
        $thumb_array = [];
        
        if ($tags) {
            foreach ($tags as $chave => $value) {
                $tags_array[] = $chave.'="'.$value.'"';
            }//foreach ($tags as $chave => $value)
        }//if ($tags)
        
        if ($thumb) {
            foreach ($thumb as $chave => $value) {
                $thumb_array[] = $chave.'='.$value;
            }//foreach ($thumb as $chave => $value)
        }//if ($thumb)
        
        if ($src) {
            $thumb_array[] = "src=".$src;
        }//if ($src)
        
        $tag_img = '<img src="f.php?'.implode("&", $thumb_array).'" '.implode(" ", $tags_array).'/>';  
        
        return $tag_img;
    }
    
    public function convertDateUTCArrayToJson($array_date_utc)
    {
        $json_date_utc = [];
		
        foreach ($array_date_utc as $date_utc => $valores) {
            $json_date_utc[] = "[".$date_utc.",".array_sum($valores)."]";
        }//foreach ($array_date_utc as $date_utc => $valores)
        
        return implode(",", $json_date_utc);  
    }
    
}