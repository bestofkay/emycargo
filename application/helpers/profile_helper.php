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
if( ! function_exists('get_timeago')){
	function get_timeago( $ptime )
{
    $estimate_time = time() - $ptime;

    if( $estimate_time < 1 )
    {
        return 'less than 1 second ago';
    }

    $condition = array( 
                12 * 30 * 24 * 60 * 60  =>  'year',
                30 * 24 * 60 * 60       =>  'month',
                24 * 60 * 60            =>  'day',
                60 * 60                 =>  'hour',
                60                      =>  'minute',
                1                       =>  'second'
    );

    foreach( $condition as $secs => $str )
    {
        $d = $estimate_time / $secs;

        if( $d >= 1 )
        {
            $r = round( $d );
            return 'about ' . $r . ' ' . $str . ( $r > 1 ? 's' : '' ) . ' ago';
        }
    }
}	
}
if( ! function_exists('return_money')){
	function return_money($number)
    {
		setlocale(LC_MONETARY, '');
		return money_format('%i', $number);
	}
}
if( ! function_exists('formatMoney')){
	function formatMoney($number, $fractional=false) { 
		if ($fractional) { 
			$number = sprintf('%.2f', $number); 
		} 
		while (true) { 
			$replaced = preg_replace('/(-?\d+)(\d\d\d)/', '$1,$2', $number); 
			if ($replaced != $number) { 
				$number = $replaced; 
			} else { 
				break; 
			} 
		} 
		return $number; 
	} 
}
if( ! function_exists('getAttributeTypeName')){
	function getAttributeTypeName($AttributeForm) { 
		$Value = "";
		switch($AttributeForm){
			case "1":
				$Value="Number";
			break;
			case "2":
				$Value="Text";
			break;
			case "3":
				$Value="List";
			break;
			case "4":
				$Value = "Date";
			break;
			case "5":
			break;
			case "6":
			break;
			case "7":
			break;
		}
		return $Value;
	} 
}
// ------------------------------------------------------------------------
if( ! function_exists('system_link_text')){
	function system_link_text($PACKAGE_ID, $STAFF_ID)
    {
		$url = "";
		switch($PACKAGE_ID){
			case "5":
				return array("label"=>"Apply for leave","link"=>base_url().'absense/new_request/'.$STAFF_ID.'/0/0/'.$PACKAGE_ID.'/0');
			break;
		}
	}
}
// ------------------------------------------------------------------------
if( ! function_exists('staff_relation')){
	function staff_relation($STAFF_ID,$USER_ID)
    {
		
	}
}




if( ! function_exists('system_link')){
	function system_link($PACKAGE, $STAFF_ID, $COMPANY_ID)
    {
		
		$url = "";
		$CI =& get_instance();
		$CI->load->model('package_model');
		$labels = array("2"=>"Family","3"=>"Work Experience","4"=>"Education");
        switch($PACKAGE["PACKAGE_ID"]){
			case 1:
				if($CI->package_model->is_module_subscribed($PACKAGE,$COMPANY_ID)){
					$url = '<a href="'.base_url().'employee/details/'.$STAFF_ID.'" class="subscribed">Biodata</a>';
				}else{
					$url = '<a href="'.base_url().'employee/details/'.$STAFF_ID.'" class="unsubscribed">Biodata</a>';
				}
			break;
			case 2:
			case 3:
			case 4:
				if($CI->package_model->is_module_subscribed($PACKAGE,$COMPANY_ID)){
					$url = '<a data-url="'.base_url().'account/request/startRequestForFamily/'.$STAFF_ID.'/'.$PACKAGE["PACKAGE_ID"].'/-1/0/0/0/0/0" href="javascript:;" class="subscribed myRequester">'.$labels[$PACKAGE["PACKAGE_ID"]].'</a>';
				}else{
					$url = '<a href="javascript:;" class="unsubscribed myRequester">'.$labels[$PACKAGE["PACKAGE_ID"]].'</a>';
				}
			break;
			case 5:
				if($CI->package_model->is_module_subscribed($PACKAGE,$COMPANY_ID)){
					$url = '<a href="javascript:;" data-url="'.base_url().'absense/new_request/'.$STAFF_ID.'/0/0/'.$PACKAGE["PACKAGE_ID"].'/0" class="subscribed myRequester">Leave</a>';
				}else{
					$url = '<a href="javascript:;" class="unsubscribed">Leave</a>';
				}
			break;
			case "6":
			
				if($CI->package_model->is_module_subscribed($PACKAGE,$COMPANY_ID)){
					$url = '<a href="javascript:;" data-url="'.base_url().'absense/schedule/'.$STAFF_ID.'/'.$PACKAGE["PACKAGE_ID"].'" class="subscribed myRequester">Leave Schedule</a>';
				}else{
					$url = '<a href="javascript:;" class="unsubscribed">Leave Schedule</a>';
				}
			break;
			case 8:
			http://localhost/hra_eloquent/expense/startRequestForExpense/8/1/0/0
				if($CI->package_model->is_module_subscribed($PACKAGE,$COMPANY_ID)){
					$url = '<a href="javascript:;" data-url="'.base_url().'expense/startRequestForExpense/'.$PACKAGE["PACKAGE_ID"].'/'.$STAFF_ID.'/0/0" class="subscribed myRequester">Expense</a>';
				}else{
					$url = '<a href="javascript:;" class="unsubscribed">Expense</a>';
				}
			break;
			case 9:
				if($CI->package_model->is_module_subscribed($PACKAGE,$COMPANY_ID)){
					$url = '<a href="javascript:;" data-url="'.base_url().'account/request/exit_request/'.$STAFF_ID.'/'.$PACKAGE["PACKAGE_ID"].'/0/0/0" class="subscribed myRequester">Exit</a>';
				}else{
					$url = '<a href="javascript:;" class="unsubscribed">Exit</a>';
				}
			break;
		}
		return $url;
    }	
	
}
if( ! function_exists('dynamic_link')){
	function dynamic_link($PACKAGE, $STAFF_ID, $COMPANY_ID)
    {
		return '<a data-url="'.base_url().'workflow/initiate/'.$STAFF_ID.'/'.$PACKAGE["PACKAGE_ID"].'/'.$PACKAGE["PACKAGE_ID"].'/0/0/0" href="javascript:;" class="subscribed myRequester">'.$PACKAGE["PACKAGE_NAME"].'</a>';
    }	
	
}

if( ! function_exists('rec_in_array')){
	function rec_in_array($needle, $haystack, $alsokeys=false)
    {
        if(!is_array($haystack)) return false;
        if(in_array($needle, $haystack) || ($alsokeys && in_array($needle, array_keys($haystack)) )) return true;
        else {
            foreach($haystack AS $element) {
                $ret = rec_in_array($needle, $element, $alsokeys);
            }
        }
        
        return $ret;
    }	
	
}

if( ! function_exists('in_multiarray')){
	function in_multiarray($elem, $array)
    {
        $top = sizeof($array) - 1;
        $bottom = 0;
        while($bottom <= $top)
        {
            if($array[$bottom] == $elem)
                return true;
            else 
                if(is_array($array[$bottom]))
                    if(in_multiarray($elem, ($array[$bottom])))
                        return true;
                    
            $bottom++;
        }        
        return false;
    }	
	
}
if( ! function_exists('DifferenceInDays')){
	function DifferenceInDays($date1,$date2,$type){
		
		$diff = abs(strtotime($date1) - strtotime($date2));
		switch($type){
			
			case "1":
				return floor($diff/(60*60*24));
			break;	
		}
	}	
}
if( ! function_exists('DifferenceBetweenDays')){
	function DifferenceBetweenDays($date1,$date2,$type){
		
		$diff = abs(strtotime($date1) - strtotime($date2));
		switch($type){
			
			case "1":
				$datetime1 = new DateTime($date1);
				$datetime2 = new DateTime($date2);
				$days_until_appt = $datetime2->diff($datetime1)->y;
				return $days_until_appt;
			break;	
			case "2":
				$datetime1 = new DateTime($date1);
				$datetime2 = new DateTime($date2);
				$days_until_appt = $datetime2->diff($datetime1)->d;
				return $days_until_appt;
			break;	
			case "3":
				$datetime1 = new DateTime($date1);
				$datetime2 = new DateTime($date2);
				$days_until_appt = $datetime2->diff($datetime1)->h;
				return $days_until_appt;
			break;
		}
	}	
}
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

if ( ! function_exists('return_key_assoc'))
{
	
	function return_key_assoc($ATTRIBUTES_IN_SIBLING_GROUP,$key)
	{
		$key_temp = array();
		foreach($ATTRIBUTES_IN_SIBLING_GROUP as $AISG){
			array_push($key_temp,$AISG[$key]);
		}
		return $key_temp;
		//implode(',',return_key_assoc($ATTRIBUTES_IN_SIBLING_GROUP,"ATTRIBUTE_ID"))
	}
}
if ( ! function_exists('create_form'))
{
	
	function create_form($form_type,$list_values,$attribute_name,$attribute_id,$string_value,$attribute_id_that_was_clicked,$is_complex,$li_value_id,$parent_attribute_id,$update_another_attribute="",$other_attribute_to_update="")
	{
		
		$CI =& get_instance();

		switch($form_type){
			case "1":

			break;
			case "2":
				$data = array("attribute_name"=>$attribute_name,"attribute_id"=>$attribute_id,"string_value"=>$string_value,"attribute_id_that_was_clicked"=>$attribute_id_that_was_clicked,"attribute_li_values"=>$list_values);
				if($is_complex){
					return $CI->load->view('partials/biodata_edit_tags_partial',$data,TRUE);
				}else{
					return $CI->load->view('partials/biodata_edit_string_partial',$data,TRUE);
				}
				
			break;
			case "4":
				$data = array("attribute_name"=>$attribute_name,"attribute_id"=>$attribute_id,"string_value"=>$string_value,"attribute_id_that_was_clicked"=>$attribute_id_that_was_clicked,"attribute_li_values"=>$list_values);
				return $CI->load->view('partials/biodata_edit_date_partial',$data,TRUE);
				
			break;
			case "3":
				$data = array("attribute_name"=>$attribute_name,"attribute_id"=>$attribute_id,"attribute_li_values"=>$list_values,"attribute_id_that_was_clicked"=>$attribute_id_that_was_clicked,"li_value_id"=>$li_value_id,"string_value"=>$li_value_id,"parent_attribute_id"=>$parent_attribute_id,"update_another_attribute"=>$update_another_attribute,"other_attribute_to_update"=>$other_attribute_to_update);
				return $CI->load->view('partials/biodata_edit_list_partial',$data,TRUE);
			break;
		}
		
	}
}
if ( ! function_exists('loadApprovalView'))
{
	
	function loadApprovalView($FIRST_APPROVER,$APPROVAL_UNITS,$APPROVAL_ROUTE,$TYPE="",$REQUEST_ID="")
	{
		$CI =& get_instance();
		$CI->load->model('requests_model');
		$data["WORKFLOW_UNIT_EXECUTIONS"] = $CI->requests_model->getRequestWorkflowUnitExecutions($REQUEST_ID);
		$data["APPROVAL_ROUTE"] = $APPROVAL_ROUTE;
		$data["TYPE"] = $TYPE;
		$data["REQUEST_ID"] = $REQUEST_ID;
		$data["APPROVAL_UNITS"] = $APPROVAL_UNITS;
		$data["FIRST_APPROVER"] = $FIRST_APPROVER;
		return $CI->load->view('partials/approval_partial',$data,TRUE);
		
	}
}
if ( ! function_exists('checkUserStatus'))
{
	
	function checkUserStatus($STAFF_ID)
	{
		$CI =& get_instance();
		$CI->load->model('employee_model');
		$STATUS = $CI->employee_model->checkStaffStatus($STAFF_ID);
		return $STATUS;
		
	}
}
if ( ! function_exists('loadAttachmentPartial'))
{
	
	function loadAttachmentPartial($TYPE,$REQUEST_ATTACHMENTS)
	{
		$data["REQUEST_ATTACHMENTS"] = $REQUEST_ATTACHMENTS;
		$CI =& get_instance();
		return $CI->load->view('partials/attachments_partial',$data,TRUE);
	}
}
if ( ! function_exists('loadTravellersPartial'))
{
	
	function loadTravellersPartial($TRAVELLERS,$TYPE)
	{
		$data["TRAVELLERS"] = $data;
		$CI =& get_instance();
		return $CI->load->view('partials/travellers_partial',$data,TRUE);
	}
}
if ( ! function_exists('loadNotePartial'))
{
	
	function loadNotePartial($TYPE,$NOTES)
	{
		$data["REQUEST_NOTES"] = $NOTES;
		$CI =& get_instance();
		return $CI->load->view('partials/notes_partial',$data,TRUE);
		
	}
}
if ( ! function_exists('loadTheApprovalFilter'))
{
	
	function loadTheApprovalFilter($APPROVALS)
	{
		$CI =& get_instance();
		$data["APPROVALS"] = $APPROVALS;
		return $CI->load->view('partials/approval_filter',$data,TRUE);
		
	}
}
