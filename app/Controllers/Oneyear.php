<?php

namespace App\Controllers;
use App\Models\IppModel;
use App\Models\LoginModel;
use App\Models\IsiModel;
use App\Models\PeriodeModel;
use App\Models\LogModel;
use App\Models\OneyearModel;
use App\Models\StrongWeakMainModel;
use App\Models\ProcsumMainModel;
use Dompdf\Dompdf;
use Config\Paths;

class Oneyear extends BaseController
{
    public function __construct(){
        $this->ippModel = new IppModel();
        $this->isiModel = new IsiModel();      
        $this->oneyearisi = new OneyearModel();      
        $this->logModel = new LogModel();
        $this->strongweakmain   = new StrongWeakMainModel();    
        $this->procsummain   = new ProcsumMainModel();
    }

    public function index(){
        $user = session()->get('npk');
        $oneyear = $this->ippModel->getOneyear($user);
        $hasRevisi = false;
        
        $data = [
            'tittle' => 'One Year Result Review',
            'oneyear' => $oneyear,
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

        return view('endyear/index', $data);
    }

    // Method detail untuk memperlihatkan isi dari tiap baris
    public function detail($id) {
        $user = session()->get('npk');
        $oneyearData = $this->oneyearisi->getIsi($id);

        $is_submitted = null;
        if (!empty($oneyearData)) {
            $is_submitted = $oneyearData[0]['is_submitted'];
        }

        $mainData = $this->ippModel->find($id);
    
        $data = [
            'tittle'       => 'Detail One Year Result Review',
            'oneyear'      => $oneyearData,
            'mainData'     => $mainData,
            'id_main'      => $id,
            'is_submitted' => $is_submitted,
            'periode'      => $mainData['periode'],
            'main'         => $this->ippModel->find($id),
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
    
        return view('endyear/detail', $data);
    }

    // Simpan Edit Data One Year
    public function save_data(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $id_main = $this->request->getVar('idMain');
            $program = $this->request->getVar('program');
            $weight = $this->request->getVar('weight');
            $oneyear = $this->request->getVar('oneyear');
            $oneyear_achv = $this->request->getVar('oneyear_achv');
            $oneyear_achv_score = $this->request->getVar('oneyear_achv_score');
            $oneyear_achv_total = $this->request->getVar('oneyear_achv_total');
            $sum_total = 0;
            $isValueChanged = false;
    
            $row = $this->oneyearisi->find($id);
    
            if ($row) {
                $oldData = [
                    'oneyear_achv'       => $row['oneyear_achv'],
                    'oneyear_achv_score' => $row['oneyear_achv_score'],
                    'oneyear_achv_total' => $row['oneyear_achv_total']
                ];
            }
    
            if (
                $oldData['oneyear_achv'] != $oneyear_achv ||
                $oldData['oneyear_achv_score'] != $oneyear_achv_score ||
                $oldData['oneyear_achv_total'] != $oneyear_achv_total
            ) {
                $isValueChanged = true;
    
                $this->ippModel->update($row['id_main'], [
                    'approval_kadept_oneyear' => 0,
                    'approval_kadiv_oneyear'  => 0
                ]);
            }
    
            // Update data dalam database berdasarkan id_main
            $this->oneyearisi->set([
                'program' => $program,
                'weight' => $weight,
                'oneyear' => $oneyear,
                'oneyear_achv' => $oneyear_achv,
                'oneyear_achv_score' => $oneyear_achv_score,
                'oneyear_achv_total' => $oneyear_achv_total,
                'is_submitted' => 0
            ])->where(['id' => $id])->update();
    
            $sumTotalQuery = $this->oneyearisi->selectSum('oneyear_achv_total', 'sum_total')->where('id_main', $row['id_main'])->get()->getRow();
            if ($sumTotalQuery) {
                $sum_total = $sumTotalQuery->sum_total;
            }

            $this->oneyearisi->set(['sum_total' => $sum_total])->where(['id_main' => $row['id_main']])->update();

    
            if ($isValueChanged) {
                $logData = [
                    'action' => 'Update',
                    'table_name' => 'oneyear',
                    'record_id' => $id_main,
                    'data_changes' => json_encode([
                        'old_data' => [
                            'One Year Achievement' => $oldData['oneyear_achv'],
                            'Score'                => $oldData['oneyear_achv_score'],
                            'Total'                => $oldData['oneyear_achv_total']
                        ],
                        'new_data' => [
                            'One Year Achievement' => $oneyear_achv,
                            'Score'                => $oneyear_achv_score,
                            'Total'                => $oneyear_achv_total
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

    public function submit(){
        if ($this->request->isAJAX()) {
            $id = $this->request->getVar('id');
            $logData = [];
            $dateSubmitted = date('Y-m-d');
    
            $this->oneyearisi->set(['is_submitted' => 1])->where(['id' => $id])->update();
            $this->isiModel->set(['is_submitted_one' => 1])->where(['id' => $id])->update();
    
            $idMain = $this->request->getVar('idMain');
            $this->ippModel->set([
                'is_submitted_one'  => 1,
                'date_submitted_one'=> $dateSubmitted
            ])->where(['id' => $idMain])->update();
    
            $response = [
                'sukses' => true,
                'message' => 'Data berhasil disimpan.'
            ];
    
            return $this->response->setJSON($response);
        }
    }

    public function oneyearpdf($id){
        $ippDetail = $this->oneyearisi->getIsi($id);
        $approval = $this->ippModel->getIppData($id);

        $dompdf = new Dompdf();
        $imagePath = Paths::$imagePath;
        $imageData = file_get_contents($imagePath);
        $base64Image = base64_encode($imageData);
        // echo $base64Image;

        $html = view('endyear/oneyear_pdf', [
            'oneyear'       => $ippDetail,
            'userNama'      => session()->get('nama'),
            'userNpk'       => session()->get('npk'),
            'approval'      => $approval,
            'date_submitted'=> $approval['date_submitted_one'],
            'base64Image'   => $base64Image,
            'id_main'       => $id,
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('IPP '. session()->get('nama') .'.pdf', ['Attachment' => 0]);
    }

    public function viewPdf($id) {
        // dd($id);
        // Retrieve the binary data from the database based on the $id
        // $fileData = $this->lampau->getIppData($id);
        $fileData = $this->ippModel->getIppData($id);
    
        if ($fileData) {
            // Send appropriate headers
            header('Content-Type: application/pdf');
            header('Content-Disposition: inline; filename="MidYear_'. session()->get("nama") .'.pdf"');
            header('Content-Length: ' . strlen($fileData['file']));
    
            // Output the PDF data
            echo $fileData['file'];
            exit;
        } else {
            // Handle if data is not found
            echo "File PDF tidak ditemukan.";
        }
    }
    
    // Log atau history perubahan
    public function logchanges($id) {
        $logData = $this->logModel->getLogEntriesByTableNameAndRecordId('oneyear', $id);

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
}