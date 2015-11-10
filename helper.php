<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_inscritos
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

/**
 * Helper for mod_inscritos
 *
 * @package     Joomla.Site
 * @subpackage  mod_inscritos
 * @since       1.5
 */
class ModInscritosHelper
{
	private static $facebook = 'https://graph.facebook.com/#user_id#?fields=name,picture';
	
	public static function getInscritos($file){
		$csv = explode("\n",self::getContents($file));
		if( isset($csv) && is_array($csv) ){
			// Retira cabeçalho do arquivo
			$cabecalho = array_filter(str_getcsv(array_shift($csv), ';'));
			$pattern = '@((http[s]?)://(www.)?facebook.com/)@';
			$csv = array_filter($csv);
			foreach( $csv as $row ){
				$row = array_filter(str_getcsv($row, ';'));
				for($x=0; $x<count($row); $x++){
					if( $cabecalho[$x] == 'Facebook'){
						$idFacebook = preg_replace($pattern, '', $row[$x]);
						$link = str_replace('#user_id#', $idFacebook, self::$facebook);
						$dado[$cabecalho[$x]] = @json_decode(self::getContents( $link ));
					}else{
						$dado[$cabecalho[$x]] = $row[$x];
					}
				}
				$dados[$dado["Status"]][] = $dado;
			}
		}
		return $dados;
	}
	
	public function getContents( $link ){
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $link);
		curl_setopt($ch, CURLOPT_HEADER, 0);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
		$content = curl_exec($ch);
		curl_close($ch);
		
		return $content;
	} 
}
