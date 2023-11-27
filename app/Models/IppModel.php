<?php

namespace App\Models;

use CodeIgniter\Model;

// Model merupakan parents model
class IppModel extends Model{
    protected $table = "main";
    protected $useTimestamps = true;
    protected $primaryKey = "id";
    protected $allowedFields = ['is_submitted', 'is_submitted_ipp_mid', 'is_submitted_ipp_one', 'date_submitted_ipp_mid', 'date_submitted_ipp_one', 'date_submitted', 'date_submitted_ipp', 'date_submitted_one', 'is_submitted_ipp', 'is_submitted_one', 'is_approved_presdir', 'is_approved_bod', 'is_approved_kadiv', 'is_approved_kadept', 'is_approved_kasie', 'is_approved_presdir_mid', 'is_approved_bod_mid', 'is_approved_kadiv_mid', 'is_approved_kadept_mid', 'is_approved_kasie_mid', 'is_approved_presdir_one', 'is_approved_bod_one', 'is_approved_kadiv_one', 'is_approved_kadept_one', 'is_approved_kasie_one', 'id_department', 'id_division', 'id_section','periode', 'sum_midyear_total', 'nama', 'created_by', 'kode_jabatan', 'approval_kadept', 'approval_kadiv', 'approval_kasie', 'approval_kadept_midyear', 'approval_kadiv_midyear', 'approval_kasie_midyear', 'approval_kadept_oneyear', 'approval_kadiv_oneyear', 'approval_kasie_oneyear', 'approval_date_kadept', 'approval_date_presdir', 'approval_date_bod', 'approval_date_kadiv', 'approval_date_kasie', 'approval_presdir_oneyear', 'approval_bod_oneyear', 'approval_presdir_midyear', 'approval_bod_midyear', 'approval_presdir', 'approval_bod', 'approval_date_presdir_oneyear', 'approval_date_bod_oneyear', 'approval_date_kadiv_oneyear', 'approval_date_kadept_oneyear', 'approval_date_kasi_oneyear', 'approval_date_presdir_midyear', 'approval_date_bod_midyear', 'approval_date_kadiv_midyear', 'approval_date_kadept_midyear', 'approval_date_kasie_midyear', 'approved_presdir_by', 'approved_bod_by', 'approved_kadept_by', 'approved_kadiv_by', 'approved_kasie_by', 'approved_presdir_by_mid', 'approved_bod_by_mid', 'approved_kadept_by_mid', 'approved_kadiv_by_mid', 'approved_kasie_by_mid', 'approved_presdir_by_one', 'approved_bod_by_one', 'approved_kadept_by_one', 'approved_kadiv_by_one', 'approved_kasie_by_one', 'file', 'division', 'department', 'section', 'edit_clicked'];

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
        $this->select('main.*, users.nama as user_nama');
        $this->join('users', 'users.npk = main.created_by', 'left');
        return $this->where('main.created_by', $id)->findAll();
    }

    public function getIppFilter($id) {
        $this->select('main.*, users.nama as user_nama');
        $this->join('users', 'users.npk = main.created_by', 'left');
        $result = $this->where('main.created_by', $id)
                    ->where('main.periode NOT LIKE', 'Mid Year%')
                    ->where('main.periode NOT LIKE', 'One Year%')
                    // ->groupStart()
                    //     ->where('main.is_submitted_ipp', 1)
                    //     ->orWhere('main.is_submitted_ipp_mid', 1)
                    //     ->orWhere('main.is_submitted_ipp_one', 1)
                    // ->groupEnd()
                    ->findAll();
        return $result;
    }

    public function getMidyear($id) {
        $currentYear = date('Y');
        $currentDate = date('Y-m-d H:i:s');

        $this->select('main.*, users.nama as user_nama');
        $this->join('users', 'users.npk = main.created_by', 'left');
        
        $result = $this->where('main.created_by', $id)
                        ->groupStart()
                            ->where('main.periode NOT LIKE', 'One Year')
                            ->groupStart()
                                ->where('main.periode', $currentYear)
                                ->where('main.is_submitted_ipp', 1)
                                ->groupStart()
                                    ->where('main.is_submitted_ipp_mid', 0)
                                    ->orWhere('main.is_submitted_ipp_mid IS NULL')
                                ->groupEnd()
                            ->groupEnd()
                            ->orGroupStart()
                                ->where('(main.periode LIKE "%Mid Year" OR main.periode LIKE "%MID YEAR")')
                                ->groupStart()
                                    ->where('main.is_submitted_ipp', 0)
                                    ->orWhere('main.is_submitted_ipp IS NULL')
                                ->groupEnd()
                                ->where('main.is_submitted_ipp_mid', 1)
                            ->groupEnd()
                            ->orGroupStart()
                                ->where('(main.periode LIKE "%Mid Year" OR main.periode LIKE "%MID YEAR")')
                                ->where('main.is_submitted_ipp', 0)
                                ->where('main.is_submitted_ipp IS NULL')
                                ->where('main.is_submitted_ipp_mid', 0)
                                ->where('main.is_submitted_ipp_mid IS NULL')
                            ->groupEnd()
                            ->orWhere('main.periode LIKE "Mid Year%"')
                        ->groupEnd()
                        ->findAll();
        return $result;
    }
    
    public function getOneyear($id) {
        $currentYear = date('Y');
        $currentDate = date('Y-m-d H:i:s');
        $this->select('main.*, users.nama as user_nama');
        $this->join('users', 'users.npk = main.created_by', 'left');
        
        $result = $this->where('main.created_by', $id)
                        ->groupStart()
                            ->groupStart()
                                ->where('main.periode', $currentYear)
                                ->groupStart()
                                    ->where('main.is_submitted_ipp', 1)
                                    ->groupStart()
                                        ->where('main.is_submitted_ipp_mid', 0)
                                        ->orWhere('main.is_submitted_ipp_mid IS NULL')
                                    ->groupEnd()
                                    ->groupStart()
                                        ->where('main.is_submitted_ipp_one', 0)
                                        ->orWhere('main.is_submitted_ipp_one IS NULL')
                                    ->groupEnd()
                                ->groupEnd()    
                            ->groupEnd()
                            ->orGroupStart()
                                ->where('(main.periode LIKE "%Mid Year" OR main.periode LIKE "%MID YEAR")')
                                ->groupStart()
                                    ->groupStart()
                                        ->where('main.is_submitted_ipp', 0)
                                        ->orWhere('main.is_submitted_ipp IS NULL')
                                    ->groupEnd()
                                    ->groupStart()
                                        ->where('main.is_submitted_ipp_one', 0)
                                        ->orWhere('main.is_submitted_ipp_one IS NULL')
                                    ->groupEnd()
                                    ->where('main.is_submitted_ipp_mid', 1)
                                ->groupEnd()
                            ->groupEnd()
                            ->orGroupStart()
                                ->where('(main.periode LIKE "%One Year" OR main.periode LIKE "%ONE YEAR")')
                                ->groupStart()
                                    ->groupStart()
                                        ->where('main.is_submitted_ipp', 0)
                                        ->orWhere('main.is_submitted_ipp IS NULL')
                                    ->groupEnd()
                                    ->groupStart()
                                        ->where('main.is_submitted_ipp_mid', 0)
                                        ->orWhere('main.is_submitted_ipp_mid IS NULL')
                                    ->groupEnd()
                                    ->where('main.is_submitted_ipp_one', 1)
                                ->groupEnd()
                            ->groupEnd()
                            ->orWhere('main.periode LIKE "One Year%"')
                        ->groupEnd()
                        ->findAll();
        return $result;
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
        $notAllowedNpk = [3659, 3651];
        // dd($id_department);
        
        $builder = $this->db->table('main');
        $builder->select('main.*');
        $builder->join('users', 'users.npk = main.created_by', 'left');
        $builder->where('main.periode NOT LIKE', 'Mid Year%');
        
        if ($kode_jabatan == 3) {
            if ($npk == 4210) {
                $builder->groupStart()
                    ->orWhere('users.kode_jabatan', 8)
                    ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd();
                $builder->groupStart()
                    ->orWhere('main.id_department', 3)
                    ->orWhere('main.id_department', 4)
                    ->groupEnd();
            }
            else {
                // Approval kadept untuk staff
                $builder->groupStart()
                        ->orWhere('users.kode_jabatan', 8)
                        ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd();
                $builder->where('main.id_department', $id_department);
            }
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
        } elseif ($kode_jabatan == 1 && $npk == 3944 ) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 3944
            $builder->where('users.kode_jabatan', 2)
                    ->whereIn('main.id_division', [1, 2])
                    ->orWhere('users.kode_jabatan', 3)
                    ->whereIn('main.id_division', [1, 2]);                  
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 4170
            $builder->where('users.kode_jabatan', 2)
                    ->whereIn('main.id_division', [3, 4, 5])
                    ->orWhere('users.kode_jabatan', 3)
                    ->whereIn('main.id_division', [3, 4, 5]);
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('users.kode_jabatan', 2);
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            // Untuk admin
        }
        return $builder->get()->getResultArray();
    } 

    public function getDataByDepartment(...$iddepartment) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.periode NOT LIKE', 'Mid Year%')
                ->groupStart()
                    ->where('main.is_submitted_ipp', 1)
                    ->groupStart()
                        ->where('main.is_submitted_ipp_mid', 0)
                        ->orWhere('main.is_submitted_ipp_mid IS NULL')
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.is_submitted_ipp_one', 0)
                        ->orWhere('main.is_submitted_ipp_one IS NULL')
                    ->groupEnd()
                ->groupEnd()
                ->orGroupStart()
                    ->where('(main.periode LIKE "%Mid Year" OR main.periode LIKE "%MID YEAR")')
                    ->where('main.is_submitted_ipp', 0)
                    ->where('main.is_submitted_ipp_mid', 1)
                    ->where('main.is_submitted_ipp_one', 0)
                    ->groupStart()
                        ->orWhere('main.is_submitted_ipp_one IS NULL')
                    ->groupEnd()
                ->groupEnd()
                ->orGroupStart()
                    ->where('(main.periode LIKE "%One Year" OR main.periode LIKE "%ONE YEAR")')
                    ->where('main.is_submitted_ipp', 0)
                    ->groupStart()
                        ->where('main.is_submitted_ipp_mid', 0)
                        ->orWhere('main.is_submitted_ipp_mid IS NULL')
                    ->groupEnd()
                    ->where('main.is_submitted_ipp_one', 1)
                ->groupEnd()
                ->whereIn('users.id_department', $iddepartment)
                ->whereIn('main.id_department', $iddepartment);

            return $builder->get()->getResultArray();
        }
    }

    public function getDataByDepartmentMid(...$iddepartment) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                // ->where('main.periode NOT LIKE', 'Mid Year%')
                ->where('main.is_submitted', 1)
                ->whereIn('users.id_department', $iddepartment)
                ->whereIn('main.id_department', $iddepartment);

            return $builder->get()->getResultArray();
        }
    }

    public function getDataByDepartmentOne(...$iddepartment) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                // ->where('main.periode NOT LIKE', 'Mid Year%')
                ->where('main.is_submitted_one', 1)
                ->whereIn('users.id_department', $iddepartment)
                ->whereIn('main.id_department', $iddepartment);

            return $builder->get()->getResultArray();
        }
    }

    public function getDataByDivision(...$iddivision) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->whereIn('users.id_division', $iddivision)
                ->whereIn('main.id_division', $iddivision)
                ->groupStart()
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->groupStart()
                            ->where('main.is_submitted_ipp_mid', 0)
                            ->orWhere('main.is_submitted_ipp_mid IS NULL')
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.is_submitted_ipp_one', 0)
                            ->orWhere('main.is_submitted_ipp_one IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('(main.periode LIKE "%Mid Year" OR main.periode LIKE "%MID YEAR")')
                        ->where('main.is_submitted_ipp', 0)
                        ->where('main.is_submitted_ipp_mid', 1)
                        ->where('main.is_submitted_ipp_one', 0)
                        ->groupStart()
                            ->orWhere('main.is_submitted_ipp_one IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('(main.periode LIKE "%One Year" OR main.periode LIKE "%ONE YEAR")')
                        ->where('main.is_submitted_ipp', 0)
                        ->groupStart()
                            ->where('main.is_submitted_ipp_mid', 0)
                            ->orWhere('main.is_submitted_ipp_mid IS NULL')
                        ->groupEnd()
                        ->where('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                ->groupEnd();

            return $builder->get()->getResultArray();
        }
    }

    public function getDataByDivisionMid(...$iddivision) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.is_submitted', 1)
                ->whereIn('users.id_division', $iddivision)
                ->whereIn('main.id_division', $iddivision);

            return $builder->get()->getResultArray();
        }
    }

    public function getDataByDivisionOne(...$iddivision) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.is_submitted_one', 1)
                ->whereIn('users.id_division', $iddivision)
                ->whereIn('main.id_division', $iddivision);

            return $builder->get()->getResultArray();
        }
    }

    // Count how many pending data or hasnt approve in ipp
    public function getDataPending() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main');
        $builder->select('main.*');
        $builder->join('users', 'users.npk = main.created_by', 'left');
        $builder->where('main.periode NOT LIKE', 'Mid Year%');

        if ($kode_jabatan == 3) {
            if ($npk === 4210) {
                $builder->groupStart()
                            ->where('users.kode_jabatan', 8)
                            ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.id_department', 3)
                            ->orWhere('main.id_department', 4)
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.is_submitted_ipp', 1)
                            ->orWhere('main.is_submitted_ipp_mid', 1)
                            ->orWhere('main.is_submitted_ipp_one', 1)
                        ->groupEnd()
                        ->groupstart()
                            ->where('main.approval_kadept', 0)
                            ->orWhere('main.approval_kadept IS NULL')
                        ->groupEnd();
            } else {
                $builder->groupStart()
                            ->where('users.kode_jabatan', 8)
                            ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd()
                        ->where('main.id_department', $id_department)
                        ->groupStart()
                            ->where('main.is_submitted_ipp', 1)
                            ->orWhere('main.is_submitted_ipp_mid', 1)
                            ->orWhere('main.is_submitted_ipp_one', 1)
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.is_submitted_ipp', 1)
                            ->orWhere('main.is_submitted_ipp_mid', 1)
                            ->orWhere('main.is_submitted_ipp_one', 1)
                        ->groupEnd()
                        ->groupstart()
                            ->where('main.approval_kadept', 0)
                            ->orWhere('main.approval_kadept IS NULL')
                        ->groupEnd();
            }
        } elseif ($kode_jabatan == 4) {
            $builder->where('users.kode_jabatan', 8)
                    ->groupStart()
                        ->where('users.npk', 3651)
                        ->orWhere('users.npk', 3659)
                    ->groupEnd()
                    ->where('main.id_section', $id_section)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.approval_kasie', 0) 
                        ->orWhere('main.approval_kasie IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 2) {
            // Approval kadiv untuk kadept
            $builder->groupStart()
                        ->where('users.kode_jabatan', 3)
                        ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd()
                    ->where('main.id_division', $id_division)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->groupstart()
                        ->where('main.approval_kadiv', 0)
                        ->orWhere('main.approval_kadiv IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 1 && $npk == 3944 ) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 3944
            $builder->groupStart()
                        ->where('users.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.id_division', 1)
                            ->orWhere('main.id_division', 2)
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->Where('users.kode_jabatan', 3)
                        ->groupStart()
                            ->where('users.kode_jabatan', 1)
                            ->orWhere('users.kode_jabatan', 2)
                        ->groupEnd()
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.approval_bod', 0) 
                        ->orWhere('main.approval_bod IS NULL')
                    ->groupEnd();                 
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 4170
            $builder->groupStart()
                        ->where('users.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.id_division', 3)
                            ->orWhere('main.id_division', 4)
                            ->orWhere('main.id_division', 5)
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->Where('users.kode_jabatan', 3)
                        ->groupStart()
                            ->where('users.kode_jabatan', 3)
                            ->orWhere('users.kode_jabatan', 4)
                            ->orWhere('users.kode_jabatan', 5)
                        ->groupEnd()
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.approval_bod', 0) 
                        ->orWhere('main.approval_bod IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('users.kode_jabatan', 2)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.approval_presdir', 0) 
                        ->orWhere('main.approval_presdir IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            $builder->where(
                '(' .
                '(
                    `main`.`is_submitted_ipp` = 1 
                    AND (
                        (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                        OR
                        (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                    )
                )
                OR
                (
                    (`main`.`periode` LIKE "%Mid Year" OR `main`.`periode` LIKE "%MID YEAR") 
                    AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                    AND `main`.`is_submitted_ipp_mid` = 1 
                    AND (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                )
                OR
                (
                    (`main`.`periode` LIKE "%One Year" OR `main`.`periode` LIKE "%ONE YEAR") 
                    AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp` IS NULL)
                    AND (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL) 
                    AND `main`.`is_submitted_ipp_one` = 1
                )'.
            ')');
            $builder->where(
                '(
                    (
                        `main`.`kode_jabatan` = 8 
                        AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                        AND (`main`.`approval_kasie` = 0 OR `main`.`approval_kasie` IS NULL) 
                        AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL)
                    )
                    OR
                    (
                        (`main`.`kode_jabatan` = 4 
                        OR (
                            `main`.`kode_jabatan` = 8 
                            AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                        ))
                        AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL) 
                        AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL)
                    )
                    OR
                    (
                        `main`.`kode_jabatan` = 3
                        AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL) 
                        AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                    )
                    OR
                    (
                        `main`.`kode_jabatan` = 2
                        AND (`main`.`approval_presdir` = 0 OR `main`.`approval_presdir` IS NULL) 
                        AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                    )
                )'
            );
        }        

        $count = $builder->countAllResults();
        return $count;
    }

    public function getPendingPlantS() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 4);
        $builder->where(
            '(' .
            '(
                `main`.`is_submitted_ipp` = 1 
                AND (
                    (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                    OR
                    (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                )
            )
            OR
            (
                (`main`.`periode` LIKE "%Mid Year" OR `main`.`periode` LIKE "%MID YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                AND `main`.`is_submitted_ipp_mid` = 1 
                AND (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
            )
            OR
            (
                (`main`.`periode` LIKE "%One Year" OR `main`.`periode` LIKE "%ONE YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp` IS NULL)
                AND (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL) 
                AND `main`.`is_submitted_ipp_one` = 1
            )'.
        ')');
        $builder->where(
            '(
                (
                    `main`.`kode_jabatan` = 8 
                    AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    AND (`main`.`approval_kasie` = 0 OR `main`.`approval_kasie` IS NULL) 
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL)
                )
                OR
                (
                    (`main`.`kode_jabatan` = 4 
                    OR (
                        `main`.`kode_jabatan` = 8 
                        AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    ))
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL) 
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 3
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 2
                    AND (`main`.`approval_presdir` = 0 OR `main`.`approval_presdir` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
            )'
        );

        return $builder->countAllResults();
    }

    public function getPendingFin() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 2);
        $builder->where(
            '(' .
            '(
                `main`.`is_submitted_ipp` = 1 
                AND (
                    (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                    OR
                    (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                )
            )
            OR
            (
                (`main`.`periode` LIKE "%Mid Year" OR `main`.`periode` LIKE "%MID YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                AND `main`.`is_submitted_ipp_mid` = 1 
                AND (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
            )
            OR
            (
                (`main`.`periode` LIKE "%One Year" OR `main`.`periode` LIKE "%ONE YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp` IS NULL)
                AND (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL) 
                AND `main`.`is_submitted_ipp_one` = 1
            )'.
        ')');
        $builder->where(
            '(
                (
                    `main`.`kode_jabatan` = 8 
                    AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    AND (`main`.`approval_kasie` = 0 OR `main`.`approval_kasie` IS NULL) 
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL)
                )
                OR
                (
                    (`main`.`kode_jabatan` = 4 
                    OR (
                        `main`.`kode_jabatan` = 8 
                        AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    ))
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL) 
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 3
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 2
                    AND (`main`.`approval_presdir` = 0 OR `main`.`approval_presdir` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
            )'
        );

        return $builder->countAllResults();
    }

    public function getPendingAdm() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 1);
        $builder->where(
            '(' .
            '(
                `main`.`is_submitted_ipp` = 1 
                AND (
                    (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                    OR
                    (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                )
            )
            OR
            (
                (`main`.`periode` LIKE "%Mid Year" OR `main`.`periode` LIKE "%MID YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                AND `main`.`is_submitted_ipp_mid` = 1 
                AND (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
            )
            OR
            (
                (`main`.`periode` LIKE "%One Year" OR `main`.`periode` LIKE "%ONE YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp` IS NULL)
                AND (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL) 
                AND `main`.`is_submitted_ipp_one` = 1
            )'.
        ')');
        $builder->where(
            '(
                (
                    `main`.`kode_jabatan` = 8 
                    AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    AND (`main`.`approval_kasie` = 0 OR `main`.`approval_kasie` IS NULL) 
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL)
                )
                OR
                (
                    (`main`.`kode_jabatan` = 4 
                    OR (
                        `main`.`kode_jabatan` = 8 
                        AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    ))
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL) 
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 3
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 2
                    AND (`main`.`approval_presdir` = 0 OR `main`.`approval_presdir` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
            )'
        );

        return $builder->countAllResults();
    }

    public function getPendingPlant() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 5);
        $builder->where(
            '(' .
            '(
                `main`.`is_submitted_ipp` = 1 
                AND (
                    (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                    OR
                    (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                )
            )
            OR
            (
                (`main`.`periode` LIKE "%Mid Year" OR `main`.`periode` LIKE "%MID YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                AND `main`.`is_submitted_ipp_mid` = 1 
                AND (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
            )
            OR
            (
                (`main`.`periode` LIKE "%One Year" OR `main`.`periode` LIKE "%ONE YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp` IS NULL)
                AND (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL) 
                AND `main`.`is_submitted_ipp_one` = 1
            )'.
        ')');
        $builder->where(
            '(
                (
                    `main`.`kode_jabatan` = 8 
                    AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    AND (`main`.`approval_kasie` = 0 OR `main`.`approval_kasie` IS NULL) 
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL)
                )
                OR
                (
                    (`main`.`kode_jabatan` = 4 
                    OR (
                        `main`.`kode_jabatan` = 8 
                        AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    ))
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL) 
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 3
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 2
                    AND (`main`.`approval_presdir` = 0 OR `main`.`approval_presdir` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
            )'
        );

        return $builder->countAllResults();
    }

    public function getPendingEng() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 3);
        $builder->where(
            '(' .
            '(
                `main`.`is_submitted_ipp` = 1 
                AND (
                    (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                    OR
                    (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                )
            )
            OR
            (
                (`main`.`periode` LIKE "%Mid Year" OR `main`.`periode` LIKE "%MID YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                AND `main`.`is_submitted_ipp_mid` = 1 
                AND (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
            )
            OR
            (
                (`main`.`periode` LIKE "%One Year" OR `main`.`periode` LIKE "%ONE YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp` IS NULL)
                AND (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL) 
                AND `main`.`is_submitted_ipp_one` = 1
            )'.
        ')');
        $builder->where(
            '(
                (
                    `main`.`kode_jabatan` = 8 
                    AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    AND (`main`.`approval_kasie` = 0 OR `main`.`approval_kasie` IS NULL) 
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL)
                )
                OR
                (
                    (`main`.`kode_jabatan` = 4 
                    OR (
                        `main`.`kode_jabatan` = 8 
                        AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    ))
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL) 
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 3
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 2
                    AND (`main`.`approval_presdir` = 0 OR `main`.`approval_presdir` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
            )'
        );

        return $builder->countAllResults();
    }

    public function getPendingIsd() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_department', 5);
        $builder->where(
            '(' .
            '(
                `main`.`is_submitted_ipp` = 1 
                AND (
                    (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                    OR
                    (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
                )
            )
            OR
            (
                (`main`.`periode` LIKE "%Mid Year" OR `main`.`periode` LIKE "%MID YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL)
                AND `main`.`is_submitted_ipp_mid` = 1 
                AND (`main`.`is_submitted_ipp_one` = 0 OR `main`.`is_submitted_ipp_one` IS NULL)
            )
            OR
            (
                (`main`.`periode` LIKE "%One Year" OR `main`.`periode` LIKE "%ONE YEAR") 
                AND (`main`.`is_submitted_ipp` = 0 OR `main`.`is_submitted_ipp` IS NULL)
                AND (`main`.`is_submitted_ipp_mid` = 0 OR `main`.`is_submitted_ipp_mid` IS NULL) 
                AND `main`.`is_submitted_ipp_one` = 1
            )'.
        ')');
        $builder->where(
            '(
                (
                    `main`.`kode_jabatan` = 8 
                    AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    AND (`main`.`approval_kasie` = 0 OR `main`.`approval_kasie` IS NULL) 
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL)
                )
                OR
                (
                    (`main`.`kode_jabatan` = 4 
                    OR (
                        `main`.`kode_jabatan` = 8 
                        AND (`main`.`created_by` != 3651 OR `main`.`created_by` != 3659)
                    ))
                    AND (`main`.`approval_kadept` = 0 OR `main`.`approval_kadept` IS NULL) 
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 3
                    AND (`main`.`approval_kadiv` = 0 OR `main`.`approval_kadiv` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
                OR
                (
                    `main`.`kode_jabatan` = 2
                    AND (`main`.`approval_presdir` = 0 OR `main`.`approval_presdir` IS NULL) 
                    AND (`main`.`approval_bod` = 0 OR `main`.`approval_bod` IS NULL)
                )
            )'
        );

        return $builder->countAllResults();
    }

    // Count how many pending data or hasnt approve in mid year
    public function getDataPendingMid() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main');
        $builder->select('main.*');
        $builder->join('users', 'users.npk = main.created_by', 'left');
        $builder->where('main.periode NOT LIKE', 'Mid Year%');

        if ($kode_jabatan == 3) {
            if ($npk === 4210) {
                $builder->groupStart()
                            ->where('users.kode_jabatan', 8)
                            ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.id_department', 3)
                            ->orWhere('main.id_department', 4)
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.is_submitted_ipp', 1)
                            ->orWhere('main.is_submitted_ipp_mid', 1)
                            ->orWhere('main.is_submitted_ipp_one', 1)
                        ->groupEnd()
                        ->where('main.is_submitted', 1)
                        ->groupstart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                        ->groupEnd();
            } else {
                $builder->groupStart()
                            ->where('users.kode_jabatan', 8)
                            ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd()
                        ->where('main.id_department', $id_department)
                        ->groupStart()
                            ->where('main.is_submitted_ipp', 1)
                            ->orWhere('main.is_submitted_ipp_mid', 1)
                            ->orWhere('main.is_submitted_ipp_one', 1)
                        ->groupEnd()
                        ->where('main.is_submitted', 1)
                        ->groupstart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                        ->groupEnd();
            }
        } elseif ($kode_jabatan == 4) {
            $builder->where('users.kode_jabatan', 8)
                    ->groupStart()
                        ->where('users.npk', '!=', 3651)
                        ->where('users.npk', '!=', 3659)
                    ->groupEnd()
                    ->where('main.id_section', $id_section)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted', 1)
                    ->groupStart()
                        ->where('main.approval_kasie_midyear', 0) 
                        ->orWhere('main.approval_kasie_midyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 2) {
            // Approval kadiv untuk kadept
            $builder->groupStart()
                        ->where('users.kode_jabatan', 3)
                        ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd()
                    ->where('main.id_division', $id_division)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted', 1)
                    ->groupstart()
                        ->where('main.approval_kadiv_midyear', 0)
                        ->orWhere('main.approval_kadiv_midyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 1 && $npk == 3944 ) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 3944
            $builder->groupStart()
                        ->where('users.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.id_division', 1)
                            ->orWhere('main.id_division', 2)
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->Where('users.kode_jabatan', 3)
                        ->groupStart()
                            ->where('users.kode_jabatan', 1)
                            ->orWhere('users.kode_jabatan', 2)
                        ->groupEnd()
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted', 1)
                    ->groupStart()
                        ->where('main.approval_bod_midyear', 0) 
                        ->orWhere('main.approval_bod_midyear IS NULL')
                    ->groupEnd();                 
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 4170
            $builder->groupStart()
                        ->where('users.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.id_division', 3)
                            ->orWhere('main.id_division', 4)
                            ->orWhere('main.id_division', 5)
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->Where('users.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.id_division', 3)
                            ->orWhere('main.id_division', 4)
                            ->orWhere('main.id_division', 5)
                        ->groupEnd()
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted', 1)
                    ->groupStart()
                        ->where('main.approval_bod_midyear', 0) 
                        ->orWhere('main.approval_bod_midyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('users.kode_jabatan', 2)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted', 1)
                    ->groupStart()
                        ->where('main.approval_presdir_midyear', 0) 
                        ->orWhere('main.approval_presdir_midyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            $builder->where('main.is_submitted', 1)
                    ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kasie_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kasie_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_presdir_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_presdir_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();
        }

        $count = $builder->countAllResults();
        return $count;
    }

    public function getPendingPlantSMid() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 4)
                ->where('main.is_submitted', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kasie_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kasie_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_presdir_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_presdir_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingFinMid() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 2)
                ->where('main.is_submitted', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kasie_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kasie_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_presdir_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_presdir_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();
    }

    public function getPendingAdmMid() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 1)
                ->where('main.is_submitted', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kasie_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kasie_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_presdir_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_presdir_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingPlantMid() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 5)
                ->where('main.is_submitted', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kasie_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kasie_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_presdir_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_presdir_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingEngMid() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 3)
                ->where('main.is_submitted', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kasie_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kasie_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_presdir_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_presdir_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingIsdMid() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_department', 5)
                ->where('main.is_submitted', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kasie_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kasie_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_kadept_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_kadiv_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_kadiv_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_midyear', 0)
                            ->orWhere('main.approval_presdir_midyear', 0)
                            ->orWhere('main.approval_bod_midyear IS NULL')
                            ->orWhere('main.approval_presdir_midyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    // Count how many pending data or hasnt approve in one year
    public function getDataPendingOne() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main');
        $builder->select('main.*');
        $builder->join('users', 'users.npk = main.created_by', 'left');
        $builder->where('main.periode NOT LIKE', 'Mid Year%');

        if ($kode_jabatan == 3) {
            if ($npk === 4210) {
                $builder->groupStart()
                            ->where('users.kode_jabatan', 8)
                            ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.id_department', 3)
                            ->orWhere('main.id_department', 4)
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.is_submitted_ipp', 1)
                            ->orWhere('main.is_submitted_ipp_mid', 1)
                            ->orWhere('main.is_submitted_ipp_one', 1)
                        ->groupEnd()
                        ->where('main.is_submitted_one', 1)
                        ->groupstart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                        ->groupEnd();
            } else {
                $builder->groupStart()
                            ->where('users.kode_jabatan', 8)
                            ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd()
                        ->where('main.id_department', $id_department)
                        ->groupStart()
                            ->where('main.is_submitted_ipp', 1)
                            ->orWhere('main.is_submitted_ipp_mid', 1)
                            ->orWhere('main.is_submitted_ipp_one', 1)
                        ->groupEnd()
                        ->where('main.is_submitted_one', 1)
                        ->groupstart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                        ->groupEnd();
            }
        } elseif ($kode_jabatan == 4) {
            $builder->where('users.kode_jabatan', 8)
                    ->groupStart()
                        ->where('users.npk', 3651)
                        ->orWhere('users.npk', 3659)
                    ->groupEnd()
                    ->where('main.id_section', $id_section)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted_one', 1)
                    ->groupStart()
                        ->where('main.approval_kasie_oneyear', 0) 
                        ->orWhere('main.approval_kasie_oneyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 2) {
            // Approval kadiv untuk kadept
            $builder->groupStart()
                        ->where('users.kode_jabatan', 3)
                        ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd()
                    ->where('main.id_division', $id_division)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted_one', 1)
                    ->groupstart()
                        ->where('main.approval_kadiv_oneyear', 0)
                        ->orWhere('main.approval_kadiv_oneyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 1 && $npk == 3944 ) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 3944
            $builder->groupStart()
                        ->where('users.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.id_division', 1)
                            ->orWhere('main.id_division', 2)
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->Where('users.kode_jabatan', 3)
                        ->groupStart()
                            ->where('users.kode_jabatan', 1)
                            ->orWhere('users.kode_jabatan', 2)
                        ->groupEnd()
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted_one', 1)
                    ->groupStart()
                        ->where('main.approval_bod_oneyear', 0) 
                        ->orWhere('main.approval_bod_oneyear IS NULL')
                    ->groupEnd();                 
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 4170
            $builder->groupStart()
                        ->where('users.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.id_division', 3)
                            ->orWhere('main.id_division', 4)
                            ->orWhere('main.id_division', 5)
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->Where('users.kode_jabatan', 3)
                        ->groupStart()
                            ->where('users.kode_jabatan', 3)
                            ->orWhere('users.kode_jabatan', 4)
                            ->orWhere('users.kode_jabatan', 5)
                        ->groupEnd()
                    ->groupEnd()
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted_one', 1)
                    ->groupStart()
                        ->where('main.approval_bod_oneyear', 0) 
                        ->orWhere('main.approval_bod_oneyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('users.kode_jabatan', 2)
                    ->groupStart()
                        ->where('main.is_submitted_ipp', 1)
                        ->orWhere('main.is_submitted_ipp_mid', 1)
                        ->orWhere('main.is_submitted_ipp_one', 1)
                    ->groupEnd()
                    ->where('main.is_submitted_one', 1)
                    ->groupStart()
                        ->where('main.approval_presdir_oneyear', 0) 
                        ->orWhere('main.approval_presdir_oneyear IS NULL')
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            $builder->where('main.is_submitted_one', 1)
                    ->groupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 8)
                            ->where('main.created_by', '!=', 3651)
                            ->where('main.created_by', '!=', 3659)
                            ->groupStart()
                                ->where('main.approval_kadept_oneyear', 0)
                                ->orWhere('main.approval_kasie_oneyear', 0)
                                ->orWhere('main.approval_kadept_oneyear IS NULL')
                                ->orWhere('main.approval_kasie_oneyear IS NULL')
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('main.kode_jabatan', 8)
                                    ->where('main.created_by', 3651)
                                    ->where('main.created_by', 3659)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('main.approval_kadept_oneyear', 0)
                                ->orWhere('main.approval_kadiv_oneyear', 0)
                                ->orWhere('main.approval_kadept_oneyear IS NULL')
                                ->orWhere('main.approval_kadiv_oneyear IS NULL')
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('main.approval_bod_oneyear', 0)
                                ->orWhere('main.approval_kadiv_oneyear', 0)
                                ->orWhere('main.approval_bod_oneyear IS NULL')
                                ->orWhere('main.approval_kadiv_oneyear IS NULL')
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('main.approval_bod_oneyear', 0)
                                ->orWhere('main.approval_presdir_oneyear', 0)
                                ->orWhere('main.approval_bod_oneyear IS NULL')
                                ->orWhere('main.approval_presdir_oneyear IS NULL')
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd();
        }

        $count = $builder->countAllResults();
        return $count;
    }

    public function getPendingPlantSOne() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 4)
                ->groupStart()
                    ->where('main.is_submitted_ipp', 1)
                    ->orWhere('main.is_submitted_ipp_mid', 1)
                    ->orWhere('main.is_submitted_ipp_one', 1)
                ->groupEnd()
                ->where('main.is_submitted_one', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kasie_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kasie_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_presdir_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_presdir_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingFinOne() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 2)
                ->groupStart()
                    ->where('main.is_submitted_ipp', 1)
                    ->orWhere('main.is_submitted_ipp_mid', 1)
                    ->orWhere('main.is_submitted_ipp_one', 1)
                ->groupEnd()
                ->where('main.is_submitted_one', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kasie_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kasie_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_presdir_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_presdir_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingAdmOne() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 1)
                ->groupStart()
                    ->where('main.is_submitted_ipp', 1)
                    ->orWhere('main.is_submitted_ipp_mid', 1)
                    ->orWhere('main.is_submitted_ipp_one', 1)
                ->groupEnd()
                ->where('main.is_submitted_one', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kasie_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kasie_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_presdir_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_presdir_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingPlantOne() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 5)
                ->groupStart()
                    ->where('main.is_submitted_ipp', 1)
                    ->orWhere('main.is_submitted_ipp_mid', 1)
                    ->orWhere('main.is_submitted_ipp_one', 1)
                ->groupEnd()
                ->where('main.is_submitted_one', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kasie_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kasie_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_presdir_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_presdir_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingEngOne() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_division', 3)
                ->groupStart()
                    ->where('main.is_submitted_ipp', 1)
                    ->orWhere('main.is_submitted_ipp_mid', 1)
                    ->orWhere('main.is_submitted_ipp_one', 1)
                ->groupEnd()
                ->where('main.is_submitted_one', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kasie_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kasie_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_presdir_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_presdir_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingIsdOne() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('main')
                ->select('main.*')
                ->join('users', 'users.npk = main.created_by', 'left')
                ->where('main.id_department', 5)
                ->groupStart()
                    ->where('main.is_submitted_ipp', 1)
                    ->orWhere('main.is_submitted_ipp_mid', 1)
                    ->orWhere('main.is_submitted_ipp_one', 1)
                ->groupEnd()
                ->where('main.is_submitted_one', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('main.kode_jabatan', 8)
                        ->where('main.created_by', '!=', 3651)
                        ->where('main.created_by', '!=', 3659)
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kasie_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kasie_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->groupStart()
                            ->where('main.kode_jabatan', 4)
                            ->orGroupStart()
                                ->where('main.kode_jabatan', 8)
                                ->where('main.created_by', 3651)
                                ->where('main.created_by', 3659)
                            ->groupEnd()
                        ->groupEnd()
                        ->groupStart()
                            ->where('main.approval_kadept_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_kadept_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 3)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_kadiv_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_kadiv_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('main.kode_jabatan', 2)
                        ->groupStart()
                            ->where('main.approval_bod_oneyear', 0)
                            ->orWhere('main.approval_presdir_oneyear', 0)
                            ->orWhere('main.approval_bod_oneyear IS NULL')
                            ->orWhere('main.approval_presdir_oneyear IS NULL')
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }
}

?>