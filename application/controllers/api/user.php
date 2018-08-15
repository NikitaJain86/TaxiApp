<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
require APPPATH . '/libraries/REST_Controller.php';

class User extends REST_Controller {

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
        $this->load->model("users");

        $this->load->library("common");
        $this->load->library('session');
    }

    public function change_password_post() {
        if (!empty($_POST['old_password']) && !empty($_POST['new_password']) && !empty($_POST['user_id'])) {
            $res = $this->db->get_where("users", array("user_id" => $_POST['user_id'], "password" => md5($_POST['old_password'])))->row();
            if (!empty($res)) {
                $this->db->where(array("user_id" => $_POST['user_id'], "password" => md5($_POST['old_password'])));
                $this->db->update("users", array("password" => md5($_POST['new_password'])));
                $this->response(array("status" => "success"));
            } else {
                $this->response(array("status" => "fail", "data" => "old password are wrong"));
            }
        } else {
            $this->response(array("status" => "fail", "data" => "require data not send"));
        }
    }

    public function profile_get() {
        if (!empty($_GET['user_id'])) {
            $res = $this->db->get_where("users", array("user_id" => $_GET['user_id']))->row();
            if (!empty($res->avatar)) {
                $res->avatar = $this->config->base_url() . $res->avatar;
            }
            if (!empty($res->license)) {
                $res->license = $this->config->base_url() . $res->license;
            }
            if (!empty($res->insurance)) {
                $res->insurance = $this->config->base_url() . $res->insurance;
            }
            if (!empty($res->permit)) {
                $res->permit = $this->config->base_url() . $res->permit;
            }
            if (!empty($res->registration)) {
                $res->registration = $this->config->base_url() . $res->registration;
            }
            $this->response(array("status" => "success", "data" => $res));
        } else {
            $this->response(array("status" => "fail", "data" => "User id not send"));
        }
    }

    public function update_post() {
        if (!empty($_POST['user_id'])) {
            if (!empty($_FILES['avatar']['name'])) {
                $path = $_FILES['avatar']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $rand = 'img_' . time() . rand(1, 988);
                $config['upload_path'] = BASEPATH . "../avatar/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = $rand;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->overwrite = true;
                if ($this->upload->do_upload('avatar')) {
                    $data = $this->upload->data();
                    $_POST['avatar'] = "avatar/" . $rand . '.' . $ext;
                } else {
                    $this->response(array("status" => "fail", "data" => "Error during file upload: only select jpg,png or gif."));
                    die;
                }
            }

            if (!empty($_FILES['license']['name'])) {
                unset($config);
                $path = $_FILES['license']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $rand1 = 'img_' . time() . rand(1, 988);
                $config['upload_path'] = BASEPATH . "../avatar/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = $rand1;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->overwrite = true;
                if ($this->upload->do_upload('license')) {
                    $data = $this->upload->data();
                    $_POST['license'] = "avatar/" . $rand1 . '.' . $ext;
                } else {
                    $this->response(array("status" => "fail", "data" => "Error during file upload: only select jpg,png or gif."));
                    die;
                }
            }
            if (!empty($_FILES['insurance']['name'])) {
                unset($config);
                $path = $_FILES['insurance']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $rand2 = 'img_' . time() . rand(1, 988);
                $config['upload_path'] = BASEPATH . "../avatar/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = $rand2;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->overwrite = true;
                if ($this->upload->do_upload('insurance')) {
                    $data = $this->upload->data();
                    $_POST['insurance'] = "avatar/" . $rand2 . '.' . $ext;
                } else {
                    $this->response(array("status" => "fail", "data" => "Error during file upload: only select jpg,png or gif."));
                    die;
                }
            }

            if (!empty($_FILES['permit']['name'])) {
                unset($config);
                $path = $_FILES['permit']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $rand3 = 'img_' . time() . rand(1, 988);
                $config['upload_path'] = BASEPATH . "../avatar/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = $rand3;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->overwrite = true;
                if ($this->upload->do_upload('permit')) {
                    $data = $this->upload->data();
                    $_POST['permit'] = "avatar/" . $rand3 . '.' . $ext;
                } else {
                    $this->response(array("status" => "fail", "data" => "Error during file upload: only select jpg,png or gif."));
                    die;
                }
            }
            if (!empty($_FILES['registration']['name'])) {
                unset($config);
                $path = $_FILES['registration']['name'];
                $ext = pathinfo($path, PATHINFO_EXTENSION);
                $rand4 = 'img_' . time() . rand(1, 988);
                $config['upload_path'] = BASEPATH . "../avatar/";
                $config['allowed_types'] = 'gif|jpg|png|jpeg';
                $config['file_name'] = $rand4;
                $this->load->library('upload', $config);
                $this->upload->initialize($config);
                $this->upload->overwrite = true;
                if ($this->upload->do_upload('registration')) {
                    $data = $this->upload->data();
                    $_POST['registration'] = "avatar/" . $rand4 . '.' . $ext;
                } else {
                    $this->response(array("status" => "fail", "data" => "Error during file upload: only select jpg,png or gif."));
                    die;
                }
            }
            if (!empty($_POST['passowrd'])) {
                $_POST['password'] = md5($_POST['password']);
            }
            unset($_POST['X-API-KEY']);
            $this->db->where("user_id", $_POST["user_id"]);
            $this->db->update("users", $_POST);
            !empty($_POST['avatar']) ? $_POST['avatar'] = $this->config->base_url() . $_POST['avatar'] : '';
            !empty($_POST['license']) ? $_POST['license'] = $this->config->base_url() . $_POST['license'] : '';
            !empty($_POST['insurance']) ? $_POST['insurance'] = $this->config->base_url() . $_POST['insurance'] : '';
            !empty($_POST['permit']) ? $_POST['permit'] = $this->config->base_url() . $_POST['permit'] : '';
            !empty($_POST['registration']) ? $_POST['registration'] = $this->config->base_url() . $_POST['registration'] : '';
            $this->response(array("status" => "success", "data" => $_POST));
        } else {
            $this->response(array("status" => "fail"));
        }
    }

    public function nearby_get() {

        empty($_GET['limit']) ? $limit = 50000 : $limit = $_GET['limit'];
        $query = $this->db->query("select user_id,name,email,latitude,longitude,vehicle_info,(((acos(sin((" . $_GET['lat'] . "*pi()/180)) *
        sin((`latitude`*pi()/180))+cos((" . $_GET['lat'] . "*pi()/180)) *
        cos((`latitude`*pi()/180)) * cos(((" . $_GET['long'] . "-
        `longitude`)*pi()/180))))*180/pi())*60*1.1515*1.609344) 
        as distance
from users where utype=1 and is_online = 1 HAVING distance < $limit order by distance asc");

        $res = $query->result();

        $fares = $this->db->get_where("settings", array("name" => "FARE"));
        $unit = $this->db->get_where("settings", array("name" => "UNIT"));

        $this->response(array("status" => "success", "fair" => array("cost" => $fares->result()[0]->value, "unit" => $unit->result()[0]->value), "data" => $res));
    }

    public function addRide_post() {

        $this->db->insert("rides", $_POST);
        $_POST['id'] = $this->db->insert_id();
        $cnt = $this->db->affected_rows();

        if ($cnt > 0) {

            $this->db->select("gcm_token");
            $this->db->from("users u");
            $this->db->join("rides r", "r.driver_id = u.user_id");
            $this->db->where("r.ride_id", $_POST['id']);
            $qry = $this->db->get();
            $res = $qry->row();

            $load = array();
            $load['title'] = 'Taxiapp';
            $load['msg'] = 'You have a new ride';
            $token[] = $res->gcm_token;

            $admin = $this->db->get("admin")->row();
            $this->common->android_push($token, $load, $admin->api_key);

            echo json_encode(array("status" => "success", "data" => $_POST));
        } else {
            echo json_encode(array("status" => "fail", "data" => "Error Try LAter."));
        }
    }

    public function rides_get() {

        empty($_GET['limit']) ? $limit = 50 : $limit = $_GET['limit'];
        //$res=$this->db->get_where("rides",array("user_id"=>$_GET["id"],"status"=>$_GET["status"]))->result();
        $id = $_GET["id"];
        $status = $_GET["status"];
        empty($_GET['utype']) ? $utype = 0 : $utype = $_GET['utype'];
        $wh = $utype == 0 ? "r.user_id=$id" : "r.driver_id=$id";
        $res = $this->db->query("select r.*,w.mobile as user_mobile,w.avatar as user_avatar,w1.avatar as driver_avatar,w.name as user_name,w1.mobile as driver_mobile,w1.user_id as driver_id,w1.name as driver_name from rides as r join users as w on r.user_id=w.user_id join users as w1 on r.driver_id=w1.user_id where $wh and r.status='$status' order by r.ride_id desc");


        $this->response(array("status" => "success", "data" => $res->result_array()));
    }

    public function rides_post() {
        $this->db->where("ride_id", $_POST['ride_id']);
        $this->db->update("rides", $_POST);
        $cnt = $this->db->affected_rows();
        if ($cnt > 0) {
            if (!empty($_POST['status'])) {
                if ($_POST['status'] == 'ACCEPTED') {
                    //$res = $this->db->get_where("rides", array("ride_id" => $_POST['ride_id']))->row();
                    $this->db->select("gcm_token");
                    $this->db->from("users u");
                    $this->db->join("rides r", "r.user_id = u.user_id");
                    $this->db->where("r.ride_id", $_POST['ride_id']);
                    $qry = $this->db->get();
                    $res = $qry->row();

                    $load = array();
                    $load['title'] = 'Taxiapp';
                    $load['msg'] = 'Your request accepted';
                    $token[] = $res->gcm_token;

                    $admin = $this->db->get("admin")->row();
                    $this->common->android_push($token, $load, $admin->api_key);
                }
                if ($_POST['status'] == 'CANCELLED') {
                    $qry = $this->db->query("SELECT `gcm_token` FROM (`users` u) JOIN `rides` r ON `r`.`user_id` = `u`.`user_id` OR `r`.`driver_id` = `u`.`user_id`
WHERE `r`.`ride_id` =  " . $_POST['ride_id'] . "");
                    $res = $qry->result();

                    $load = array();
                    $load['title'] = 'Taxiapp';
                    $load['msg'] = 'Your ride has been cancelled';
                    foreach ($res as $val) {
                        $token[] = $val->gcm_token;
                    }
                    $admin = $this->db->get("admin")->row();
                    $this->common->android_push($token, $load, $admin->api_key);

                    echo json_encode(array("status" => "success", "data" => "Your ride has been cancelled"));
                } elseif ($_POST['status'] == 'COMPLETED') {
                    $qry = $this->db->query("SELECT `gcm_token` FROM (`users` u) JOIN `rides` r ON `r`.`user_id` = `u`.`user_id` OR `r`.`driver_id` = `u`.`user_id`
WHERE `r`.`ride_id` =  " . $_POST['ride_id'] . "");
                    $res = $qry->result();

                    $load = array();
                    $load['title'] = 'Taxiapp';
                    $load['msg'] = 'Your ride has been completed';
                    foreach ($res as $val) {
                        $token[] = $val->gcm_token;
                    }
                    $admin = $this->db->get("admin")->row();
                    $this->common->android_push($token, $load, $admin->api_key);
                    echo json_encode(array("status" => "success", "data" => "Your ride has been completed"));
                } else {
                    echo json_encode(array("status" => "success", "data" => "Success"));
                }
            } else {
                if (!empty($_POST['payment_mode'])) {
                    $load = array();
                    if ($_POST['payment_mode'] != 'PAYPAL') {
                        $load['msg'] = 'User requested offline payment';
                    } else {
                        $load['msg'] = 'User just paid for your ride';
                    }
                    $this->db->select("gcm_token");
                    $this->db->from("users u");
                    $this->db->join("rides r", "r.driver_id = u.user_id");
                    $this->db->where("r.ride_id", $_POST['ride_id']);
                    $qry = $this->db->get();
                    $res = $qry->row();
                    
                    $load['title'] = 'Taxiapp';
                    $token[] = $res->gcm_token;

                    $admin = $this->db->get("admin")->row();
                    $this->common->android_push($token, $load, $admin->api_key);
                }
                echo json_encode(array("status" => "success", "data" => "Success"));
            }
        } else {
            echo json_encode(array("status" => "fail", "data" => "Error Try LAter."));
        }
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */