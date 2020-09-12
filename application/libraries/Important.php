<?php
/**
 * Name:    Bcrypt
 *
 * Requirements: PHP5 or above
 *
 * @package    CodeIgniter-Ion-Auth
 * @author     Ben Edmunds
 * @link       http://github.com/benedmunds/CodeIgniter-Ion-Auth
 * @filesource
 */
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Bcrypt
 */
class Important
{
    private $CI;

    function __construct()
	{
        $this->CI = & get_instance();
        $this->CI->load->database();
    }

public function store() {
        $config['upload_path'] = './images/';
        $config['allowed_types'] = 'gif|jpg|png';
        $config['max_size'] = 500;
        $config['max_width'] = 1500;
        $config['max_height'] = 1500;

        $this->load->library('upload', $config);

        if (!$this->upload->do_upload('profile_image')) {
            $error = array('error' => $this->upload->display_errors());

            $this->load->view('files/upload_form', $error);
        } else {
            $data = array('image_metadata' => $this->upload->data());

            $this->load->view('files/upload_result', $data);
        }
    }

    public function sendMail($sender, $senderName=null, $recipient, $recipientName=null, $subject, $message){


        $this->CI->load->library('email');
        $this->CI->email->initialize(array(
            'protocol' => 'smtp',
            'smtp_host' => 'smtp.sendgrid.net',
            'smtp_user' => 'apikey',
            'smtp_pass' => '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',
            'smtp_crypto' => 'tls',
            'smtp_port' => 587,   
            'crlf' => "\r\n",
            'newline' => "\r\n"
        ));
  
        $this->CI->email->from($sender, $senderName);
        $this->CI->email->to($recipient,$recipientName);
        $this->CI->email->subject($subject);
        $this->CI->email->message($message);
        if ($this->CI->email->send()) {
           return true;
        } else {
            return $this->CI->email->print_debugger();
        }
    }

    public function add_links($class, $route, $operation, $desc, $link) {

       $links=array(
           'class'=>$class,
           'route'=>$route,
           'operation'=>$operation,
           'description'=>$desc,
           'link'=>$link,
       );
       $this->CI->db->select('*');
       $this->CI->db->from('links');
       $this->CI->db->where('class', $class);
       $this->CI->db->where('route', $route);
           $query =  $this->CI->db->get();
           if($query->num_rows() > 0) {
               return false;
           } else {
            $this->db->insert('links', $links); 
           }

    }

    public function audit_trail($user, $userStaff, $date, $operation, $table, $desc, $old=null, $new=null) {
       
        $links=array(
            'userID'=>$user,
            'userStaff'=>$userStaff,
            'transactionDate'=>$date,
            'operationPerformed'=>$operation,
            'tableAffected'=>$table,
            'description'=>$desc,
            'old_data'=>$old,
            'new_data'=>$new,       
        );

        $this->CI->db->insert('audit_trail', $links); 

    }

}