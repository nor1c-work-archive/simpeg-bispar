<?php

class Employee extends WIBU_Controller {

    public $module;
    protected $model = 'Employee_model';

    public function __construct() {
        parent::__construct();
        $this->load->model(array($this->model));
        $this->module           = uriSegment(1);
        $this->page             = 'pages/'.$this->module.'/';
        $this->columns          = array('nip' => 'NIP', 'nama' => 'Nama', 'pangkat' => 'Pangkat', 'no_telp' => 'No Telp');
        $this->pk               = 'nip';
        $this->retirementStatus = array('0' => 'Aktif', '1' => 'Sudah Pensiun');
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

        render($this->page.'employee', $data);
    }

    public function getAll() {
        $data       = $this->{$this->model}->getAll();
        
        generateDataTable($data, $this->columns, $this->pk, $this->model);
    }

    public function form() {
        if ($_POST) {
            $photo = inputPost('photo');
            if ($photo && $photo != 'removed') {
                // note, please change post_max_size to upload the images
                define('UPLOAD_DIR', $this->profilePhotoPath);
                $img = $photo;
                $img = str_replace('data:image/png;base64,', '', $img);
                $img = str_replace(' ', '+', $img);
                $data = base64_decode($img);
                $filename = uniqid() . '.png';
                $file = UPLOAD_DIR . $filename;
                $uploadStatus = file_put_contents($file, $data);

                if ($uploadStatus) {
                    $data = $this->grabFormInput($photo, $filename);
                } else {
                    return false;
                }
            } else {
                $data = $this->grabFormInput($photo);
            }
            
            if (inputPost('new_password')) {
                $data['password'] = md5(inputPost('new_password'));
            }

            ifProcessed($this->module, $this->model, 'insertOrUpdate', $data, '', NULL, inputPost('f'));
        } else {
            $this->renderForm();
        }
    }

    public function grabFormInput($photo, $photoFileName = '') {
        $data = array(
            'edit'          => inputPost('edit'),
            'nip'           => inputPost('nip'),
            'nama'          => inputPost('nama'),
            'tempat_lahir'  => inputPost('tempat_lahir'),
            'tgl_lahir'     => inputDate(inputPost('tgl_lahir')),
            'no_telp'       => inputPost('no_telp'),

            'tmt_sk_terakhir'   => inputDate(inputPost('tmt_sk_terakhir')),
            'perguruan_tinggi'  => inputPost('perguruan_tinggi'),
            'pendidikan'        => inputPost('pendidikan'),
            'tahun_pendidikan'  => inputPost('tahun_pendidikan'),
        );

        if ($photo) {
            $data['photo'] = !in_array($photo, array('', 'removed')) ? $photoFileName : NULL;
        }

        if (canAccess('update_position')) {
            $data['golongan']  = inputPost('golongan');
            $data['roleID'] = inputPost('roleID');
            $data['jabatan']   = inputPost('jabatan');
        }

        return $data;
    }

    public function renderForm() {
        $this->load->model(array('Golongan_model', 'Pangkat_model', 'Jabatan_model', 'Role_model'));

        $pk = uriSegment(3);
        
        if ($pk) {
            $data['data']   = $this->{$this->model}->getSingleData($pk);
        }
        $data['golongan']   = $this->Golongan_model->getAllSelection();
        $data['pangkat']    = $this->Pangkat_model->getAllSelection();
        $data['jabatan']    = $this->Jabatan_model->getAllSelection();
        $data['role']       = $this->Role_model->getAllSelection();

        render($this->page.'form', $data);
    }

    public function oldPasswordCheck() {
        $password   = inputPost('password');
        $pk         = inputPost('pk');

        $this->{$this->model}->oldPasswordCheck($password, $pk);
    }

    public function delete() {
        $pk = inputGet('ids');

        $this->{$this->model}->delete($pk);
    }

    public function uploadPhoto() {
        $photo = inputPost('image');
        print_r($photo);
    }

    public function detail() {
        $pk     = inputGet('pk');

        $data['data'] = $this->{$this->model}->detail($pk);
        render($this->page.'detail', $data, FALSE);
    }

    public function rekapSelector() {
        if (inputGet('print')) { 
            $this->{$this->model}->rekap(inputGet());
        } else {
            $this->load->model(array('Golongan_model', 'Pangkat_model', 'Jabatan_model'));
        
            $data['golongan']           = $this->Golongan_model->getAll();
            $data['pangkat']            = $this->Pangkat_model->getAll();
            $data['jabatan']            = $this->Jabatan_model->getAll();
            $data['retirementStatus']   = $this->retirementStatus;

            render($this->page.'rekapSelector', $data, FALSE);
        }
    }

}