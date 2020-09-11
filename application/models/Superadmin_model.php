<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Superadmin_model extends CI_Model
{
    public function create_admin($data) {
            
        $hash = $this->hash($data['password']);
        $data = array(
            'surname' => $data['surname'],
            'other_name' => $data['other_name'],
            'email' => $data['email'],
            'password' => $hash,
            'phone_number' => $data['phone_number'],
            'is_super_admin' => 0
        );
               $this->db->insert('admin_member', $data);

            if ($this->db->affected_rows() > 0) {

                return TRUE;

            } else {

          return FALSE;
        }
    }
    
    public function create_admin_user($data) {
            
        $hash = $this->hash($data['password']);
        $data = array(
            'surname' => $data['surname'],
            'other_name' => $data['other_name'],
            'email' => $data['email'],
            'password' => $hash,
            'phone_number' => $data['phone_number'],
            'validate_token' => $data['validate_token'],
            'status' => 0
        );
            
            $this->db->insert('admin_member', $data);

            if ($this->db->affected_rows() > 0) {
                
                return $this->db->insert_id();

            } else {

          return FALSE;
        }
    }

    // login method and password verify
    function login($data) {
        $this->db->select('admin_member.*, role_title.role_name, role_title.approve_power');
        //$this->db->select('admin_member.*, role_title.role_name');
        $this->db->from('admin_member');
        $this->db->join('role_title', 'role_title.role_title_id = admin_member.role_title_id', 'left'); 
        $this->db->where('email', $data['email']);       
        $query = $this->db->get()->row_array();

        if ($query) {
            if ($this->verifyHash($data['password'], $query['password']) == TRUE) {
                return $query;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }


    // password hash
    public function hash($password) {
        $hash = password_hash($password, PASSWORD_DEFAULT);
        return $hash;
    }

    // password verify
    public function verifyHash($password, $vpassword) {
        if (password_verify($password, $vpassword)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }
}