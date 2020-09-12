<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Settings extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation','session'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('Settings_model');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('home/login', 'refresh');
		}
    }

    public function index()
    {
         redirect(site_url('settings/company'));
    }

    public function terminal_charges()
    {
        $company = $this->Settings_model->get_parameters();
        $this->data['data'] = $company;
        $this->render('backend/terminal_charges', $this->data);
    }

    public function company()
    {
        $company = $this->Settings_model->get_company(1);
        $this->data['data'] = $company;
        $this->render('backend/company', $this->data);
    }


    public function edit_company()
    {
       $this->form_validation->set_rules('company_name', 'Company name', 'required');
       $this->form_validation->set_rules('address', 'Company address', 'required');
       $this->form_validation->set_rules('rc_no', 'CAC No', 'required');
       $this->form_validation->set_rules('email', 'Company email', 'required');
       $this->form_validation->set_rules('phones', 'Company Phones', 'required');
       $this->form_validation->set_rules('bank', 'Company bank', 'required');
       $this->form_validation->set_rules('account_name', 'Account name', 'required');
       $this->form_validation->set_rules('account_no', 'Account number', 'required');
       
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('settings/company'));
       }
       else{
        $message=array(
            'company_name' => $this->input->post('company_name'),
            'company_phones' => $this->input->post('phones'),
            'company_email' => $this->input->post('email'),
            'company_address' => $this->input->post('address'),
            'cac_no' => $this->input->post('rc_no'),
            'bank_name'=>$this->input->post('bank'),
            'account_number'=>$this->input->post('account_no'),
            'account_name'=>$this->input->post('account_name'),
        );
            $update = $this->Settings_model->update_company($message, $this->input->post('id'));
            if($update){
             $this->session->set_flashdata('message', 'Company settings updated successfully');
             redirect(site_url('settings/company'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to update company settings, Try again');
                redirect(site_url('settings/company'));
            }  
    }
}


public function edit_charges()
    {
      $array=array();
      $id=$this->input->post('id');
      $charges=$this->input->post('charges');
      $count=count($this->input->post('id'));
      for($x=0; $x < $count; $x++){
        $array[]=array(
            'id'=>$id[$x],
            'charges'=>$charges[$x]
        );
      }
            $update = $this->Settings_model->update_parameters($array);
            if($update){
             $this->session->set_flashdata('message', 'Company terminal charges updated successfully');
             redirect(site_url('settings/terminal_charges'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to update company terminal charges, Try again');
                redirect(site_url('settings/terminal_charges'));
            }  
    }

}
    
