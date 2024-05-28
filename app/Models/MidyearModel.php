<?php

namespace App\Models;

use CodeIgniter\Model;

class MidyearModel extends Model{
    protected $table = "midyear";
    protected $primaryKey = "id";
    protected $allowedFields = ['id_main', 'is_submitted', 'program', 'weight', 'midyear', 'midyear_achv', 'midyear_achv_score', 'midyear_achv_total', 'sum_total', 'duedate'];

    public function getIsi($id_main = null) {
        if ($id_main === null) {
            return $this->findAll();
        } else {
            $result = $this->select('midyear.*, main.id AS id_main, main.created_by AS field1, main.nama AS field2, main.approval_kasie, main.approval_kadept, main.approval_kadiv, main.approval_bod, main.approval_presdir, isi_ipp.kategori, isi_ipp.urutan')
               ->join('main', 'main.id = midyear.id_main')
               ->join('isi_ipp', "CAST(isi_ipp.program AS VARCHAR(MAX)) = CAST(midyear.program AS VARCHAR(MAX))", 'left')
               ->where(['midyear.id_main' => $id_main])
               ->orderBy('isi_ipp.urutan', 'desc')
               ->findAll();
    
            return $result ? $result : [];
        }
    }
    
    // Percobaan menambahkan total_score ke kolom sum_midyear_total
    public function callTotalScore($id){
        $builder = $this->db->table('main');
        $builder->select('main.created_by, sum(midyear.midyear_achv_total) as sum_midyear_total');
        $builder->join('midyear', 'midyear.id_main = main.id');
        $builder->join('procsum_main', 'procsum_main.created_by = main.created_by');
        $builder->join('proc_sum', 'proc_sum.id_procsum_main = procsum_main.id');
        $builder->where('procsum_main.id', $id);
        $builder->groupBy('main.created_by');
        $query = $builder->get();
        
        return $query->getResultArray();
    }

    // Menambahkan total_score ke kolom sum_oneyear_total
    public function callTotalScoreOne($id){
        $builder = $this->db->table('main');
        $builder->select('main.created_by, sum(oneyear.oneyear_achv_total) as sum_oneyear_total');
        $builder->join('oneyear', 'oneyear.id_main = main.id');
        $builder->join('procsum_main', 'procsum_main.created_by = main.created_by');
        $builder->join('proc_sum', 'proc_sum.id_procsum_main = procsum_main.id');
        $builder->where('procsum_main.id', $id);
        $builder->groupBy('main.created_by');
        $query = $builder->get();
        
        return $query->getResultArray();
    }

    // SharedDataModel.php
    public function getSumTotal($id)
    {
        $builder = $this->db->table('main');
        $builder->select('main.created_by, sum(midyear_achv_total) as sum_midyear_total');
        $builder->join('midyear', 'midyear.id_main = main.id');
        $builder->join('procsum_main', 'procsum_main.created_by = main.created_by');
        $builder->join('proc_sum', 'proc_sum.id_procsum_main = procsum_main.id');
        $builder->where('procsum_main.id', $id);
        $builder->groupBy('main.created_by');
        $query = $builder->get();
        
        return $query->getResultArray();
    }

    
}
?>