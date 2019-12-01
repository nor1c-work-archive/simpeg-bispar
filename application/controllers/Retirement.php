<?php

class Retirement extends WIBU_Controller {

    public $module;
    protected $model = 'Retirement_model';

    public function __construct() {
        parent::__construct();
        $this->load->model(array($this->model));
        $this->module               = uriSegment(1);
        $this->page                 = 'pages/'.$this->module.'/';
        $this->columns              = array('requestStatus' => 'Status', 'retirementReqID' => 'Task Code', 'nip' => 'NIP Pemohon', 'nama' => 'Nama Pemohon', 'currentGolongan' => 'Golongan Lama', 'currentSK' => 'SK Lama', 'bup' => 'BUP', 'retSK' => 'Tmt SK', 'createdDate' => 'Tanggal Permohonan', 'adminReviewName' => 'Nama Pelaksana', 'approved' => 'Keputusan');
        $this->pk                   = 'activityID';
        $this->numberOfDocuments    = '11';
        $this->documentPath         = 'public/documents/retirement/';
        $this->mode                 = uriSegment(2);
    }

    public function index() {
        $data['columns']    = $this->columns;
        if (inputGet('filterKey')) {
            $filterKey      = inputGet('filterKey');
            $filterKeyword  = inputGet('filterKeyword');
            
            $data['dataUrl']    = site_url($this->module.'/getAll?mode='.$this->mode.'&filterKey='.$filterKey.'&filterKeyword='.$filterKeyword);
        } else {
            $data['dataUrl']    = site_url($this->module.'/getAll?mode='.$this->mode);
        }

        render($this->page.'retirement', $data);
    }

    public function getAll() {
        $data = $this->{$this->model}->getAll();
        
        generateDataTable($data, $this->columns, $this->pk, $this->model);
    }

    public function form() {
        if ($_POST) {
            $data = $this->grabFormInput();
            ifProcessed($this->module, $this->model, 'insertOrUpdate', $data, $this->mode, $this->mode);
        } else {
            $this->renderForm();
        }
    }

    public function grabFormInput($photoFileName = '') {
        if ($this->mode == 'report') {
            $data = array(
                'edit'              => inputPost('edit'),
                'adminReviewNIP'    => inputPost('adminReviewNIP'),
                'startReviewTime'   => inputDate(inputPost('startReviewTime')),
                'requestStatus'     => inputPost('requestStatus'),
                'mark'              => inputPost('mark'),
                'approved'          => inputPost('approved'),
                'newSK'             => $_FILES['newSK'],

                // for employee retirement purpose only
                'userRequestNIP'    => inputPost('nip'),
            );
        } else {
            $data = array(
                'edit'              => inputPost('edit'),
                'userRequestNIP'    => inputPost('nip'),
                'currentSK'         => inputDate(inputPost('tmt_sk_terakhir')),
                'currentGolongan'   => inputPost('golongan'),
                'documentName'      => inputPost('documentName'),
                'documentFile'      => $_FILES['documentPath'],
            );
        }
        return $data;
    }

    public function renderForm() {
        $this->load->model(array('Golongan_model', 'Pangkat_model', 'Jabatan_model', 'Employee_model'));

        $pk = uriSegment(4);
        
        $data['documentPath']       = $this->documentPath;
        $data['numberOfDocuments']  = $this->numberOfDocuments;

        if ($pk) {
            $data['automaticFill']  = $this->{$this->model}->getSingleData($pk);
            $data['documents']      = $this->{$this->model}->getUploadedDocuments($pk);
        } else
            $data['automaticFill']   = $this->Employee_model->getSingleData(sessData('nip'));

        $data['golongan']   = $this->Golongan_model->getAllSelection();
        $data['pangkat']    = $this->Pangkat_model->getAllSelection();
        $data['jabatan']    = $this->Jabatan_model->getAllSelection();

        render($this->page.'form', $data);
    }

    public function oldPasswordCheck() {
        $password   = inputPost('password');
        $pk         = inputPost('pk');

        $this->{$this->model}->oldPasswordCheck($password, $pk);
    }

    public function delete() {
        $pk = inputGet('ids');

        if (inputGet('mode') == 'report') {
            $resetData = array(
                'edit'              => $pk,
                'adminReviewNIP'    => NULL,
                'startReviewTime'   => NULL,
                'finishReviewTime'  => NULL,
                'requestStatus'     => 'Open',
                'approved'          => NULL,
                'mark'              => NULL,
            );
            ifProcessed($this->module, $this->model, 'insertOrUpdate', $resetData, 'request', $this->mode);
        } else {
            $this->{$this->model}->delete($pk);
        }
    }

    public function detail() {
        $pk     = inputGet('pk');

        $data['data'] = $this->{$this->model}->detail($pk);

        $data['documentPath']   = $this->documentPath;
        $data['documents']      = $this->{$this->model}->getUploadedDocuments($pk);
        
        render($this->page.'detail', $data, FALSE);
    }

    public function rekapSelector() {
        $this->load->model(array('Golongan_model', 'Pangkat_model', 'Jabatan_model'));
        
        $data['golongan']   = $this->Golongan_model->getAllSelection();
        $data['pangkat']    = $this->Pangkat_model->getAllSelection();
        $data['jabatan']    = $this->Jabatan_model->getAllSelection();

        render($this->page.'rekapSelector', $data, FALSE);
    }

}