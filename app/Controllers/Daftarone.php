<?php

namespace App\Controllers;
use App\Models\IppModel;
use App\Models\LoginModel;
use App\Models\IsiModel;
use App\Models\OneyearModel;
use App\Models\StrongweakMainModel;
use App\Models\ProcsumMainModel;
use App\Models\LogModel;
use Dompdf\Dompdf;
use Config\Paths;

class DaftarOne extends BaseController
{
    public function __construct(){
        $this->ippModel = new IppModel();
        $this->isiModel = new IsiModel();      
        $this->oneyearisi = new OneyearModel();   
        $this->strongweakmain = new StrongweakMainModel();      
        $this->procsummain = new ProcsumMainModel();      
        $this->logModel = new LogModel();      
    }

    public function index(){
        $mainData = $this->ippModel->getIppByDepartmentAndDivision();
        $ehs = $this->ippModel->getDataByDepartment(1);
        $mtc = $this->ippModel->getDataByDepartment(6);
        $mkt = $this->ippModel->getDataByDepartment(7);
        $fincont = $this->ippModel->getDataByDepartment(2);
        $mis = $this->ippModel->getDataByDepartment(8);
        $hr = $this->ippModel->getDataByDepartment(3, 4);
        $procurement = $this->ippModel->getDataByDepartment(11);
        $productsatu = $this->ippModel->getDataByDepartment(13);
        $productdua = $this->ippModel->getDataByDepartment(14);
        $ppic = $this->ippModel->getDataByDepartment(9);
        $spv = $this->ippModel->getDataByDepartment(16);
        $producteng = $this->ippModel->getDataByDepartment(12);
        $processeng = $this->ippModel->getDataByDepartment(10);
        $isd = $this->ippModel->getDataByDepartment(5);
        $qa = $this->ippModel->getDataByDepartment(15);

        $plantserv = $this->ippModel->getDataByDivisionOne(4);
        $fin = $this->ippModel->getDataByDivisionOne(2);
        $adm = $this->ippModel->getDataByDivisionOne(1);
        $plant = $this->ippModel->getDataByDivisionOne(5);
        $eng = $this->ippModel->getDataByDivisionOne(3);
        $content = $this->request->getVar('content');
        // dd($content);
        $contentdept = $this->request->getVar('contentdept');

        $filteredOneData = array_filter($mainData, function ($row) {
            return $row['is_submitted_one'] == 1;
        });

        // By Division
        if(session()->get('npk') == 0){
            if ($content == 'plantserv') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $plantserv,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($content == 'fin') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $fin,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($content == 'adm') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $adm,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
                // dd($data);
            } elseif ($content == 'plant') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $plant, 
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($content == 'eng') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $eng,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($content == 'isd') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $isd,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            }

            // By Department
            if ($contentdept == 'ehs') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $ehs,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'mtc') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $mtc,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'mkt') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $mkt,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'fincont') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $fincont,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'mis') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $mis, 
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'hr') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $hr,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'procurement') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $procurement,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'productsatu') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $productsatu,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'productdua') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $productdua,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'ppic') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $ppic,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'spv') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $spv,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'qa') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $qa,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'producteng') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $producteng,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            } elseif ($contentdept == 'processeng') {
                $data = [
                    'tittle' => 'Daftar One Year Result Karyawan',
                    'daftarone'=> $processeng,
                    'maindata' => $mainData,
                    'content'  => $content,
                    'contentdept' => $contentdept,
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
            }
        
        } else {
            $data = [
                'tittle' => 'Daftar One Year Result Karyawan',
                'daftarone'=> $filteredOneData,
                'maindata' => $mainData,
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
        }

        return view('daftarone/index', $data);
    }

    // Method Detail
    public function detail($id){
        $mainData = $this->ippModel->find($id);

        if ($mainData) {
            $created_by = $mainData['created_by'];
            $nama = $mainData['nama'];
        } else {
            $created_by = null;
            $nama = null;
        }

        $is_approved_before = null;
        $is_approved = null;
        if (session()->get('kode_jabatan') == 3) {
            if($mainData['kode_jabatan'] == 8 && $mainData['created_by'] != [3651, 3659]){
                $is_approved_before = !$mainData['is_approved_kasie_one'];
            }
            $is_approved = $mainData['is_approved_kadept_one'];
        } elseif (session()->get('kode_jabatan') == 2) {
            if($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])){
                $is_approved_before = !$mainData['is_approved_kadept_one'];
            }
            $is_approved = $mainData['is_approved_kadiv_one'];
        } elseif (session()->get('kode_jabatan') == 1) {
            if($mainData['kode_jabatan'] == 3 || ($mainData['kode_jabatan'] == 4 && $mainData['id_department'] == 5)){
                $is_approved_before = !$mainData['is_approved_kadiv_one'];
            }
            $is_approved = $mainData['is_approved_bod_one'];
        } elseif (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
            $is_approved_before = !$mainData['is_approved_bod_one'];
            $is_approved = !$mainData['is_approved_presdir_one'];
        } elseif (session()->get('kode_jabatan') == 4){
            $is_approved = !$mainData['is_approved_kasie_one'];
            $is_approved_before = true;
        }
        
        $data = [
            'tittle'     => 'Daftar One Year Review Karyawan',
            'daftarone'  => $this->oneyearisi->getIsi($id),
            'mainData'  => $mainData,
            'onemain'    => $this->ippModel->getIppByDepartmentAndDivision(),
            'id_main'    => $id,
            'created_by' => $created_by,
            'nama'       => $nama,
            'is_approved'=> $is_approved,
            'is_approved_before'=> $is_approved_before,
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
        // dd($data);

        return view('daftarone/detail', $data);
    }

    // Simpan Edit Data Mid Year
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
            // dd($id_main);
    
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
            }
    
            // Update data dalam database berdasarkan id_main
            $this->oneyearisi->set([
                'program' => $program,
                'weight' => $weight,
                'oneyear' => $oneyear,
                'oneyear_achv' => $oneyear_achv,
                'oneyear_achv_score' => $oneyear_achv_score,
                'oneyear_achv_total' => $oneyear_achv_total
            ])->where(['id' => $id])->update();
    
            $sumTotalQuery = $this->oneyearisi->selectSum('oneyear_achv_total', 'sum_total')->where('id_main', $row['id_main'])->get()->getRow();
            if ($sumTotalQuery) {
                $sum_total = $sumTotalQuery->sum_total;
            }

            $this->oneyearisi->set(['sum_total' => $sum_total])->where(['id_main' => $row['id_main']])->update();
            // dd($isValueChanged);
    
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
            } else{

            }
    
            $msg = [
                'sukses' => true,
                'message' => 'Data Berhasil Disimpan!'
            ];
    
            return $this->response->setJSON($msg);
        }
    }
    
    public function approveKadept($id) {
        if (session()->get('kode_jabatan') != 3) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_kadept_oneyear'    => 1,
            'is_approved_kadept_one'     => 1,
            'approval_date_kadep_oneyear'=> date('Y-m-d'),
            'approved_kadept_by_one'     => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadept approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }
    
    public function approveKadiv($id) {
        if (session()->get('kode_jabatan') != 2) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_kadiv_oneyear'     => 1,
            'is_approved_kadiv_one'      => 1,
            'approval_date_kadiv_oneyear'=> date('Y-m-d'),
            'approved_kadiv_by_one'      => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadept approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }
    
    public function approveKasie($id) {
        if (session()->get('kode_jabatan') != 4) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_kasie_oneyear'     => 1,
            'is_approved_kasie_one'      => 1,
            'approval_date_kasie_oneyear'=> date('Y-m-d'),
            'approved_kasie_by_one'      => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadept approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approvePresdir($id) {
        if (session()->get('kode_jabatan') != 0) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_presdir_oneyear'     => 1,
            'is_approved_presdir_one'      => 1,
            'approval_date_presdir_oneyear'=> date('Y-m-d'),
            'approved_presdir_by_one'      => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Presdir approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approveBod($id) {
        if (session()->get('kode_jabatan') != 1) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_bod_oneyear'     => 1,
            'is_approved_bod_one'      => 1,
            'approval_date_bod_oneyear'=> date('Y-m-d'),
            'approved_bod_by_one'      => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'BoD approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
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
            'date_submitted'=> $approval['date_submitted'],
            'base64Image'   => $base64Image,
            'id_main'       => $id,
        ]);
        
        $dompdf->loadHtml($html);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();
        $dompdf->stream('IPP '. session()->get('nama') .'.pdf', ['Attachment' => 0]);
    }

    public function unsubmit() {
        $id = $this->request->getVar('id');
        $data = $this->ippModel->find($id);
    
        if ($data['is_submitted_one'] == 1) {
            $this->ippModel->set([
                'is_submitted_one'           => 0,
                'approval_bod_oneyear'       => 0,
                'is_approved_bod_oneyear'    => 0,
                'approval_presdir_oneyear'   => 0,
                'is_approved_presdir_oneyear'=> 0,
                'approval_kadiv_oneyear'     => 0,
                'is_approved_kadiv_oneyear'  => 0,
                'approval_kadept_oneyear'    => 0,
                'is_approved_kadept_oneyear' => 0,
                'approval_kasie_oneyear'     => 0,
                'is_approved_kasie_oneyear'  => 0
            ])->where(['id'=> $id])->update();
        }
    
        $msg = [
            'sukses' => true,
            'message' => 'Data has been unsubmitted.'
        ];
    
        return $this->response->setJSON($msg);
    }
}