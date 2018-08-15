<?php

class Win_driver extends CI_Model {

    function __construct() {
        // Call the Model constructor
        parent::__construct();
        //$this->load->library('session');
        //$this->load->library('common');
    }

    function chk_dup() {
        $email = trim(stripcslashes($_POST['email']));
        $this->db->select('count(*) as cnt');
        $this->db->from('win_driver');
        $this->db->where("email", $email);
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            $row = $query->row_array();
            return $row;
        }
    }

    public function getalldriver($limit = NULL, $start = NULL) {
        !empty($limit) ? $this->db->limit($limit, $start) : '';
        return $this->db->get('win_driver')->result_array();
    }

    function driver_signup() {
        $this->db->insert('win_driver', $_POST);
        $id = $this->db->insert_id();
        if (!empty($id)) {
            return $id;
        }
    }

    function getNearBy() {
        empty($_GET['lim']) ? $lim = 50 : $lim = $_GET['lim'];
        $query = $this->db->query("select *,(((acos(sin((" . $_GET['lat'] . "*pi()/180)) *
        sin((`latitude`*pi()/180))+cos((" . $_GET['lat'] . "*pi()/180)) *
        cos((`latitude`*pi()/180)) * cos(((" . $_GET['long'] . "-
        `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) 
        as distance
from win_driver HAVING distance < $lim order by distance asc");

        $res = $query->result();
        return $res;
    }

    public function find() {
        empty($_GET['lim']) ? $lim = 50 : $lim = $_GET['lim'];
        $query = $this->db->query("select *,(((acos(sin((" . $_GET['lat'] . "*pi()/180)) *
        sin((`latitude`*pi()/180))+cos((" . $_GET['lat'] . "*pi()/180)) *
        cos((`latitude`*pi()/180)) * cos(((" . $_GET['long'] . "-
        `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) 
        as distance
from win_driver HAVING distance < $lim order by distance asc limit 5");
        $res = $query->result();
        foreach ($res as $val) {
            $this->db->query("insert into win_select_driver(user_id,driver_id,distance,status)VALUES(" . $_GET['user_id'] . "," . $val->driver_id . ",'" . $val->distance . "','PENDING')");
        }
        return $res;
    }

    function chkLogin() {
        $email = trim(stripcslashes($_GET['email']));
        $this->db->select('*');
        $this->db->from('win_driver');
        $this->db->where(array("email" => $email, "password" => $_GET['password'], "status" => 1, "is_active" => 1));
        $query = $this->db->get();
        if ($query->num_rows() > 0) {
            return $query->row_array();
        } else {
            return 0;
        }
    }

    public function getSelected() {
        $query = $this->db->query("SELECT d.name,d.email,d.mobile,d.vehicle_no,d.id_proof_name,d.id_proof_number,d.avatar,s.distance,s.accept_date FROM `win_select_driver` s LEFT JOIN `win_driver` d ON d.driver_id = s.driver_id where s.status = 'ACCEPTED' and s.user_id = " . $_GET['user_id'] . " order by s.`distance` asc limit 1");
        if ($query->num_rows() > 0) {
            return $query->row();
        } else {
            return 0;
        }
    }

}