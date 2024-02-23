<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\IppModel;
use App\Models\IsiSaveModel;
use App\Models\LoginModel;
use App\Models\IsiModel;
use App\Models\PeriodeModel;
use App\Models\LogModel;
use App\Models\MidyearModel;
use App\Models\LampauModel;
use App\Models\StrongWeakMainModel;
use App\Models\ProcsumMainModel;
use Dompdf\Dompdf;
use Config\Paths;

class Ipp extends BaseController
{

    public function __construct(){
        $this->loginModel     = new LoginModel();
        $this->ippModel     = new IppModel();
        $this->isisave      = new IsiSaveModel();
        $this->isiModel     = new IsiModel();
        $this->logModel     = new LogModel();     
        $this->lampau       = new LampauModel();     
        $this->periodeModel = new PeriodeModel();     
        $this->midyearisi   = new MidyearModel();
        $this->strongweakmain   = new StrongWeakMainModel();    
        $this->procsummain   = new ProcsumMainModel();
    }

    public function index(){
        $user       = session()->get('npk');
        // dd($user);
        $ipp        = $this->ippModel->getIppFilter($user);

        // $loginModel = new LoginModel();
        $nama       = session()->get('nama');

        $data = [
            'tittle'    => 'Pengisian IPP',
            'ipp'       => $ipp,
            'nama'      => $nama,
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
        
        return view('ipp/index', $data);
    }

    public function ipplampau(){
        $user       = session()->get('npk');
        // dd($user);
        $ipp        = $this->lampau->getIppByUser($user);

        // $loginModel = new LoginModel();
        $nama       = session()->get('nama');

        $data = [
            'tittle'    => 'Pengisian IPP',
            'ipp'       => $ipp,
            'nama'      => $nama,
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
        
        return view('ipp/indexlampau', $data);
    }

    // Tambah data periode ipp baru
    public function save(){
        $created_at = date('Y-m-d');
        $periode = date('Y');
        $created_by = session()->get('npk');
        $id_division = session()->get('id_division');
        $id_department = session()->get('id_department');
        $department = session()->get('department');
        $division = session()->get('division');
        $section = session()->get('section');
        $id_section = session()->get('id_section');
        $kode_jabatan = session()->get('kode_jabatan');
        // dd($created_by);

        $existingIpp = $this->ippModel->where('periode', $periode)
            ->where('created_by', $created_by)
            ->first();

        if ($existingIpp) {
            $hasil['sukses'] = false;
            $hasil['gagal'] = "IPP untuk tahun ini sudah ada.";
        } else {
            // $loginModel = new LoginModel();
            // $nama = $loginModel->where('npk', $created_by)->first()['nama'];
            $nama = session()->get('nama');

            $data = [
                'created_at' => $created_at,
                'periode' => $periode,
                'created_by' => $created_by,
                'nama' => $nama,
                'id_department' => $id_department,
                'id_division' => $id_division,
                'id_section' => $id_section,
                'division' => $division,
                'department' => $department,
                'section' => $section,
                'kode_jabatan' => $kode_jabatan
            ];
            $this->ippModel->insert($data);

            $hasil['sukses'] = "Berhasil memasukkan data";
            $hasil['gagal'] = true;
        }

        return json_encode($hasil);
    }

    public function datalama(){
        if ($this->request->isAJAX()) {
            $created_at = date('Y-m-d');
            $periode = $this->request->getVar('periode');
            // $file = $this->request->getFile('file');
            // $fileData = file_get_contents($file->getTempName());
            $file = $this->request->getFile('ippFile');
            // var_dump($file).die();
            $newName = 'IPP' . '_' . $periode . '_' . session()->get('nama');
            $file->move(WRITEPATH . 'uploads', $newName);
            $created_by = session()->get('npk');
            $id_division = session()->get('id_division');
            $id_department = session()->get('id_department');
            $id_section = session()->get('id_section');
            $division = session()->get('division');
            $department = session()->get('department');
            $section = session()->get('section');
            $kode_jabatan = session()->get('kode_jabatan');
            $nama = session()->get('nama');

            // if (!$file->isValid()) {
            //     return $this->response->setJSON([
            //         'success' => false,
            //         'message' => 'Failed to upload the file. Please try again.',
            //     ]);
            // }

            $existingIpp = $this->ippModel->where('periode', $periode)
            ->where('created_by', $created_by)
            ->first();

            if($existingIpp) {
                $hasil['sukses'] = false;
                $hasil['gagal'] = "Periode ini sudah ada.";
            } else {
                $inserted = $this->ippModel->insert([
                    'periode' => $periode,
                    'files'    => $newName,
                    'created_at' => $created_at,
                    'created_by' => $created_by,
                    'nama' => $nama,
                    'id_department' => $id_department,
                    'id_division' => $id_division,
                    'id_section' => $id_section,
                    'department' => $department,
                    'division' => $division,
                    'section' => $section,
                    'kode_jabatan' => $kode_jabatan,
                    'approval_bod'     => 1,
                    'is_approved_bod'  => 1,
                    'approval_date_bod'=> date('Y-m-d'),
                    'approval_presdir'     => 1,
                    'is_approved_presdir'  => 1,
                    'approval_date_presdir'=> date('Y-m-d'),
                    'approval_kadiv'     => 1,
                    'is_approved_kadiv'  => 1,
                    'approval_date_kadiv'=> date('Y-m-d'),
                    'approval_kadept'     => 1,
                    'is_approved_kadept'  => 1,
                    'approval_date_kadept'=> date('Y-m-d'),
                    'approval_kasie'     => 1,
                    'is_approved_kasie'  => 1,
                    'approval_date_kasie'=> date('Y-m-d'),
                    // 'is_submitted_ipp'   => 1,
                    'approval_bod_midyear'     => 1,
                    'is_approved_bod_midyear'  => 1,
                    'approval_date_bod_midyear'=> date('Y-m-d'),
                    'approval_presdir_midyear'     => 1,
                    'is_approved_presdir_midyear'  => 1,
                    'approval_date_presdir_midyear'=> date('Y-m-d'),
                    'approval_kadiv_midyear'     => 1,
                    'is_approved_kadiv_midyear'  => 1,
                    'approval_date_kadiv_midyear'=> date('Y-m-d'),
                    'approval_kadept_midyear'     => 1,
                    'is_approved_kadept_midyear'  => 1,
                    'approval_date_kadept_midyear'=> date('Y-m-d'),
                    'approval_kasie_midyear'     => 1,
                    'is_approved_kasie_midyear'  => 1,
                    'approval_date_kasie_midyear'=> date('Y-m-d'),
                    'approval_bod_oneyear'     => 1,
                    'is_approved_bod_oneyear'  => 1,
                    'approval_date_bod_oneyear'=> date('Y-m-d'),
                    'approval_presdir_oneyear'     => 1,
                    'is_approved_presdir_oneyear'  => 1,
                    'approval_date_presdir_oneyear'=> date('Y-m-d'),
                    'approval_kadiv_oneyear'     => 1,
                    'is_approved_kadiv_oneyear'  => 1,
                    'approval_date_kadiv_oneyear'=> date('Y-m-d'),
                    'approval_kadept_oneyear'     => 1,
                    'is_approved_kadept_oneyear'  => 1,
                    'approval_date_kadept_oneyear'=> date('Y-m-d'),
                    'approval_kasie_oneyear'     => 1,
                    'is_approved_kasie_oneyear'  => 1,
                    'approval_date_kasie_oneyear'=> date('Y-m-d'),
                ]);

                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['gagal'] = true;
            }

            return json_encode($hasil);
        }
    }

    // Method Detail
    public function detail($id) {
        $mainData           = $this->ippModel->find($id);
        // dd($mainData);
        $user               = session()->get('npk');
        $periode            = $mainData['periode'];

    
        if ($mainData) {
            $created_by = $mainData['created_by'];
            $nama       = $mainData['nama'];
        } else {
            $created_by = null;
            $nama       = null;
        }
    
        $is_submitted_ipp_main = $mainData['is_submitted_ipp'];
        $is_submitted_ipp_mid_main = $mainData['is_submitted_ipp_mid'];
        $is_submitted_ipp_one_main = $mainData['is_submitted_ipp_one'];
        $ippData = $this->isiModel->getIsi($id);
        $is_submitted_ipp = null;
        $is_submitted_ipp_mid = null;
        $is_submitted_ipp_one = null;
        if (!empty($ippData)) {
            $is_submitted_ipp = $ippData[0]['is_submitted_ipp'];
            $is_submitted_ipp_mid = $ippData[0]['is_submitted_ipp_mid'];
            $is_submitted_ipp_one = $ippData[0]['is_submitted_ipp_one'];
        }
    
        $data = [
            'tittle'          => 'Individual Performance Planning',
            'ipp'             => $ippData,
            'id_main'         => $id,
            'created_by'      => $created_by,
            'nama'            => $nama,
            'is_submitted_ipp'=> $is_submitted_ipp,
            'is_submitted_ipp_main'=> $is_submitted_ipp_main,
            'is_submitted_ipp_mid'=> $is_submitted_ipp_mid,
            'is_submitted_ipp_one'=> $is_submitted_ipp_one,
            'is_submitted_ipp_mid_main'=> $is_submitted_ipp_mid_main,
            'is_submitted_ipp_one_main'=> $is_submitted_ipp_one_main,
            'periode'         => $periode,
            'main'            => $this->ippModel->getIpp(),
            'is_submittedmid' => $mainData['is_submitted'],
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
    
        return view('ipp/detail', $data);
    }

    // Save all data in ipp (saveallbutton) (submit)
    public function insert_data() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $idMain = $this->request->getVar('idMain');
            $logData = [];
            $dateSubmitted = date('Y-m-d');
            $periodeIPP = $this->periodeModel->getLatestIPPeriode();
            $periodeIPPMid = $this->periodeModel->getLatestMidPeriode();
            $periodeIPPOne = $this->periodeModel->getLatestOnePeriode();
            $ippPeriode = false;
            $editIppMid = false;
            $editIppOne = false;
            // dd($periodeIPP);

            $currentDate = date('Y-m-d H:i:s');
            if ($periodeIPP !== null) {
                $ippPeriode = ($currentDate >= $periodeIPP['start_period'] && $currentDate <= $periodeIPP['end_period']);
            } elseif ($periodeIPPMid !== null){
                $editIppMid = ($currentDate >= $periodeIPPMid['start_period'] && $currentDate <= $periodeIPPMid['end_period']);
            } elseif ($periodeIPPOne !== null){
                $editIppOne = ($currentDate >= $periodeIPPOne['start_period'] && $currentDate <= $periodeIPPOne['end_period']);
            };

            if ($ippPeriode == true){
                $this->isiModel->set(['is_submitted_ipp' => 1])->where(['id' => $id])->update();
        
                $idMain = $this->request->getVar('idMain');
                $this->ippModel->set([
                    'is_submitted_ipp'       => 1,
                    'date_submitted_ipp'     => $dateSubmitted
                ])->where(['id' => $idMain])->update();
            } elseif ($editIppMid == true){
                $this->isiModel->set(['is_submitted_ipp_mid' => 1])->where(['id' => $id])->update();
        
                $idMain = $this->request->getVar('idMain');
                $this->ippModel->set([
                    'is_submitted_ipp_mid'       => 1,
                    'date_submitted_ipp_mid'     => $dateSubmitted
                ])->where(['id' => $idMain])->update();
            } elseif ($editIppOne == true){
                $this->isiModel->set(['is_submitted_ipp_one' => 1])->where(['id' => $id])->update();
        
                $idMain = $this->request->getVar('idMain');
                $this->ippModel->set([
                    'is_submitted_ipp_one'       => 1,
                    'date_submitted_ipp_one'     => $dateSubmitted
                ])->where(['id' => $idMain])->update();
            };
    
            $response = [
                'sukses' => true,
                'message' => 'Data berhasil disimpan.'
            ];
    
            return $this->response->setJSON($response);
        }
    }    

    // Save data temporarily
    public function save_temporarily() {
        if ($this->request->isAJAX()) {
            $dataToSave = $this->request->getPost('dataToSave');
            $logData = []; // Inisialisasi data log
    
            foreach ($dataToSave as $data) {
                if (isset($data['program'])) {
                    $insertData = [
                        'id_main' => $data['idMain'],
                        'program' => $data['program'],
                        'weight' => $data['weight'],
                        'midyear' => $data['midyear'],
                        'oneyear' => $data['oneyear'],
                        'duedate' => $data['duedate']
                    ];
                    $this->isiModel->insert($insertData);
                    
                    // Tambahkan log untuk setiap data yang di-insert
                    $logData[] = [
                        'action' => 'insert',
                        'table_name' => 'isi_ipp',
                        'record_id' => $data['idMain'],
                        'data_changes' => json_encode([
                            'new_data' => [
                                'Program' => $data['program'],
                                'Wight' => $data['weight'],
                                'Mid Year' => $data['midyear'],
                                'One Year' => $data['oneyear'],
                                'Due Date' => $data['duedate']
                            ]
                        ]),
                        'by' => session()->get('nama')
                    ];
                }
            }
    
            // Simpan log data
            if (!empty($logData)) {
                $logModel = new LogModel();
                $logModel->insertBatch($logData);
            }
    
            $response = [
                'sukses' => true,
                'message' => 'Data berhasil disimpan.'
            ];
    
            return $this->response->setJSON($response);
        }
    }
    
    // Save edit ipp per row
    public function saveDataEditIpp() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $id_main = $this->request->getVar('id_main');
            $program = $this->request->getVar('program');
            $weight = $this->request->getVar('weight');
            $midyear = $this->request->getVar('midyear');
            $oneyear = $this->request->getVar('oneyear');
            $duedate = $this->request->getVar('duedate');
            $isValueChanged = false;
            
            $row = $this->isiModel->find($id);
    
            if ($row) {
                $oldData = [
                    'program' => $row['program'],
                    'weight'  => $row['weight'],
                    'midyear' => $row['midyear'],
                    'oneyear' => $row['oneyear'],
                    'duedate' => $row['duedate']
                ];
    
                if (
                    $oldData['program'] !== $program ||
                    $oldData['weight'] !== $weight ||
                    $oldData['midyear'] !== $midyear ||
                    $oldData['oneyear'] !== $oneyear ||
                    $oldData['duedate'] !== $duedate
                ) {
                    $isValueChanged = true;
    
                    // Jika ada perubahan, set approval menjadi 0
                    $this->ippModel->update($row['id_main'], [
                        'approval_kadept' => 0,
                        'approval_kadiv' => 0
                    ]);
                }
    
                $this->isiModel->set([
                    'program' => $program,
                    'weight' => $weight,
                    'midyear' => $midyear,
                    'oneyear' => $oneyear,
                    'duedate' => $duedate
                ])->where(['id' => $id])->update();
    
                if ($isValueChanged) {
                    $logData = [
                        'action' => 'update',
                        'table_name' => 'isi_ipp',
                        'record_id' => $id,
                        'data_changes' => json_encode([
                            'old_data' => [
                                'Program' => $oldData['program'],
                                'Weight' => $oldData['weight'],
                                'Mid Year' => $oldData['midyear'],
                                'One Year' => $oldData['oneyear'],
                                'Due Date' => $oldData['duedate']
                            ],
                            'new_data' => [
                                'Program' => $program,
                                'Weight' => $weight,
                                'Mid Year' => $midyear,
                                'One Year' => $oneyear,
                                'Due Date' => $duedate
                            ]
                        ]),
                        'by' => session()->get('nama')
                    ];
                    $this->logModel->insert($logData);
                }
    
                $msg = [
                    'sukses' => true,
                    'message' => 'Data Berhasil Diperbarui!'
                ];
    
                return $this->response->setJSON($msg);
            } else {
                $msg = [
                    'error' => 'Data not found.'
                ];
    
                return $this->response->setJSON($msg);
            }
        } else {
            $msg = [
                'error' => 'Invalid request.'
            ];
    
            return $this->response->setJSON($msg);
        }
    }

    public function editRevisi(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $idMain = $this->request->getVar('idMain');
            $dateSubmitted = date('Y-m-d');
            $periodeIPP = $this->periodeModel->getLatestIPPeriode();
            $periodeIPPMid = $this->periodeModel->getLatestMidPeriode();
            $periodeIPPOne = $this->periodeModel->getLatestOnePeriode();
            $ippPeriode = false;
            $editIppMid = false;
            $editIppOne = false;
            // dd($periodeIPP);

            $currentDate = date('Y-m-d H:i:s');
            if ($periodeIPPMid !== null){
                $editIppMid = ($currentDate >= $periodeIPPMid['start_period'] && $currentDate <= $periodeIPPMid['end_period']);
            } elseif ($periodeIPPOne !== null){
                $editIppOne = ($currentDate >= $periodeIPPOne['start_period'] && $currentDate <= $periodeIPPOne['end_period']);
            };

            if ($periodeIPPMid == true){
                $this->isiModel->set(['is_submitted_ipp' => 0])->where(['id' => $id])->update();
        
                $idMain = $this->request->getVar('idMain');
                $this->ippModel->set([
                    'is_submitted_ipp'   => 0,
                    'date_submitted_ipp' => null,
                    'is_approved_presdir'=> 0,
                    'is_approved_bod'=> 0,
                    'is_approved_kadiv'=> 0,
                    'is_approved_kadept'=> 0,
                    'is_approved_kasie'=> 0,
                    'approval_presdir'=> 0,
                    'approval_bod'=> 0,
                    'approval_kadiv'=> 0,
                    'approval_kadept'=> 0,
                    'approval_kasie'=> 0
                ])->where(['id' => $idMain])->update();
            } elseif($periodeIPPOne == true){
                $this->isiModel->set([
                    'is_submitted_ipp' => 0,
                    'is_submitted_ipp_mid' => 0
                ])->where(['id' => $id])->update();
        
                $idMain = $this->request->getVar('idMain');
                $this->ippModel->set([
                    'is_submitted_ipp'   => 1,
                    'is_submitted_ipp_mid' => 1,
                    'is_approved_presdir'=> 0,
                    'is_approved_bod'=> 0,
                    'is_approved_kadiv'=> 0,
                    'is_approved_kadept'=> 0,
                    'is_approved_kasie'=> 0,
                    'approval_presdir'=> 0,
                    'approval_bod'=> 0,
                    'approval_kadiv'=> 0,
                    'approval_kadept'=> 0,
                    'approval_kasie'=> 0
                ])->where(['id' => $idMain])->update();
            }
    
            $response = [
                'sukses' => true,
                'message' => 'Data berhasil disimpan.'
            ];
    
            return $this->response->setJSON($response);
        }
    }

    public function newMain(){
        $periode = $this->request->getVar('$periode');
        $id_main = $this->request->getVar('id_main');
        // dd($id_main, $periode = strpos($periode, 'Revisi 1') !== true);
        // dd();
        if (strpos($periode, 'Rev. Mid Year') === false){
            $created_at = date('Y-m-d');
            $periode = date('Y') . ' Rev. Mid Year';
            $created_by = session()->get('npk');
            $id_division = session()->get('id_division');
            $id_department = session()->get('id_department');
            $id_section = session()->get('id_section');
            $kode_jabatan = session()->get('kode_jabatan');
            // $id_main = $this->ippModel->getInsertID();
            $this->ippModel->set(['is_submitted_ipp' => 0])->where(['id'=> $id_main])->update();

            $existingIpp = $this->ippModel->where('periode', $periode)
                ->where('created_by', $created_by)
                ->first();

            // $loginModel = new LoginModel();
            // $nama = $loginModel->where('npk', $created_by)->first()['nama'];
            $nama = session()->get('nama');

            $data = [
                'created_at' => $created_at,
                'periode' => $periode,
                'created_by' => $created_by,
                'nama' => $nama,
                'id_department' => $id_department,
                'id_division' => $id_division,
                'id_section' => $id_section,
                'department' => session()->get('department'),
                'division' => session()->get('division'),
                'section' => session()->get('section'),
                'kode_jabatan' => $kode_jabatan
            ];

            $this->ippModel->insert($data);
            $id_main = $this->ippModel->getInsertID();
            // dd($id_main);
        }

        $msg = [
            'sukses' => true,
            'message' => 'Data Berhasil Diperbarui!',
            'id_main' => $id_main
        ];

        return $this->response->setJSON($msg);
    }

    // Save edit untuk edit ipp saat midyear
    public function saveEditIppMid() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $program = $this->request->getVar('program');
            $weight = $this->request->getVar('weight');
            $midyear = $this->request->getVar('midyear');
            $oneyear = $this->request->getVar('oneyear');
            $duedate = $this->request->getVar('duedate');
            $id_main = $this->request->getVar('id_main');
            $isValueChanged = false;
            // dd($id);
    
            $dataInput = [
                'id_main' => $id_main,
                'program' => $program,
                'weight' => $weight,
                'midyear' => $midyear,
                'oneyear' => $oneyear,
                'duedate' => $duedate,
                // 'is_submitted_ipp' => 0
            ];
            // dd($dataInput);

            $periode = $this->request->getVar('$periode');
            if (strpos($periode, 'Rev. Mid Year') !== false || strpos($periode, 'Rev. One Year') !== false){
                $this->isiModel->set($dataInput)->where(['id'=> $id])->update();
                $isValueChanged = false;
            
                $row = $this->isiModel->find($id);
        
                if ($row) {
                    $oldData = [
                        'program' => $row['program'],
                        'weight'  => $row['weight'],
                        'midyear' => $row['midyear'],
                        'oneyear' => $row['oneyear'],
                        'duedate' => $row['duedate']
                    ];
        
                    if (
                        $oldData['program'] !== $program ||
                        $oldData['weight'] !== $weight ||
                        $oldData['midyear'] !== $midyear ||
                        $oldData['oneyear'] !== $oneyear ||
                        $oldData['duedate'] !== $duedate
                    )
        
                    if ($isValueChanged) {
                        $logData = [
                            'action' => 'update',
                            'table_name' => 'isi_ipp',
                            'record_id' => $id,
                            'data_changes' => json_encode([
                                'old_data' => [
                                    'Program' => $oldData['program'],
                                    'Weight' => $oldData['weight'],
                                    'Mid Year' => $oldData['midyear'],
                                    'One Year' => $oldData['oneyear'],
                                    'Due Date' => $oldData['duedate']
                                ],
                                'new_data' => [
                                    'Program' => $program,
                                    'Weight' => $weight,
                                    'Mid Year' => $midyear,
                                    'One Year' => $oneyear,
                                    'Due Date' => $duedate
                                ]
                            ]),
                            'by' => session()->get('nama')
                        ];
                        $this->logModel->insert($logData);
                    }
        
                    $msg = [
                        'sukses' => true,
                        'message' => 'Data Berhasil Diperbarui!'
                    ];
        
                    return $this->response->setJSON($msg);
                }
            } else {
                $this->isiModel->insert($dataInput);
                // dd($id_main);
                $logData = [
                    'action' => 'Insert',
                    'table_name' => 'isi_ipp',
                    'record_id' => $id,
                    'data_changes' => json_encode([
                        'new_data' => [
                            'Program' => $program,
                            'Weight' => $weight,
                            'Mid Year' => $midyear,
                            'One Year' => $oneyear,
                            'Due Date' => $duedate
                        ]
                    ]),
                    'by' => session()->get('nama')
                ];
                $this->logModel->insert($logData);
            
            }

            $msg = [
                'sukses' => true,
                'message' => 'Data Berhasil Diperbarui!'
            ];

            return $this->response->setJSON($msg);
        }
    }

    public function newMainOne(){
        $periode = $this->request->getVar('$periode');
        $id_main = $this->request->getVar('id_main');
        // dd($id_main, $periode = strpos($periode, 'Revisi 1') !== true);
        // dd();
        if (strpos($periode, 'Rev. One Year') === false){
            $created_at = date('Y-m-d');
            $periode = date('Y') . ' Rev. One Year';
            $created_by = session()->get('npk');
            $id_division = session()->get('id_division');
            $id_department = session()->get('id_department');
            $id_section = session()->get('id_section');
            $kode_jabatan = session()->get('kode_jabatan');
            $nama = session()->get('nama');
            // $id_main = $this->ippModel->getInsertID();
            $this->ippModel->set(['is_submitted_ipp' => 0, 'is_submitted_ipp_mid' => 0])->where(['id'=> $id_main])->update();

            $existingIpp = $this->ippModel->where('periode', $periode)
                ->where('created_by', $created_by)
                ->first();

            // $loginModel = new LoginModel();
            // $nama = $loginModel->where('npk', $created_by)->first()['nama'];

            $data = [
                'created_at' => $created_at,
                'periode' => $periode,
                'created_by' => $created_by,
                'nama' => $nama,
                'id_department' => $id_department,
                'id_division' => $id_division,
                'id_section' => $id_section,
                'department' => session()->get('department'),
                'division' => session()->get('division'),
                'section' => session()->get('section'),
                'kode_jabatan' => $kode_jabatan
            ];

            $this->ippModel->insert($data);
            $id_main = $this->ippModel->getInsertID();
            // dd($id_main);
        }

        $msg = [
            'sukses' => true,
            'message' => 'Data Berhasil Diperbarui!',
            'id_main' => $id_main
        ];

        return $this->response->setJSON($msg);
    }

    // Delete baris
    public function delete_data() {
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $id_main = $this->request->getVar('id_main');
            $isiModel = new IsiModel();
            $deletedRow = $isiModel->find($id);
    
            if ($deletedRow) {
                $isiModel->delete($id);
                $msg = [
                    'sukses' => true,
                    'message' => 'Data deleted successfully.'
                ];
    
                // Simpan perubahan dalam log
                $logData = [
                    'action' => 'Delete',
                    'table_name' => 'isi_ipp',
                    'record_id' => $id,
                    'data_changes' => json_encode(['deleted_data' => $deletedRow]),
                    'by' => session()->get('nama')
                ];
    
                $logModel = new LogModel();
                $logModel->insert($logData);
            } else {
                $msg = [
                    'sukses' => false,
                    'message' => 'Data not found or could not be deleted.'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }    

    // Log atau history perubahan
    public function viewLogChanges($id) {
        $logData = $this->logModel->getLogEntriesByTableNameAndRecordId('isi_ipp', $id);

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

    public function generatePdf($id){
        $ippDetail = $this->isiModel->getIsi($id);
        $approval = $this->ippModel->getIppData($id);
        $mainData = $this->ippModel->find($id);
        $nama = $mainData['nama'];
        $npk = $mainData['created_by'];
        
        $dompdf = new Dompdf();
        // $dompdf->setTitle('IPP PDF');
        $imagePath = Paths::$imagePath;
        $imageData = file_get_contents($imagePath);
        $base64Image = base64_encode($imageData);
        // echo $base64Image;
        if (!empty($approval['date_submitted_ipp'])) {
            $date_submitted = $approval['date_submitted_ipp'];
        } elseif (!empty($approval['date_submitted_ipp_mid'])) {
            $date_submitted = $approval['date_submitted_ipp_mid'];
        } elseif (!empty($approval['date_submitted_ipp_one'])) {
            $date_submitted = $approval['date_submitted_ipp_one'];
        } else {
            $date_submitted = '';
        }

        $html = view('ipp/ipp_pdf', [
            'ipp'           => $ippDetail,
            'userNama'      => $approval['nama'],
            'userNpk'       => $npk,
            'kode_jabatan'  => $mainData['kode_jabatan'],
            'approval'      => $approval,
            'date_submitted'=> $date_submitted,
            'base64Image'   => $base64Image,
            'id_main'       => $id
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('IPP '. session()->get('nama') .'.pdf', ['Attachment' => 0]);
    }

    public function viewPdf($id) {
        $mainData = $this->ippModel->find($id);
        $file_name = $mainData['files'];
        $pdf_path = WRITEPATH . 'uploads/' . $file_name;
        $display_name = 'IPP' . '_' . $mainData['periode'] . '_' . $mainData['nama'] . '.pdf';

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