<?php

namespace App\Models;

use CodeIgniter\Model;

class StrongWeakMainModel extends Model{
    protected $table = "strongweak_main";
    protected $useTimestamps = true;
    protected $primaryKey = "id";
    protected $allowedFields = ['nama', 'periode', 'is_submitted', 'is_submitted_one', 'npk_user', 'created_by', 'kode_jabatan', 'updated_at', 'id_department', 'id_division', 'id_section', 'approval_presdir_strongweak', 'approval_bod_strongweak', 'approval_kadept_strongweak', 'approval_kadiv_strongweak', 'approval_kasie_strongweak', 'approval_date_presdir_strongweak', 'approval_date_bod_strongweak', 'approval_date_kadiv_strongweak', 'approval_date_kadept_strongweak', 'approval_date_kasie_strongweak', 'is_approved', 'is_approved_presdir', 'is_approved_bod', 'is_approved_kadiv', 'is_approved_kadept', 'is_approved_kasie', 'is_approved_oneyear', 'is_approved_presdir_oneyear', 'is_approved_bod_oneyear', 'is_approved_kadiv_oneyear', 'is_approved_kadept_oneyear', 'is_approved_kasie_oneyear', 'approval_kadept_oneyear', 'approval_kadiv_oneyear', 'approval_kasie_oneyear', 'approval_bod_oneyear', 'approval_presdir_oneyear', 'approval_date_presdir_oneyear', 'approval_date_bod_oneyear', 'approval_date_kadiv_oneyear', 'approval_date_kadept_oneyear', 'approval_date_kasie_oneyear', 'approved_presdir_by', 'approved_bod_by', 'approved_kadiv_by', 'approved_kadept_by', 'approved_kasie_by', 'presdir_by_oneyear', 'bod_by_oneyear', 'kadiv_by_oneyear', 'kadept_by_oneyear', 'kasie_by_oneyear', 'department', 'division', 'section', 'date_submitted', 'date_submitted_one', 'file'];

    public function getStrongweak($id = false){

        if($id == false){
            return $this->findAll();
        }
        
        return $this->where(['id'])->findAll();
    }

    public function getStrongweakData($id) {
        return $this->where('id', $id)->first();
    }

    public function getStrongWeakByUser($id) {
        $this->select('strongweak_main.*, users.nama as nama, users.department as department, users.division as division, users.section as section');
        $this->join('users', 'users.npk = strongweak_main.created_by', 'left');
        return $this->where('created_by', $id)->findAll();
    }

    public function getStrongweakByDepartmentAndDivision() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');
        $notAllowedNpk = [3659, 3651];
        
        $builder = $this->db->table('strongweak_main');
        $builder->select('strongweak_main.*');
        $builder->join('users', 'users.npk = strongweak_main.created_by', 'left');
        
        if ($kode_jabatan == 3) {
            // Approval kadept untuk staff
            if ($npk == 4210) {
                $builder->groupStart()
                            ->where('users.kode_jabatan', 8)
                            ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd()
                        ->groupStart()
                            ->where('strongweak_main.id_department', 3)
                            ->orWhere('strongweak_main.id_department', 4)
                        ->groupEnd()
                        ->where('strongweak_main.is_submitted', 1);
            } else {
                // Approval kadept untuk staff
                $builder->groupStart()
                ->where('users.kode_jabatan', 8)
                    ->orWhere('users.kode_jabatan', 4)
                ->groupEnd()
                ->where('strongweak_main.is_submitted', 1)
                ->where('strongweak_main.id_department', $id_department);
            }
        } elseif ($kode_jabatan == 4) {
            $builder->where('users.kode_jabatan', 8)
                    ->groupStart()
                        ->where('users.npk <>', 3651)
                        ->orWhere('users.npk <>', 3659)
                    ->groupEnd()
                    ->where('strongweak_main.id_section', $id_section)
                    ->where('strongweak_main.is_submitted', 1);
        } elseif ($kode_jabatan == 2) {
            // Approval kadiv untuk kadept
            $builder->groupStart()
                        ->where('users.kode_jabatan', 3)
                        ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd()
                    ->where('strongweak_main.id_division', $id_division)
                    ->where('strongweak_main.is_submitted', 1);
        } elseif ($kode_jabatan == 1 && $npk == 3944 ) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 3944
            $builder->where('strongweak_main.is_submitted', 1)
                    ->groupstart()
                        ->groupStart()
                            ->where('users.kode_jabatan', 2)
                            ->whereIn('strongweak_main.id_division', [1, 2])
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('users.kode_jabatan', 3)
                            ->whereIn('strongweak_main.id_division', [1, 2])
                        ->groupEnd()
                    ->groupEnd();                  
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 4170
            $builder->where('strongweak_main.is_submitted', 1)
                    ->groupstart()
                        ->groupStart()
                            ->where('users.kode_jabatan', 2)
                            ->whereIn('strongweak_main.id_division', [3, 4, 5])
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('users.kode_jabatan', 3)
                            ->whereIn('strongweak_main.id_division', [3, 4, 5])
                        ->groupEnd()
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('strongweak_main.is_submitted', 1)
                    ->where('users.kode_jabatan', 2);
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            // Untuk admin
        }
        return $builder->get()->getResultArray();
    }  

    public function getDataByDepartment(...$iddepartment) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.is_submitted', 1)
                ->whereIn('users.id_department', $iddepartment)
                ->whereIn('strongweak_main.id_department', $iddepartment);
                // ->where('strongweak_main.periode NOT LIKE', 'Mid Year%')

            return $builder->get()->getResultArray();
        }
    }

    public function getDataByDivision(...$iddivision) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.is_submitted', 1)
                ->whereIn('users.id_division', $iddivision)
                ->whereIn('strongweak_main.id_division', $iddivision);
                // ->where('strongweak_main.periode NOT LIKE', 'Mid Year%')

            return $builder->get()->getResultArray();
        }
    }

    // Count how many pending data or hasnt approved in mid year
    public function getDataPendingSw() {
        $periodeModel = new \App\Models\PeriodeModel();
        $currentDate = date('Y-m-d H:i:s');
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        if ($periodeMid !== null) {
            $isWithinMidPeriode = ($currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
        } else {
            $isWithinMidPeriode = false;
        }

        if ($periodeOne !== null) {
            $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
        } else {
            $isWithinOnePeriode = false;
        }
        
        $id_department = session()->get('id_department');
        $id_division = session()->get('id_division');
        $id_section = session()->get('id_section');
        $kode_jabatan = session()->get('kode_jabatan');
        $npk           = session()->get('npk');
        $npk = session()->get('npk');
    
        $builder = $this->db->table('strongweak_main');
        $builder->select('strongweak_main.*');
        $builder->join('users', 'users.npk = strongweak_main.created_by', 'left');
        $builder->where('strongweak_main.periode NOT LIKE', 'Mid Year%');
    
        if ($kode_jabatan == 3) {
            if ($npk == 4210) {
                $builder->groupStart()
                    ->where('(strongweak_main.id_department = 3 OR strongweak_main.id_department = 4)')
                    ->groupStart()
                        ->where('(strongweak_main.is_submitted = 1 AND
                                    (
                                        (strongweak_main.kode_jabatan = 4 AND (strongweak_main.approval_kadept_strongweak = 0 OR strongweak_main.approval_kadept_strongweak IS NULL))
                                        OR
                                        (strongweak_main.kode_jabatan = 8 AND strongweak_main.created_by IN (3569, 3651) AND (strongweak_main.approval_kadept_strongweak = 0 OR strongweak_main.approval_kadept_strongweak IS NULL))
                                    ))'
                                )
                        ->orWhere('(strongweak_main.is_submitted_one = 1 AND
                                    (
                                        (strongweak_main.kode_jabatan = 4 AND (strongweak_main.approval_kadept_oneyear = 0 OR strongweak_main.approval_kadept_oneyear IS NULL))
                                        OR
                                        (strongweak_main.kode_jabatan = 8 AND strongweak_main.created_by IN (3569, 3651) AND (strongweak_main.approval_kadept_oneyear = 0 OR strongweak_main.approval_kadept_oneyear IS NULL))
                                    ))'
                                )
                    ->groupEnd();
            } else {
                $builder->where('strongweak_main.id_department', $id_department)
                        ->where('(strongweak_main.is_submitted = 1 AND
                                    (
                                        (strongweak_main.kode_jabatan = 4 AND (strongweak_main.approval_kadept_strongweak = 0 OR strongweak_main.approval_kadept_strongweak IS NULL))
                                        OR
                                        (strongweak_main.kode_jabatan = 8 AND strongweak_main.created_by IN (3569, 3651) AND (strongweak_main.approval_kadept_strongweak = 0 OR strongweak_main.approval_kadept_strongweak IS NULL))
                                    ))'
                                )
                        ->orWhere('(strongweak_main.is_submitted_one = 1 AND
                                    (
                                        (strongweak_main.kode_jabatan = 4 AND (strongweak_main.approval_kadept_oneyear = 0 OR strongweak_main.approval_kadept_oneyear IS NULL))
                                        OR
                                        (strongweak_main.kode_jabatan = 8 AND strongweak_main.created_by IN (3569, 3651) AND (strongweak_main.approval_kadept_oneyear = 0 OR strongweak_main.approval_kadept_oneyear IS NULL))
                                    ))'
                                );
            }
        } elseif ($kode_jabatan == 4) {
            $builder->where('users.kode_jabatan', 8)
                    ->groupStart()
                        ->where('users.npk <>', 3651)
                        ->orWhere('users.npk <>', 3659)
                    ->groupEnd()
                    ->where('strongweak_main.id_section', $id_section)
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.is_submitted_one', 1)
                            ->groupStart()
                                ->where('strongweak_main.approval_kasie_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd();
        } elseif ($kode_jabatan == 2) {
            $builder->groupStart()
                        ->where('users.kode_jabatan', 3)
                        ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd()
                    ->where('strongweak_main.id_division', $id_division)
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.approval_kadiv_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.is_submitted_one', 1)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd();
        } elseif ($kode_jabatan == 1 && $npk == 3944 ) {
            $builder->where('users.kode_jabatan', 2)
                    ->groupStart()
                        ->where('strongweak_main.id_division', 1)
                        ->orWhere('strongweak_main.id_division', 2)
                    ->groupEnd()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.approval_bod_strongweak', 0)
                            ->orWhere('strongweak_main.approval_bod_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.is_submitted_one', 1)
                            ->groupStart()
                                ->where('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd();
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            $builder->where('users.kode_jabatan', 2)
                    ->groupStart()
                        ->where('strongweak_main.id_division', 3)
                        ->orWhere('strongweak_main.id_division', 4)
                        ->orWhere('strongweak_main.id_division', 5)
                    ->groupEnd()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.approval_bod_strongweak', 0)
                            ->orWhere('strongweak_main.approval_bod_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.is_submitted_one', 1)
                            ->groupStart()
                                ->where('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('users.kode_jabatan', 2)
                    ->where('strongweak_main.is_submitted', 1)
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.approval_presdir_strongweak', 0)
                            ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.is_submitted_one', 1)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            // Untuk admin
            $builder->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('strongweak_main.is_submitted_one', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->orWhere('strongweak_main.approval_kasie_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd();
        }
    
        $count = $builder->countAllResults();
        return $count;
    }
    
    public function getPendingPlantSSw() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.id_division', 4)
                ->groupStart()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('strongweak_main.is_submitted_one', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->orWhere('strongweak_main.approval_kasie_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingFinSw() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.id_division', 2)
                ->groupStart()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('strongweak_main.is_submitted_one', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->orWhere('strongweak_main.approval_kasie_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingAdmSw() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.id_division', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('strongweak_main.is_submitted_one', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->orWhere('strongweak_main.approval_kasie_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingPlantSw() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.id_division', 5)
                ->groupStart()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('strongweak_main.is_submitted_one', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->orWhere('strongweak_main.approval_kasie_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingEngSw() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.id_division', 3)
                ->groupStart()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('strongweak_main.is_submitted_one', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->orWhere('strongweak_main.approval_kasie_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingIsdSw() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('strongweak_main')
                ->select('strongweak_main.*')
                ->join('users', 'users.npk = strongweak_main.created_by', 'left')
                ->where('strongweak_main.id_department', 5)
                ->groupStart()
                    ->groupStart()
                        ->where('strongweak_main.is_submitted', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->where('strongweak_main.approval_kasie_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                            ->orWhere('strongweak_main.approval_kasie_strongweak', null)
                            ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_kadept_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('strongweak_main.approval_kadiv_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_kadiv_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('strongweak_main.approval_presdir_strongweak', 0)
                                ->orWhere('strongweak_main.approval_bod_strongweak', 0)
                                ->orWhere('strongweak_main.approval_presdir_strongweak', null)
                                ->orWhere('strongweak_main.approval_bod_strongweak', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('strongweak_main.is_submitted_one', 1)
                        ->groupStart()
                            ->where('strongweak_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('strongweak_main.created_by <>', 3569)
                                ->where('strongweak_main.created_by <>', 3561)
                            ->groupEnd()
                            ->orWhere('strongweak_main.approval_kasie_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                            ->orWhere('strongweak_main.approval_kasie_oneyear', null)
                            ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('strongweak_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('strongweak_main.kode_jabatan', 8)
                                    ->where('strongweak_main.created_by <>', 3569)
                                    ->where('strongweak_main.created_by <>', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_kadiv_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('strongweak_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('strongweak_main.approval_presdir_oneyear', 0)
                                ->orWhere('strongweak_main.approval_bod_oneyear', 0)
                                ->orWhere('strongweak_main.approval_presdir_oneyear', null)
                                ->orWhere('strongweak_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }
}

?>