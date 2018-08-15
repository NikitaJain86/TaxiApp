<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');

class User extends CI_Controller {

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

    public function register() {
        if (!empty($_POST['email'])) {
            $dup = $this->users->chk_dup();
            if (empty($dup['cnt'])) {
                $randomString = $this->common->Generate_hash(16);
                $mail_data = $this->db->get("settings")->result();
                $_POST['random'] = $randomString;
                if (!empty($mail_data[2]->value) && !empty($mail_data[3]->value) && !empty($mail_data[4]->value) && !empty($mail_data[5]->value)) {
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => $mail_data[2]->value,
                        'smtp_port' => $mail_data[3]->value,
                        'smtp_user' => $mail_data[4]->value, // change it to yours
                        'smtp_pass' => $mail_data[5]->value, // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );


                    $body = $this->load->view("admin/mail_template", $_POST, TRUE);

                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from($mail_data[6]->value); // change it to yours
                    $this->email->to($_POST['email']); // change it to yours
                    $this->email->subject('Confirmation Registarion');
                    $this->email->message($body);
                    $send = $this->email->send();
                } else {
                    $to = $_POST['email'];
                    $subject = "Confirmation Registarion";
                    $message = $this->load->view("admin/mail_template", $_POST, TRUE);
                    $headers = "From: taxiapp@test.com";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $send = mail($to, $subject, $message, $headers);
                }
                if ($send) {
                    $_POST['random'] = $randomString;
                    $res = $this->users->user_signup();
                    if (!empty($res)) {
                        $this->load->helper('string');
                        $rand = random_string('alnum', 8) . random_string('numeric', 8) . random_string('alnum', 8) . random_string('numeric', 8);
                        $datakey = array(
                            "user_id" => $res,
                            "key" => $rand
                        );
                        $this->db->insert("keys", $datakey);
                        $cnt = $this->db->affected_rows();

                        $res = $this->db->get_where("users", array('user_id' => $res))->row_array();
                        if ($cnt > 0) {
                            $res['key'] = $rand;
                        }
                        echo json_encode(array("status" => "success", "data" => $res));
                    } else {
                        echo json_encode(array("status" => "fail", "data" => "Not Inserted"));
                    }
                    header("Content-Type:application/json");
                } else {
                    
                    echo json_encode(array("status" => "fail", "data" => "Email Not send, Please check your SMTP settings"));
                }
            } else {
                echo json_encode(array("status" => "fail", "data" => "User already registered"));
            }
        }
    }

    public function login() {

        $res = $this->users->chkLogin();
        if (!empty($res)) {
            if ($res['status'] == 0) {
                echo json_encode(array("status" => "fail", "data" => "Please first verify your account"));
                die;
            }
            if (!empty($_POST['gcm_token'])) {
                $this->db->where("email", $_POST['email']);
                $this->db->update("users", array("gcm_token" => $_POST['gcm_token']));
            }
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
            if (!empty($res['avatar'])) {
                $res['avatar'] = $this->config->base_url() . $res['avatar'];
            }
            if (!empty($res['license'])) {
                $res['license'] = $this->config->base_url() . $res['license'];
            }
            if (!empty($res['insurance'])) {
                $res['insurance'] = $this->config->base_url() . $res['insurance'];
            }
            if (!empty($res['permit'])) {
                $res['permit'] = $this->config->base_url() . $res['permit'];
            }
            if (!empty($res['registration'])) {
                $res['registration'] = $this->config->base_url() . $res['registration'];
            }
            echo json_encode(array("status" => "success", "data" => $res));
        } else {
            echo json_encode(array("status" => "fail", "data" => "Please enter valid email OR password"));
        }
    }

    public function reset_password($conf_id = null) {
        if (!empty($_POST)) {
            unset($_POST['confirm_password']);
            $_POST['random'] = '';
            $_POST['password'] = md5($_POST['password']);
            $this->db->where('user_id', $_POST['user_id']);
            $this->db->update("users", $_POST);

            echo "<h3><b style = 'color:green'>Password successfully changed, now you can login..</b></h3>";
        } else {
            $data = '';
            if (!empty($conf_id)) {
                $data['res'] = $this->db->get_where("users", array("random" => $conf_id))->row();
                if (!empty($data['res'])) {
                    $this->load->view('layout/header');
                    $this->load->view("admin/reset_password", $data);
                    //$this->load->view('layout/footer');
                } else {
                    echo "<h3><b style = 'color:red'>Error occur: Contact administration</b></h3>";
                }
            }
        }
    }

    public function confirm($conf_id = null) {
        $data = '';
        if (!empty($conf_id)) {
            $resid = $this->users->chkConfirmId($conf_id, "users");
            if (!empty($resid)) {
                $this->db->where("random", $conf_id);
                $this->db->update("users", array("status" => 1));
                echo "<h3><b style = 'color:green'>Your Registration Request is success, Now you can login with your username and password</b></h3>";
            } else {
                echo "<h3><b style = 'color:red'>User activation failed. contact to administartion</b></h3>";
            }
        }
    }

    public function forgot_password() {
        if (!empty($_POST['email'])) {
            $res = $this->db->get_where("users", array("email" => $_POST['email']))->row();
            if (!empty($res->email)) {
                $randomString = $this->common->Generate_hash(16);
                // you can set your configuration from constant file in application/config folder

                $mail_data = $this->db->get("settings")->result();
                if (!empty($mail_data[2]->value) && !empty($mail_data[3]->value) && !empty($mail_data[4]->value) && !empty($mail_data[5]->value)) {
                    $config = Array(
                        'protocol' => 'smtp',
                        'smtp_host' => $mail_data[2]->value,
                        'smtp_port' => $mail_data[3]->value,
                        'smtp_user' => $mail_data[4]->value, // change it to yours
                        'smtp_pass' => $mail_data[5]->value, // change it to yours
                        'mailtype' => 'html',
                        'charset' => 'iso-8859-1',
                        'wordwrap' => TRUE
                    );

                    $message = 'Hello <b>' . $_POST['email'] . '</b>,';
                    $message .= '<br/>';
                    $message .= 'If you want to reset your password, Click below link <br/>';
                    $message .= '';
//                $message .= "http://127.0.0.1/restaurant/" . "user/confirm/" . $randomString . "";
                    $message .= $this->config->base_url() . "user/reset_password/" . $randomString . "";

                    $this->load->library('email', $config);
                    $this->email->set_newline("\r\n");
                    $this->email->from(empty($mail_data[6]->value) ? 'taxiapp@test.com' : $mail_data[6]->value); // change it to yours
                    $this->email->to($_POST['email']); // change it to yours
                    $this->email->subject('Reset Password');
                    $this->email->message($message);
                    $send = $this->email->send();
                } else {
                    $to = $_POST['email'];
                    $subject = "Confirmation Registarion";
                    $message = 'Hello <b>' . $_POST['email'] . '</b>,';
                    $message .= '<br/>';
                    $message .= 'If you want to reset your password, Click below link <br/>';
                    $message .= '';
                    $message .= $this->config->base_url() . "user/reset_password/" . $randomString . "";
                    $headers = "From: taxiapp@test.com";
                    $headers .= "MIME-Version: 1.0\r\n";
                    $headers .= "Content-Type: text/html; charset=ISO-8859-1\r\n";
                    $send = mail($to, $subject, $message, $headers);
                }
                if ($send) {
                    $a['random'] = $randomString;
                    $this->db->where("email", $_POST['email']);
                    $this->db->update("users", $a);
                    echo json_encode(array("status" => "success", "data" => "Email send successfully"));
                } else {
                    echo json_encode(array("status" => "fail", "data" => "Email Not send, Try again"));
                }
            } else {
                echo json_encode(array("status" => "fail", "data" => "Email not registered"));
            }
        }
    }

    public function logout() {
        $this->session->sess_destroy();
        $this->load->view('main');
    }

}

/* End of file welcome.php */
    /* Location: ./application/controllers/welcome.php */