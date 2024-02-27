<?php

namespace App\Models;

use CodeIgniter\Model;

class IsiModel extends Model{
    protected $table = "isi_ipp";
    protected $primaryKey = "id";
    protected $allowedFields = ['id_main', 'created_at', 'is_submitted_ipp', 'is_submitted_ipp_mid', 'is_submitted_ipp_one', 'date_submitted_ipp_mid', 'date_submitted_ipp_one', 'is_submitted', 'is_submitted_one', 'program', 'weight', 'midyear', 'midyear_achv', 'midyear_achv_score', 'midyear_achv_total', 'oneyear', 'oneyear_achv', 'oneyear_achv_score', 'oneyear_achv_total', 'duedate', 'urutan', 'kategori', 'id_kategori'];

    public function getIsi($id_main = null, $id_kategori = null) {
        if ($id_main === null) {
            return $this->findAll();
        } else {
            $query = $this->select('isi_ipp.*, main.id AS id_main, main.created_by AS field1, main.nama AS field2, main.approval_kasie, main.approval_kadept, main.approval_kadiv, main.approval_bod, main.approval_presdir')
                ->join('main', 'main.id = isi_ipp.id_main')
                ->where(['isi_ipp.id_main' => $id_main]);
    
            // if ($id_kategori !== null) {
            //     $query->where(['isi_ipp.id_kategori' => $id_kategori]);
            // }
    
            $result = $query->findAll();
    
            return $result ? $result : [];
        }
    }    

}
?>