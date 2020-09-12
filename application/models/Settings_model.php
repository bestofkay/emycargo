<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Settings_model extends CI_Model
{
    public function get_company($id)
    {
            $query = $this->db->get('settings');
            $this->db->where('id', $id);
            return $query->row();
       
    }

    public function get_parameters()
    {
            $query = $this->db->get('fines');
            return $query->result();
       
    }

   
        public function update_company($data, $id){
            $this->db->where('id', $id);
            $this->db->update('settings', $data);
            if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
        }

        public function update_parameters($data){
            $this->db->update_batch('fines', $data, 'id');
            if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
        }

    
}