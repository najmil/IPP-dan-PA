<?php

namespace App\Controllers;

use App\Models\ProcsumModel;
use App\Models\ProcsumMainModel;
use CodeIgniter\Controller;
use App\Models\IsiModel;
use App\Models\IppModel;
use App\Models\LoginModel;
use App\Models\PeriodeModel;
use App\Models\MidyearModel;
use App\Models\LogModel;
use App\Models\StrongWeakMainModel;
use Dompdf\Dompdf;
use Config\Paths;

class Procsum extends BaseController
{
    public function __construct(){
        $this->procsummodel = new ProcsumModel();
        $this->procsummain = new ProcsumMainModel();  
        $this->ippModel = new IppModel();  
        $this->isiModel = new IsiModel();     
        $this->midyearisi   = new MidyearModel(); 
        $this->logModel     = new LogModel();  
        $this->strongweakmain   = new StrongWeakMainModel();    
    }

    public function index(){
        $user = session()->get('npk');
        $procsum = $this->procsummain->getIppByUser($user);
        // dd($user);
        $approval = $this->ippModel->getIppByUser($user);

        // $loginModel = new LoginModel();
        $nama = session()->get('nama');

        $data = [
            'tittle'   => 'Process and Summary',
            'procsum'  => $procsum,
            'nama'     => $nama,
            'approval' => $approval,
            'countPending' => $this->ippModel->getDataPending(),
            'countPendingPlantS' => $this->ippModel->getPendingPlantS(),
            'countPendingAdm' => $this->ippModel->getPendingAdm(),
            'countPendingFin' => $this->ippModel->getPendingFin(),
            'countPendingPlant' => $this->ippModel->getPendingPlant(),
            'countPendingEng' => $this->ippModel->getPendingEng(),
            'countPendingIsd' => $this->ippModel->getPendingIsd(),

            'countPendingMid' => $this->ippModel->getDataPendingMid(),
            'countPendingPlantSMid' => $this->ippModel->getPendingPlantSMid(),
            'countPendingAdmMid' => $this->ippModel->getPendingAdmMid(),
            'countPendingFinMid' => $this->ippModel->getPendingFinMid(),
            'countPendingPlantMid' => $this->ippModel->getPendingPlantMid(),
            'countPendingEngMid' => $this->ippModel->getPendingEngMid(),
            'countPendingIsdMid' => $this->ippModel->getPendingIsdMid(),

            'countPendingOne' => $this->ippModel->getDataPendingOne(),
            'countPendingPlantSOne' => $this->ippModel->getPendingPlantSOne(),
            'countPendingAdmOne' => $this->ippModel->getPendingAdmOne(),
            'countPendingFinOne' => $this->ippModel->getPendingFinOne(),
            'countPendingPlantOne' => $this->ippModel->getPendingPlantOne(),
            'countPendingEngOne' => $this->ippModel->getPendingEngOne(),
            'countPendingIsdOne' => $this->ippModel->getPendingIsdOne(),
            
            'countPendingSw' => $this->strongweakmain->getDataPendingSw(),
            'countPendingPlantSSw' => $this->strongweakmain->getPendingPlantSSw(),
            'countPendingAdmSw' => $this->strongweakmain->getPendingAdmSw(),
            'countPendingFinSw' => $this->strongweakmain->getPendingFinSw(),
            'countPendingPlantSw' => $this->strongweakmain->getPendingPlantSw(),
            'countPendingEngSw' => $this->strongweakmain->getPendingEngSw(),
            'countPendingIsdSw' => $this->strongweakmain->getPendingIsdSw(),

            // 'countPendingSOne' => $this->strongweakmain->getDataPendingOne(),
            'countPendingPMid' => $this->procsummain->getDataPendingMid(),
            'countPendingPlantSProc' => $this->procsummain->getPendingPlantSProc(),
            'countPendingAdmProc' => $this->procsummain->getPendingAdmProc(),
            'countPendingFinProc' => $this->procsummain->getPendingFinProc(),
            'countPendingPlantProc' => $this->procsummain->getPendingPlantProc(),
            'countPendingEngProc' => $this->procsummain->getPendingEngProc(),
            'countPendingIsdProc' => $this->procsummain->getPendingIsdProc(),
        ];
        
        return view('procsum/index', $data);
    }

    // Save for the procsum's periode
    public function save() {
        $periodeInput = $this->request->getPost('periodeInput'); 
        $created_by = session()->get('npk');
        $kode_jabatan = session()->get('kode_jabatan');
        $id_division = session()->get('id_division');
        $id_department = session()->get('id_department');
        $id_section = session()->get('id_section');
        $dateTimeNow = new \DateTime();
        $created_at = $dateTimeNow->format('Y-m-d H:i:s');
        $updated_at = $dateTimeNow->format('Y-m-d H:i:s');
    
        if (empty($periodeInput)) {
            $hasil['sukses'] = false;
            $hasil['gagal'] = "Periode cannot be empty.";
        } else {
            $existingIpp = $this->procsummain
            ->where('periode', $periodeInput)
            ->where('created_by', $created_by)
            ->first();
    
            if ($existingIpp) {
                $hasil['sukses'] = false;
                $hasil['gagal'] = "Performance Appraisal (Process Summary) untuk periode ini sudah ada.";
            } else {
                $nama = session()->get('nama');
                
                $data = [
                    'nama' => $nama,
                    'created_at' => $created_at,
                    'periode' => $periodeInput,
                    'created_by' => $created_by,
                    'id_department' => $id_department,
                    'id_division' => $id_division,
                    'id_section' => $id_section,
                    'kode_jabatan' => $kode_jabatan
                ];
    
                $this->procsummain->insert($data);
    
                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['gagal'] = false;
            }
        }
    
        return json_encode($hasil);
    }

    public function detail($id) {
        $mainData         = $this->procsummain->find($id);
        $npk              = $mainData['created_by'];
        $user             = session()->get('npk');
        $kode_jabatan     = session()->get('kode_jabatan');
        $sum_midyear_total= $this->midyearisi->callTotalScore($id);
        $sum_oneyear_total= $this->midyearisi->callTotalScoreOne($id);
        // dd($sum_midyear_total);
        $validation       = \Config\Services::validation();
        $periode          = $mainData['periode'];
        // $sum_total        = $this->midyearisi->getSumTotal($id_main);
        $dataproc         = $this->procsummodel->getIsi($id);
        // dd($dataproc);

        // if (strpos($periode, 'One Year') !== false) {
        //     return redirect()->to(base_url("procsum/detail_one/{$id}"));
        // }
    
        // dd($dataproc);
        $data = [
            'tittle'                => 'Detail Process & Summary Karyawan (Mid Year)',
            'procsum'               => $this->procsummodel->getSavedData($id),
            'id_procsum_main'       => $id,
            'npk'                   => $npk,
            'validation'            => $validation,
            'periode'               => $periode,
            'sum_midyear_total'     => $sum_midyear_total,
            'sum_oneyear_total'     => $sum_oneyear_total,
            'kode_jabatan'          => $kode_jabatan,
            'is_submitted_midyear'  => $mainData['is_submitted_midyear'],
            'is_submitted_oneyear'  => $mainData['is_submitted_oneyear'],
            'is_saved_oneyear'      => isset($dataproc[0]['is_saved_oneyear']) ? $dataproc[0]['is_saved_oneyear'] : null,
            'data'                  => $dataproc,
            'countPending' => $this->ippModel->getDataPending(),
            'countPendingPlantS' => $this->ippModel->getPendingPlantS(),
            'countPendingAdm' => $this->ippModel->getPendingAdm(),
            'countPendingFin' => $this->ippModel->getPendingFin(),
            'countPendingPlant' => $this->ippModel->getPendingPlant(),
            'countPendingEng' => $this->ippModel->getPendingEng(),
            'countPendingIsd' => $this->ippModel->getPendingIsd(),

            'countPendingMid' => $this->ippModel->getDataPendingMid(),
            'countPendingPlantSMid' => $this->ippModel->getPendingPlantSMid(),
            'countPendingAdmMid' => $this->ippModel->getPendingAdmMid(),
            'countPendingFinMid' => $this->ippModel->getPendingFinMid(),
            'countPendingPlantMid' => $this->ippModel->getPendingPlantMid(),
            'countPendingEngMid' => $this->ippModel->getPendingEngMid(),
            'countPendingIsdMid' => $this->ippModel->getPendingIsdMid(),

            'countPendingOne' => $this->ippModel->getDataPendingOne(),
            'countPendingPlantSOne' => $this->ippModel->getPendingPlantSOne(),
            'countPendingAdmOne' => $this->ippModel->getPendingAdmOne(),
            'countPendingFinOne' => $this->ippModel->getPendingFinOne(),
            'countPendingPlantOne' => $this->ippModel->getPendingPlantOne(),
            'countPendingEngOne' => $this->ippModel->getPendingEngOne(),
            'countPendingIsdOne' => $this->ippModel->getPendingIsdOne(),
            
            'countPendingSw' => $this->strongweakmain->getDataPendingSw(),
            'countPendingPlantSSw' => $this->strongweakmain->getPendingPlantSSw(),
            'countPendingAdmSw' => $this->strongweakmain->getPendingAdmSw(),
            'countPendingFinSw' => $this->strongweakmain->getPendingFinSw(),
            'countPendingPlantSw' => $this->strongweakmain->getPendingPlantSw(),
            'countPendingEngSw' => $this->strongweakmain->getPendingEngSw(),
            'countPendingIsdSw' => $this->strongweakmain->getPendingIsdSw(),

            // 'countPendingSOne' => $this->strongweakmain->getDataPendingOne(),
            'countPendingPMid' => $this->procsummain->getDataPendingMid(),
            'countPendingPlantSProc' => $this->procsummain->getPendingPlantSProc(),
            'countPendingAdmProc' => $this->procsummain->getPendingAdmProc(),
            'countPendingFinProc' => $this->procsummain->getPendingFinProc(),
            'countPendingPlantProc' => $this->procsummain->getPendingPlantProc(),
            'countPendingEngProc' => $this->procsummain->getPendingEngProc(),
            'countPendingIsdProc' => $this->procsummain->getPendingIsdProc(),
        ];

        return view('procsum/detail', $data); 
    }  
        
    // Save submit data
    public function insert_data(){
        if ($this->request->isAJAX()) {
            $id_procsum_main = $this->request->getPost('id_procsum_main');
            $logData = [];
            $dateSubmitted = date('Y-m-d');

            $periodeModel = new \App\Models\PeriodeModel();
            $periodeMid = $periodeModel->getLatestMidPeriode();
            $periodeOne = $periodeModel->getLatestOnePeriode();                            
            // dd($periodeIPP);

            $currentDate = date('Y-m-d H:i:s');
            $isWithinMidPeriode = ($periodeMid !== null && $currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
            $isWithinOnePeriode = ($periodeOne !== null && $currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);

            if($isWithinMidPeriode){
                $this->procsummodel->set(['is_submitted_midyear' => 1])->where(['id_procsum_main' => $id_procsum_main])->update();
                // dd($insertData);
        
                $this->procsummain->set([
                    'is_submitted_midyear' => 1,
                    'date_submitted'       => $dateSubmitted
                ])->where(['id' => $id_procsum_main])->update();
            } elseif($isWithinOnePeriode){
                $this->procsummodel->set(['is_submitted_oneyear' => 1])->where(['id_procsum_main' => $id_procsum_main])->update();
                // dd($insertData);
        
                $this->procsummain->set([
                    'is_submitted_oneyear'  => 1,
                    'date_submitted_oneyear'=> $dateSubmitted
                ])->where(['id' => $id_procsum_main])->update();
            }

            $response = [
                'sukses' => true,
                'message' => 'Data berhasil disimpan.'
            ];
    
            return $this->response->setJSON($response);
        }
    }  

    // Save the "save temporarily" data
    public function save_temporarily(){
        $request = $this->request;

        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();                            
        // dd($periodeIPP);

        $currentDate = date('Y-m-d H:i:s');
        $isWithinMidPeriode = ($periodeMid !== null && $currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
        $isWithinOnePeriode = ($periodeOne !== null && $currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);

        if ($request->isAJAX()) {
            $validation = \Config\Services::validation();
    
            $id_procsum_main = $request->getPost('id_procsum_main');
            $plan_mid = $request->getPost('plan_mid');
            $do_mid = $request->getPost('do_mid');
            $check_mid = $request->getPost('check_mid');
            $act_mid = $request->getPost('act_mid');
            $teamwork_mid = $request->getPost('teamwork_mid');
            $cust_mid = $request->getPost('cust_mid');
            $passion_mid = $request->getPost('passion_mid');
            $gc_mid = $request->getPost('gc_mid');
            $delegating_mid = $request->getPost('delegating_mid');
            $couch_mid = $request->getPost('couch_mid');
            $develop_mid = $request->getPost('develop_mid');
            $result_mid = $request->getPost('result_mid');
            $midyear_value = $request->getPost('midyear_value');
            $plan_one = $request->getPost('plan_one');
            $do_one = $request->getPost('do_one');
            $check_one = $request->getPost('check_one');
            $act_one = $request->getPost('act_one');
            $teamwork_one = $request->getPost('teamwork_one');
            $cust_one = $request->getPost('cust_one');
            $passion_one = $request->getPost('passion_one');
            $gc_one = $request->getPost('gc_one');
            $delegating_one = $request->getPost('delegating_one');
            $couch_one = $request->getPost('couch_one');
            $develop_one = $request->getPost('develop_one');
            $result_one = $request->getPost('result_one');
            $oneyear_value = $request->getPost('oneyear_value');
            
            // $user = session()->get('npk');
            $kode_jabatan = session()->get('kode_jabatan');
            
            // Validasi input
            if($isWithinMidPeriode){
                $validationRules = [
                    'plan_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'do_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'check_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'act_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'teamwork_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'cust_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'passion_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                ];
                if ($kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) {
                    $validationRules = [
                        'gc_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                        'delegating_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                        'couch_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                        'develop_mid' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]'
                    ];
                }
            } elseif($isWithinOnePeriode){
                $validationRules = [
                    'plan_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'do_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'check_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'act_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'teamwork_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'cust_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                    'passion_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                ];
                if ($kode_jabatan != 8 || ($kode_jabatan == 4 && $npk != [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) {
                    $validationRules = [
                        'gc_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                        'delegating_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                        'couch_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]',
                        'develop_one' => 'required|numeric|greater_than_equal_to[1]|less_than_equal_to[5]'
                    ];
                }
            }

            $validationMessages = [
                'plan_mid' => [
                    'required' => 'Kolom Plan (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Plan (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Plan (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Plan (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'do_mid' => [
                    'required' => 'Kolom Do (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Do (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Do (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Do (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'check_mid' => [
                    'required' => 'Kolom Check (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Check (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Check (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Check (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'act_mid' => [
                    'required' => 'Kolom Action (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Action (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Action (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Action (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'teamwork_mid' => [
                    'required' => 'Kolom Teamwork (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Teamwork (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Teamwork (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Teamwork (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'cust_mid' => [
                    'required' => 'Kolom Customer Focus (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Customer Focus (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Customer Focus (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Customer Focus (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'passion_mid' => [
                    'required' => 'Kolom Passion for Excellence (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Passion for Excellence (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Passion for Excellence (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Passion for Excellence (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'gc_mid' => [
                    'required' => 'Kolom Getting Commitment on IPP (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Getting Commitment on IPP (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Getting Commitment on IPP (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Getting Commitment on IPP (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'delegating_mid' => [
                    'required' => 'Kolom Delegating (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Delegating (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Delegating (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Delegating (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'couch_mid' => [
                    'required' => 'Kolom Couching and Counseling (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Couching and Counseling (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Couching and Counseling (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Couching and Counseling (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'develop_mid' => [
                    'required' => 'Kolom Developing Subordinate (Mid Year) wajib diisi.',
                    'numeric' => 'Kolom Developing Subordinate (Mid Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Developing Subordinate (Mid Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Developing Subordinate (Mid Year) harus kurang dari atau sama dengan 5.'
                ],
                'plan_one' => [
                    'required' => 'Kolom Plan (One Year) wajib diisi.',
                    'numeric' => 'Kolom Plan (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Plan (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Plan (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'do_one' => [
                    'required' => 'Kolom Do (One Year) wajib diisi.',
                    'numeric' => 'Kolom Do (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Do (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Do (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'check_one' => [
                    'required' => 'Kolom Check (One Year) wajib diisi.',
                    'numeric' => 'Kolom Check (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Check (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Check (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'act_one' => [
                    'required' => 'Kolom Action (One Year) wajib diisi.',
                    'numeric' => 'Kolom Action (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Action (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Action (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'teamwork_one' => [
                    'required' => 'Kolom Teamwork (One Year) wajib diisi.',
                    'numeric' => 'Kolom Teamwork (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Teamwork (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Teamwork (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'cust_one' => [
                    'required' => 'Kolom Customer Focus (One Year) wajib diisi.',
                    'numeric' => 'Kolom Customer Focus (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Customer Focus (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Customer Focus (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'passion_one' => [
                    'required' => 'Kolom Passion for Excellence (One Year) wajib diisi.',
                    'numeric' => 'Kolom Passion for Excellence (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Passion for Excellence (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Passion for Excellence (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'gc_one' => [
                    'required' => 'Kolom Getting Commitment on IPP (One Year) wajib diisi.',
                    'numeric' => 'Kolom Getting Commitment on IPP (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Getting Commitment on IPP (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Getting Commitment on IPP (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'delegating_one' => [
                    'required' => 'Kolom Delegating (One Year) wajib diisi.',
                    'numeric' => 'Kolom Delegating (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Delegating (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Delegating (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'couch_one' => [
                    'required' => 'Kolom Couching and Counseling (One Year) wajib diisi.',
                    'numeric' => 'Kolom Couching and Counseling (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Couching and Counseling (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Couching and Counseling (One Year) harus kurang dari atau sama dengan 5.'
                ],
                'develop_one' => [
                    'required' => 'Kolom Developing Subordinate (One Year) wajib diisi.',
                    'numeric' => 'Kolom Developing Subordinate (One Year) harus berisi angka.',
                    'greater_than_equal_to' => 'Kolom Developing Subordinate (One Year) harus lebih dari atau sama dengan 1.',
                    'less_than_equal_to' => 'Kolom Developing Subordinate (One Year) harus kurang dari atau sama dengan 5.'
                ]
            ];

            $validation->setRules($validationRules, $validationMessages);

            if (!$validation->withRequest($this->request)->run()) {
                return json_encode([
                    'sukses' => false,
                    'errors' => $validation->getErrors()
                ]);
            }

            // Validasi input
            if ($validation->withRequest($this->request)->run()) {
                $id_procsum_main = $request->getPost('id_procsum_main');
                $plan_mid = $request->getPost('plan_mid');
                $do_mid = $request->getPost('do_mid');
                $check_mid = $request->getPost('check_mid');
                $act_mid = $request->getPost('act_mid');
                $teamwork_mid = $request->getPost('teamwork_mid');
                $cust_mid = $request->getPost('cust_mid');
                $passion_mid = $request->getPost('passion_mid');
                $gc_mid = $request->getPost('gc_mid');
                $delegating_mid = $request->getPost('delegating_mid');
                $couch_mid = $request->getPost('couch_mid');
                $develop_mid = $request->getPost('develop_mid');
                $result_mid = $request->getPost('result_mid');
                $midyear_value = $request->getPost('midyear_value');
                $plan_one = $request->getPost('plan_one');
                $do_one = $request->getPost('do_one');
                $check_one = $request->getPost('check_one');
                $act_one = $request->getPost('act_one');
                $teamwork_one = $request->getPost('teamwork_one');
                $cust_one = $request->getPost('cust_one');
                $passion_one = $request->getPost('passion_one');
                $gc_one = $request->getPost('gc_one');
                $delegating_one = $request->getPost('delegating_one');
                $couch_one = $request->getPost('couch_one');
                $develop_one = $request->getPost('develop_one');
                $result_one = $request->getPost('result_one');
                $oneyear_value = $request->getPost('oneyear_value');

                // Menghitung rata-rata B1
                $b1_values = [$plan_mid, $do_mid, $check_mid, $act_mid, $teamwork_mid, $cust_mid, $passion_mid];
                $b1_total = array_sum($b1_values);
                $b1_average = count($b1_values) > 0 ? $b1_total / count($b1_values) : 0;
                
                $b2_values = [$gc_mid, $delegating_mid, $couch_mid, $develop_mid];
                $b2_total = array_sum($b2_values);
                $b2_average = count($b2_values) > 0 ? $b2_total / count($b2_values) : 0;

                // Menghitung rata-rata B1 (One Year)
                $b1_values_one = [$plan_one, $do_one, $check_one, $act_one, $teamwork_one, $cust_one, $passion_one];
                $b1_total_one = array_sum($b1_values_one);
                $b1_average_one = count($b1_values_one) > 0 ? $b1_total_one / count($b1_values_one) : 0;

                $b2_values_one = [$gc_one, $delegating_one, $couch_one, $develop_one];
                $b2_total_one = array_sum($b2_values_one);
                $b2_average_one = count($b2_values_one) > 0 ? $b2_total_one / count($b2_values_one) : 0;

                // Calculate pdca_mid, pm_mid, and result_mid
                $kode_jabatan = session()->get('kode_jabatan');
                $percentage_b1_average = 0;
                $percentage_b2_average = 0;

                if ($kode_jabatan == 2) {
                    $percentage_b1_average = 0.3;
                    $percentage_b2_average = 0.2;
                } elseif ($kode_jabatan == 3) {
                    $percentage_b1_average = 0.35;
                    $percentage_b2_average = 0.15;
                } elseif ($kode_jabatan == 4) {
                    $percentage_b1_average = 0.4;
                    $percentage_b2_average = 0.1;
                } elseif ($kode_jabatan == 8 || ($kode_jabatan == 4 && $npk == [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) {
                    $percentage_b1_average = 0.5;
                }

                $pdca_mid = $b1_average * $percentage_b1_average;
                $pm_mid = $b2_average * $percentage_b2_average;
                $result_mid = $b1_average * 0.5;
                
                $pdca_one = $b1_average_one * $percentage_b1_average;
                $pm_one = $b2_average_one * $percentage_b2_average;
                $result_one = $b1_average_one * 0.5;

                // Calculate midyear_value
                $midyear_value = $result_mid + $pdca_mid + $pm_mid;
                
                // Calculate oneyear_value
                $oneyear_value = $result_one + $pdca_one + $pm_one;
                
                if($isWithinMidPeriode){
                    $insertData = [
                        'id_procsum_main' => $id_procsum_main,
                        'plan_mid' => $plan_mid,
                        'do_mid' => $do_mid,
                        'check_mid' => $check_mid,
                        'act_mid' => $act_mid,
                        'teamwork_mid' => $teamwork_mid,
                        'cust_mid' => $cust_mid,
                        'passion_mid' => $passion_mid,
                        'gc_mid' => $gc_mid,
                        'delegating_mid' => $delegating_mid,
                        'couch_mid' => $couch_mid,
                        'develop_mid' => $develop_mid,
                        'b1_average' => $b1_average,
                        'b2_average' => $b2_average,
                        'result_mid' => $result_mid,
                        'pdca_mid' => $pdca_mid,
                        'pm_mid' => $pm_mid,
                        'midyear_value' => $midyear_value,
                        'is_submitted_midyear' => 0
                    ];

                    $this->procsummodel->insert($insertData);

                    $logData[] = [
                        'action' => 'Insert (Mid Year)',
                        'table_name' => 'procsum (mid year)',
                        'record_id' => $id_procsum_main,
                        'data_changes' => json_encode([
                            'new_data' => [
                                'Plan' => $plan_mid,
                                'Do' => $do_mid,
                                'Check' => $check_mid,
                                'Action' => $act_mid,
                                'Teamwork' => $teamwork_mid,
                                'Customer Focus' => $cust_mid,
                                'Passion For Excellence' => $passion_mid,
                                'Getting Commitment on IPP' => $gc_mid,
                                'Delegating' => $delegating_mid,
                                'Couching and Counseling' => $couch_mid,
                                'Developing Subordinate' => $develop_mid,
                                'Result' => $result_mid,
                                'PDCA and Values' => $pdca_mid,
                                'People Management' => $pm_mid,
                                'Mid Year Value' => $midyear_value
                            ]
                        ]),
                        'by' => session()->get('nama')
                    ];
                } elseif($isWithinOnePeriode){
                    $this->procsummodel->set([
                        'is_submitted_oneyear' => 0,
                        'plan_one' => $plan_one,
                        'do_one' => $do_one,
                        'check_one' => $check_one,
                        'act_one' => $act_one,
                        'teamwork_one' => $teamwork_one,
                        'cust_one' => $cust_one,
                        'passion_one' => $passion_one,
                        'gc_one' => $gc_one,
                        'delegating_one' => $delegating_one,
                        'couch_one' => $couch_one,
                        'develop_one' => $develop_one,
                        'b1_average' => $b1_average,
                        'b2_average' => $b2_average,
                        'result_one' => $result_one,
                        'pdca_one' => $pdca_one,
                        'pm_one' => $pm_one,
                        'oneyear_value' => $oneyear_value
                    ])->where(['id_procsum_main' => $id_procsum_main])->update();

                    $logData[] = [
                        'action' => 'Insert (One Year)',
                        'table_name' => 'procsum (one year)',
                        'record_id' => $id_procsum_main,
                        'data_changes' => json_encode([
                            'new_data' => [
                                'Plan' => $plan_one,
                                'Do' => $do_one,
                                'Check' => $check_one,
                                'Action' => $act_one,
                                'Teamwork' => $teamwork_one,
                                'Customer Focus' => $cust_one,
                                'Passion For Excellence' => $passion_one,
                                'Getting Commitment on IPP' => $gc_one,
                                'Delegating' => $delegating_one,
                                'Couching and Counseling' => $couch_one,
                                'Developing Subordinate' => $develop_one,
                                'Result' => $result_one,
                                'PDCA and Values' => $pdca_one,
                                'People Management' => $pm_one,
                                'Mid Year Value' => $oneyear_value
                            ]
                        ]),
                        'by' => session()->get('nama')
                    ];
                }
                // dd($insertData);

                $this->logModel->insertBatch($logData);

                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['gagal'] = true;
            } else {
                $hasil['sukses'] = false;
                $hasil['gagal'] = $validation->getErrors();
            }
            return json_encode($hasil);
        }
    }  

    public function save_edit(){
        $id = $this->request->getVar('id');
        $id_procsum_main = $this->request->getVar('id_procsum_main');
        $plan_mid = $this->request->getVar('plan_mid');
        $do_mid = $this->request->getVar('do_mid');
        // dd($id_procsum_main);
        $check_mid = $this->request->getVar('check_mid');
        $act_mid = $this->request->getVar('act_mid');
        $teamwork_mid = $this->request->getVar('teamwork_mid');
        $cust_mid = $this->request->getVar('cust_mid');
        $passion_mid = $this->request->getVar('passion_mid');
        $gc_mid = $this->request->getVar('gc_mid');
        $delegating_mid = $this->request->getVar('delegating_mid');
        $couch_mid = $this->request->getVar('couch_mid');
        $develop_mid = $this->request->getVar('develop_mid');
        $b1_average = $this->request->getVar('b1_average');
        $b2_average = $this->request->getVar('b2_average');
        // $result_mid = $this->request->getVar('result_mid');
        // $pdca_mid = $this->request->getVar('pdca_mid');
        // $pm_mid = $this->request->getVar('pm_mid');
        $midyear_value = $this->request->getVar('midyear_value');
        $plan_one = $this->request->getVar('plan_one');
        $do_one = $this->request->getVar('do_one');
        $check_one = $this->request->getVar('check_one');
        $act_one = $this->request->getVar('act_one');
        $teamwork_one = $this->request->getVar('teamwork_one');
        $cust_one = $this->request->getVar('cust_one');
        $passion_one = $this->request->getVar('passion_one');
        $gc_one = $this->request->getVar('gc_one');
        $delegating_one = $this->request->getVar('delegating_one');
        $couch_one = $this->request->getVar('couch_one');
        $develop_one = $this->request->getVar('develop_one');
        $result_one = $this->request->getVar('result_one');
        $oneyear_value = $this->request->getVar('oneyear_value');
        // dd($do_mid);

        $b1_values = [$plan_mid, $do_mid, $check_mid, $act_mid, $teamwork_mid, $cust_mid, $passion_mid];
        $b1_total = array_sum($b1_values);
        $b1_average = count($b1_values) > 0 ? $b1_total / count($b1_values) : 0;

        $b2_values = [$gc_mid, $delegating_mid, $couch_mid, $develop_mid];
        $b2_total = array_sum($b2_values);
        $b2_average = count($b2_values) > 0 ? $b2_total / count($b2_values) : 0;

        // Menghitung rata-rata B1 (One Year)
        $b1_values_one = [$plan_one, $do_one, $check_one, $act_one, $teamwork_one, $cust_one, $passion_one];
        $b1_total_one = array_sum($b1_values_one);
        $b1_average_one = count($b1_values_one) > 0 ? $b1_total_one / count($b1_values_one) : 0;

        $b2_values_one = [$gc_one, $delegating_one, $couch_one, $develop_one];
        $b2_total_one = array_sum($b2_values_one);
        $b2_average_one = count($b2_values_one) > 0 ? $b2_total_one / count($b2_values_one) : 0;

        // Calculate pdca_mid, pm_mid, and result_mid
        $mainData              = $this->procsummain->find($id_procsum_main);
        $kode_jabatan          = $mainData['kode_jabatan'];
        $npk                   = $mainData['created_by'];
        $percentage_b1_average = 0;
        $percentage_b2_average = 0;

        if ($kode_jabatan == 2) {
            $percentage_b1_average = 0.3;
            $percentage_b2_average = 0.2;
        } elseif ($kode_jabatan == 3) {
            $percentage_b1_average = 0.35;
            $percentage_b2_average = 0.15;
        } elseif ($kode_jabatan == 4) {
            $percentage_b1_average = 0.4;
            $percentage_b2_average = 0.1;
        } elseif ($kode_jabatan == 8 || ($kode_jabatan == 4 && $npk == [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) {
            $percentage_b1_average = 0.5;
        }

        $pdca_mid = $b1_average * $percentage_b1_average;
        $pm_mid = $b2_average * $percentage_b2_average;
        $result_mid = $b1_average * 0.5;

        $pdca_one = $b1_average_one * $percentage_b1_average;
        $pm_one = $b2_average_one * $percentage_b2_average;
        $result_one = $b1_average_one * 0.5;

        // Calculate midyear_value
        $midyear_value = $result_mid + $pdca_mid + $pm_mid;

        // Calculate oneyear_value
        $oneyear_value = $result_one + $pdca_one + $pm_one;

        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();                            
        // dd($periodeIPP);

        $currentDate = date('Y-m-d H:i:s');
        $isWithinMidPeriode = ($periodeMid !== null && $currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
        $isWithinOnePeriode = ($periodeOne !== null && $currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);

        $row = $this->procsummodel->getSavedData($id_procsum_main);
        $isValueChanged = false;

        if($isWithinMidPeriode){
            if($row){
                $oldData = [
                    'plan_mid'      => $row['plan_mid'],
                    'do_mid'        => $row['do_mid'],
                    'check_mid'     => $row['check_mid'],
                    'act_mid'       => $row['act_mid'],
                    'teamwork_mid'  => $row['teamwork_mid'],
                    'cust_mid'      => $row['cust_mid'],
                    'passion_mid'   => $row['passion_mid'],
                    'gc_mid'        => $row['gc_mid'],
                    'delegating_mid'=> $row['delegating_mid'],
                    'couch_mid'     => $row['couch_mid'],
                    'develop_mid'   => $row['develop_mid'],
                    'b1_average'    => $row['b1_average'],
                    'b2_average'    => $row['b2_average'],
                    'result_mid'    => $row['result_mid'],
                    'pdca_mid'      => $row['pdca_mid'],
                    'pm_mid'        => $row['pm_mid'],
                    'midyear_value' => $row['midyear_value']
                ];

                if(
                    $oldData['plan_mid'] !== $plan_mid ||
                    $oldData['do_mid'] !== $do_mid ||
                    $oldData['check_mid'] !== $check_mid ||
                    $oldData['act_mid'] !== $act_mid ||
                    $oldData['teamwork_mid'] !== $teamwork_mid ||
                    $oldData['cust_mid'] !== $cust_mid ||
                    $oldData['passion_mid'] !== $passion_mid ||
                    $oldData['gc_mid'] !== $gc_mid ||
                    $oldData['delegating_mid'] !== $delegating_mid ||
                    $oldData['couch_mid'] !== $couch_mid ||
                    $oldData['develop_mid'] !== $develop_mid ||
                    $oldData['b1_average'] !== $b1_average ||
                    $oldData['b2_average'] !== $b2_average ||
                    $oldData['result_mid'] !== $result_mid ||
                    $oldData['pdca_mid'] !== $pdca_mid ||
                    $oldData['pm_mid'] !== $pm_mid ||
                    $oldData['midyear_value'] !== $midyear_value
                ){
                    $isValueChanged = true;
                }

                $this->procsummodel->set([
                    'plan_mid' => $plan_mid,
                    'do_mid' => $do_mid,
                    'check_mid' => $check_mid,
                    'act_mid' => $act_mid,
                    'teamwork_mid' => $teamwork_mid,
                    'cust_mid' => $cust_mid,
                    'passion_mid' => $passion_mid,
                    'gc_mid' => $gc_mid,
                    'delegating_mid' => $delegating_mid,
                    'couch_mid' => $couch_mid,
                    'develop_mid' => $develop_mid,
                    'b1_average' => $b1_average,
                    'b2_average' => $b2_average,
                    'result_mid' => $result_mid,
                    'pdca_mid' => $pdca_mid,
                    'pm_mid' => $pm_mid,
                    'midyear_value' => $midyear_value,
                    'is_submitted_midyear' => 0
                ])->where(['id_procsum_main' => $id_procsum_main])->update();
                // dd($id);

                if($isValueChanged){
                    $logData = [
                        'action' => 'Update (Mid Year)',
                        'table_name' => 'procsum (mid year)',
                        'record_id' => $id_procsum_main,
                        'data_changes' => json_encode([
                            'old_data' => $oldData,
                            'new_data' => [
                                'Plan' => $plan_mid,
                                'Do' => $do_mid,
                                'Check' => $check_mid,
                                'Action' => $act_mid,
                                'Teamwork' => $teamwork_mid,
                                'Customer Focus' => $cust_mid,
                                'Passion For Excellence' => $passion_mid,
                                'Getting Commitment on IPP' => $gc_mid,
                                'Delegating' => $delegating_mid,
                                'Couching and Counseling' => $couch_mid,
                                'Developing Subordinate' => $develop_mid,
                                'Result' => $result_mid,
                                'PDCA and Values' => $pdca_mid,
                                'People Management' => $pm_mid,
                                'Mid Year Value' => $midyear_value
                            ]
                        ]),
                        'by' => session()->get('nama')
                    ];
                    $this->logModel->insert($logData);
                }
            }
        } elseif($isWithinOnePeriode){
            if($row){
                $oldData = [
                    'plan_one'      => $row['plan_one'],
                    'do_one'        => $row['do_one'],
                    'check_one'     => $row['check_one'],
                    'act_one'       => $row['act_one'],
                    'teamwork_one'  => $row['teamwork_one'],
                    'cust_one'      => $row['cust_one'],
                    'passion_one'   => $row['passion_one'],
                    'gc_one'        => $row['gc_one'],
                    'delegating_one'=> $row['delegating_one'],
                    'couch_one'     => $row['couch_one'],
                    'develop_one'   => $row['develop_one'],
                    'b1_average_one'=> $row['b1_average_one'],
                    'b2_average_one'=> $row['b2_average_one'],
                    'result_one'    => $row['result_one'],
                    'pdca_one'      => $row['pdca_one'],
                    'pm_one'        => $row['pm_one'],
                    'oneyear_value' => $row['oneyear_value']
                ];

                if(
                    $oldData['plan_one'] !== $plan_one ||
                    $oldData['do_one'] !== $do_one ||
                    $oldData['check_one'] !== $check_one ||
                    $oldData['act_one'] !== $act_one ||
                    $oldData['teamwork_one'] !== $teamwork_one ||
                    $oldData['cust_one'] !== $cust_one ||
                    $oldData['passion_one'] !== $passion_one ||
                    $oldData['gc_one'] !== $gc_one ||
                    $oldData['delegating_one'] !== $delegating_one ||
                    $oldData['couch_one'] !== $couch_one ||
                    $oldData['develop_one'] !== $develop_one ||
                    $oldData['b1_average_one'] !== $b1_average_one ||
                    $oldData['b2_average_one'] !== $b2_average_one ||
                    $oldData['result_one'] !== $result_one ||
                    $oldData['pdca_one'] !== $pdca_one ||
                    $oldData['pm_one'] !== $pm_one ||
                    $oldData['oneyear_value'] !== $oneyear_value
                ){
                    $isValueChanged = true;
                }

                $this->procsummodel->set([
                    'plan_one' => $plan_one,
                    'do_one' => $do_one,
                    'check_one' => $check_one,
                    'act_one' => $act_one,
                    'teamwork_one' => $teamwork_one,
                    'cust_one' => $cust_one,
                    'passion_one' => $passion_one,
                    'gc_one' => $gc_one,
                    'delegating_one' => $delegating_one,
                    'couch_one' => $couch_one,
                    'develop_one' => $develop_one,
                    'b1_average_one' => $b1_average_one,
                    'b2_average_one' => $b2_average_one,
                    'result_one' => $result_one,
                    'pdca_one' => $pdca_one,
                    'pm_one' => $pm_one,
                    'oneyear_value' => $oneyear_value,
                    'is_submitted_oneyear' => 0
                ])->where(['id_procsum_main' => $id_procsum_main])->update();
                // dd($id);

                if($isValueChanged){
                    $logData = [
                        'action' => 'Update (One Year)',
                        'table_name' => 'procsum (one year)',
                        'record_id' => $id_procsum_main,
                        'data_changes' => json_encode([
                            'old_data' => [
                                'Plan'                      => $oldData['plan_one'],
                                'Do'                        => $oldData['do_one'],
                                'Check'                     => $oldData['check_one'],
                                'Action'                    => $oldData['act_one'],
                                'Teamwork'                  => $oldData['teamwork_one'],
                                'Customer Focus'            => $oldData['cust_one'],
                                'Passion For Excellence'    => $oldData['passion_one'],
                                'Getting Commitment on IPP' => $oldData['gc_one'],
                                'Delegating'                => $oldData['delegating_one'],
                                'Couching and Counseling'   => $oldData['couch_one'],
                                'Developing Subordinate'    => $oldData['develop_one'],
                                'Result'                    => $oldData['result_one'],
                                'PDCA and Values'           => $oldData['pdca_one'],
                                'People Management'         => $oldData['pm_one'],
                                'One Year Value'            => $oldData['oneyear_value']
                            ],
                            'new_data' => [
                                'Plan' => $plan_one,
                                'Do' => $do_one,
                                'Check' => $check_one,
                                'Action' => $act_one,
                                'Teamwork' => $teamwork_one,
                                'Customer Focus' => $cust_one,
                                'Passion For Excellence' => $passion_one,
                                'Getting Commitment on IPP' => $gc_one,
                                'Delegating' => $delegating_one,
                                'Couching and Counseling' => $couch_one,
                                'Developing Subordinate' => $develop_one,
                                'Result' => $result_one,
                                'PDCA and Values' => $pdca_one,
                                'People Management' => $pm_one,
                                'One Year Value' => $oneyear_value
                            ]
                        ]),
                        'by' => session()->get('nama')
                    ];
                    $this->logModel->insert($logData);
                }
            }
        }

        return json_encode(['message' => 'Data updated successfully']);
    }

    public function save_one(){
        $id = $this->request->getVar('id');
        $id_procsum_main = $this->request->getVar('id_procsum_main');
        $plan_one = $this->request->getVar('plan_one');
        $do_one = $this->request->getVar('do_one');
        $check_one = $this->request->getVar('check_one');
        $act_one = $this->request->getVar('act_one');
        $teamwork_one = $this->request->getVar('teamwork_one');
        $cust_one = $this->request->getVar('cust_one');
        $passion_one = $this->request->getVar('passion_one');
        $gc_one = $this->request->getVar('gc_one');
        $delegating_one = $this->request->getVar('delegating_one');
        $couch_one = $this->request->getVar('couch_one');
        $develop_one = $this->request->getVar('develop_one');
        $result_one = $this->request->getVar('result_one');
        $oneyear_value = $this->request->getVar('oneyear_value');

        // Menghitung rata-rata B1 (One Year)
        $b1_values_one = [$plan_one, $do_one, $check_one, $act_one, $teamwork_one, $cust_one, $passion_one];
        $b1_total_one = array_sum($b1_values_one);
        $b1_average_one = count($b1_values_one) > 0 ? $b1_total_one / count($b1_values_one) : 0;

        $b2_values_one = [$gc_one, $delegating_one, $couch_one, $develop_one];
        $b2_total_one = array_sum($b2_values_one);
        $b2_average_one = count($b2_values_one) > 0 ? $b2_total_one / count($b2_values_one) : 0;

        // Calculate pdca_mid, pm_mid, and result_mid
        $mainData              = $this->procsummain->find($id_procsum_main);
        $kode_jabatan          = $mainData['kode_jabatan'];
        $npk                   = $mainData['created_by'];
        $percentage_b1_average = 0;
        $percentage_b2_average = 0;

        if ($kode_jabatan == 2) {
            $percentage_b1_average = 0.3;
            $percentage_b2_average = 0.2;
        } elseif ($kode_jabatan == 3) {
            $percentage_b1_average = 0.35;
            $percentage_b2_average = 0.15;
        } elseif ($kode_jabatan == 4) {
            $percentage_b1_average = 0.4;
            $percentage_b2_average = 0.1;
        } elseif ($kode_jabatan == 8 || ($kode_jabatan == 4 && $npk == [4277, 3651, 3659, 2354, 2352, 2070, 1814, 2592])) {
            $percentage_b1_average = 0.5;
        }

        $pdca_one = $b1_average_one * $percentage_b1_average;
        $pm_one = $b2_average_one * $percentage_b2_average;
        $result_one = $b1_average_one * 0.5;

        // Calculate oneyear_value
        $oneyear_value = $result_one + $pdca_one + $pm_one;

        $periodeModel = new \App\Models\PeriodeModel();
        $periodeOne = $periodeModel->getLatestOnePeriode();                            
        // dd($periodeIPP);

        $currentDate = date('Y-m-d H:i:s');
        $isWithinOnePeriode = ($periodeOne !== null && $currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);

        $row = $this->procsummodel->getSavedData($id_procsum_main);

        $this->procsummodel->set([
            'plan_one' => $plan_one,
            'do_one' => $do_one,
            'check_one' => $check_one,
            'act_one' => $act_one,
            'teamwork_one' => $teamwork_one,
            'cust_one' => $cust_one,
            'passion_one' => $passion_one,
            'gc_one' => $gc_one,
            'delegating_one' => $delegating_one,
            'couch_one' => $couch_one,
            'develop_one' => $develop_one,
            'b1_average_one' => $b1_average_one,
            'b2_average_one' => $b2_average_one,
            'result_one' => $result_one,
            'pdca_one' => $pdca_one,
            'pm_one' => $pm_one,
            'oneyear_value' => $oneyear_value,
            'is_submitted_oneyear' => 0,
            'is_saved_oneyear' => 1
        ])->where(['id_procsum_main' => $id_procsum_main])->update();
        
        $logData[] = [
            'action' => 'Insert (One Year)',
            'table_name' => 'procsum (one year)',
            'record_id' => $id_procsum_main,
            'data_changes' => json_encode([
                'new_data' => [
                    'Plan' => $plan_one,
                    'Do' => $do_one,
                    'Check' => $check_one,
                    'Action' => $act_one,
                    'Teamwork' => $teamwork_one,
                    'Customer Focus' => $cust_one,
                    'Passion For Excellence' => $passion_one,
                    'Getting Commitment on IPP' => $gc_one,
                    'Delegating' => $delegating_one,
                    'Couching and Counseling' => $couch_one,
                    'Developing Subordinate' => $develop_one,
                    'Result' => $result_one,
                    'PDCA and Values' => $pdca_one,
                    'People Management' => $pm_one,
                    'One Year Value' => $oneyear_value
                ]
            ]),
            'by' => session()->get('nama')
        ];
    
        // dd($insertData);

        $this->logModel->insertBatch($logData);

        return json_encode(['message' => 'Data updated successfully']);
    }

    public function procsumpdf($id){
        $procsumDetail = $this->procsummodel->getIsi($id);
        $approval = $this->procsummain->getSavedData($id);

        $dompdf = new Dompdf();
        $imagePath = Paths::$imagePath;
        $imageData = file_get_contents($imagePath);
        $base64Image = base64_encode($imageData);
        $sum_midyear_total      = $this->midyearisi->callTotalScore($id);
        $sum_oneyear_total      = $this->midyearisi->callTotalScoreOne($id);
        $mainData               = $this->procsummain->find($id);
        $npk                    = $mainData['created_by'];
        $nama                   = $mainData['nama'];
        $kode_jabatan           = $mainData['kode_jabatan'];
        $validation             = \Config\Services::validation();
        $periode                = $mainData['periode'];

        $midyearData              = $this->procsummodel->getIsi($id);
        // echo $base64Image;

        $html = view('procsum/procsum_pdf', [
            'procsum'        => $this->procsummodel->getSavedData($id),
            'mainprocsum'    => $this->procsummain->getSavedDataWithDepartment($id),
            'userNama'       => $nama,
            'userNpk'        => $npk,
            'approval'       => $approval,
            'date_submitted' => $approval['date_submitted'],
            'department'     => session()->get('departement'),
            'division'     => session()->get('divisi'),
            'base64Image'    => $base64Image,
            'id_procsum_main'=> $id,
            'sum_midyear_total'=> $sum_midyear_total,
            'sum_oneyear_total'=> $sum_oneyear_total,
            'kode_jabatan'     => $kode_jabatan
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('IPP '. session()->get('nama') .'.pdf', ['Attachment' => 0]);
    }

    // Log atau history perubahan
    public function logchanges($id) {
        $logDataOneYear = $this->logModel->getLogEntriesByTableNameAndRecordId('procsum (one year)', $id);
        $logDataMidYear = $this->logModel->getLogEntriesByTableNameAndRecordId('procsum (mid year)', $id);

        $logData = array_merge($logDataOneYear, $logDataMidYear);

        $data = [
            'tittle'    => 'History Perubahan',
            'logData'   => $logData,
            'countPending' => $this->ippModel->getDataPending(),
            'countPendingPlantS' => $this->ippModel->getPendingPlantS(),
            'countPendingAdm' => $this->ippModel->getPendingAdm(),
            'countPendingFin' => $this->ippModel->getPendingFin(),
            'countPendingPlant' => $this->ippModel->getPendingPlant(),
            'countPendingEng' => $this->ippModel->getPendingEng(),
            'countPendingIsd' => $this->ippModel->getPendingIsd(),

            'countPendingMid' => $this->ippModel->getDataPendingMid(),
            'countPendingPlantSMid' => $this->ippModel->getPendingPlantSMid(),
            'countPendingAdmMid' => $this->ippModel->getPendingAdmMid(),
            'countPendingFinMid' => $this->ippModel->getPendingFinMid(),
            'countPendingPlantMid' => $this->ippModel->getPendingPlantMid(),
            'countPendingEngMid' => $this->ippModel->getPendingEngMid(),
            'countPendingIsdMid' => $this->ippModel->getPendingIsdMid(),

            'countPendingOne' => $this->ippModel->getDataPendingOne(),
            'countPendingPlantSOne' => $this->ippModel->getPendingPlantSOne(),
            'countPendingAdmOne' => $this->ippModel->getPendingAdmOne(),
            'countPendingFinOne' => $this->ippModel->getPendingFinOne(),
            'countPendingPlantOne' => $this->ippModel->getPendingPlantOne(),
            'countPendingEngOne' => $this->ippModel->getPendingEngOne(),
            'countPendingIsdOne' => $this->ippModel->getPendingIsdOne(),
            
            'countPendingSw' => $this->strongweakmain->getDataPendingSw(),
            'countPendingPlantSSw' => $this->strongweakmain->getPendingPlantSSw(),
            'countPendingAdmSw' => $this->strongweakmain->getPendingAdmSw(),
            'countPendingFinSw' => $this->strongweakmain->getPendingFinSw(),
            'countPendingPlantSw' => $this->strongweakmain->getPendingPlantSw(),
            'countPendingEngSw' => $this->strongweakmain->getPendingEngSw(),
            'countPendingIsdSw' => $this->strongweakmain->getPendingIsdSw(),

            // 'countPendingSOne' => $this->strongweakmain->getDataPendingOne(),
            'countPendingPMid' => $this->procsummain->getDataPendingMid(),
            'countPendingPlantSProc' => $this->procsummain->getPendingPlantSProc(),
            'countPendingAdmProc' => $this->procsummain->getPendingAdmProc(),
            'countPendingFinProc' => $this->procsummain->getPendingFinProc(),
            'countPendingPlantProc' => $this->procsummain->getPendingPlantProc(),
            'countPendingEngProc' => $this->procsummain->getPendingEngProc(),
            'countPendingIsdProc' => $this->procsummain->getPendingIsdProc(),
        ];

        return view('ipp/log', $data);
    }

    public function datalama(){
        if ($this->request->isAJAX()) {
            $created_at = date('Y-m-d H:i:s');
            $periode = $this->request->getVar('periode');
            $file = $this->request->getFile('file');
            $newName = $periode . '_' . session()->get('nama');
            $file->move(WRITEPATH . 'uploads/procsum', $newName);
            $created_by = session()->get('npk');
            $id_division = session()->get('id_division');
            $id_department = session()->get('id_department');
            $id_section = session()->get('id_section');
            $kode_jabatan = session()->get('kode_jabatan');
            $nama = session()->get('nama');

            $existingProccsum = $this->procsummain->where('periode', $periode)
            ->where('created_by', $created_by)
            ->first();

            if($existingProccsum) {
                $hasil['sukses'] = false;
                $hasil['gagal'] = "Periode ini sudah ada.";
            } else {
                $this->procsummain->insert([
                    'periode'                     => $periode,
                    'files'                       => $newName,
                    'created_at'                  => $created_at,
                    'created_by'                  => $created_by,
                    'nama'                        => $nama,
                    'id_department'               => $id_department,
                    'id_division'                 => $id_division,
                    'id_section'                  => $id_section,
                    'kode_jabatan'                => $kode_jabatan,
                    'approval_bod_midyear'        => 1,
                    'approval_presdir_midyear'    => 1,
                    'approval_kadiv_midyear'      => 1,
                    'approval_kadept_midyear'     => 1,
                    'approval_kasie_midyear'      => 1,
                    'approval_bod_oneyear'        => 1,
                    'approval_presdir_oneyear'    => 1,
                    'approval_kadiv_oneyear'      => 1,
                    'approval_kadept_oneyear'     => 1,
                    'approval_kasie_oneyear'      => 1
                ]);

                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['gagal'] = true;
            }

            return json_encode($hasil);
        }
    }

    // pdf untuk data yang telah diinputkan
    public function viewPdf($id) {
        $mainData = $this->procsummain->find($id);
        $file_name = $mainData['files'];
        $pdf_path = WRITEPATH . 'uploads/procsum/' . $file_name;
        $display_name = $mainData['periode'] . '_' . $mainData['nama'] . '.pdf';

        if (file_exists($pdf_path)) {
            // Membaca isi file
            $file_content = file_get_contents($pdf_path);

            return $this->response
                ->setHeader('Content-Type', 'application/pdf')
                ->setHeader('Content-Disposition', 'inline; filename="' . $display_name . '"')
                ->setHeader('Cache-Control', 'no-store, no-cache, must-revalidate, max-age=0')
                ->setHeader('Cache-Control', 'post-check=0, pre-check=0')
                ->setHeader('Pragma', 'no-cache')
                ->setBody($file_content);
        } else {
            return $this->response->setStatusCode(404)->setJSON(['error' => 'File not found']);
        }
    }
}
