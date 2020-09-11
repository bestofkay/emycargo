<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Login_model extends CI_Model
{
    public function get($email)
    {
        $this->db->select('admin_member.*, role_title.role_name, role_title.role_keys');
            $this->db->from('admin_member');
            $this->db->join('role_title', 'role_title.role_title_id = admin_member.role_title_id', 'left'); 
            $this->db->where('admin_member.email', $email);
            $query = $this->db->get();
            return $query->row();
    }

    public function get_super($email)
    {
            $this->db->where('email', $email);
            $query = $this->db->get('super_admin');
            return $query->row();
    }

    public function trash(){

        $this->db->where('deleted_at !=', NULL);
            $query = $this->db->get('news');
            return $query->result();
    }

    public function get_news_name(){
        $this->db->select('id, name');
        $this->db->where('deleted_at', NULL);
        $query = $this->db->get('news');
        return $query->result();
    }

    public function insert($array)
    {
        $this->db->insert('news', $array);
    }

    public function update($data, $id){
        $this->db->where('admin_member_id', $id);
        $this->db->update('admin_member', $data);
    }

    public function force_delete($id){
        $this->db->where('id', $id);
        $this->db->delete('news');   
    }

    public function soft_delete($id){
        $data = array(
            'deleted_at' => date('Y-m-d h:m:s'),
    );
        $this->db->where('id', $id);
        $this->db->update('news', $data);
    }

    public function restore($id){
        $data = array(
            'deleted_at' => NULL,
    );
        $this->db->where('id', $id);
        $this->db->update('news', $data);
    }
    
}