<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class Driver extends REST_Controller {

    /**
     * Index Page for this controller.
     *
     * Maps to the following URL
     * 		http://example.com/index.php/welcome
     * 	- or -  
     * 		http://example.com/index.php/welcome/index
     * 	- or -
     * Since this controller is set as the default controller in 
     * config/routes.php, it's displayed at http://example.com/
     *
     * So any other public methods not prefixed with an underscore will
     * map to /index.php/welcome/<method_name>
     * @see http://codeigniter.com/user_guide/general/urls.html
     */
    function __construct() {
        // Call the Model constructor
        parent::__construct();
        error_reporting(E_ERROR | E_PARSE);
        $this->load->model("win_driver");
        $this->load->library('session');
    }


    public function rides_get() {
        if (!empty($_GET['driver_id'])) {
            $res = $this->db->order_by("ride_id", "DESC")->get_where("rides", array("driver_id" => $_GET['driver_id']))->result();
            if ($this->db->affected_rows() > 0) {
                $this->response(array("status" => "success", "data" => $res));
            } else {
                $this->response(array("status" => "fail", "data" => "no data"));
            }
        } else {
            $this->response(array("status" => "fail", "data" => "Require data not recived"));
        }
    }

    public function earn_get() {
        if (!empty($_GET['driver_id'])) {
            $qry = $this->db->query("SELECT round(sum(amount),2) as month_earning,IFNULL((SELECT round(sum(amount),2) as earning FROM `rides` where driver_id = " . $_GET['driver_id'] . " and `time` >= DATE_SUB(NOW(), INTERVAL 7 DAY) and payment_status = 'PAID' group by driver_id),0) as week_earning,IFNULL((SELECT round(sum(amount),2) as earning FROM `rides` where driver_id = " . $_GET['driver_id'] . " and payment_status = 'PAID' group by driver_id),0) as total_earning,IFNULL((SELECT round(sum(amount),2) as earning FROM `rides` where driver_id = " . $_GET['driver_id'] . " and `time` >= DATE_SUB(NOW(), INTERVAL 1 DAY) and payment_status = 'PAID' group by driver_id),0) as today_earning,(SELECT count(ride_id) FROM `rides` where driver_id = " . $_GET['driver_id'] . " and status = 'COMPLETED') as total_rides FROM `rides` where driver_id = " . $_GET['driver_id'] . " and `time` >= DATE_SUB(NOW(), INTERVAL 1 MONTH) and payment_status = 'PAID' group by driver_id");
            $unit = $this->db->get_where("settings", array("name" => "UNIT"))->row();
            $res = $qry->row();
            if (empty($res)) {
                $res = (object) array();
                $res->month_earning = !empty($res->month_earning) ? $res->month_earning : '';
                $res->week_earning = !empty($res->week_earning) ? $res->week_earning : '';
                $res->total_earning = !empty($res->total_earning) ? $res->total_earning : '';
                $res->today_earning = !empty($res->today_earning) ? $res->today_earning : '';
                $res->total_rides = !empty($res->total_rides) ? $res->total_rides : '';
            }
            $res->unit = $unit->value;
            $this->response(array("status" => "success", "data" => $res));
        } else {
            $this->response(array("status" => "fail", "data" => "Require data not recived"));
        }
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */