<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class Ion Auth Model
 * @property Bcrypt $bcrypt The Bcrypt library
 * @property Ion_auth $ion_auth The Ion_auth library
 */
class Invoice_model extends CI_Model
{
    public function insert($param)
    {
        $this->db->insert('invoice', $param); 
        if($this->db->affected_rows() > 0){
            return true;
        }else{
            return false;
        } 
    }

    public function get()
    {
            $this->db->select('invoice.*,b.fullname as staff_name,c.fullname as fullname');
            $this->db->from('invoice');
            $this->db->join('container', 'container.id = invoice.containerID', 'left');
            $this->db->join('users as b', 'invoice.staffID = b.id', 'left');
            $this->db->join('users as c', 'container.userID = c.id', 'left');
            $this->db->where('container.clearStatus', 0);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            } 
    }

    public function get_cargo($unique)
    {
        $this->db->select('invoice.*,b.fullname as staff_name,c.fullname as fullname');
        $this->db->from('invoice');
        $this->db->join('container', 'container.id = invoice.containerID', 'left');
        $this->db->join('users as b', 'invoice.staffID = b.id', 'left');
        $this->db->join('users as c', 'container.userID = c.id', 'left');
            $this->db->where('container.uniqueID', $unique);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->result();
            } else {
                return array();
            } 
    }


    public function get_container($id)
    {
            $this->db->select('container.*');
            $this->db->from('container');
            $this->db->join('invoice', 'container.id = invoice.containerID', 'left');
           $this->db->where('invoice.id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->row();
            } else {
                return array();
            } 
    }

    public function get_client($id)
    {
        $this->db->select('users.*');
        $this->db->from('users');
        $this->db->join('container', 'container.userID = users.id', 'left');
        $this->db->join('invoice', 'container.id = invoice.containerID', 'left');
        $this->db->where('invoice.id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->row();
            } else {
                return array();
            } 
    }

    public function get_invoice_staff($id)
    {
            $this->db->select('invoice.*, b.fullname as staff_name');
            $this->db->from('invoice');
            $this->db->join('container', 'container.id = invoice.containerID', 'left');
            $this->db->join('users as b', 'invoice.staffID = b.id', 'left');
            $this->db->where('invoice.id', $id);
            $query = $this->db->get();
            if($query->num_rows() > 0) {
                return $query->row();
            } else {
                return array();
            } 
    }

    public function delete($id){
        $this->db->where('id', $id);
        $this->db->delete('invoice');   
    }


   
}