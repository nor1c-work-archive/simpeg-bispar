<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Index extends WIBU_Controller {

	public function __construct() {
		parent::__construct();
	}
	
	public function index() {
		render();
	}
}
