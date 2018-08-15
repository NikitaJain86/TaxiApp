<?php

class Users extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        // $this->load->library('session');
        //$this->load->library('common');
    }

    function chk_dup() {
        $email = trim(stripcslashes($_POST['email']));
        $this->db->select('count(*) as cnt');
        $this->db->from('users');
        $this->db->where("email", $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    function user_signup() {
        $_POST["password"] = md5($_POST["password"]);

        $this->db->insert('users', $_POST);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return $id;
        }
    }

    public function chkConfirmId($id) {
        $chkId = $this->db->get_where("users", array("random" => $id))->row();
        return count($chkId);
    }

    function finded_driver() {
        $query = $this->db->query("select * from win_select_driver where user_id = " . $_POST['user_id'] . " and status = 'REQUEST_ACCEPTED'");
        return $query->result();
    }

    function chk_dup_fb($post, $par = NULL) {
        $uname = $post->id;
        if ($par == "data") {
            $this->db->select('*');
        } else {
            $this->db->select('count(*) as cnt');
        }
        $this->db->from('users');
        $where = "fb_id = '$uname' or email = '$post->email'";
        $this->db->where($where);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        } else {
            return FALSE;
        }
    }

    function chkLogin() {
        $email = trim(stripcslashes($_POST['email']));
        $this->db->select('*');
        $this->db->from('users');
        $this->db->where(array("email" => $email, "password" => MD5($_POST['password']), "utype" => $_POST['utype']));
        $query = $this->db->get();


        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return 0;
        }
    }

}
