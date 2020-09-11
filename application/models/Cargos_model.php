<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Cargos_model extends CI_Model
{
    public function insert($param)
    {
        $this->db->insert('container', $param); 
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }


    public function get_cargo($unique=null, $id=null)
    {
        if(empty($unique) && empty($id)){
            $this->db->select('*');
            $this->db->from('container');
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            } 

        }
            $this->db->select('*');
            $this->db->from('container');
            $this->db->where('container.uniqueID', $unique);
            $this->db->where('container.id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->row();
            } else {
                return array();
            } 
    }

    public function get_clear($id)
    {
            $this->db->select('container.*,b.fullname as client_name ,c.fullname as staff_name');
            $this->db->from('container');
            $this->db->join('users as b', 'container.userID = b.id', 'left');
            $this->db->join('users as c', 'container.staffID = c.id', 'left');
            $this->db->where('container.clearStatus', $id);   
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            } 
    }
	
	public function get_clients($unique, $id)
    {
            $this->db->select('container.*');
            $this->db->from('container');
            $this->db->join('users', 'container.userID = users.id', 'left');
            $this->db->where('users.uniqueID', $unique);
            $this->db->where('users.id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            } 
    }

    ####### UPDATE ADMIN MEMBERS #########
    public function update($data, $id){
        $this->db->where('id', $id);
        $this->db->update('company', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }


    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('company');   
    }

    public function delete_group($id){
        $this->db->where('id', $id);
        $this->db->delete('groups');   
    }

    ####### UPDATE ADMIN MEMBERS #########
    public function activate($data, $id){
        $this->db->where('id', $id);
        $this->db->update('company', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function deactivate($data, $id){
        $this->db->where('id', $id);
        $this->db->update('company', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }
    
}