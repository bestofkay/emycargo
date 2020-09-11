<?php defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Auth
 * @property Ion_auth|Ion_auth_model $ion_auth        The ION Auth spark
 * @property CI_Form_validation      $form_validation The form validation library
 */
class Invoice extends MY_Controller
{
	public function __construct()
	{
		parent::__construct();
        $this->load->database();
        $this->load->library(array('ion_auth', 'form_validation','session'));
        $this->load->helper(array('url', 'language'));
        $this->load->model(array('Invoice_model', 'Clients_model','Cargos_model','Settings_model'));
        $this->lang->load('auth');
        if (!$this->ion_auth->logged_in())
		{
			redirect('home/login', 'refresh');
		}
    }

    public function index()
    {
        $invoice = $this->Invoice_model->get();
        $this->data['invoice_details'] = $invoice;
        $this->render('backend/all_invoices', $this->data);
    }

    public function generate_invoice($data)
    {
       
        $data_array=explode('_', $data);
        $unique=$data_array[0];
        $id=$data_array[1];
        $last = $this->db->order_by('id',"desc")
		->limit(1)
		->get('invoice')
        ->row();
        if(empty($last)){
            $inv='EMY/INV/'.'1000000001';
        }else{
            $no=1000000001 + $last->id;
            $inv='EMY/INV/'.$no;
        }
        
        $message=array(
            'containerID' => $id,
            'invoiceNo' => $inv,
            'staffID'=>  $this->session->userdata('user_id'),
            'dateCreated'=> date('Y-m-d h:i:s'),
        );

            $comm = $this->Invoice_model->insert($message);
            if($comm){
                $this->session->set_flashdata('message', 'New Invoice created successfully');
                redirect(site_url('invoice/cargo/'.$data));
               }else{
                   $this->session->set_flashdata('error', 'Oops! Unable to create new invoice, Try again');
                   redirect(site_url('invoice/cargo/'.$data));
               }  
    }

    public function cargo($data)
    {
                $data_array=explode('_', $data);
                $unique=$data_array[0];
                $id=$data_array[1];
                $invoice = $this->Invoice_model->get_cargo($unique);
                $cargo = $this->Cargos_model->get_cargo($unique, $id);
                $this->data['invoice_details'] = $invoice;
                $this->data['cargo'] = $cargo;
                $this->render('backend/cargo_invoice', $this->data);
    }


    public function print_invoice($id){
       $this->data['container']=  $this->Invoice_model->get_container($id);
       $this->data['client'] =  $this->Invoice_model->get_client($id);
        $last = $this->db->order_by('id',"desc")
		->limit(1)
		->get('settings')
        ->row();
       $this->data['company']=$last;
       $this->data['parameters']= $this->Settings_model->get_parameters();
       $this->data['staff']= $this->Invoice_model->get_invoice_staff($id);
      $this->load->view('backend/print_invoice', $this->data);
/*
        require_once APPPATH."/third_party/mpdf/mpdf.php";
        $mpdf=new mPDF();
        $mpdf = new mPDF('utf-8', 'A4', 0, '', 0, 0, 7, 0, 0, 0);
        $file_name=$this->data['container']->containerNumber.'_Invoice.pdf';
       $filename = $this->load->view("backend/print_invoice", $this->data, TRUE);
       $mpdf->WriteHTML($filename); 

         $mpdf->Output( $file_name, "D"); 
         */

    }
    

    public function delete()
{
    $id=$this->input->post('id');
    $data=$this->input->post('data');
    $this->Invoice_model->delete($id);
    $this->session->set_flashdata('message', 'invoice deleted successfully');
    redirect(site_url('invoice/cargo/'.$data));
}


}