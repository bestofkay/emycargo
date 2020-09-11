<?php
if($user_details->userStaff=='user'){ 
  $this->ion_auth->logout();
  $this->session->set_flashdata('message', 'Oops! only an admin user can access.');
  redirect('home/login', 'refresh');
}?>

<?php
  $this->load->view('templates/back_header');
  $this->load->view('templates/back_nav');
?>

<?php echo $the_view_content;?>

<?php
 $this->load->view('templates/back_foot');
?>
           
		