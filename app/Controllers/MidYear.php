<?php

namespace App\Controllers;
use App\Models\IppModel;
use App\Models\LoginModel;
use App\Models\IsiModel;
use App\Models\IsiSaveModel;
use App\Models\PeriodeModel;
use App\Models\MidyearModel;
use App\Models\LogModel;
use App\Models\StrongWeakMainModel;
use App\Models\ProcsumMainModel;
use Dompdf\Dompdf;
use Config\Paths;

class MidYear extends BaseController
{
    public function __construct(){
        $this->ippModel = new IppModel();
        $this->isiModel = new IsiModel();      
        $this->isisave = new IsiSaveModel(); 
        $this->midyearisi = new MidyearModel();     
        $this->logModel = new LogModel();
        $this->strongweakmain   = new StrongWeakMainModel();    
        $this->procsummain   = new ProcsumMainModel();
    }

    public function index() {
        $user = session()->get('npk');
        $midyear = $this->ippModel->getMidyear($user);
        $hasRevisi = false;
        // dd($user);
    
        $data = [
            'tittle' => 'Mid Year Result Review',
            'midyear' => $midyear,
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
    
        return view('midyear/index', $data);
    }    

    public function detail($id) {
        // dd($id);
        $user = session()->get('npk');
        $midyearData = $this->midyearisi->getIsi($id);

        $is_submitted = null;
        if (!empty($midyearData)) {
            $is_submitted = $midyearData[0]['is_submitted'];
        }
        $mainData = $this->ippModel->find($id);
    
        $data = [
            'tittle'       => 'Detail Mid Year Result Review',
            'midyear'      => $midyearData,
            'mainData'     => $mainData,
            'main'         => $this->ippModel->find($id),
            'id_main'      => $id,
            'is_submitted' => $is_submitted,
            'periode'      => $mainData['periode'],
            'mainall'      => $this->ippModel->findAll(),
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
    
        if ($mainData) {
            $data['npk_user'] = $mainData['created_by'];
            $data['nama'] = $mainData['nama'];
        } else {
            $data['npk_user'] = null;
            $data['nama'] = null;
        }
    
        return view('midyear/detail', $data);
    }
    
    // Simpan edit data
    public function save_data(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $id_main = $this->request->getVar('idMain');
            $program = $this->request->getVar('program');
            $weight = $this->request->getVar('weight');
            $midyear = $this->request->getVar('midyear');
            $midyear_achv = $this->request->getVar('midyear_achv');
            $midyear_achv_score = $this->request->getVar('midyear_achv_score');
            $midyear_achv_total = $this->request->getVar('midyear_achv_total');
            $sum_total = 0; // Inisialisasi sum_total
            $isValueChanged = false;
    
            $row = $this->midyearisi->find($id);
    
            if ($row) {
                $oldData = [
                    'midyear_achv'       => $row['midyear_achv'],
                    'midyear_achv_score' => $row['midyear_achv_score'],
                    'midyear_achv_total' => $row['midyear_achv_total']
                ];
            }
    
            if (
                $oldData['midyear_achv'] != $midyear_achv ||
                $oldData['midyear_achv_score'] != $midyear_achv_score ||
                $oldData['midyear_achv_total'] != $midyear_achv_total
            ) {
                $isValueChanged = true;
    
                $this->ippModel->update($row['id_main'], [
                    'approval_kadept_midyear' => 0,
                    'approval_kadiv_midyear'  => 0
                ]);
            }
    
            // Update data dalam database berdasarkan id_main
            $this->midyearisi->set([
                'program' => $program,
                'weight' => $weight,
                'midyear' => $midyear,
                'midyear_achv' => $midyear_achv,
                'midyear_achv_score' => $midyear_achv_score,
                'midyear_achv_total' => $midyear_achv_total,
                'is_submitted' => 0
            ])->where(['id' => $id])->update();
    
            $sumTotalQuery = $this->midyearisi->selectSum('midyear_achv_total', 'sum_total')->where('id_main', $row['id_main'])->get()->getRow();
            if ($sumTotalQuery) {
                $sum_total = $sumTotalQuery->sum_total;
            }

            $this->midyearisi->set(['sum_total' => $sum_total])->where(['id_main' => $row['id_main']])->update();

    
            if ($isValueChanged) {
                $logData = [
                    'action' => 'Update',
                    'table_name' => 'midyear',
                    'record_id' => $id_main,
                    'data_changes' => json_encode([
                        'old_data' => [
                            'Mid Year Achievement' => $oldData['midyear_achv'],
                            'Score'                => $oldData['midyear_achv_score'],
                            'Total'                => $oldData['midyear_achv_total']
                        ],
                        'new_data' => [
                            'Mid Year Achievement' => $midyear_achv,
                            'Score'                => $midyear_achv_score,
                            'Total'                => $midyear_achv_total
                        ]
                    ]),
                    'by' => session()->get('nama')
                ];
    
                $this->logModel->insert($logData);
            }
    
            $msg = [
                'sukses' => true,
                'message' => 'Data Berhasil Disimpan!'
            ];
    
            return $this->response->setJSON($msg);
        } else {
            $msg = [
                'error' => 'Permintaan tidak valid.'
            ];
    
            return $this->response->setJSON($msg);
        }
    }    

    // Submit data
    public function submit(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $logData = [];
            $dateSubmitted = date('Y-m-d');
    
            $this->midyearisi->set(['is_submitted' => 1])->where(['id' => $id])->update();
            $this->isiModel->set(['is_submitted' => 1])->where(['id' => $id])->update();
    
            $idMain = $this->request->getVar('idMain');
            $this->ippModel->set([
                'is_submitted'  => 1,
                'date_submitted'=> $dateSubmitted
            ])->where(['id' => $idMain])->update();
    
            $response = [
                'sukses' => true,
                'message' => 'Data berhasil disimpan.'
            ];
    
            return $this->response->setJSON($response);
        }
    }

    public function datalama(){
        if ($this->request->isAJAX()) {
            $created_at = date('Y-m-d');
            $periode = $this->request->getVar('periode');
            // $file = $this->request->getFile('file');
            // $fileData = file_get_contents($file->getTempName());
            $file = $this->request->getFile('file');
            $newName = 'MidYear' . '_' . $periode . '_' . session()->get('nama');
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
            $existingMid = $this->ippModel->where('periode', $periode)
            ->where('created_by', $created_by)
            ->first();

            if($existingMid) {
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
                    'approval_date_bod'=> date('Y-m-d'),
                    'approval_presdir'     => 1,
                    'approval_date_presdir'=> date('Y-m-d'),
                    'approval_kadiv'     => 1,
                    'approval_date_kadiv'=> date('Y-m-d'),
                    'approval_kadept'     => 1,
                    'approval_date_kadept'=> date('Y-m-d'),
                    'approval_kasie'     => 1,
                    'approval_date_kasie'=> date('Y-m-d'),
                    // 'is_submitted_ipp'   => 1,
                    'approval_bod_midyear'     => 1,
                    'approval_date_bod_midyear'=> date('Y-m-d'),
                    'approval_presdir_midyear'     => 1,
                    'approval_date_presdir_midyear'=> date('Y-m-d'),
                    'approval_kadiv_midyear'     => 1,
                    'approval_date_kadiv_midyear'=> date('Y-m-d'),
                    'approval_kadept_midyear'     => 1,
                    'approval_date_kadept_midyear'=> date('Y-m-d'),
                    'approval_kasie_midyear'     => 1,
                    'approval_date_kasie_midyear'=> date('Y-m-d')
                ]);

                $hasil['sukses'] = "Berhasil memasukkan data";
                $hasil['gagal'] = true;
            }

            return json_encode($hasil);
        }
    }

    // Menyimpan sum_midyear_total
    public function sum_midyear_total(){
        if ($this->request->isAJAX()) {
            $userNpk = session()->get('npk');
            $totalScore = $this->request->getVar('sum_midyear_total');

            $this->ippModel->where('created_by', $userNpk)->set(['sum_midyear_total' => $totalScore])->update();

            $msg = [
                'success' => true,
                'message' => 'Total Score berhasil disimpan ke dalam database.'
            ];

            return $this->response->setJSON($msg);
        } else {
            $msg = [
                'error' => 'Permintaan tidak valid.'
            ];

            return $this->response->setJSON($msg);
        }
    }

    // Log atau history perubahan
    public function logchanges($id) {
        $logData = $this->logModel->getLogEntriesByTableNameAndRecordId('midyear', $id);
        // dd($logData);

        $data = [
            'tittle'    => 'History Perubahan Mid Year Review',
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

    public function midyearpdf($id){
        $ippDetail = $this->midyearisi->getIsi($id);
        $approval = $this->ippModel->getIppData($id);

        $dompdf = new Dompdf();
        $imagePath = Paths::$imagePath;
        $imageData = file_get_contents($imagePath);
        $base64Image = base64_encode($imageData);
        // echo $base64Image;

        $html = view('midyear/midyear_pdf', [
            'midyear'       => $ippDetail,
            'userNama'      => session()->get('nama'),
            'userNpk'       => session()->get('npk'),
            'approval'      => $approval,
            'date_submitted'=> $approval['date_submitted'],
            'base64Image'   => $base64Image,
            'id_main'       => $id,
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('MID YEAR '. session()->get('nama') .'.pdf', ['Attachment' => 0]);
    }

    public function viewPdf($id) {
        $mainData = $this->ippModel->find($id);
        $file_name = $mainData['files'];
        $pdf_path = WRITEPATH . 'uploads/' . $file_name;
        $display_name = 'MidYear' . '_' . $mainData['periode'] . '_' . $mainData['nama'] . '.pdf';

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