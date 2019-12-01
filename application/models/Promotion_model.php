<?php

class Promotion_model extends WIBU_Model {

    protected $protectedColumns = array();
    protected $pk_column = 'activityID';

    protected $column_order   = array(null, null, 'activityID', 'activityID', 'nip', 'nama', 'currentGolongan', 'promotionGolongan', 'currentSK', 'promotionSK', 'createdDate', 'adminReviewName', 'approved');
    protected $column_search  = array('activityID', 'activityID', 'nip', 'nama', 'currentGolongan', 'promotionGolongan', 'currentSK', 'promotionSK', 'createdDate', 'adminReviewName', 'approved');
    protected $order          = array('createdDate' => 'desc');

    public function construct() {
        parent::__construct();
    }

    public function selectedColumn() {
        dbSelect($this->promotion, '*');
        dbSelect($this->promotion, array('activityID' => 'promotionReqID'));
        dbSelect($this->pegawai, array('nip', 'nama'));
        dbSelect('PA', array('nama' => 'adminReviewName'));
    }

    public function selectedTable() {
        DBS()->from($this->promotion);
        DBS()->join($this->pegawai, "$this->promotion.userRequestNIP=$this->pegawai.nip", 'left');
        DBS()->join($this->pegawai.' PA', "$this->promotion.adminReviewNIP=PA.nip", 'left');
        // DBS()->group_by("$this->promotion.$this->pk_column");
    }
    
    public function getAll() {
        $this->dataTableQuery();

        if (inputGet('mode') == 'report') {
            dbWhere('adminReviewNIP !=', 'NULL');
        }

        if($_POST['length'] != -1)
            DBS()->limit($_POST['length'], $_POST['start']);

        $query = DBS()->get();
        return $query->result();
    }

    public function getSingleData($pk) {
        $this->selectedColumn();

        dbWhere($this->promotion.'.'.$this->pk_column, $pk);

        $this->selectedTable();

        $data = DBS()->get()->result();
        return $data;
    }
 
    public function countAll() {
        $this->selectedTable();
        return DBS()->count_all_results();
    }

    public function countFiltered() {
        $this->dataTableQuery();

        $query = DBS()->get();
        return $query->num_rows();
    }

    private function dataTableQuery() {
        $this->selectedColumn();
        $this->selectedTable();

        if (inputGet('filterKey')) {
            if (in_array(inputGet('filterKey'), array('nip', 'nama'))) {
                DBS()->like($this->pegawai.'.'.inputGet('filterKey'), inputGet('filterKeyword'));
            } else {
                DBS()->like(inputGet('filterKey'), inputGet('filterKeyword'));
            }
        }
 
        $i = 0;
     
        foreach ($this->column_search as $item) {
            if($_POST['search']['value']) {

                if($i===0) {
                    DBS()->group_start(); 
                    DBS()->like($item, $_POST['search']['value']);
                } else {
                    if (in_array($item, array('nip', 'nama'))) {
                        DBS()->or_like($this->pegawai.'.'.$item, $_POST['search']['value']);
                    } else if ($item == 'adminReviewName') {
                        DBS()->or_like('PA.nama', $_POST['search']['value']);
                    } else {
                        DBS()->or_like($item, $_POST['search']['value']);
                    }
                    
                    if (strpos('TPR-', $_POST['search']['value']) !== TRUE) {
                        $search_query = str_replace('TPR-', '', $_POST['search']['value']);
                        $search_query = ltrim($search_query, '0');
                        DBS()->or_like($this->promotion.'.activityID', $search_query);
                    } 
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

    public function insertOrUpdate($data, $mode) { // proses insert ke database
        $userRequestNIP = $data['userRequestNIP'];

        $isEdit = $data['edit']; // $data['edit], >=1 atau 0, >=1 = TRUE : 0 = FALSE;
        unset($data['edit']);

        if ($mode == 'request') { // request
            $documentName = $data['documentName']; // nama filenya
            $documentFile = $data['documentFile']; // filenya, $_FILES

            unset($data['documentName']); // bukan bagian dari tabel promotion
            unset($data['documentFile']);
        } else { // mode report
            $skFile = $data['newSK'];
            unset($data['newSK']);

            if ($data['approved'] != 'Y') { // diapprove apa nggak, kalau nggak :
                unset($data['userRequestNIP'], $data['promotionSK'], $data['promotionGolongan']);
            }
        }

        if ($isEdit) { // jika edit :
            $data['lastUpdated'] = date('Y-m-d H:i:s', time());
            $activityID = $isEdit; // bool, >=1,  3 = TRUE, 0 = FALSE

            dbWhere($this->pk_column, $activityID); // $this->db->where('activityID', 3)
            DBS()->update($this->promotion, $data); // $this->db->update('tabel', 'datanya')

            $isSuccess  = DBS()->affected_rows(); // kalo berhasil : actID : 3, kalo gagal : 0

            if ($mode == 'request') { // ini buat update file yang salah / replace
                $uploadedDocs = array();
                for ($i=1; $i <= env('PROMOTION_DOC'); $i++) { 
                    if ($documentFile['tmp_name'][$i] != '') {
                        $uploadedDocs[] = $i;
                    }
                }
            }

            if ($mode == 'request') {
                if (!empty($uploadedDocs)) {
                    $this->processDocuments($activityID, $documentName, $documentFile, 'Required Documents', $isEdit);
                }
            } else {
                if ($skFile['tmp_name'][env('PROMOTION_DOC')+1] != '') { // buat SK doang
                    $this->processDocuments($activityID, 'SK', $skFile, 'SK', $isEdit); // insert dokumen SKnya

                    $sk = array( // insert notifikasi kalau SK udah diupload
                        'activityType' => 'Promotion',
                        'activityID' => $activityID,
                        'requester' => $userRequestNIP,
                        'updatedBy' => sessData('nama'),
                        'content' => 'File SK diupload',
                        'time' => date('Y-m-d H:i:s', time())
                    );
                    DBS()->insert($this->notification, $sk);
                }

                if ($data['approved'] == 'Y') { // approve apa nggak, kalo diapprove
                    $this->promoteEmployee($data['userRequestNIP'], $data['promotionSK'], $data['promotionGolongan']); // promote pegawai ke golongan & SK baru
                }
            }

            if (!empty($uploadedDocs)) { // insert notifikasi dokumen yg salah udah diperbarui
                $update = array(
                    'activityType' => 'Promotion',
                    'activityID' => $activityID,
                    'requester' => $userRequestNIP,
                    'updatedBy' => sessData('nama'),
                    'content' => 'Update Dokumen',
                    'time' => date('Y-m-d H:i:s', time())
                );
                DBS()->insert($this->notification, $update);
            }
        } else { // ini buat tambah
            DBS()->insert($this->promotion, $data); // $this->db->insert('tablenya', 'datanya');
            $isSuccess  = DBS()->affected_rows(); // result dari proses insertnya, berhasil : sesuai auto incrementnya, gagal : 0 (FALSE), bool : 1/TRUE, 0/FALSE
            $activityID = DBS()->insert_id(); // dapeting value auto incrementnya
            // disini udah kelar insert data textnya ke tabel promotion

            $this->processDocuments($activityID, $documentName, $documentFile, 'Required Documents'); // proses/upload documentnnya
        }
        
        if ($isSuccess) {
            // initialize notification
            if ($data['mark'] != '') { // insert notifikasi, apa yg dilakukan admin
                $mark = array(
                    'activityType' => 'Promotion',
                    'activityID' => $activityID,
                    'requester' => $userRequestNIP,
                    'updatedBy' => sessData('nama'),
                    'content' => $data['mark'],
                    'time' => date('Y-m-d H:i:s', time())
                );
                DBS()->insert($this->notification, $mark); // insert ke notifikasi
            }
        }

        return $isSuccess;
    }

    public function processDocuments($activityID, $documentName, $documentFile, $documentType, $isEdit = FALSE) {
        foreach ($documentFile['tmp_name'] as $key => $value) {
            if ($documentFile['tmp_name'][$key] != '') { // jika tidak kosong, maka di proses
                // delete from database and directory
                if ($isEdit != FALSE && $documentType != 'SK') { // dipake pas edit doang
                    $this->deleteDocuments($activityID, $key);
        
                    dbWhere($this->pk_column, $activityID);
                    dbWhere('activityType', 'Promotion');
                    dbWhere('documentNumber', $key);
                    DBS()->delete($this->documents);
                }
                
                // update new image
                $config['upload_time'] = date('Y-m-d H:i:s', time());
                $config['file_name']   = date('Y-m-d H-i-s', strtotime($config['upload_time'])) . $documentFile['name'][$key];
                $config['upload_path'] = 'public/documents/promotion/'.$config['file_name'];
    
                move_uploaded_file($documentFile['tmp_name'][$key], $config['upload_path']); // ditulis dulu ke folder webnya
    
                $documents = array(
                    'activityType'  => 'Promotion',
                    'activityID'    => $activityID,
                    'uploadedBy'    => sessData('nip'),
                    'documentNumber'=> $key,
                    'documentName'  => $documentName[$key],
                    'documentType'  => $documentType,
                    'documentPath'  => $config['file_name'],
                    'uploadTime'    => $config['upload_time'],
                );

                DBS()->insert($this->documents, $documents); // $this->db->insert('table', 'datanya');
            }
        }
    }

    public function promoteEmployee($employeeNIP, $promotionSK, $promotionGolongan) {
        $promotionData = array(
            'tmt_sk_terakhir'   => $promotionSK,
            'golongan'          => $promotionGolongan,
        );

        dbWhere('nip', $employeeNIP); // $this->db->where('nip', 1902)
        DBS()->update($this->pegawai, $promotionData); 
        return DBS()->affected_rows(); // 1902 : TRUE, gagal : 0
    }

    public function deleteDocuments($activityID, $documentNumber = NULL) {
        dbSelect($this->documents, array('documentPath'));
        dbWhere($this->pk_column, $activityID);
        dbWhere('activityType', 'Promotion');
        dbWhere('documentNumber', $documentNumber);

        DBS()->from($this->documents);
        $files = DBS()->get()->result_array();

        foreach ($files as $key => $file) {
            if (file_exists('public/documents/promotion/'.$file['documentPath'])) {
                unlink('public/documents/promotion/'.$file['documentPath']);
            }
        }
    }

    public function delete($pk) {
        if (strpos($pk, ',') !== false) {
            $pk = explode(',', $pk);
            
            DBS()->where_in($this->pk_column, $pk);
            DBS()->delete($this->promotion);
        } else {
            $this->deleteDocuments($pk);

            dbWhere($this->pk_column, $pk);
            dbWhere('activityType', 'Promotion');
            DBS()->delete($this->documents);

            DBS()->where($this->pk_column, $pk);
            DBS()->delete($this->promotion);
        }

        echo json_encode(DBS()->affected_rows());
    }

    public function detail($pk) {
        $this->selectedColumn();
        dbWhere($this->promotion.'.'.$this->pk_column, $pk);
        $this->selectedTable();

        $data = DBS()->get()->result_array();

        return $data;
    }

    public function getUploadedDocuments($activityID) {
        dbSelect($this->documents, '*');
        dbWhere($this->pk_column, $activityID);
        dbWhere('activityType', 'Promotion');
        DBS()->from($this->documents);
        DBS()->order_by('documentNumber', 'ASC');

        $data = DBS()->get()->result_array();
        
        return $data;
    }
    
    public function rekap($data) {
        if ($data['firstCreatedDate'] != '')
            dbWhere('YEAR(tgl_lahir) >=', $data['firstCreatedDate']);

        if ($data['lastCreatedDate'] != '')
            dbWhere('YEAR(tgl_lahir) <=', $data['lastCreatedDate']);

        if ($data['retirementStatus'] != '')
            dbWhere('isRetired', $data['retirementStatus']);

        unset($data['print'], $data['firstCreatedDate'], $data['lastCreatedDate'], $data['retirementStatus']);

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