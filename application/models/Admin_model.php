<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Admin_model extends CI_Model
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

    public function insert_group($param)
    {
        $this->db->insert('groups', $param); 
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }

    public function get()
    {
            $this->db->select('users.*, groups.name as g_name');
            $this->db->from('users');
            $this->db->join('groups', 'users.role_id = groups.id');
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result();
            } else {
                return FALSE;
            } 
    }

    public function get_group() {
        $query = $this->db->get('groups');
//$this->db->where('id >', 2);
        return $query->result();
    }

    public function get_state() {
        $query = $this->db->get('states');
        return $query->result();
    }

    ####### UPDATE ADMIN MEMBERS #########
    public function update($data, $id){
        $this->db->where('id', $id);
        $this->db->update('users', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function update_group($data, $id){
        $this->db->where('id', $id);
        $this->db->update('groups', $data);
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        }
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('users');   
    }

    public function delete_group($id){
        $this->db->where('id', $id);
        $this->db->delete('groups');   
    }

    ####### UPDATE ADMIN MEMBERS #########
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
    
    ####### ADD ROLE #########
    
    public function getrole() {
        $this->db->where('role_title_id !=', 1);
        $query = $this->db->get('role_title');
        return $query->result();
    }
    
    public function getsinglerole($roleId) {
        
        $query = $this->db->get_where('role', array('role_title_id' => $roleId)); 
        return $query->result();
    }
    
    
    public function addrole($data) {
        $this->db->insert('role', $data);
        
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }
    
    public function updaterole($data) {
        $this->db->set('roles',  $data['roles']);
        $this->db->set('roles_description',  $data['roles_description']);
        $this->db->where('role_id', $data['role_id']);
        $this->db->update('role');
                
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }
    
    public function deleterole($id) {
        $this->db->where('role_id', $id);
        $this->db->delete('role');
        
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }
    
    
    public function getAdminToken($admin_id){
		return $this->db->query("select * from admin_member where admin_member_id = '".$admin_id."' ")->row_array();
	}
    
}