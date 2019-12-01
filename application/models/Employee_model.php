<?php

class Employee_model extends WIBU_Model {

    protected $protectedColumns = array('password');
    protected $pk_column = 'nip';

    protected $column_order   = array(null, null, 'nip', 'nama','jabatan','no_telp');
    protected $column_search  = array('nip', 'nama','jabatan','no_telp');
    protected $order          = array('nip', 'nama' => 'asc'); 

    public function construct() {
        parent::__construct();
    }
    
    public function getAll() {
        $this->dataTableQuery();

        if($_POST['length'] != -1)
            DBS()->limit($_POST['length'], $_POST['start']);

        $query = DBS()->get();
        return $query->result();
    }

    public function getSingleData($pk) {
        dbSelect($this->pegawai, '*');
        dbWhere('nip', $pk);
        DBS()->from($this->pegawai);

        $data = DBS()->get()->result();
        return $data;
    }
 
    public function countAll() {
        DBS()->from($this->pegawai);
        return DBS()->count_all_results();
    }

    public function countFiltered() {
        $this->dataTableQuery();

        $query = DBS()->get();
        return $query->num_rows();
    }

    private function dataTableQuery() {

        DBS()->from($this->pegawai);
        DBS()->join($this->golongan, "$this->golongan.golongan=$this->pegawai.golongan", 'left');

        if (inputGet('filterKey')) {
            DBS()->like($this->input->get('filterKey'), $this->input->get('filterKeyword'));
        }
 
        $i = 0;
     
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {
                 
                if($i===0) {
                    DBS()->group_start(); 
                    DBS()->like($item, $_POST['search']['value']);
                } else {
                    DBS()->or_like($item, $_POST['search']['value']);
                }
 
                if(count($this->column_search) - 1 == $i) 
                    DBS()->group_end(); 
            }
            $i++;
        }
         
        if(isset($_POST['order']))  {
            DBS()->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if(isset($this->order)) {
            $order = $this->order;
            DBS()->order_by(key($order), $order[key($order)]);
        }
    }

    public function insertOrUpdate($data) {
        $isEdit = $data['edit'];
        unset($data['edit']);

        if ($isEdit) {
            $data['lastUpdated'] = date('Y-m-d H:i:s', time());

            dbWhere($this->pk_column, $data['nip']);
            DBS()->update($this->pegawai, $data);
        } else {
            DBS()->insert($this->pegawai, $data);
        }

        return DBS()->affected_rows();
    }

    public function oldPasswordCheck($password, $pk) {
        dbSelect($this->pegawai, 'password');
        dbWhere($this->pk_column, $pk);
        DBS()->from($this->pegawai);
        $query = DBS()->get()->result_array()[0];

        if ($query['password'] == md5($password)) 
            echo json_encode(TRUE);
        else
            echo json_encode(FALSE);
    }

    public function delete($pk) {
        if (strpos($pk, ',') !== false) {
            $pk = explode(',', $pk);

            DBS()->where_in('nip', $pk);
            DBS()->delete($this->pegawai);
        } else {
            DBS()->where('nip', $pk);
            DBS()->delete($this->pegawai);
        }

        echo json_encode(DBS()->affected_rows());
    }

    public function detail($pk) {
        dbSelect($this->pegawai, '*'); //SELECT tbl_pegawai.*
        dbSelect($this->golongan, array('pangkat')); //SELECT tbl_golongan.pangkat
        dbWhere('nip', $pk); //WHERE tbl_pegawai.nip='$nik'
        DBS()->from($this->pegawai); //FROM tbl_pegawai
        DBS()->join($this->golongan, "$this->golongan.golongan=$this->pegawai.golongan", 'left'); //LEFT JOIN tbl_golongan ON tbl_golongan.golongan=tbl_pegawai.golongan
        $data = DBS()->get()->result_array();
        
        return $data;
    }

    public function rekap($data) {
        if ($data['firstBirthYear'] != '')
            dbWhere('YEAR(tgl_lahir) >=', $data['firstBirthYear']);

        if ($data['lastBirthYear'] != '')
            dbWhere('YEAR(tgl_lahir) <=', $data['lastBirthYear']);

        if ($data['retirementStatus'] != '')
            dbWhere('isRetired', $data['retirementStatus']);

        unset($data['print'], $data['firstBirthYear'], $data['lastBirthYear'], $data['retirementStatus']);

        foreach ($data as $key => $value) {
            if ($value != '')
                dbWhere($key, $value);
        }

        DBS()->from($this->pegawai);
        $data = DBS()->get()->result_array();

        $columns = array('nip' => 'NIP', 'nama' => 'Nama', 'tgl_lahir' => 'Tgl Lahir', 'tmt_sk_terakhir' => 'SK Terakhir', 'golongan' => 'Golongan', 'pangkat' => 'Pangkat', 'jabatan' => 'Jabatan', 'isRetired' => 'Status');

        printTable($columns, $data);
    }

}