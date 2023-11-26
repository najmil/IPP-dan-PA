<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcsumModel extends Model
{
    protected $table = 'proc_sum';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_procsum_main', 'is_submitted_midyear', 'is_submitted_oneyear', 'midyear_achv_total', 'plan_mid', 'do_mid', 'check_mid', 'act_mid', 'teamwork_mid', 'cust_mid', 'passion_mid', 'gc_mid', 'delegating_mid', 'couch_mid', 'develop_mid', 'b1_average', 'b2_average', 'pdca_mid', 'result_mid', 'pm_mid', 'midyear_value','oneyear_achv_total', 'plan_one', 'do_one', 'check_one', 'act_one', 'teamwork_one', 'cust_one', 'passion_one', 'gc_one', 'delegating_one', 'couch_one', 'develop_one', 'b1_average_one', 'b2_average_one', 'pdca_one', 'pm_one', 'result_one', 'oneyear_value', 'is_submitted_oneyear', 'is_saved_oneyear'];
    
    public function getIsi($id_procsum_main = null) {
        if ($id_procsum_main === null) {
            return $this->findAll();
        } else {
            $result = $this->select('proc_sum.*')
                ->join('procsum_main', 'procsum_main.id = proc_sum.id_procsum_main')
                ->where(['proc_sum.id_procsum_main' => $id_procsum_main])
                ->findAll();
    
            return $result ? $result : [];
        }
    }    
    
    public function getSavedData($id) {
        return $this->where('id_procsum_main', $id)->first();
    }    

    public function checkDataSaved($id) {
        return $this->where('id_procsum_main', $id)->countAllResults() > 0;
    }

    public function saveResultMid($id_procsum_main, $result_mid){
        $data = [
            'result_mid' => $result_mid
        ];

        $this->db->table('nama_tabel')->where('id_procsum_main', $id_procsum_main)->update($data);
    }

}
