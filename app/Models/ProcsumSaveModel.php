<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcsumSaveModel extends Model
{
    protected $table = 'proc_sum_save';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_procsum_main', 'midyear_achv_total', 'plan_mid', 'do_mid', 'check_mid', 'act_mid', 'teamwork_mid', 'cust_mid', 'passion_mid', 'gc_mid', 'delegating_mid', 'couch_mid', 'develop_mid', 'b1_average', 'b2_average', 'pdca_mid', 'pm_mid', 'midyear_value'];
    
    public function getIsi($id_procsum_main = null) {
        if ($id_procsum_main === null) {
            return $this->findAll();
        } else {
            $result = $this->select('proc_sum_save.*')
                ->join('procsum_main', 'procsum_main.id = proc_sum_save.id_procsum_main')
                ->where(['proc_sum_save.id_procsum_main' => $id_procsum_main])
                ->first();
    
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
