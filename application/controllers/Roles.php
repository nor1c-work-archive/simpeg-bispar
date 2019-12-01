<?php

class Roles extends WIBU_Controller {

    public $module;
    protected $model = 'Role_model';

    public function __construct() {
        parent::__construct();
        $this->load->model(array($this->model));
        $this->module           = uriSegment(1);
        $this->page             = 'pages/'.$this->module.'/';
        $this->columns          = array('roleName' => 'Role');
        $this->pk               = 'roleID';
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
        render($this->page.'role', $data);
    }

    public function getAll() {
        $data       = $this->{$this->model}->getAll();
        
        generateDataTable($data, $this->columns, $this->pk, $this->model);
    }

    public function form() {
        if ($_POST) {
            $data = $this->input->post();
            
            ifProcessed($this->module, $this->model, 'insertOrUpdate', $data);
        } else 
            $this->renderForm();
    }
    
    public function grabFormInput($photoFileName = '') {
        $data = array(
            'edit'          => inputPost('edit'),
            'nip'           => inputPost('nip'),
            'nama'          => inputPost('nama'),
            'tempat_lahir'  => inputPost('tempat_lahir'),
            'tgl_lahir'     => inputDate(inputPost('tgl_lahir')),
            'no_telp'       => inputPost('no_telp'),
            'photo'         => !in_array(inputPost('photo'), array('', 'removed')) ? $photoFileName : NULL,

            'tmt_sk_terakhir'   => inputDate(inputPost('tmt_sk_terakhir')),
            'perguruan_tinggi'  => inputPost('perguruan_tinggi'),
            'pendidikan'        => inputPost('pendidikan'),
            'tahun_pendidikan'  => inputPost('tahun_pendidikan'),

            'golongan'  => inputPost('golongan'),
            'pangkat'   => inputPost('pangkat'),
            'jabatan'   => inputPost('jabatan'),
        );
        return $data;
    }

    public function renderForm() {
        $pk = uriSegment(3);
        
        $data['data'] = NULL;
        if ($pk) {
            $data['data']       = $this->{$this->model}->getSingleData($pk);
            $data['accesses']   = $this->{$this->model}->getRoleAccess($pk);
        }

        render($this->page.'form', $data);
    }

    public function delete() {
        $pk = inputGet('ids');

        $this->{$this->model}->delete($pk);
    }

}