<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Email
| -------------------------------------------------------------------------
| This file lets you define parameters for sending emails.
| Please see the user guide for info:
|
|	http://codeigniter.com/user_guide/libraries/email.html
|
*/
$config['protocol'] = 'smtp';
$config['smtp_host'] = 'mail.smtp2go.com';
$config['smtp_port'] = '2525'; // 8025, 587 and 25 can also be used. Use Port 465 for SSL.
$config['smtp_crypto'] = 'tls';
$config['smtp_user'] = 'USERNAME';
$config['smtp_pass'] = 'PASSWORD';
$config['charset'] = 'utf-8';
$config['mailtype'] = 'html';
$config['newline'] = "rn";
/*
$config = array(
    'protocol' => 'smtp', // 'mail', 'sendmail', or 'smtp'
    'smtp_host' => 'smtp.example.com', 
    'smtp_port' => 465,
    'smtp_user' => 'no-reply@example.com',
    'smtp_pass' => '12345!',
    'smtp_crypto' => 'ssl', //can be 'ssl' or 'tls' for example
    'mailtype' => 'text', //plaintext 'text' mails or 'html'
    'smtp_timeout' => '4', //in seconds
    'charset' => 'iso-8859-1',
    'wordwrap' => TRUE
);
*/


/* End of file email.php */
/* Location: ./application/config/email.php */