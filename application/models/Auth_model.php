<?php



class Auth_model extends WIBU_Model {

    public function construct() {
        parent::__construct();
    }
    
    public function authCheck($nip, $password) {
        if ($nip !== NULL && $password !== NULL) {
            dbSelect($this->pegawai, '*');
            DBS()->from($this->pegawai);

            dbWhere('nip', $nip);
            dbWhere('password', $password);

            $qCheck = DBS()->get();

            if ($qCheck->num_rows()) {
                $qRow = $qCheck->row();
                
                $this->generateSession($qRow);
                return TRUE;
            } else {   
                return FALSE;
            }
        } else {
            return FALSE;
        }
    }

    public function generateSession($qRow) {
        $sessions = array(
            'nip'               => $qRow->nip,
            'nama'              => $qRow->nama,
            'tgl_lahir'         => $qRow->tgl_lahir,
            'jabatan'           => $qRow->jabatan,
            'pangkat'           => $qRow->pangkat,
            'golongan'          => $qRow->golongan,
            'password'          => $qRow->password,
            'photo'             => $qRow->photo,
            'roleID'            => $qRow->roleID,
            'authenticated'     => TRUE,
        );

        setSession($sessions);
    }

    public function getUserPhoto($nip) {
        dbSelect($this->pegawai, array('photo'));
        dbWhere('nip', $nip);
        DBS()->from($this->pegawai);
        $data = DBS()->get()->result_array()[0]['photo'];
        return $data;
    }

}