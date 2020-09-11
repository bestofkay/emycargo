<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/**
 * CodeIgniter Form Helpers
 *
 * @package		CodeIgniter
 * @subpackage	Helpers
 * @category	Helpers
 * @author		EllisLab Dev Team
 * @link		http://codeigniter.com/user_guide/helpers/form_helper.html
 */

// ------------------------------------------------------------------------

if ( ! function_exists('allowed_post_params'))
{
	
	function allowed_post_params($params = array(),$postData)
	{
		$allowed_params = array();
		foreach($params as $param){
			if(isset($postData[$param])){
				
				$allowed_params[$param] = $postData[$param];
			}else{
				
				$allowed_params[$param] = NULL;
			}
			
		}
		return $allowed_params;
	}
}