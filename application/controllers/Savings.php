<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Savings extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation','session'));
        $this->load->helper(array('url', 'language'));
        $this->load->model(array('Members_model', 'Savings_model', 'Admin_model'));
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
		{
			// redirect them to the login page
			redirect('home/login', 'refresh');
		}
    }

    public function index()
    {
        $members = $this->Members_model->get_all();
        $this->data['members'] = $members;
        $this->render('backend/saving_search', $this->data);
        /*
        $this->data['savings'] =  $this->Savings_model->get_savings();
        $this->data['trans'] =  $this->Savings_model->get_transaction();
        $this->render('backend/savings', $this->data);
        */
    }

    public function withdrawal_request()
    {
        $this->data['savings'] =  $this->Savings_model->get_transaction_pending(0);
        $this->render('backend/withdrawal_request', $this->data);
        /*
        $this->data['savings'] =  $this->Savings_model->get_savings();
        $this->data['trans'] =  $this->Savings_model->get_transaction();
        $this->render('backend/savings', $this->data);
        */
    }

    public function approve_withdrawal()
    {
        $message=array(
            'approval_status' => 1,
            'approve_date'=> date('Y-m-d')
        );
        $update = $this->Savings_model->approve_withdrawal($message, $this->input->post('id'));
                if($update){
                 $this->session->set_flashdata('message', 'withdrawal approved successfully');
                 redirect(site_url('savings/withrawal_request'));
                }else{
                    $this->session->set_flashdata('error', 'Oops! Unable to approve withdrawal, Try again');
                    redirect(site_url('savings/withrawal_request'));
                } 
    }

    public function reject_withdrawal()
    {
        $message=array(
            'approval_status' => 2,
            'approve_date'=> date('Y-m-d')
        );
        $update = $this->Savings_model->approve_withdrawal($message, $this->input->post('id'));
                if($update){
                 $this->session->set_flashdata('message', 'withdrawal approved successfully');
                 redirect(site_url('savings/withrawal_request'));
                }else{
                    $this->session->set_flashdata('error', 'Oops! Unable to approve withdrawal, Try again');
                    redirect(site_url('savings/withrawal_request'));
                } 
    }

    public function disburse_status()
    {
        $new_pay=$this->input->post('amount');
        $member = $this->Savings_model->get_savings($this->input->post('member_id'));
        $total_amount=$member->total_amount - $new_pay;

        $message=array(
            'disburse_status' => 1,
            'trans_type'=>2,
            'balance'=>$total_amount,
            'disburse_date'=> date('Y-m-d')
        );
        $update = $this->Savings_model->approve_withdrawal($message, $this->input->post('id'));
                $message=array(
                    'total_amount'=>$total_amount,
                );
           
                $this->Savings_model->update_savings($message, $this->input->post('member_id'));

       
                if($update){
                 $this->session->set_flashdata('message', 'disbursed confirmed successfully');
                 redirect(site_url('savings/disbursed_withdrawal'));
                }else{
                    $this->session->set_flashdata('error', 'Oops! Unable to confirm disburse, Try again');
                    redirect(site_url('savings/pending_disburse'));
                } 
    }

    public function pending_disburse()
    {
        $this->data['savings'] =  $this->Savings_model->get_withdrawal_approve(0);
        $this->render('backend/pending_disburse', $this->data);

    }

    public function disbursed_withdrawal()
    {
        $this->data['savings'] =  $this->Savings_model->get_withdrawal_approve(1);
        $this->render('backend/disbursed_withdrawal', $this->data);

    }



    public function search_savings()
    {
        
        $this->form_validation->set_rules('search', 'Search type', 'required');
        $this->form_validation->set_rules('search4', 'Date Search type', 'required');
        $search= $this->input->post('search');
        //echo $search; exit;
        if ($this->form_validation->run() == FALSE){
            $errors = validation_errors();
            $this->session->set_flashdata('error', $errors);
            redirect(site_url('savings'));
           }else{
           // echo $search; exit; 
            $search2= $this->input->post('search2');
            $search3= $this->input->post('search3');
            $search4= $this->input->post('search4');
            $search5= $this->input->post('search5');
            $search6= $this->input->post('search6');
            $month= $this->input->post('month');
            $year= $this->input->post('year');
           // echo $search4; exit;

              if($search==2){
               if($search2 > 0){
                   $this->data['trans'] =  $this->Savings_model->get_transaction($id=null,$month=null,$year=null,$member=null,$search2);
                  // $this->data['savings'] =  $this->Savings_model->get_savings();
                   $this->data['type'] =  $search2;
                $this->render('backend/savings', $this->data);
            }else{ $this->session->set_flashdata('error', 'Transaction type is required');
               redirect(site_url('savings'));}    
              }
              if($search==1){
               // echo $search;
                  if($search5 > 0){
                   // echo $search5; exit;
                    $this->data['trans'] =  $this->Savings_model->get_transaction($id=null,$month,$year,$search5,$search2);
                    $this->data['type'] =  $search2;
                    $this->render('backend/savings', $this->data);
                  }
                  if($search6 > 0){
                   // echo $search6; exit;
                   $this->data['trans'] =  $this->Savings_model->get_transaction($id=null,$month,$year,$search5,$search2);
                   // $this->data['savings'] =  $this->Savings_model->get_savings();
                   $this->data['type'] =  $search2;
                    $this->render('backend/savings', $this->data);
                  } 
               }
           }
        
    }

    public function member_savings()
    {
        $this->data['savings'] =  $this->Savings_model->get_transaction();
        $this->render('backend/savings2', $this->data);
    }

    public function monthly_savings()
    {
        $this->data['savings'] =  $this->Savings_model->monthly_savings($data=null, 1);
        $this->data['type'] = 1;
        $this->render('backend/monthly_save', $this->data);
    }

    public function monthly_withdrawal()
    {
        $this->data['savings'] =  $this->Savings_model->monthly_savings($data=null, 2);
        $this->data['type'] = 2;
        $this->render('backend/monthly_save', $this->data);
    }

    public function yearly_savings($id)
    {
        $this->data['savings'] =  $this->Savings_model->yearly_savings($id, 1);
        $this->data['type'] = 1;
        $this->render('backend/yearly_save', $this->data);
    }

    public function yearly_withdrawal_list($id)
    {
        $this->data['savings'] =  $this->Savings_model->yearly_savings($id, 2);
        $this->data['type'] = 2;
        $this->render('backend/yearly_save', $this->data);
    }

    public function monthly($data)
    {
        $this->data['savings'] =  $this->Savings_model->monthly_savings($data, 1);
        $this->data['type'] = 1;
        $this->data['month']= $data;
        $this->render('backend/month_save_list', $this->data);
    }
    public function monthly_withdrawal_list($data)
    {
        $this->data['savings'] =  $this->Savings_model->monthly_savings($data, 2);
        $this->data['type'] = 2;
        $this->data['month']= $data;
        $this->render('backend/month_save_list', $this->data);
    }
    public function yearly()
    {
        $this->data['savings'] =  $this->Savings_model->yearly_savings($data=null, 1);
        $this->data['type'] = 1;
        $this->render('backend/year_save_list', $this->data);
    }

    public function yearly_withdrawal()
    {
        $this->data['savings'] =  $this->Savings_model->yearly_savings($data=null, 2);
        $this->data['type'] = 2;
        $this->render('backend/year_save_list', $this->data);
    }

    public function payment()
    {
        $new_pay=$this->input->post('amount');
        $member = $this->Savings_model->get_savings($this->input->post('member_id'));
        $total_amount=$member->total_amount + $new_pay;
    
                $message=array(
                    'total_amount'=>$total_amount,
                );
           
                $message2=array(
                    'amount'=>$new_pay,
                    'balance'=>$total_amount,
                    'trans_type'=>1,
                    'member_id'=>$this->input->post('member_id'),
                    'month_year'=>date('Y-m'),
                    'year'=>date('Y'),
                    'date_created'=> date('Y-m-d')
                );
                $this->Savings_model->insert_transaction($message2);
                $this->Savings_model->update_savings($message, $this->input->post('member_id'));
                $this->session->set_flashdata('message', 'deposit made successfully');
             redirect(site_url('savings')); 
    }

    public function delete_savings()
    {
        $id=$this->input->post('id');
        $am=$this->input->post('amount');
        $member = $this->Savings_model->get_savings($this->input->post('member_id'));
        $mem=$this->input->post('member_id');
        $total_amount=$member->total_amount - $am;
        $message=array(  
            'total_amount'=>$total_amount,
        );
      $update = $this->Savings_model->update_savings($message, $this->input->post('member_id'));
            if($update){
                $this->Savings_model->delete_transaction($id);
                $this->session->set_flashdata('message', 'Transaction reversed successfully');
                redirect(site_url('savings/member_savings'));
            } 
    }



}