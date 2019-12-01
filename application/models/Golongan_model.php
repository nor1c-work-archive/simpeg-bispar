<?php

class Golongan_model extends WIBU_Model {

    protected $protectedColumns = array();
    protected $pk_column = 'golongan';

    protected $column_order   = array(null, null, 'pangkat' => 'Pangkat');
    protected $column_search  = array('pangkat' => 'Pangkat');
    protected $order          = array('golongan' => 'asc');

    public function construct() {
        parent::__construct();
    }
    
    public function getAllSelection() {
        dbSelect($this->golongan, '*'); // $this->db->select('*') : SELECT *
        DBS()->from($this->golongan); // $this->db->from('table') : FROM golongan

        $query = DBS()->get(); // ga ada RAW SQLnya
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
        dbSelect($this->golongan, '*');
        dbWhere('golongan', $pk);
        DBS()->from($this->golongan);

        $data = DBS()->get()->result();
        return $data;
    }
 
    public function countAll() {
        DBS()->from($this->golongan);
        return DBS()->count_all_results();
    }

    public function countFiltered() {
        $this->dataTableQuery();

        $query = DBS()->get();
        return $query->num_rows();
    }

    private function dataTableQuery() {

        DBS()->from($this->golongan);

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

}