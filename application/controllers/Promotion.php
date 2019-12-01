<?php

class Promotion extends WIBU_Controller {

    public $module;
    protected $model = 'Promotion_model';

    public function __construct() {
        parent::__construct();
        $this->load->model(array($this->model));
        $this->module               = uriSegment(1);
        $this->page                 = 'pages/'.$this->module.'/';
        $this->columns              = array('requestStatus' => 'Status', 'promotionReqID' => 'Task Code', 'nip' => 'NIP Pemohon', 'nama' => 'Nama Pemohon', 'currentGolongan' => 'Golongan Lama', 'promotionGolongan' => 'Golongan Baru', 'currentSK' => 'SK Lama', 'promotionSK' => 'SK Baru', 'createdDate' => 'Tanggal Permohonan', 'adminReviewName' => 'Nama Pelaksana', 'approved' => 'Keputusan');
        $this->pk                   = 'activityID';
        $this->documentPath         = 'public/documents/promotion/';
        $this->numberOfDocuments    = env('PROMOTION_DOC');
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

        render($this->page.'promotion', $data);
    }

    public function getAll() {
        $data = $this->{$this->model}->getAll();
        
        generateDataTable($data, $this->columns, $this->pk, $this->model);
    }

    public function form() {
        if ($_POST) { // apakah dia ngesubmit form
            $data = $this->grabFormInput(); // func grabFormInput
            ifProcessed($this->module, $this->model, 'insertOrUpdate', $data, $this->mode, $this->mode);
        } else { // new form atau edit
            $this->renderForm(); // ngarah ke func renderForm
        }
    }

    public function renderForm()
    {
        $this->load->model(array('Golongan_model',  'Employee_model')); // biar bisa dipake di code selanjutnya

        $pk = uriSegment(4); // id = uri segment ke 4, kosong ? sama dengan ''

        // ambil informasi aja dari constructor
        $data['documentPath']       = $this->documentPath;
        $data['numberOfDocuments']  = $this->numberOfDocuments;

        if ($pk) { // ada isinya apa nggak, berarti edit, kalo ada isinya :
            $data['automaticFill']  = $this->{$this->model}->getSingleData($pk); // ngambil dari tabel promotion_activity
            $data['documents']      = $this->{$this->model}->getUploadedDocuments($pk); // ngambil dari tabel activity_document
        } else // berarti add baru
            $data['automaticFill']   = $this->Employee_model->getSingleData(sessData('nip')); // ngambil informasi dari tabel pegawai

        $data['golongan']   = $this->Golongan_model->getAllSelection(); // ngambil daftar golongan dari tabel golongan

        render($this->page . 'form', $data); // $this->load->view(viewnya, $data);
    }

    public function grabFormInput($photoFileName = '') {
        if ($this->mode == 'report') {
            $data = array(
                'edit'              => inputPost('edit'),
                'adminReviewNIP'    => inputPost('adminReviewNIP'), // siapa admninnya
                'startReviewTime'   => inputDate(inputPost('startReviewTime')), // adminnya review tgl jam berapa
                'requestStatus'     => inputPost('requestStatus'), // status pemeriksaan, open apa sedang di periksa dokumennya
                'mark'              => inputPost('mark'), // keterangan
                'approved'          => inputPost('approved'), // select, approve reject, Y / N
                'newSK'             => $_FILES['newSK'], // dari file SK

                // for employee promotion purpose only
                'userRequestNIP'    => inputPost('nip'), // buat parameter update tabel data pegawai yg ngajuin
                'promotionSK'       => inputDate(inputPost('promotionSK')), // SK barunya, diupdate ke tabel pegawai
                'promotionGolongan' => inputPost('promotionGolongan'), // golongan barunya si pegawai
            );
        } else {
            $data = array(
                'edit'              => inputPost('edit'), // bukan dari database
                'userRequestNIP'    => inputPost('nip'),
                'currentSK'         => inputDate(inputPost('tmt_sk_terakhir')),
                'promotionSK'       => inputDate(inputPost('promotionSK')),
                'currentGolongan'   => inputPost('golongan'),
                'promotionGolongan' => inputPost('promotionGolongan'),
                'documentName'      => inputPost('documentName'),
                'documentFile'      => $_FILES['documentPath'],
            );
        }
        return $data;
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

        $data['documentPath']       = $this->documentPath;
        $data['documents'] = $this->{$this->model}->getUploadedDocuments($pk);
        
        render($this->page.'detail', $data, FALSE);
    }

    public function rekapSelector() {
        if (inputGet('print')) { 
            $this->{$this->model}->rekap(inputGet());
        } else {
            render($this->page.'rekapSelector', NULL, FALSE);
        }
    }

}