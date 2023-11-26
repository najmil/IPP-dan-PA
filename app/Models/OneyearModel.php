<?php

namespace App\Models;

use CodeIgniter\Model;

class OneyearModel extends Model{
    protected $table = "oneyear";
    protected $primaryKey = "id";
    protected $allowedFields = ['id_main', 'is_submitted', 'program', 'weight', 'oneyear', 'oneyear_achv', 'oneyear_achv_score', 'oneyear_achv_total', 'sum_total', 'duedate'];

    public function getIsi($id_main = null) {
        if ($id_main === null) {
            return $this->findAll();
        } else {
            $result = $this->select('oneyear.*, main.id AS id_main, main.created_by AS field1, main.nama AS field2, main.approval_kasie, main.approval_kadept, main.approval_kadiv, main.approval_bod, main.approval_presdir')
                ->join('main', 'main.id = oneyear.id_main')
                ->where(['oneyear.id_main' => $id_main])
                ->findAll();
    
            return $result ? $result : [];
        }
    }
}
?>