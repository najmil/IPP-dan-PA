<?php

namespace App\Models;

use CodeIgniter\Model;

// Model merupakan parents model
class IsiSaveModel extends Model{
    protected $table = "isi_ipp_save";
    protected $useTimestamps = true;
    protected $primaryKey = "id";
    protected $allowedFields = ['id_main', 'program', 'weight', 'midyear', 'midyear_achv', 'midyear_achv_score', 'midyear_achv_total', 'oneyear', 'oneyear_achv', 'oneyear_achv_score', 'oneyear_achv_total', 'duedate'];

    public function getIsi($id_main = null) {
        if ($id_main === null) {
            return $this->findAll();
        } else {
            $result = $this->select('isi_ipp_save.*, main.id AS id_main, main.created_by AS field1, main.nama AS field2, main.approval_kasie, main.approval_kadept, main.approval_kadiv, main.approval_bod, main.approval_presdir')
                ->join('main', 'main.id = isi_ipp_save.id_main')
                ->where(['isi_ipp_save.id_main' => $id_main])
                ->findAll();
    
            return $result ? $result : [];
        }
    }

}

?>