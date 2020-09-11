<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Cargo extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation','session'));
        $this->load->helper(array('url', 'language'));
        $this->load->model(array('Clients_model','Cargos_model'));
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

    public function new_cargo($data)
	{
        $data_array=explode('_', $data);
        $unique=$data_array[0];
        $id=$data_array[1];
        $this->data['client_details'] = $this->Clients_model->get_clients($id);
        $this->render('backend/add_cargo', $this->data); 
    }

    public function create_action()
	{
        $message=array();
        $this->form_validation->set_rules('container_no', 'Container Number', 'required');
        $this->form_validation->set_rules('laden', 'Port of Laden', 'required');
        $this->form_validation->set_rules('discharge', 'Port of discharge', 'required');
        $this->form_validation->set_rules('bill_no', 'Bill number', 'required');
        $this->form_validation->set_rules('callNo', 'Call number', 'required');
        $this->form_validation->set_rules('voyageNo', 'Voyage number', 'required');
        $this->form_validation->set_rules('start', 'Departure Date', 'required');
        $this->form_validation->set_rules('end', 'Arrival Date', 'required');
        $this->form_validation->set_rules('due', 'Due Date', 'required');
        $this->form_validation->set_rules('vessel', 'Vessel name', 'required');
        $this->form_validation->set_rules('volume', 'Volume', 'required');
        $this->form_validation->set_rules('weight', 'Weight', 'required');
        $this->form_validation->set_rules('mode', 'Mode', 'required');
 
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('cargo/new_cargo/'.$this->input->post('client_name')));
       }
       else{
        $unique_id=md5(microtime(true).mt_Rand());
        $message=array(
            'userID' => $this->input->post('client_id'),
            'staffID' => $this->session->userdata('user_id'),
            'portOfLaden' => $this->input->post('laden'),
            'portOfDischarge'=> $this->input->post('discharge'),
            'containerNumber'=> $this->input->post('container_no'),
            'billNumber'=>$this->input->post('bill_no'),
            'uniqueID'=>$unique_id,
            'takeOffDate' => date('Y-m-d', strtotime($this->input->post('start'))),
            'arrivalDate' => date('Y-m-d', strtotime($this->input->post('end'))),
            'vessel' => $this->input->post('vessel'),
            'manifest'=> $this->input->post('manifest'),
            'weight'=> $this->input->post('weight'),
            'volume' => $this->input->post('volume'),
            'mode'=> $this->input->post('mode'),
            'package'=> $this->input->post('package'),
            'lineOperator'=> $this->input->post('line'),
            'comments'=> $this->input->post('comment'),
            'callNo'=> $this->input->post('callNo'),
            'dueDate'=> date('Y-m-d', strtotime($this->input->post('due'))),
            'earlyDelivery' => $this->input->post('early'),
            'lateDelivery'=> $this->input->post('late'),
        );
            $create = $this->Cargos_model->insert($message);
            if($create){
             $this->session->set_flashdata('message', 'New Cargo added successfully &nbsp; <a style="color:blue" href='.site_url("cargo/clients/".$this->input->post('client_name')).'>View Added Cargo</a>');
             redirect(site_url('cargo/new_cargo/'.$this->input->post('client_name')));
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to create cargo to client, Try again');
                redirect(site_url('cargo/new_cargo/'.$this->input->post('client_name')));
            }  
    }
     
    }

    public function cargo_search()
	{  
           $this->render('backend/cargo_client_search', $this->data);
    }

    
    public function search_cargo_action()
	{
        $this->form_validation->set_rules('client_name', 'Provide Client name, email or primary phone', 'required');
 
       if ($this->form_validation->run() == FALSE){
        $errors = validation_errors();
        $this->session->set_flashdata('error', $errors);
        redirect(site_url('cargo/cargo_search'));
       }
       else{
            $clients = $this->Clients_model->get($this->input->post('client_name'));
            if($clients){
                $this->data['clients']=$clients;
             $this->render('backend/cargo_client_search', $this->data);
            
            }else{
                $this->session->set_flashdata('error', 'Oops! Unable to get client with enter details. &nbsp; <a style="color:blue" href='.site_url("clients/new_client").'>Create New Client</a>');
                redirect(site_url('cargo/cargo_search'));
            }  
    }
      
    }

    public function uncleared_cargos()
	{  
        $this->data['cargos'] = $this->Cargos_model->get_clear(0);
        $this->data['status']=0;
           $this->render('backend/cargo_status', $this->data);
    }


    public function cleared_cargos()
	{  
        $this->data['cargos'] = $this->Cargos_model->get_clear(1);
        $this->data['status']=1;
           $this->render('backend/cargo_status', $this->data);
    }


    public function clients($data)
	{
        $data_array=explode('_', $data);
        $unique=$data_array[0];
        $id=$data_array[1];
        $this->data['client_cargo'] = $this->Cargos_model->get_clients($unique, $id);
        $this->data['client_details'] = $this->Clients_model->get_clients($id);
        $this->render('backend/cargo_clients', $this->data);
    }
    
}
