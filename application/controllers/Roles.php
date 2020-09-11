<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Roles extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation','session'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('Admin_model');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('home/login', 'refresh');
		}
    }

    public function index()
    {
            $group_user = $this->Admin_model->get_group();
                $this->data['group'] = $group_user;
               // $this->data['form_type'] = 0;
                $this->render('backend/roles', $this->data);
    }

    public function create_roles()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
       
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('roles'));
       }
       else{
        $message=array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );
            $create = $this->Admin_model->insert_group($message);
            if($create){
             $this->session->set_flashdata('message', 'New user role added successfully');
             redirect(site_url('roles'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to add user role. Try again');
                redirect(site_url('admin'));
            }  
    }
}


    public function edit_role()
    {
        $this->form_validation->set_rules('name', 'name', 'required');
       
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('roles'));
       }
       else{
        $message=array(
            'name' => $this->input->post('name'),
            'description' => $this->input->post('description'),
        );
            $update = $this->Admin_model->update_group($message, $this->input->post('role_id'));
            if($update){
             $this->session->set_flashdata('message', 'roles updated successfully');
             redirect(site_url('roles'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to update roles, Try again');
                redirect(site_url('roles'));
            }  
    }
}

public function delete()
{
    $id=$this->post('role_id');
    $this->Admin_model->delete_roup($id);
    $this->session->set_flashdata('message', 'role deleted successfully');
    redirect(site_url('roles')); 
}


}