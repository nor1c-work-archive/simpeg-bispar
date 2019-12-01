<?php

class Pangkat extends WIBU_Controller {

    public $module;
    protected $model = 'Pangkat_model';

    public function __construct() {
        parent::__construct();
        $this->load->model(array($this->model));
        $this->module           = uriSegment(1);
        $this->page             = 'pages/'.$this->module.'/';
        $this->columns          = array('pangkat' => 'Pangkat');
        $this->pk               = 'pangkat';
    }

    public function index() {
        $data['columns'] = $this->columns;
        if (inputGet('filterKey')) {
            $filterKey      = inputGet('filterKey');
            $filterKeyword  = inputGet('filterKeyword');
            
            $data['dataUrl']    = site_url($this->module.'/getAll?filterKey='.$filterKey.'&filterKeyword='.$filterKeyword);
        } else {
            $data['dataUrl']    = site_url($this->module.'/getAll');
        }
        render($this->page.'pangkat', $data);
    }

    public function getAll() {
        $data       = $this->{$this->model}->getAll();
        
        generateDataTable($data, $this->columns, $this->pk, $this->model);
    }

}