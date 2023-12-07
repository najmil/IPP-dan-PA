<?php

namespace App\Models;

use CodeIgniter\Model;

// Model merupakan parents model
class LampauModel extends Model{
    protected $table = "ipp_lampau";
    protected $useTimestamps = false;
    protected $primaryKey = "id";
    protected $allowedFields = ['file', 'created_by', 'created_at', 'nama', 'id_department', 'id_division', 'id_section', 'periode'];

    public function getIpp($id = false){

        if($id == false){
            return $this->findAll();
        }
        
        return $this->where(['id'])->first();
    }

    public function getIppData($id) {
        return $this->where('id', $id)->first();
    }

    public function getIppByUser($id) {
        $this->select('ipp_lampau.*, users.nama as user_nama');
        $this->join('users', 'users.npk = ipp_lampau.created_by', 'left');
        return $this->where('ipp_lampau.created_by', $id)->findAll();
    }

    public function getIppByUserDua($id) {
        $this->select('main.*, users.nama as user_nama');
        $this->join('users', 'users.npk = main.created_by', 'left');
        return $this->where('main.created_by', $id)
                    ->where("main.periode < '2023'")
                    ->like('main.periode', 'ipp')
                    ->findAll();
    }

    public function getIppById($id) {
        // Replace 'ipp_table' with the actual name of your database table that stores IPP data
        return $this->db->table('main')
            ->where(['id' => $id])
            ->get()
            ->getRowArray();
        echo $this->db->getLastQuery();
    }      

    public function getIppByUserFilter($id, $showRevisi = true) {
        $currentYear = date('Y');
        $this->select('main.*, users.nama as user_nama');
        $this->join('users', 'users.npk = main.created_by', 'left');
    
        if ($showRevisi) {
            $this->notLike('main.periode', $currentYear . ' Rev. Mid Year');
        } else {
            $this->like('main.periode', $currentYear . ' Rev. Mid Year');
        }
    
        return $this->where('main.created_by', $id)->findAll();
    }
    
    public function getIppByUserFilterOne($id, $showRevisi = true, $showRevisiMidYear = false) {
        $this->select('main.*, users.nama as user_nama');
        $this->join('users', 'users.npk = main.created_by', 'left');
    
        if ($showRevisi && !$showRevisiMidYear) {
            $this->notLike('main.periode', $currentYear . ' Rev. One Year');
        } elseif ($showRevisiMidYear) {
            $this->like('main.periode', $currentYear . ' Rev. Mid Year');
        } else {
            $this->like('main.periode', $currentYear . ' Rev. One Year');
        }
    
        return $this->where('main.created_by', $id)->findAll();
    } 

    public function getIppByDepartmentAndDivision() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');
        $notAllowedNpk = [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592];
        
        $builder = $this->db->table('main');
        $builder->select('main.*');
        $builder->join('users', 'users.npk = main.created_by', 'left');
        
        if ($kode_jabatan == 3) {
            // Approval kadept untuk staff
            $builder->groupStart()
                    ->orWhere('users.kode_jabatan', 8)
                    ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd();
            $builder->where('main.id_department', $id_department);
        } elseif ($kode_jabatan == 4) {
            $builder->where('users.kode_jabatan', 8)
                    ->whereNotIn('users.npk', $notAllowedNpk)
                    ->where('main.id_section', $id_section);
        } elseif ($kode_jabatan == 2) {
            // Approval kadiv untuk kadept
            $builder->whereIn('users.kode_jabatan', [3, 4])
                    ->where('main.id_division', $id_division);
            // $builder->groupStart()
            //     ->where('users.kode_jabatan', 8)
            //     ->whereNotIn('users.npk', $notAllowedNpk)
            //     ->where('main.id_section', $id_division)
            //     ->groupEnd();
        } elseif (($kode_jabatan == 1 && $npk == 3944 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 3944
            $builder->groupStart()
                ->where('users.kode_jabatan', 3)
                ->where('main.id_division', [1, 2])
                ->groupEnd();
            $builder->orWhere('users.kode_jabatan', 2);
            $builder->where('main.id_division', [1, 2]);
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 4170
            $builder->groupStart()
                ->where('users.kode_jabatan', 3)
                ->where('main.id_division', [3, 4, 5])
                ->groupEnd();
            $builder->orWhere('users.kode_jabatan', 2);
            $builder->where('main.id_division', [3, 4, 5]);
        } elseif ($kode_jabatan == 1 && $npk == 3944) {
            // Untuk kadiv yang diapprove oleh presdir dan BoD dengan npk 111
            $builder->where('users.kode_jabatan', 2);
            $builder->where('main.id_division', [2, 1]);
            // $builder->whereIn('users.npk', [1529, 961]);
        } elseif ($kode_jabatan == 1 && $npk == 4170) {
            // Untuk kadiv yang diapprove oleh presdir dan BoD dengan npk 123
            $builder->where('users.kode_jabatan', 2);
            $builder->where('main.id_division', [3, 4, 5]);
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('users.kode_jabatan', 2);
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            // Untuk admin
        }
        return $builder->get()->getResultArray();
    } 
}

?>