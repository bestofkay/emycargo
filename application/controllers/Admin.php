<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Admin extends MY_Controller
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
            $admin_users = $this->Admin_model->get();
            $group_user = $this->Admin_model->get_group();
                $this->data['data'] = $admin_users;
                $this->data['group'] = $group_user;
               // $this->data['form_type'] = 0;
                $this->render('backend/admin', $this->data);
    }

    public function create_admin()
    {
        $this->form_validation->set_rules('fname', 'first name', 'required');
        $this->form_validation->set_rules('lname', 'last name', 'required');
        $this->form_validation->set_rules('email', 'Email', 'required|valid_email|is_unique[users.email]');
        $this->form_validation->set_rules('approve', 'Admin group', 'required');
       
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('admin'));
       }
       else{
        $password_new=password_hash('password', PASSWORD_BCRYPT, ["cost" => 12]);
        $message=array(
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'email' => $this->input->post('email'),
            'password'=>$password_new,
            'role_id'=>$this->input->post('approve'),
        );
            $create = $this->Admin_model->insert($message);
            if($create){
             $this->session->set_flashdata('message', 'New admin user created successfully');
             redirect(site_url('admin'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to create admin, Try again');
                redirect(site_url('admin'));
            }  
    }
}


    public function edit_admin()
    {
        $this->form_validation->set_rules('fname', 'first name', 'required');
        $this->form_validation->set_rules('lname', 'last name', 'required');
       $this->form_validation->set_rules('approve', 'Admin group', 'required');
       
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('admin'));
       }
       else{
        $message=array(
            'first_name' => $this->input->post('fname'),
            'last_name' => $this->input->post('lname'),
            'role_id'=>$this->input->post('approve'),
        );
            $update = $this->Admin_model->update($message, $this->input->post('admin_id'));
            if($update){
             $this->session->set_flashdata('message', 'admin updated successfully');
             redirect(site_url('admin'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to update admin, Try again');
                redirect(site_url('admin'));
            }  
    }
}

public function delete()
{
    $id=$this->input->post('admin_id');
    $this->Admin_model->delete($id);
    $this->session->set_flashdata('message', 'admin deleted successfully');
    redirect(site_url('admin')); 
}

public function activate()
{
    $message=array(
        'active' => 1,
    );
    $update = $this->Admin_model->update($message, $this->input->post('admin_id'));
            if($update){
             $this->session->set_flashdata('message', 'admin activated successfully');
             redirect(site_url('admin'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to activate admin, Try again');
                redirect(site_url('admin'));
            } 
        
}


public function deactivate()
{
    $message=array(
        'active' => 0,
    );
    $update = $this->Admin_model->update($message, $this->input->post('admin_id'));
            if($update){
             $this->session->set_flashdata('message', 'admin deactivated successfully');
             redirect(site_url('admin'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to deactivate admin, Try again');
                redirect(site_url('admin'));
            } 
        
}

}
    
