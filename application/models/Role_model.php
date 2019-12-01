<?php

class Role_model extends WIBU_Model {

    protected $protectedColumns = array();
    protected $pk_column = 'roleID';

    protected $column_order   = array(null, null, 'roleName' => 'Role');
    protected $column_search  = array('roleName' => 'Role');
    protected $order          = array('roleName' => 'asc'); 

    public function construct() {
        parent::__construct();
    }
    
    public function getAllSelection() {
        dbSelect($this->role, '*');
        DBS()->from($this->role);

        $query = DBS()->get();
        return $query->result_array();
    }
    
    public function getAll() {
        $this->dataTableQuery();

        if($_POST['length'] != -1)
            DBS()->limit($_POST['length'], $_POST['start']);

        $query = DBS()->get();
        return $query->result();
    }

    public function getSingleData($pk) {
        dbSelect($this->role, '*');
        dbWhere('roleID', $pk);
        DBS()->from($this->role);

        $data = DBS()->get()->result();
        return $data;
    }
 
    public function countAll() {
        DBS()->from($this->role);
        return DBS()->count_all_results();
    }

    public function countFiltered() {
        $this->dataTableQuery();

        $query = DBS()->get();
        return $query->num_rows();
    }

    private function dataTableQuery() {

        DBS()->from($this->role);

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
         
        if($_POST['order'][0]['column'] != 1)  {
            DBS()->order_by($this->column_order[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
        } else if (isset($this->order)) {
            $order = $this->order;
            DBS()->order_by(key($order), $order[key($order)]);
        }
    }

    public function insertOrUpdate($data) {
        $isEdit = $data['edit'];
        unset($data['edit']);

        $roleData = array('roleName' => $data['roleName']);

        if ($isEdit) {
            // update role first
            dbWhere($this->pk_column, $isEdit);
            DBS()->update($this->role, $roleData);

            // update access
            $accessData = array();
            foreach ($data['access'] as $access) {
                $accessData[] = array(
                    'roleID' => $isEdit,
                    'access' => $access
                );
            }

            // delete last data first
            DBS()->where($this->pk_column, $isEdit);
            DBS()->delete($this->roleAccess);

            // insert new access
            DBS()->insert_batch($this->roleAccess, $accessData);
        } else {
            // insert role first
            DBS()->insert($this->role, $roleData);
            $roleID = DBS()->insert_id();

            // update access
            $accessData = array();
            foreach ($data['access'] as $access) {
                $accessData[] = array(
                    'roleID' => $roleID,
                    'access' => $access
                );
            }

            DBS()->insert_batch($this->roleAccess, $accessData);
        }

        return DBS()->affected_rows();
    }

    function canAccess($roleID, $menu) {
        DBS()->select('*');
        DBS()->where('roleID', $roleID);
        DBS()->where('access', $menu);
        DBS()->from($this->roleAccess);

        $query = DBS()->get();
        return $query->num_rows();
    }

    function getRoleAccess($roleID) {
        DBS()->select('access');
        DBS()->where('roleID', $roleID);
        DBS()->from($this->roleAccess);

        $query = DBS()->get();
        $accesses = $query->result();

        $access = array();
        foreach ($accesses as $key => $value) {
            $access[] = $value->access;
        }

        return $access;
    }

    public function delete($pk) {
        if (strpos($pk, ',') !== false) {
            $pk = explode(',', $pk);

            DBS()->where_in('roleID', $pk);
            DBS()->delete($this->role);

            DBS()->where_in('roleID', $pk);
            DBS()->delete($this->roleAccess);
        } else {
            DBS()->where('roleID', $pk);
            DBS()->delete($this->role);

            DBS()->where('roleID', $pk);
            DBS()->delete($this->roleAccess);
        }

        echo json_encode(DBS()->affected_rows());
    }
}