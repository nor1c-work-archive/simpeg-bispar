<?php 



class WIBU_Controller extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        // Date and time configuration
        date_default_timezone_set('Asia/Jakarta');
        $this->timestamp = date('Y-m-d H:i:s', time());
        $this->profilePhotoPath = 'public/images/users/profile_pictures/';

        // Load frequently used helpers
        $this->load->helper(
            array(
                'url',
                'simpeg_helper',
                'db_helper',
                'form',
                'file',
            )
        );

        // Load frequently used models
        $this->load->model(
            array(
                'Auth_model',
                'Master_model',
                'Users_model',
            )
        );
        
        // Load frequently used libraries
        $this->load->library(
            array(
                'form_validation',
                'session',
                'pagination',
            )
        );

        // Initial load database
        $this->load->database();
        
        // get all parameters
        $this->params = $this->input->get();

    }

}