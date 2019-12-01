<?php



class WIBU_Model extends CI_Model {

    public function __construct() {
        parent::__construct();

        $this->table = array(
            'pegawai' => 'pegawai',
            'golongan' => 'ref_golongan',
            'pangkat' => 'ref_pangkat',
            'jabatan' => 'ref_jabatan_khusus',
            'promotion' => 'promotion_activity',
            'retirement' => 'retirement_activity',
            'documents' => 'activity_documents',
            'notification' => 'notification',
            'role' => 'role',
            'roleAccess' => 'role_has_access',
        );

        foreach($this->table as $key => $tbl) {
            $this->{$key} = $tbl;
        }
    }

}