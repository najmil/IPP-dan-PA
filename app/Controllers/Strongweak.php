<?php

namespace App\Controllers;

use App\Models\StrongweakModel;
use App\Models\StrongWeakMainModel;
use CodeIgniter\Controller;
use App\Models\LoginModel;
use App\Models\IppModel;
use App\Models\LogModel;
use App\Models\ProcsumMainModel;
use Dompdf\Dompdf;
use Config\Paths;

class Strongweak extends BaseController
{
    public function __construct(){
        $this->strongweakmodel = new StrongweakModel();
        $this->strongweakmain = new StrongWeakMainModel();    
        $this->ippModel = new IppModel();
        $this->logModel     = new LogModel(); 
        $this->procsummain   = new ProcsumMainModel();
    }

    public function index(){
        $user = session()->get('npk');
        $strongweak = $this->strongweakmain->getStrongweakByUser($user);
        $approval = $this->ippModel->getIppByUser($user);
        // dd($approval);

        $nama = session()->get('nama');

        $data = [
            'tittle'     => 'Strength and Weakness',
            'strongweak' => $strongweak,
            'nama'       => $nama,
            'approval'   => $approval,
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
        
        return view('strongweak/index', $data);
    } 

    public function save() {
        $periodeInput = $this->request->getPost('periodeInput'); 
        $created_by = session()->get('npk');
        $id_division = session()->get('id_division');
        $id_department = session()->get('id_department');
        $id_section = session()->get('id_section');
        $kode_jabatan = session()->get('kode_jabatan');
        $type_karyawan = session()->get('type_karyawan');
        $dateTimeNow = new \DateTime();
        $created_at = $dateTimeNow->format('Y-m-d H:i:s');
        $updated_at = $dateTimeNow->format('Y-m-d H:i:s');
        $nama = session()->get('nama');
    
        if (empty($periodeInput)) {
            $hasil['sukses'] = false;
            $hasil['gagal'] = "Periode cannot be empty.";
        } else {
            $existingIpp = $this->strongweakmain
            ->where('periode', $periodeInput)
            ->where('created_by', $created_by)
            ->first();
    
            if ($existingIpp) {
                $hasil['sukses'] = false;
                $hasil['gagal'] = "Performance Appraisal (Strength and Weakness) untuk periode ini sudah ada.";
            } else {
                // $nama = $this->loginModel->where('npk', $created_by)->first()['nama'];

                $data = [
                    'nama' => $nama,
                    'created_at' => $created_at,
                    'periode' => $periodeInput,
                    'created_by' => $created_by,
                    'updated_at' => $updated_at,
                    'id_department' => $id_department,
                    'id_division' => $id_division,
                    'id_section' => $id_section,
                    'kode_jabatan' => $kode_jabatan,
                    'type_karyawan' => $type_karyawan
                ];
    
                $this->strongweakmain->insert($data);
    
                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['gagal'] = false;
            }
        }
    
        return json_encode($hasil);
    }

    public function detail($id){
        $strongweakDetail = $this->strongweakmodel->getIsi($id);
        $mainData         = $this->strongweakmain->find($id);
        $currentYear      = date('Y');
        $periode          = $mainData['periode'];
        $validation       = \Config\Services::validation();

        $is_submitted     = null;
        $is_submitted_one = null;
        $is_saved_midyear = null;
        $is_saved_oneyear = null;
        if (!empty($strongweakDetail)) {
            $is_submitted = $strongweakDetail[0]['is_submitted'];
            $is_submitted_one = $strongweakDetail[0]['is_submitted_one'];
            $is_saved_oneyear = $strongweakDetail[0]['is_saved_oneyear'];
            $is_saved_midyear = $strongweakDetail[0]['is_saved_midyear'];
        }

        if (strpos($periode, 'One Year') !== false) {
            return redirect()->to(base_url("strongweak/detail_one/{$id}"));
        }

        $data = [
            'tittle'                => 'Detail Strength and Weakness',
            'id_strongweak_main'    => $id,
            'strongweak'            => $this->strongweakmodel->getSavedData($id),
            'strongweakmain'        => $this->strongweakmain->getStrongweakData($id),
            'validation'            => $validation,
            'is_submitted'          => $is_submitted,
            'is_submitted_one'      => $is_submitted_one,
            'is_saved_oneyear'      => $is_saved_oneyear,
            'is_saved_midyear'      => $is_saved_midyear,
            'countPending' => $this->ippModel->getDataPending(),
            'countPendingPlantS' => $this->ippModel->getPendingPlantS(),
            'countPendingAdm' => $this->ippModel->getPendingAdm(),
            'countPendingFin' => $this->ippModel->getPendingFin(),
            'countPendingPlant' => $this->ippModel->getPendingPlant(),
            'countPendingEng' => $this->ippModel->getPendingEng(),
            'countPendingIsd' => $this->ippModel->getPendingIsd(),

            'countPendingMid' => $this->ippModel->getDataPendingMid(),
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

        return view('strongweak/detail', $data);
    }

    // Save or insert the first input
    public function save_data(){
        $id_strongweak_main = $this->request->getVar('id_strongweak_main');
        $note_mid           = $this->request->getVar('note_mid');
        $alc_mid            = $this->request->getVar('alc_mid');
        $sub_alc_mid        = $this->request->getVar('sub_alc_mid');
        $technical_mid      = $this->request->getVar('technical_mid');
        $technical_value_mid= $this->request->getVar('technical_value_mid');
        $strong_mid_alc     = $this->request->getVar('strong_mid_alc');
        $weak_alc_mid       = $this->request->getVar('weak_alc_mid');
        $weak_sub_alc_mid   = $this->request->getVar('weak_sub_alc_mid');
        $weak_technical_mid = $this->request->getVar('weak_technical_mid');
        $weak_mid_alc       = $this->request->getVar('weak_mid_alc');
        $weak_technical_value_mid = $this->request->getVar('weak_technical_value_mid');

        // $validation = \Config\Services::validation();

        $data = [
            'id_strongweak_main'      => $id_strongweak_main,
            'note_mid'                => $note_mid,
            'alc_mid'                 => $alc_mid,
            'sub_alc_mid'             => $sub_alc_mid,
            'technical_mid'           => $technical_mid,
            'strong_mid_alc'          => $strong_mid_alc,
            'technical_value_mid'     => $technical_value_mid,
            'weak_alc_mid'            => $weak_alc_mid,
            'weak_sub_alc_mid'        => $weak_sub_alc_mid,
            'weak_technical_mid'      => $weak_technical_mid,
            'weak_mid_alc'            => $weak_mid_alc,
            'weak_technical_value_mid'=> $weak_technical_value_mid,
            'is_saved_midyear'        => 1
        ];
        // dd($data);

        $logData = [
            'action' => 'Insert (Mid Year)',
            'table_name' => 'strongweak',
            'record_id' => $id_strongweak_main,
            'data_changes' => json_encode([
                'new_data' => [
                    'Alc (Strength)'                  => $alc_mid,
                    'Key-alc (Strength)'              => $sub_alc_mid,
                    'Keterangan (Alc Strength)'       => $strong_mid_alc,
                    'Technical (Strength)'            => $technical_mid,
                    'Keterangan  (Technical Strength)'=> $technical_value_mid,
                    'Alc (Weakness)'                  => $weak_alc_mid,
                    'Key Alc (Weakness)'              => $weak_sub_alc_mid,
                    'Keterangan (Alc Weakness)'       => $weak_mid_alc,
                    'Technical (Weakness)'            => $weak_technical_mid,
                    'Keterangan (Technical Weakness)' => $weak_technical_value_mid,
                    'Note'                            => $note_mid
                ]
            ]),
            'by' => session()->get('nama')
        ];

        $this->logModel->insert($logData);

        if ($this->strongweakmodel->insert($data)) {
            return $this->response->setJSON(['message' => 'Data berhasil disimpan.']);
        } else {
            return $this->response->setJSON(['message' => 'Gagal menyimpan data.']);
        }
    }

    public function save_data_one(){
        $id_strongweak_main = $this->request->getVar('id_strongweak_main');
        $note_one           = $this->request->getVar('note_one');
        $alc_one      = $this->request->getVar('alc_one');
        $sub_alc_one      = $this->request->getVar('sub_alc_one');
        $technical_one      = $this->request->getVar('technical_one');
        $strong_one_alc      = $this->request->getVar('strong_one_alc');
        $technical_value_one      = $this->request->getVar('technical_value_one');
        $weak_alc_one      = $this->request->getVar('weak_alc_one');
        $weak_sub_alc_one      = $this->request->getVar('weak_sub_alc_one');
        $weak_technical_one      = $this->request->getVar('weak_technical_one');
        $weak_one_alc      = $this->request->getVar('weak_one_alc');
        $weak_technical_value_one      = $this->request->getVar('weak_technical_value_one');

        $validation = \Config\Services::validation();

        $this->strongweakmodel->set([
            'note_one'                 => $note_one,
            'alc_one'                  => $alc_one,
            'sub_alc_one'              => $sub_alc_one,
            'technical_one'            => $technical_one,
            'strong_one_alc'           => $strong_one_alc,
            'technical_value_one'      => $technical_value_one,
            'weak_alc_one'             => $weak_alc_one,
            'weak_sub_alc_one'         => $weak_sub_alc_one,
            'weak_technical_one'       => $weak_technical_one,
            'weak_one_alc'             => $weak_one_alc,
            'weak_technical_value_one' => $weak_technical_value_one,
            'is_saved_oneyear'         => 1
        ])->where(['id_strongweak_main' => $id_strongweak_main])->update();

        $logData = [
            'action' => 'insert one year',
            'table_name' => 'strongweak',
            'record_id' => $id_strongweak_main,
            'data_changes' => json_encode([
                'new_data' => [
                    'Alc (Strength)'                  => $alc_one,
                    'Key-alc (Strength)'              => $sub_alc_one,
                    'Keterangan (Alc Strength)'       => $strong_one_alc,
                    'Technical (Strength)'            => $technical_one,
                    'Keterangan  (Technical Strength)'=> $technical_value_one,
                    'Alc (Weakness)'                  => $weak_alc_one,
                    'Key Alc (Weakness)'              => $weak_sub_alc_one,
                    'Keterangan (Alc Weakness)'       => $weak_one_alc,
                    'Technical (Weakness)'            => $weak_technical_one,
                    'Keterangan (Technical Weakness)' => $weak_technical_value_one,
                    'Note'                            => $note_one
                ]
            ]),
            'by' => session()->get('nama')
        ];

        $this->logModel->insert($logData);
    }

    public function update_data(){
        $id_strongweak_main = $this->request->getPost('id_strongweak_main');
        $note_mid           = $this->request->getVar('note_mid');
        $alc_mid            = $this->request->getVar('alc_mid');
        $sub_alc_mid        = $this->request->getVar('sub_alc_mid');
        $technical_mid      = $this->request->getVar('technical_mid');
        $technical_value_mid= $this->request->getVar('technical_value_mid');
        $strong_mid_alc     = $this->request->getVar('strong_mid_alc');
        $weak_alc_mid       = $this->request->getVar('weak_alc_mid');
        $weak_sub_alc_mid   = $this->request->getVar('weak_sub_alc_mid');
        $weak_technical_mid = $this->request->getVar('weak_technical_mid');
        $weak_mid_alc       = $this->request->getVar('weak_mid_alc');
        $weak_technical_value_mid = $this->request->getVar('weak_technical_value_mid');

        $row = $this->strongweakmodel->getSavedData($id_strongweak_main);
        if($row){
            $oldData = [
                'alc_mid'                  => $row['alc_mid'],
                'sub_alc_mid'              => $row['sub_alc_mid'],
                'strong_mid_alc'           => $row['strong_mid_alc'],
                'technical_mid'            => $row['technical_mid'],
                'technical_value_mid'      => $row['technical_value_mid'],
                'weak_alc_mid'             => $row['weak_alc_mid'],
                'weak_sub_alc_mid'         => $row['weak_sub_alc_mid'],
                'weak_mid_alc'             => $row['weak_mid_alc'],
                'weak_technical_mid'       => $row['weak_technical_mid'],
                'weak_technical_value_mid' => $row['weak_technical_value_mid'],
                'note_mid'                 => $row['note_mid']
            ];

            if(
                $oldData['alc_mid'] !== $alc_mid ||
                $oldData['sub_alc_mid'] !== $sub_alc_mid ||
                $oldData['strong_mid_alc'] !== $strong_mid_alc ||
                $oldData['technical_mid'] !== $technical_mid ||
                $oldData['technical_value_mid'] !== $technical_value_mid ||
                $oldData['weak_alc_mid'] !== $weak_alc_mid ||
                $oldData['weak_sub_alc_mid'] !== $weak_sub_alc_mid ||
                $oldData['weak_mid_alc'] !== $weak_mid_alc ||
                $oldData['weak_technical_mid'] !== $weak_technical_mid ||
                $oldData['weak_technical_value_mid'] !== $weak_technical_value_mid ||
                $oldData['note_mid'] !== $note_mid
            ){
                $isValueChanged = true;
            }

            $this->strongweakmodel->set([
                'alc_mid'                  => $alc_mid,
                'sub_alc_mid'              => $sub_alc_mid,
                'strong_mid_alc'           => $strong_mid_alc,
                'technical_mid'            => $technical_mid,
                'technical_value_mid'      => $technical_value_mid,
                'weak_alc_mid'             => $weak_alc_mid,
                'weak_sub_alc_mid'         => $weak_sub_alc_mid,
                'weak_mid_alc'             => $weak_mid_alc,
                'weak_technical_mid'       => $weak_technical_mid,
                'weak_technical_value_mid' => $weak_technical_value_mid,
                'note_mid'                 => $note_mid,
                'is_submitted'             => 0
            ])->where(['id_strongweak_main'=> $id_strongweak_main])->update();

            if($isValueChanged){
                $logData = [
                    'action' => 'Update (Mid Year)',
                    'table_name' => 'strongweak',
                    'record_id' => $id_strongweak_main,
                    'data_changes' => json_encode([
                        'old_data' => [
                            'Alc (Strength)'                  => $oldData['alc_mid'],
                            'Key-alc (Strength)'              => $oldData['sub_alc_mid'],
                            'Keterangan (Alc Strength)'       => $oldData['strong_mid_alc'],
                            'Technical (Strength)'            => $oldData['technical_mid'],
                            'Keterangan  (Technical Strength)'=> $oldData['technical_value_mid'],
                            'Alc (Weakness)'                  => $oldData['weak_alc_mid'],
                            'Key Alc (Weakness)'              => $oldData['weak_sub_alc_mid'],
                            'Keterangan (Alc Weakness)'       => $oldData['weak_mid_alc'],
                            'Technical (Weakness)'            => $oldData['weak_technical_mid'],
                            'Keterangan (Technical Weakness)' => $oldData['weak_technical_value_mid'],
                            'Note'                            => $oldData['note_mid']
                        ],
                        'new_data' => [
                            'Alc (Strength)'                  => $alc_mid,
                            'Key-alc (Strength)'              => $sub_alc_mid,
                            'Keterangan (Alc Strength)'       => $strong_mid_alc,
                            'Technical (Strength)'            => $technical_mid,
                            'Keterangan  (Technical Strength)'=> $technical_value_mid,
                            'Alc (Weakness)'                  => $weak_alc_mid,
                            'Key Alc (Weakness)'              => $weak_sub_alc_mid,
                            'Keterangan (Alc Weakness)'       => $weak_mid_alc,
                            'Technical (Weakness)'            => $weak_technical_mid,
                            'Keterangan (Technical Weakness)' => $weak_technical_value_mid,
                            'Note'                            => $note_mid
                        ]
                    ]),
                    'by' => session()->get('nama')
                ];
                $this->logModel->insert($logData);
            }
        }

        return $this->response->setJSON(['message' => 'Data berhasil diperbarui.']);
    }

    public function update_data_one(){
        $id_strongweak_main = $this->request->getPost('id_strongweak_main');
        $note_one           = $this->request->getVar('note_one');
        $alc_one            = $this->request->getVar('alc_one');
        $sub_alc_one        = $this->request->getVar('sub_alc_one');
        $technical_one      = $this->request->getVar('technical_one');
        $technical_value_one= $this->request->getVar('technical_value_one');
        $strong_one_alc     = $this->request->getVar('strong_one_alc');
        $weak_alc_one       = $this->request->getVar('weak_alc_one');
        $weak_sub_alc_one   = $this->request->getVar('weak_sub_alc_one');
        $weak_technical_one = $this->request->getVar('weak_technical_one');
        $weak_one_alc       = $this->request->getVar('weak_one_alc');
        $weak_technical_value_one = $this->request->getVar('weak_technical_value_one');
        $isValueChanged = false;

        $row = $this->strongweakmodel->getSavedData($id_strongweak_main);
        if($row){
            $oldData = [
                'alc_one'                  => $row['alc_one'],
                'sub_alc_one'              => $row['sub_alc_one'],
                'strong_one_alc'           => $row['strong_one_alc'],
                'technical_one'            => $row['technical_one'],
                'technical_value_one'      => $row['technical_value_one'],
                'weak_alc_one'             => $row['weak_alc_one'],
                'weak_sub_alc_one'         => $row['weak_sub_alc_one'],
                'weak_one_alc'             => $row['weak_one_alc'],
                'weak_technical_one'       => $row['weak_technical_one'],
                'weak_technical_value_one' => $row['weak_technical_value_one'],
                'note_one'                 => $row['note_one']
            ];

            if(
                $oldData['alc_one'] !== $alc_one ||
                $oldData['sub_alc_one'] !== $sub_alc_one ||
                $oldData['strong_one_alc'] !== $strong_one_alc ||
                $oldData['technical_one'] !== $technical_one ||
                $oldData['technical_value_one'] !== $technical_value_one ||
                $oldData['weak_alc_one'] !== $weak_alc_one ||
                $oldData['weak_sub_alc_one'] !== $weak_sub_alc_one ||
                $oldData['weak_one_alc'] !== $weak_one_alc ||
                $oldData['weak_technical_one'] !== $weak_technical_one ||
                $oldData['weak_technical_value_one'] !== $weak_technical_value_one ||
                $oldData['note_one'] !== $note_one
            ){
                $isValueChanged = true;
            }

            $this->strongweakmodel->set([
                'alc_one'                  => $alc_one,
                'sub_alc_one'              => $sub_alc_one,
                'strong_one_alc'           => $strong_one_alc,
                'technical_one'            => $technical_one,
                'technical_value_one'      => $technical_value_one,
                'weak_alc_one'             => $weak_alc_one,
                'weak_sub_alc_one'         => $weak_sub_alc_one,
                'weak_one_alc'             => $weak_one_alc,
                'weak_technical_one'       => $weak_technical_one,
                'weak_technical_value_one' => $weak_technical_value_one,
                'note_one'                 => $note_one,
                'is_submitted'             => 0
            ])->where(['id_strongweak_main'=> $id_strongweak_main])->update();

            if($isValueChanged){
                $logData = [
                    'action' => 'Update (One Year)',
                    'table_name' => 'strongweak',
                    'record_id' => $id_strongweak_main,
                    'data_changes' => json_encode([
                        'old_data' => [
                            'Alc (Strength)'                  => $oldData['alc_one'],
                            'Key-alc (Strength)'              => $oldData['sub_alc_one'],
                            'Keterangan (Alc Strength)'       => $oldData['strong_one_alc'],
                            'Technical (Strength)'            => $oldData['technical_one'],
                            'Keterangan  (Technical Strength)'=> $oldData['technical_value_one'],
                            'Alc (Weakness)'                  => $oldData['weak_alc_one'],
                            'Key Alc (Weakness)'              => $oldData['weak_sub_alc_one'],
                            'Keterangan (Alc Weakness)'       => $oldData['weak_one_alc'],
                            'Technical (Weakness)'            => $oldData['weak_technical_one'],
                            'Keterangan (Technical Weakness)' => $oldData['weak_technical_value_one'],
                            'Note'                            => $oldData['note_one']
                        ],
                        'new_data' => [
                            'Alc (Strength)'                  => $alc_one,
                            'Key-alc (Strength)'              => $sub_alc_one,
                            'Keterangan (Alc Strength)'       => $strong_one_alc,
                            'Technical (Strength)'            => $technical_one,
                            'Keterangan  (Technical Strength)'=> $technical_value_one,
                            'Alc (Weakness)'                  => $weak_alc_one,
                            'Key Alc (Weakness)'              => $weak_sub_alc_one,
                            'Keterangan (Alc Weakness)'       => $weak_one_alc,
                            'Technical (Weakness)'            => $weak_technical_one,
                            'Keterangan (Technical Weakness)' => $weak_technical_value_one,
                            'Note'                            => $note_one
                        ]
                    ]),
                    'by' => session()->get('nama')
                ];
                $this->logModel->insert($logData);
            }
        }

        return $this->response->setJSON(['message' => 'Data berhasil diperbarui.']);
    }

    public function datalama(){
        if ($this->request->isAJAX()) {
            $created_at = date('Y-m-d');
            $periode = $this->request->getVar('periode');
            $file = $this->request->getFile('file');
            $newName = $periode . '_' . session()->get('nama');
            $file->move(WRITEPATH . 'uploads/strongweak', $newName);
            $created_by = session()->get('npk');
            $id_division = session()->get('id_division');
            $id_department = session()->get('id_department');
            $id_section = session()->get('id_section');
            $kode_jabatan = session()->get('kode_jabatan');
            $nama = session()->get('nama');

            $existingIpp = $this->strongweakmain->where('periode', $periode)
            ->where('created_by', $created_by)
            ->first();

            if($existingIpp) {
                $hasil['sukses'] = false;
                $hasil['gagal'] = "Periode ini sudah ada.";
            } else {
                $this->strongweakmain->insert([
                    'periode'                     => $periode,
                    'files'                       => $newName,
                    'created_at'                  => $created_at,
                    'created_by'                  => $created_by,
                    'nama'                        => $nama,
                    'id_department'               => $id_department,
                    'id_division'                 => $id_division,
                    'id_section'                  => $id_section,
                    'kode_jabatan'                => $kode_jabatan,
                    'approval_bod_strongweak'     => 1,
                    'approval_presdir_strongweak' => 1,
                    'approval_kadiv_strongweak'   => 1,
                    'approval_kadept_strongweak'  => 1,
                    'approval_kasie_strongweak'   => 1,
                    'approval_bod_oneyear'        => 1,
                    'approval_presdir_oneyear'    => 1,
                    'approval_kadiv_oneyear'      => 1,
                    'approval_kadept_oneyear'     => 1,
                    'approval_kasie_oneyear'      => 1
                ]);

                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['gagal'] = true;
            }
        }
        
        return json_encode($hasil);
    }

    // Submit data midyear
    public function submit_data(){
        if ($this->request->isAJAX()) {
            $id_strongweak_main = $this->request->getPost('id_strongweak_main');
            $currentDate = date('Y-m-d');
    
            // var_dump($this->isiModel->getLastQuery());

            $this->strongweakmodel->set(['is_submitted' => 1])->where(['id_strongweak_main' => $id_strongweak_main])->update();
    
            $this->strongweakmain->set([
                'is_submitted' => 1,
                'date_submitted' => $currentDate
            ])->where(['id' => $id_strongweak_main])->update();
    
            return $this->response->setJSON(['message' => 'Data berhasil diperbarui.']);
        }
    }

    // Submit data oneyear
    public function submit_data_one(){
        if ($this->request->isAJAX()) {
            $id_strongweak_main = $this->request->getPost('id_strongweak_main');
            $currentDate = date('Y-m-d');
    
            // var_dump($this->isiModel->getLastQuery());

            $this->strongweakmodel->set(['is_submitted_one' => 1])->where(['id_strongweak_main' => $id_strongweak_main])->update();
    
            $this->strongweakmain->set([
                'is_submitted_one' => 1,
                'date_submitted_one' => $currentDate
            ])->where(['id' => $id_strongweak_main])->update();
    
            return $this->response->setJSON(['message' => 'Data berhasil diperbarui.']);
        }
    }

    public function pdf($id){
        $strongweakDetail = $this->strongweakmodel->getIsi($id);
        $approval = $this->strongweakmain->getStrongweakData($id);

        $dompdf = new Dompdf();

        $html = view('strongweak/strongweak_pdf', [
            'strongweak' => $strongweakDetail,
            'userNama' => session()->get('nama'),
            'userNpk' => session()->get('npk'),
            'approval' => $approval
        ]);

        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('StrengthWeakness.pdf', ['Attachment' => 0]);
    }

    public function logchanges($id) {
        $logData = $this->logModel->getLogEntriesByTableNameAndRecordId('strongweak', $id);

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

    // pdf untuk data yang telah diinputkan
    public function viewPdf($id) {
        $mainData = $this->strongweakmain->find($id);
        $file_name = $mainData['files'];
        $pdf_path = WRITEPATH . 'uploads/strongweak/' . $file_name;
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
