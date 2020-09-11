<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Clients extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation','session'));
        $this->load->helper(array('url', 'language'));
        $this->load->model('Clients_model');
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('home/login', 'refresh');
		}
    }
    
    public function index()
	{
        $this->data['all_type'] = $this->category_model->as_object()->get_all();
        $this->data['form_type'] = 0;
        $this->render('backend/category', $this->data);
    }

    public function new_client()
	{
        $this->render('backend/add_client'); 
    }

    public function create_action()
	{
        $message=array();
        $this->form_validation->set_rules('client_name', 'Client name', 'required|is_unique[users.fullname]');
        $this->form_validation->set_rules('email', 'Client email address', 'required|is_unique[users.email]');
        $this->form_validation->set_rules('phone_no', 'Client primary phone', 'required|is_unique[users.phone]');
        $this->form_validation->set_rules('address', 'Client address', 'required');
 
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('clients/new_client'));
       }
       else{
        $unique_id=md5(microtime(true).mt_Rand());
        $password =  $this->input->post('password'); 
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);
        $message=array(
            'fullname' => $this->input->post('client_name'),
            'address' => $this->input->post('address'),
            'email' => $this->input->post('email'),
            'phone'=> $this->input->post('phone_no'),
            'other_phones'=> $this->input->post('o_phone_no'),
            'uniqueID'=> $unique_id,
            'password'=>$hashed_password,
        );
            $create = $this->Clients_model->insert($message);
            if($create){
             $this->session->set_flashdata('message', 'New Client added successfully');
             redirect(site_url('clients/new_client'));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to create client, Try again');
                redirect(site_url('clients/new_client'));
            }  
    }
     
    }

    public function search_client()
	{  
           $this->render('backend/client_search', $this->data);
    }


    public function search_client_action()
	{
        $this->form_validation->set_rules('client_name', 'Provide Client name, email or primary phone', 'required');
 
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('client_search'));
       }
       else{
            $clients = $this->Clients_model->get($this->input->post('client_name'));
            if($clients){
                $this->data['clients']=$clients;
             $this->render('backend/client_search', $this->data);
            
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to get client with enter details, Try again');
                redirect(site_url('clients/client_search'));
            }  
    }
      
    }

    public function edit($id)
	{
        $this->data['one_type'] = $this->category_model->as_object()->get($id);
        $this->data['form_type'] = 1;
        $this->render('backend/category', $this->data);
    }

    public function update()
	{
        $this->form_validation->set_rules('m_type', 'Category name', 'required');
      
        if ($this->form_validation->run() == FALSE){
         $errors = validation_errors();
         $this->session->set_flashdata('error', $errors);
         redirect(site_url('category'));
        }else{
         $insert_data = array('name'=>$this->input->post('m_type'), 'description'=>$this->input->post('desc'));
         $this->category_model->update($insert_data, $this->input->post('type_id'));
         $this->session->set_flashdata('message', 'Category edited successfully');
         redirect(site_url('category'));

        }

    }

    public function delete($id)
	{
        $this->category_model->delete($id);
        $this->session->set_flashdata('message', 'Category trashed successfully');
        redirect(site_url('category'));

    }

    public function trash()
	{
        $this->db->where('deleted_at !=', NULL);
        $query = $this->db->get('product_category');
        $this->data['all_type']=$query->result();
        $this->data['form_type'] = 2;
        $this->render('backend/category', $this->data);

    }


    public function restore($id)
	{
        $this->category_model->restore($id);
        $this->session->set_flashdata('message', 'Category restored successfully');
        redirect(site_url('category'));

    }

    
    public function force_delete($id)
	{
        $this->category_model->force_delete($id);
        $this->session->set_flashdata('message', 'Category deleted successfully');
        redirect(site_url('category'));

    }
    
}
