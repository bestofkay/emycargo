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
    $id=$this->post('admin_id');
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

   

    public function update_password_post()
    {
        $password=password_hash($this->post('new_password'), PASSWORD_BCRYPT, ["cost" => 12]);
        $message=array(
            'password' => $password
        );
            $login = $this->Admin_model->get($this->post('admin_id'));
            if($login){ 
                if(password_verify($this->post('old_password'), $login->password)){
                    $this->Login_model->update($message, $this->post('admin_id'));
                    $this->response([
                        'status' => TRUE,
                        'message' => 'Password changed successfully'
                    ], REST_Controller::HTTP_OK);
                    ################## AUDIT TRAIL #############

                    #############################################
                    }else{
                        $this->response([
                            'status' => FALSE,
                            'message' => 'Invalid password'
                        ], REST_Controller::HTTP_NOT_FOUND); 
                    }       
        }else{
                $this->response([
                    'status' => FALSE,
                    'message' => 'Username/password not valid'
                ], REST_Controller::HTTP_NOT_FOUND); 
            }            
    }


    public function update_admin_post()
    {
        $message=array(
            'surname' => $this->post('surname'),
            'other_name' => $this->post('other_name'),
            'email' => $this->post('email'),
            'phone_number' => $this->post('phone_number'),
            'date_created' => date('Y-m-d'),
            'role_title_id'=>$this->post('role_title_id')
        );
        
        $update=$this->Admin_model->update($message,$this->post('admin_member_id'));
        if($update){
            $this->response([
                'status' => TRUE,
                'message' => 'Admin data updated successfully'
            ], REST_Controller::HTTP_OK);
            ################## AUDIT TRAIL #############

            #############################################
        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Error in updating admin user. Try again later!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }            
    }
    ########### CREATE ROLES ##########
    
    public function create_roles_post()
    {        
        // Validating token
        $token = $this->post('tokens');
        if($this->validate_token($token)){
            $message = array(
                'roles' => $this->post('roleName'),
                'approve_power' => $this->post('approve_power'),
            );
            $create = $this->Admin_model->addrole($message);
            if($create){
             return $this->response([
                'status' => TRUE,
                'message' => 'Role created successfully'
            ], REST_Controller::HTTP_OK);
            }else{
               return $this->response([
                    'status' => FALSE,
                    'message' => 'Error in  creating role. Try again later!'
                ], REST_Controller::HTTP_NOT_FOUND); 
            }  
        }else{
            $response["status"] = false;
            $response["message"] = "Token not found / Token expire.";
            return $this->response($response, REST_Controller::HTTP_NOT_FOUND);
        }
         
    }


    public function getroles_get($id = 0)
    {
        $token = ($this->post('token'));
        $this->validate_token($token);
        
        if(!empty($id)){
            $roles = $this->Admin_model->getsinglerole($id);
            return $this->response([
                'status' => TRUE,
                'result'=> $roles
                ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
        }else{
            $roles = $this->Admin_model->getrole();
            if(empty($roles) || count($roles)==0){
                 // Set the response and exit
                 return $this->response([
                    'status' => FALSE,
                    'message' => 'No role was found'
                ], REST_Controller::HTTP_NOT_FOUND);
            }else{
               return $this->response([
                    'status' => TRUE,
                    'result'=> $roles
                    ], REST_Controller::HTTP_OK); // OK (200) being the HTTP response code
            }
    
        }
         
    }

    public function update_roles_put($role_id)
    {
        $message = array(
            'roles'=>$this->put('roles'),
            'roles_description' => $this->put('roles_description'),
            'role_id' => $role_id
        );
                
        $updated=$this->Admin_model->updaterole($message);
        if($updated){
            $this->response([
                'status' => TRUE,
                'message' => 'Role updated successfully'
            ], REST_Controller::HTTP_OK);

        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Error in updating role keys. Try again later!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
            
    }
    
    public function delete_role_delete($role_id) {        
        $deleted = $this->Admin_model->deleterole($role_id);
        
        if($deleted){
            $this->response([
                'status' => TRUE,
                'message' => 'Role deleted successfully'
            ], REST_Controller::HTTP_OK);

        }else{
            $this->response([
                'status' => FALSE,
                'message' => 'Error on deleting role. Try again later!'
            ], REST_Controller::HTTP_NOT_FOUND);
        }
    }

}
    
