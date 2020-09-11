<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Clients_model extends CI_Model
{
    public function insert($param)
    {
        $this->db->insert('users', $param); 
        if($this->db->affected_rows() > 0){
            return $this->db->insert_id();
        }else{
            return false;
        } 
    }

   
    #### APPROVED AND ACTIVE###############
    public function get($id)
    {
            $this->db->where('fullname', $id);
            $this->db->or_where('email', $id);
            $this->db->or_where('phone', $id);
            $this->db->where('userStaff', 'user');
            $query = $this->db->get('users');
            if($query->num_rows() > 0) {
                return $query->row();
            } else {
                return FALSE;
            } 
    }

    #### APPROVED AND ACTIVE###############
    public function get_clients($id = NULL)
    {
        if(empty($id)){
            $this->db->where('userStaff', 'user');
            $this->db->where('active', 1);
            $query = $this->db->get('users');
            return $query->result();
        }else{
            $this->db->select('users.*');
            $this->db->from('users');
            $this->db->where('users.id', $id);
            $query = $this->db->get();
            return $query->row();
        }
       
    }


    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('users');   
    }

    ####### UPDATE ADMIN usersS #########
    public function activate($data, $id){
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function deactivate($data, $id){
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
}