<?php

class Auth extends WIBU_Controller {

    public function __construct() {
        parent::__construct();
    }

    public function in() {
        $nip        = inputPost('nip');
        $password   = md5(inputPost('password'));

        $authenticated = $this->Auth_model->authCheck($nip, $password);
        redirect();
    }

    public function out() {
        $this->session->sess_destroy();
        redirect('');
    }

}