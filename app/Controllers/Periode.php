<?php

namespace App\Controllers;

use App\Models\PeriodeModel;
use App\Models\ProcsumMainModel;
use App\Models\IppModel;
use App\Models\StrongWeakMainModel;

class Periode extends BaseController
{
    protected $menuControlModel;

    public function __construct(){
        $this->periodeModel = new PeriodeModel();
        $this->procsummain = new ProcsumMainModel();  
        $this->ippModel = new IppModel();  
        $this->strongweakmain   = new StrongWeakMainModel();
    }

    public function index(){
        $data = [
            'tittle' => 'Periode Pengisian IPP dan IDP',
            'periode' => $this->periodeModel->findAll(),
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

        return view('periode/index', $data);
    }

    public function savePeriodeIpp(){
        $name         = $this->request->getVar('name');
        $start_period = $this->request->getVar('start_period');
        $end_period   = $this->request->getVar('end_period');

        $formatted_start_period = (new \DateTime($start_period))->format('Y-m-d H:i:s');
        $formatted_end_period = (new \DateTime($end_period))->format('Y-m-d H:i:s');

        $data = [
            'name'        => $name,
            'start_period'=> $formatted_start_period,
            'end_period'  => $formatted_end_period,
        ];

        // dd($data);

        $this->periodeModel->insert($data);

        $hasil['sukses']    = "Berhasil memasukkan data";
        $hasil['gagal']     = true;
        
        return json_encode($hasil);
    }

    public function updatePeriodeIpp(){
        $id           = $this->request->getVar('id');
        $start_period = $this->request->getVar('start_period');
        $end_period   = $this->request->getVar('end_period');

        $formatted_start_period = (new \DateTime($start_period))->format('Y-m-d H:i:s');
        $formatted_end_period = (new \DateTime($end_period))->format('Y-m-d H:i:s');
    
        // Lakukan pembaruan data berdasarkan $id
        $this->periodeModel->set([
            'start_period' => $formatted_start_period,
            'end_period'   => $formatted_end_period
        ])->where(['id' => $id])->update();

        dd($id, $start_period, $end_period);
    
        $hasil['sukses'] = "Berhasil mengupdate data";
        $hasil['gagal']  = true;
    
        return json_encode($hasil);
    }
}
