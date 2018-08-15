
<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class Driver extends CI_Controller {

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
        //$this->load->model("mc_common");
        //$this->load->library("common");
        $this->load->library('session');
    }

    public function register($type = NULL) {
        if (!empty($_POST['email'])) {
            //error_reporting(E_ERROR | E_PARSE);
            $dup = $this->win_driver->chk_dup();
            if (empty($dup['cnt'])) {
                $res = $this->win_driver->driver_signup();
                header("Content-Type:application/json");
                if (!empty($res)) {
                    $this->load->helper('string');
                    $rand = random_string('alnum', 8) . random_string('numeric', 8) . random_string('alnum', 8) . random_string('numeric', 8);
                    $datakey = array(
                        "user_id" => $res,
                        "key" => $rand
                    );
                    $this->db->insert("keys", $datakey);
                    $cnt = $this->db->affected_rows();

                    $res = $this->db->get_where("win_driver", array('driver_id' => $res))->row_array();
                    if ($cnt > 0) {
                        $res['key'] = $rand;
                    }
                    echo json_encode(array("status" => "success", "data" => $res));
                } else {
                    echo json_encode(array("status" => "fail", "data" => "Not Inserted"));
                }
//                    } else {
//                        echo json_encode(array("status" => "fail", "data" => "Mail not send"));
//                    }
            } else {
                echo json_encode(array("status" => "fail", "data" => "Already Registered"));
            }
        }
    }

    public function nearBy() {
        $res = $this->win_driver->getNearBy();
        if (!empty($res)) {
            echo json_encode(array("status" => "success", "data" => $res));
        } else {
            echo json_encode(array("status" => "fail"));
        }
    }

    public function login() {
        if ($_GET["is_mobile"]) {
            $res = $this->win_driver->chkLogin();
            if (!empty($res)) {
                unset($res['password']);
                $this->load->helper('string');
                $rand = random_string('alnum', 8) . random_string('numeric', 8) . random_string('alnum', 8) . random_string('numeric', 8);
                $str = $this->db->query("select user_id from `keys` where user_id = '" . $res['id'] . "'");
                $row = $str->row_array();
                if (!empty($row)) {
                    $data = array(
                        "user_id" => $res['user_id'],
                        "key" => $rand
                    );
                    $this->db->where("user_id", $res['user_id']);
                    $this->db->update("keys", $data);
                } else {
                    $data = array(
                        "user_id" => $res['user_id'],
                        "key" => $rand
                    );
                    $this->db->insert("keys", $data);
                }
                $cnt = $this->db->affected_rows();
                if ($cnt > 0) {
                    $res['key'] = $rand;
                }
                echo json_encode(array("status" => "success", "data" => $res));
            } else {
                echo json_encode(array("status" => "fail"));
            }
        }
    }

    public function all() {
        $data['res'] = $this->db->get("win_driver");
        $this->load->view('layout/header');
        $this->load->view('layout/sidebar');
        $this->load->view('admin/drivers', $data);
        $this->load->view('layout/footer');
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->view('main');
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */