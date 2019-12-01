<?php

class Retirement_model extends WIBU_Model {

    protected $protectedColumns = array();
    protected $pk_column = 'activityID';

    protected $column_order   = array(null, null, 'activityID', 'activityID', 'nip', 'nama', 'currentGolongan', 'currentSK', 'createdDate', 'adminReviewName', 'approved');
    protected $column_search  = array('activityID', 'activityID', 'nip', 'nama', 'currentGolongan', 'currentSK', 'createdDate', 'adminReviewName', 'approved');
    protected $order          = array('createdDate' => 'desc');

    public function construct() {
        parent::__construct();
    }

    public function selectedColumn() {
        dbSelect($this->retirement, '*');
        dbSelect($this->retirement, array('activityID' => 'retirementReqID'));
        dbSelect($this->pegawai, array('nip', 'nama', 'tgl_lahir'));
        dbSelect('PA', array('nama' => 'adminReviewName'));
    }

    public function selectedTable() {
        DBS()->from($this->retirement);
        DBS()->join($this->pegawai, "$this->retirement.userRequestNIP=$this->pegawai.nip", 'left');
        DBS()->join($this->pegawai.' PA', "$this->retirement.adminReviewNIP=PA.nip", 'left');
        // DBS()->group_by("$this->retirement.$this->pk_column");
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

        dbWhere($this->retirement.'.'.$this->pk_column, $pk);

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
                    
                    if (strpos('TRT-', $_POST['search']['value']) !== TRUE) {
                        $search_query = str_replace('TRT-', '', $_POST['search']['value']);
                        $search_query = ltrim($search_query, '0');
                        DBS()->or_like($this->retirement.'.activityID', $search_query);
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

    public function insertOrUpdate($data, $mode) {
        $isEdit = $data['edit'];
        unset($data['edit']);

        if ($mode == 'request') {
            $documentName = $data['documentName'];
            $documentFile = $data['documentFile'];

            unset($data['documentName']);
            unset($data['documentFile']);
        } else {
            $skFile = $data['newSK'];

            unset($data['newSK']);

            if ($data['approved'] != 'Y') {
                unset($data['userRequestNIP'], $data['retirementSK'], $data['retirementGolongan']);
            }
        }

        if ($isEdit) {
            $data['lastUpdated'] = date('Y-m-d H:i:s', time());
            $activityID = $isEdit;

            dbWhere($this->pk_column, $activityID);

            DBS()->update($this->retirement, $data);
            $isSuccess  = DBS()->affected_rows();
            
            if ($mode == 'request') {
                if ($documentFile['tmp_name'][1] != '' || $documentFile['tmp_name'][2] != '' || $documentFile['tmp_name'][3] != '' || $documentFile['tmp_name'][4] != '' || $documentFile['tmp_name'][5] != '' || $documentFile['tmp_name'][6] != '' || $documentFile['tmp_name'][7] != '' || $documentFile['tmp_name'][8] != '' || $documentFile['tmp_name'][9] != '' || $documentFile['tmp_name'][10] != '' || $documentFile['tmp_name'][11] != '') {
                    $this->processDocuments($activityID, $documentName, $documentFile, 'Required Documents', $isEdit);
                }
            } else {
                if ($skFile['tmp_name'][12] != '') {
                    $this->processDocuments($activityID, 'SK', $skFile, 'SK', $isEdit);
                }

                if ($data['approved'] == 'Y') {
                    $this->retireEmployee($data['userRequestNIP']);
                }
            }
            
            if ($mode == 'request') {
                $update = array(
                    'activityType' => 'Retirement',
                    'activityID' => $activityID,
                    'requester' => $userRequestNIP,
                    'updatedBy' => sessData('nama'),
                    'content' => 'Update Dokumen',
                    'time' => date('Y-m-d H:i:s', time())
                );

                DBS()->insert($this->notification, $update);
            }
        } else {
            DBS()->insert($this->retirement, $data);
            $isSuccess  = DBS()->affected_rows();
            $activityID = DBS()->insert_id();

            $this->processDocuments($activityID, $documentName, $documentFile, 'Required Documents');
        }

        if ($isSuccess) {
            // initialize notification
            if ($data['mark'] != '') {
                $mark = array(
                    'activityType' => 'Retirement',
                    'activityID' => $activityID,
                    'requester' => $userRequestNIP,
                    'updatedBy' => sessData('nama'),
                    'content' => $data['mark'],
                    'time' => date('Y-m-d H:i:s', time())
                );

                DBS()->insert($this->notification, $mark);
            }
        }

        return $isSuccess;
    }

    

    public function processDocuments($activityID, $documentName, $documentFile, $documentType, $isEdit = FALSE) {
        foreach ($documentFile['tmp_name'] as $key => $value) {
            if ($documentFile['tmp_name'][$key] != '') {
                // delete from database and directory
                if ($isEdit != FALSE && $documentType != 'SK') {
                    $this->deleteDocuments($activityID, $key);
        
                    dbWhere($this->pk_column, $activityID);
                    dbWhere('activityType', 'Retirement');
                    dbWhere('documentNumber', $key);
                    DBS()->delete($this->documents);
                } else {
                    $this->deleteDocuments($activityID, $key);

                    dbWhere($this->pk_column, $activityID);
                    dbWhere('activityType', 'Retirement');
                    dbWhere('documentType', 'SK');
                    DBS()->delete($this->documents);
                }
                
                // update new image
                $config['upload_time'] = date('Y-m-d H:i:s', time());
                $config['file_name']   = date('Y-m-d H-i-s', strtotime($config['upload_time'])) . $documentFile['name'][$key];
                $config['upload_path'] = 'public/documents/retirement/'.$config['file_name'];
    
                move_uploaded_file($documentFile['tmp_name'][$key], $config['upload_path']);
    
                $documents = array(
                    'activityType'  => 'Retirement',
                    'activityID'    => $activityID,
                    'uploadedBy'    => sessData('nip'),
                    'documentNumber'=> $key,
                    'documentName'  => $documentName[$key],
                    'documentType'  => $documentType,
                    'documentPath'  => $config['file_name'],
                    'uploadTime'    => $config['upload_time'],
                );

                DBS()->insert($this->documents, $documents);
            }
        }
    }

    public function retireEmployee($employeeNIP) {
        $retirementData = array(
            'isRetired'   => 1
        );

        dbWhere('nip', $employeeNIP);
        DBS()->update($this->pegawai, $retirementData);
        return DBS()->affected_rows();
    }

    public function deleteDocuments($activityID, $documentNumber = NULL) {
        dbSelect($this->documents, array('documentPath'));
        dbWhere($this->pk_column, $activityID);
        dbWhere('activityType', 'Retirement');
        if ($documentNumber) {
            dbWhere('documentNumber', $documentNumber);
        }

        DBS()->from($this->documents);
        $files = DBS()->get()->result_array();

        foreach ($files as $key => $file) {
            if (file_exists('public/documents/retirement/'.$file['documentPath'])) {
                unlink('public/documents/retirement/'.$file['documentPath']);
            }
        }
    }

    public function delete($pk) {
        if (strpos($pk, ',') !== false) {
            $pk = explode(',', $pk);

            DBS()->where_in($this->pk_column, $pk);
            DBS()->delete($this->retirement);
        } else {
            $this->deleteDocuments($pk);

            dbWhere($this->pk_column, $pk);
            dbWhere('activityType', 'Retirement');
            DBS()->delete($this->documents);

            DBS()->where($this->pk_column, $pk);
            DBS()->delete($this->retirement);
        }

        echo json_encode(DBS()->affected_rows());
    }

    public function detail($pk) {
        $this->selectedColumn();
        dbWhere($this->retirement.'.'.$this->pk_column, $pk);
        $this->selectedTable();

        $data = DBS()->get()->result_array();

        return $data;
    }

    public function getUploadedDocuments($activityID) {
        dbSelect($this->documents, '*');
        dbWhere($this->pk_column, $activityID);
        dbWhere('activityType', 'Retirement');
        DBS()->order_by('LENGTH(documentNumber)', 'ASC');
        DBS()->order_by('documentNumber', 'ASC');
        DBS()->from($this->documents);

        $data = DBS()->get()->result_array();
        
        return $data;
    }

}