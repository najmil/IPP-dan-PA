<?php

namespace App\Models;

use CodeIgniter\Model;

class ProcsumMainModel extends Model
{
    protected $table = 'procsum_main';
    protected $primaryKey = 'id';
    protected $useTimestamps = true;
    protected $allowedFields = ['periode', 'is_submitted_midyear', 'is_submitted_oneyear', 'is_approved_presdir', 'is_approved_bod', 'is_approved_kadiv', 'is_approved_kadept', 'is_approved_kasie', 'created_by', 'kode_jabatan', 'nama', 'created_at', 'updated_at', 'id_department', 'id_division', 'id_section', 'approval_kadept_procsum', 'approval_kadiv_procsum', 'approval_kasie_procsum', 'approval_bod_procsum', 'approval_presdir_procsum', 'approval_date_kasie_procsum', 'approval_date_kadept_procsum', 'approval_date_kadiv_procsum', 'approval_date_bod_procsum', 'approval_date_presdir_procsum', 'approved_presdir_by', 'approved_bod_by', 'approved_kadiv_by', 'approved_kadept_by', 'approved_kasie_by', 'date_submitted', 'is_submitted_oneyear', 'date_submitted_oneyear', 'is_approved_presdir_oneyear', 'is_approved_bod_oneyear', 'is_approved_kadiv_oneyear', 'is_approved_kadept_oneyear', 'is_approved_kasie_oneyear', 'approval_kadept_midyear', 'approval_kadiv_midyear', 'approval_kasie_midyear', 'approval_bod_midyear', 'approval_presdir_midyear', 'approval_date_presdir_midyear', 'approval_date_bod_midyear', 'approval_date_kadiv_midyear', 'approval_date_kadept_midyear', 'approval_date_kasie_midyear', 'approval_kadept_oneyear', 'approval_kadiv_oneyear', 'approval_kasie_oneyear', 'approval_bod_oneyear', 'approval_presdir_oneyear', 'approval_date_presdir_oneyear', 'approval_date_bod_oneyear', 'approval_date_kadiv_oneyear', 'approval_date_kadept_oneyear', 'approval_date_kasie_oneyear', 'presdir_by_oneyear', 'bod_by_oneyear', 'kadiv_by_oneyear', 'kadept_by_oneyear', 'kasie_by_oneyear', 'department', 'division', 'section', 'file'];

    public function getSavedData($id) {
        return $this->where('id', $id)->first();
    }

    public function getSavedDataWithDepartment($id) {
        return $this->select('procsum_main.*, users.department as department, users.division as division')
                    ->join('users', 'users.kode_jabatan = procsum_main.kode_jabatan AND users.id_department = procsum_main.id_department', 'left')
                    ->where('procsum_main.id', $id)
                    ->first();
    }    

    public function getIppByUser($id) {
        $this->select('procsum_main.*, users.nama as nama');
        $this->join('users', 'users.npk = procsum_main.created_by', 'left');
        return $this->where('created_by', $id)->findAll();
    }

    public function getSumMidyear($id){
        $this->select('procsum_main.*, main.sum_midyear_total');
        $this->join('main', 'main.id = procsum_main.id_main', 'left');
        return $this->where('id_main', $id)->first();
    }

    public function getProcsumByDepartmentAndDivision() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');
        $notAllowedNpk = [960, 4277, 3659, 1814, 2070, 2322, 2364, 2592];
        
        $builder = $this->db->table('procsum_main');
        $builder->select('procsum_main.*');
        $builder->join('users', 'users.npk = procsum_main.created_by', 'left');
        
        if ($kode_jabatan == 3) {
            // Approval kadept untuk staff
            if ($npk == 4210) {
                $builder->groupStart()
                    ->orWhere('users.kode_jabatan', 8)
                    ->orWhere('users.kode_jabatan', 4)
                    ->groupEnd();
                $builder->groupStart()
                    ->orWhere('procsum_main.id_department', 3)
                    ->orWhere('procsum_main.id_department', 4)
                    ->groupEnd();
            }
            else {
                // Approval kadept untuk staff
                $builder->groupStart()
                        ->orWhere('users.kode_jabatan', 8)
                        ->orWhere('users.kode_jabatan', 4)
                        ->groupEnd();
                $builder->where('procsum_main.id_department', $id_department);
            }
        } elseif ($kode_jabatan == 4) {
            $builder->where('users.kode_jabatan', 8)
                    ->whereNotIn('users.npk', $notAllowedNpk)
                    ->where('procsum_main.id_section', $id_section);
        } elseif ($kode_jabatan == 2) {
            // Approval kadiv untuk kadept
            $builder->whereIn('users.kode_jabatan', [3, 4])
                    ->where('procsum_main.id_division', $id_division);
            // $builder->groupStart()
            //     ->where('users.kode_jabatan', 8)
            //     ->whereNotIn('users.npk', $notAllowedNpk)
            //     ->where('procsum_main.id_section', $id_division)
            //     ->groupEnd();
        } elseif ($kode_jabatan == 1 && $npk == 3944 ) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 3944
            $builder->where('users.kode_jabatan', 2)
                    ->whereIn('procsum_main.id_division', [1, 2])
                    ->orWhere('users.kode_jabatan', 3)
                    ->whereIn('procsum_main.id_division', [1, 2]);                  
        } elseif (($kode_jabatan == 1 && $npk == 4170 )) {
            // Approval BoD untuk kadept untuk yang di bawah divisi 4170
            $builder->where('users.kode_jabatan', 2)
                    ->whereIn('procsum_main.id_division', [3, 4, 5])
                    ->orWhere('users.kode_jabatan', 3)
                    ->whereIn('procsum_main.id_division', [3, 4, 5]);
        } elseif ($kode_jabatan == 0 && $npk == 4280){
            $builder->where('users.kode_jabatan', 2);
        } elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            // Untuk admin
        }
        return $builder->get()->getResultArray();
    }   

    public function getDataByDepartment(...$iddepartment) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.periode NOT LIKE', 'Mid Year%')
                ->whereIn('users.id_department', $iddepartment)
                ->whereIn('procsum_main.id_department', $iddepartment);

            return $builder->get()->getResultArray();
        }
    }

    public function getDataByDivision(...$iddivision) {
        if (session()->get('npk') == 0) {
            $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.periode NOT LIKE', 'Mid Year%')
                ->whereIn('users.id_division', $iddivision)
                ->whereIn('procsum_main.id_division', $iddivision);

            return $builder->get()->getResultArray();
        }
    }

    // Count how many pending data or hasnt approve in mid year and one year
    public function getDataPendingMid() {
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
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('procsum_main');
        $builder->select('procsum_main.*');
        $builder->join('users', 'users.npk = procsum_main.created_by', 'left');

        if ($kode_jabatan == 3) {
            if ($npk == 4210) {
                $builder->groupStart()
                    ->where('(procsum_main.id_department = 3 OR procsum_main.id_department = 4)')
                    ->groupStart()
                        ->where('(procsum_main.is_submitted_midyear = 1 AND
                                    (
                                        (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL))
                                        OR
                                        (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL))
                                    ))'
                                )
                        ->orWhere('(procsum_main.is_submitted_oneyear = 1 AND
                                    (
                                        (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL))
                                        OR
                                        (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL))
                                    ))'
                                )
                    ->groupEnd();
            } else {
                $builder->where('procsum_main.id_department', $id_department)->where('(procsum_main.is_submitted_midyear = 1 AND
                                    (
                                        (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL))
                                        OR
                                        (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL))
                                    ))'
                                )
                        ->orWhere('(procsum_main.is_submitted_oneyear = 1 AND
                                    (
                                        (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL))
                                        OR
                                        (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL))
                                    ))'
                                );
            }
        } elseif ($kode_jabatan == 4) {
            $builder->where('procsum_main.id_section', $id_section)
                    ->groupStart()
                        ->where('(procsum_main.is_submitted_midyear = 1 AND
                                    (
                                        procsum_main.kode_jabatan = 8 AND procsum_main.created_by NOT IN (3569, 3651) AND
                                        (
                                            (procsum_main.approval_kasie_midyear = 0 OR procsum_main.approval_kasie_midyear IS NULL)
                                            OR
                                            (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL)
                                        )
                                    ))'
                                )
                        ->orWhere('(procsum_main.is_submitted_oneyear = 1 AND
                                (
                                    procsum_main.kode_jabatan = 8 AND procsum_main.created_by NOT IN (3569, 3651) AND
                                    (
                                        (procsum_main.approval_kasie_oneyear = 0 OR procsum_main.approval_kasie_oneyear IS NULL)
                                        OR
                                        (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL)
                                    )
                                ))'
                            )
                    ->groupEnd();
        } elseif ($kode_jabatan == 2) {
            $builder->where('procsum_main.id_division', $id_division)
                    ->groupStart()
                        ->where('(procsum_main.is_submitted_midyear = 1 AND
                                    (
                                        (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_kadiv_midyear = 0 OR procsum_main.approval_kadiv_midyear IS NULL))
                                        OR
                                        (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_kadiv_midyear = 0 OR procsum_main.approval_kadiv_midyear IS NULL))
                                    ))'
                                )
                        ->orWhere('(procsum_main.is_submitted_oneyear = 1 AND
                                    (
                                        (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_kadiv_oneyear = 0 OR procsum_main.approval_kadiv_oneyear IS NULL))
                                        OR
                                        (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_kadiv_oneyear = 0 OR procsum_main.approval_kadiv_oneyear IS NULL))
                                    ))'
                                )
                    ->groupEnd();
        } elseif ($kode_jabatan == 1 && $npk == 3944) {
            $builder->groupStart()
                    ->where('(procsum_main.id_division = 1 OR procsum_main.id_division = 2)')
                    ->groupStart()
                        ->where('(procsum_main.is_submitted_midyear = 1 AND
                                (
                                    (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_bod_midyear = 0 OR procsum_main.approval_bod_midyear IS NULL))
                                    OR
                                    (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_bod_midyear = 0 OR procsum_main.approval_bod_midyear IS NULL))
                                ))'
                            )
                        ->orWhere('(procsum_main.is_submitted_oneyear = 1 AND
                                (
                                    (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_bod_oneyear = 0 OR procsum_main.approval_bod_oneyear IS NULL))
                                    OR
                                    (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_bod_oneyear = 0 OR procsum_main.approval_bod_oneyear IS NULL))
                                ))'
                            )
                    ->groupEnd();
        } elseif ($kode_jabatan == 1 && $npk == 4170) {
            $builder->groupStart()
                    ->where('(procsum_main.id_division = 3 OR procsum_main.id_division = 4 OR procsum_main.id_division = 5)')
                    ->groupStart()
                        ->where('(procsum_main.is_submitted_midyear = 1 AND
                                (
                                    (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_bod_midyear = 0 OR procsum_main.approval_bod_midyear IS NULL))
                                    OR
                                    (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_bod_midyear = 0 OR procsum_main.approval_bod_midyear IS NULL))
                                ))'
                            )
                        ->orWhere('(procsum_main.is_submitted_oneyear = 1 AND
                                (
                                    (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_bod_oneyear = 0 OR procsum_main.approval_bod_oneyear IS NULL))
                                    OR
                                    (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_bod_oneyear = 0 OR procsum_main.approval_bod_oneyear IS NULL))
                                ))'
                            )
                    ->groupEnd();
        } elseif ($kode_jabatan == 0 && $npk == 4280) {
            $builder->where('(procsum_main.is_submitted_midyear = 1 AND
                                (
                                    (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_presdir_midyear = 0 OR procsum_main.approval_presdir_midyear IS NULL))
                                    OR
                                    (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_presdir_midyear = 0 OR procsum_main.approval_presdir_midyear IS NULL))
                                )
                            )'
                        )
                    ->orWhere('(procsum_main.is_submitted_oneyear = 1 AND
                                (
                                    (procsum_main.kode_jabatan = 4 AND (procsum_main.approval_presdir_oneyear = 0 OR procsum_main.approval_presdir_oneyear IS NULL))
                                    OR
                                    (procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND (procsum_main.approval_presdir_oneyear = 0 OR procsum_main.approval_presdir_oneyear IS NULL))
                                )
                            )'
                    );
        }
         elseif ($kode_jabatan == 0 && ($npk == null || $npk == 0)) {
            // Untuk admin
            $builder->where(
                '(
                    procsum_main.is_submitted_midyear = 1 AND
                    (
                        (
                            procsum_main.kode_jabatan = 8 AND procsum_main.created_by NOT IN (3569, 3651) AND
                            (
                                (procsum_main.approval_kasie_midyear = 0 OR procsum_main.approval_kasie_midyear IS NULL) OR
                                (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL)
                            )
                        )
                        OR
                        (
                            procsum_main.kode_jabatan = 4 AND
                            (
                                (procsum_main.approval_kadiv_midyear = 0 OR procsum_main.approval_kadiv_midyear IS NULL) OR
                                (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL)
                            )
                            OR
                            (
                                procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND
                                (
                                    (procsum_main.approval_kadiv_midyear = 0 OR procsum_main.approval_kadiv_midyear IS NULL) OR
                                    (procsum_main.approval_kadept_midyear = 0 OR procsum_main.approval_kadept_midyear IS NULL)
                                )
                            )
                        )
                        OR
                        (
                            procsum_main.kode_jabatan = 3 AND
                            (
                                (procsum_main.approval_kadiv_midyear = 0 OR procsum_main.approval_kadiv_midyear IS NULL) OR
                                (procsum_main.approval_bod_midyear = 0 OR procsum_main.approval_bod_midyear IS NULL)
                            )
                        )
                        OR
                        (
                            procsum_main.kode_jabatan = 2 AND
                            (
                                (procsum_main.approval_presdir_midyear = 0 OR procsum_main.approval_presdir_midyear IS NULL) OR
                                (procsum_main.approval_bod_midyear = 0 OR procsum_main.approval_bod_midyear IS NULL)
                            )
                        )
                    )
                )
                OR
                (
                    procsum_main.is_submitted_oneyear = 1 AND
                    (
                        (
                            procsum_main.kode_jabatan = 8 AND procsum_main.created_by NOT IN (3569, 3651) AND
                            (
                                (procsum_main.approval_kasie_oneyear = 0 OR procsum_main.approval_kasie_oneyear IS NULL) OR
                                (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL)
                            )
                        )
                        OR
                        (
                            procsum_main.kode_jabatan = 4 AND
                            (
                                (procsum_main.approval_kadiv_oneyear = 0 OR procsum_main.approval_kadiv_oneyear IS NULL) OR
                                (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL)
                            )
                            OR
                            (
                                procsum_main.kode_jabatan = 8 AND procsum_main.created_by IN (3569, 3651) AND
                                (
                                    (procsum_main.approval_kadiv_oneyear = 0 OR procsum_main.approval_kadiv_oneyear IS NULL) OR
                                    (procsum_main.approval_kadept_oneyear = 0 OR procsum_main.approval_kadept_oneyear IS NULL)
                                )
                            )
                        )
                        OR
                        (
                            procsum_main.kode_jabatan = 3 AND
                            (
                                (procsum_main.approval_kadiv_oneyear = 0 OR procsum_main.approval_kadiv_oneyear IS NULL) OR
                                (procsum_main.approval_bod_oneyear = 0 OR procsum_main.approval_bod_oneyear IS NULL)
                            )
                        )
                        OR
                        (
                            procsum_main.kode_jabatan = 2 AND
                            (
                                (procsum_main.approval_presdir_oneyear = 0 OR procsum_main.approval_presdir_oneyear IS NULL) OR
                                (procsum_main.approval_bod_oneyear = 0 OR procsum_main.approval_bod_oneyear IS NULL)
                            )
                        )
                    )
                )'
            );
        }
    
        $count = $builder->countAllResults();
        return $count;
    }

    public function getPendingPlantSProc() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.id_division', 4)
                ->groupStart()
                    ->groupStart()
                        ->where('procsum_main.is_submitted_midyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->where('procsum_main.approval_kasie_midyear', 0)
                            ->orWhere('procsum_main.approval_kadept_midyear', 0)
                            ->orWhere('procsum_main.approval_kasie_midyear', null)
                            ->orWhere('procsum_main.approval_kadept_midyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_kadept_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_kadept_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('procsum_main.approval_presdir_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_presdir_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('procsum_main.is_submitted_oneyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->orWhere('procsum_main.approval_kasie_oneyear', 0)
                            ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                            ->orWhere('procsum_main.approval_kasie_oneyear', null)
                            ->orWhere('procsum_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_presdir_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_presdir_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingFinProc() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.id_division', 2)
                ->groupStart()
                    ->groupStart()
                        ->where('procsum_main.is_submitted_midyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->where('procsum_main.approval_kasie_midyear', 0)
                            ->orWhere('procsum_main.approval_kadept_midyear', 0)
                            ->orWhere('procsum_main.approval_kasie_midyear', null)
                            ->orWhere('procsum_main.approval_kadept_midyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_kadept_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_kadept_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('procsum_main.approval_presdir_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_presdir_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('procsum_main.is_submitted_oneyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->orWhere('procsum_main.approval_kasie_oneyear', 0)
                            ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                            ->orWhere('procsum_main.approval_kasie_oneyear', null)
                            ->orWhere('procsum_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_presdir_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_presdir_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingAdmProc() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.id_division', 1)
                ->groupStart()
                    ->groupStart()
                        ->where('procsum_main.is_submitted_midyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->where('procsum_main.approval_kasie_midyear', 0)
                            ->orWhere('procsum_main.approval_kadept_midyear', 0)
                            ->orWhere('procsum_main.approval_kasie_midyear', null)
                            ->orWhere('procsum_main.approval_kadept_midyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_kadept_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_kadept_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('procsum_main.approval_presdir_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_presdir_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('procsum_main.is_submitted_oneyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->orWhere('procsum_main.approval_kasie_oneyear', 0)
                            ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                            ->orWhere('procsum_main.approval_kasie_oneyear', null)
                            ->orWhere('procsum_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_presdir_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_presdir_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingPlantProc() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.id_division', 5)
                ->groupStart()
                    ->groupStart()
                        ->where('procsum_main.is_submitted_midyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->where('procsum_main.approval_kasie_midyear', 0)
                            ->orWhere('procsum_main.approval_kadept_midyear', 0)
                            ->orWhere('procsum_main.approval_kasie_midyear', null)
                            ->orWhere('procsum_main.approval_kadept_midyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_kadept_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_kadept_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('procsum_main.approval_presdir_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_presdir_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('procsum_main.is_submitted_oneyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->orWhere('procsum_main.approval_kasie_oneyear', 0)
                            ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                            ->orWhere('procsum_main.approval_kasie_oneyear', null)
                            ->orWhere('procsum_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_presdir_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_presdir_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingEngProc() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.id_division', 3)
                ->groupStart()
                    ->groupStart()
                        ->where('procsum_main.is_submitted_midyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->where('procsum_main.approval_kasie_midyear', 0)
                            ->orWhere('procsum_main.approval_kadept_midyear', 0)
                            ->orWhere('procsum_main.approval_kasie_midyear', null)
                            ->orWhere('procsum_main.approval_kadept_midyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_kadept_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_kadept_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('procsum_main.approval_presdir_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_presdir_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('procsum_main.is_submitted_oneyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->orWhere('procsum_main.approval_kasie_oneyear', 0)
                            ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                            ->orWhere('procsum_main.approval_kasie_oneyear', null)
                            ->orWhere('procsum_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_presdir_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_presdir_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }

    public function getPendingIsdProc() {
        $id_department = session()->get('id_department');
        $id_division   = session()->get('id_division');
        $id_section    = session()->get('id_section');
        $kode_jabatan  = session()->get('kode_jabatan');
        $npk           = session()->get('npk');

        $builder = $this->db->table('procsum_main')
                ->select('procsum_main.*')
                ->join('users', 'users.npk = procsum_main.created_by', 'left')
                ->where('procsum_main.id_department', 5)
                ->groupStart()
                    ->groupStart()
                        ->where('procsum_main.is_submitted_midyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->where('procsum_main.approval_kasie_midyear', 0)
                            ->orWhere('procsum_main.approval_kadept_midyear', 0)
                            ->orWhere('procsum_main.approval_kasie_midyear', null)
                            ->orWhere('procsum_main.approval_kadept_midyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_kadept_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_kadept_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->where('procsum_main.approval_kadiv_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->where('procsum_main.approval_presdir_midyear', 0)
                                ->orWhere('procsum_main.approval_bod_midyear', 0)
                                ->orWhere('procsum_main.approval_presdir_midyear', null)
                                ->orWhere('procsum_main.approval_bod_midyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                    ->orGroupStart()
                        ->where('procsum_main.is_submitted_oneyear', 1)
                        ->groupStart()
                            ->where('procsum_main.kode_jabatan', 8)
                            ->groupStart()
                                ->where('procsum_main.created_by', '!=', 3569)
                                ->where('procsum_main.created_by', '!=', 3561)
                            ->groupEnd()
                            ->orWhere('procsum_main.approval_kasie_oneyear', 0)
                            ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                            ->orWhere('procsum_main.approval_kasie_oneyear', null)
                            ->orWhere('procsum_main.approval_kadept_oneyear', null)
                        ->groupEnd()
                        ->orGroupStart()
                            ->groupStart()
                                ->where('procsum_main.kode_jabatan', 4)
                                ->orGroupStart()
                                    ->where('procsum_main.kode_jabatan', 8)
                                    ->where('procsum_main.created_by', '!=', 3569)
                                    ->where('procsum_main.created_by', '!=', 3561)
                                ->groupEnd()
                            ->groupEnd()
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadept_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_kadept_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 3)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_kadiv_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_kadiv_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                        ->orGroupStart()
                            ->where('procsum_main.kode_jabatan', 2)
                            ->groupStart()
                                ->orWhere('procsum_main.approval_presdir_oneyear', 0)
                                ->orWhere('procsum_main.approval_bod_oneyear', 0)
                                ->orWhere('procsum_main.approval_presdir_oneyear', null)
                                ->orWhere('procsum_main.approval_bod_oneyear', null)
                            ->groupEnd()
                        ->groupEnd()
                    ->groupEnd()
                ->groupEnd();

        return $builder->countAllResults();
    }
}
