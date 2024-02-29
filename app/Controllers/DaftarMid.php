<?php

namespace App\Controllers;
use App\Models\IppModel;
use App\Models\LoginModel;
use App\Models\LogModel;
use App\Models\IsiModel;
use App\Models\MidyearModel;
use App\Models\StrongWeakMainModel;
use App\Models\ProcsumMainModel;
use Dompdf\Dompdf;
use Config\Paths;

class DaftarMid extends BaseController
{
    public function __construct(){
        $this->ippModel = new IppModel();
        $this->isiModel = new IsiModel();      
        $this->logModel = new LogModel();      
        $this->midyearisi = new MidyearModel();      
        $this->strongweakmain = new StrongWeakMainModel();      
        $this->procsummain = new ProcsumMainModel();      
    }

    public function index(){
        $mainData = $this->ippModel->orderBy('created_at', 'DESC')->getIppByDepartmentAndDivision();
        $ehs = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(30);
        $mtc = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(29);
        $mkt = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(23);
        $fincont = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(22);
        $mis = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(24);
        $hr = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(20);
        $procurement = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(21);
        $productsatu = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(31);
        $productdua = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(32);
        $ppic = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(33);
        $spv = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(34);
        $producteng = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(28);
        $processeng = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(26);
        $isd = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(27);
        $qa = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDepartmentMid(25);

        $plantserv = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDivisionMid(4);
        $fin = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDivisionMid(2);
        $adm = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDivisionMid(1);
        $plant = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDivisionMid(5);
        $eng = $this->ippModel->orderBy('created_at', 'DESC')->getDataByDivisionMid(3);
        $content = $this->request->getVar('content');
        $contentdept = $this->request->getVar('contentdept');
        // dd($contentdept);

        $filteredMidData = array_filter($mainData, function ($row) {
            return $row['is_submitted'] == 1;
        });

        // By Division
        if(session()->get('npk') == 0){
            if ($content == 'plantserv') {
                $data = [
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $plantserv,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $fin,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $adm,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $plant, 
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $eng,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $isd,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $ehs,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $mtc,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $mkt,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $fincont,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $mis, 
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $hr,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $procurement,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $productsatu,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $productdua,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $ppic,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $spv,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $qa,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $producteng,
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
                    'tittle' => 'Daftar Mid Year Result Karyawan',
                    'daftarmid'=> $processeng,
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
                'tittle' => 'Daftar Mid Year Result Karyawan',
                'daftarmid'=> $filteredMidData,
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

        return view('daftarmid/index', $data);
    }

    // Method Detail
    public function detail($id){
        $mainData = $this->ippModel->find($id);

        if ($mainData) {
            $npk = $mainData['created_by'];
            $nama = $mainData['nama'];
        } else {
            $npk = null;
            $nama = null;
        }

        $is_approved_before = false;
        $is_approved = false;
        
        if (session()->get('kode_jabatan') == 3) {
            if($mainData['kode_jabatan'] == 8){
                $is_approved_before = $mainData['approval_kasie_midyear'];
            }
            $is_approved = empty($mainData['approval_kadept_midyear']);
        } elseif (session()->get('kode_jabatan') == 2) {
            if($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])){
                $is_approved_before = $mainData['approval_kadept_midyear'];
            }
            $is_approved = empty($mainData['approval_kadiv_midyear']);
        } elseif (session()->get('kode_jabatan') == 1) {
            if(($mainData['kode_jabatan'] == 3 && $mainData['id_department'] != 27) || ($mainData['kode_jabatan'] == 4 && $mainData['id_department'] == 27)){
                $is_approved_before = $mainData['approval_kadiv_midyear'];
            } elseif ($mainData['kode_jabatan'] == 3 && $mainData['id_department'] == 27){
                $is_approved_before = true;
            }
            $is_approved = empty($mainData['approval_bod_midyear']);
        } elseif (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
            $is_approved_before = $mainData['approval_bod_midyear'];
            $is_approved = empty($mainData['approval_presdir_midyear']);
        } elseif (session()->get('kode_jabatan') == 4){
            $is_approved = empty($mainData['approval_kasie_midyear']);
            $is_approved_before = true;
        }
        
        $data = [
            'tittle'      => 'Detail Mid Year Review Karyawan',
            'daftarmid'   => $this->midyearisi->getIsi($id),
            'midmain'     => $this->ippModel->find($id),
            'id_main'     => $id,
            'npk'         => $npk,
            'nama'        => $nama,
            'is_approved' => $is_approved,
            'is_approved_before' => $is_approved_before,
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

        return view('daftarmid/detail', $data);
    }

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
    
            $isiModel = new IsiModel();
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
            }
    
            // Use the correct format for the where clause
            $this->midyearisi->set([
                'program' => $program,
                'weight' => $weight,
                'midyear' => $midyear,
                'midyear_achv' => $midyear_achv,
                'midyear_achv_score' => $midyear_achv_score,
                'midyear_achv_total' => $midyear_achv_total,
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

    public function approveKadept($id) {
        // dd($id);
        if (session()->get('kode_jabatan') != 3) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_kadept_midyear'      => 1,
            'approval_kadept_midyear'       => 1,
            'approval_date_kadept_midyear' => date('Y-m-d'),
            'approved_kadept_by_mid' => session()->get('nama')
        ]);

        $daftarmid = $this->ippModel->find($id);
        $getmid = $this->midyearisi->getIsi($id);
        if ($daftarmid['kode_jabatan'] == 8 && $daftarmid['created_by'] != [3651, 3659]){
            foreach($getmid as $g){
                $datamid = $this->midyearisi->update($id, [
                    'midyear_achv'      => $g['midyear_achv'],
                    'midyear_achv_score'=> $g['midyear_achv_score'],
                    'midyear_achv_total'=> $g['midyear_achv_total']
                ]);
            }
        }
    
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
            'approval_kadiv_midyear'      => 1,
            'approval_kadiv_midyear'       => 1,
            'approval_date_kadiv_midyear' => date('Y-m-d'),
            'approved_kadiv_by_mid'       => session()->get('nama')
        ]);

        $daftarmid = $this->ippModel->find($id);
        $getmid = $this->midyearisi->getIsi($id);
        if ($daftarmid['kode_jabatan'] == 4 || ($daftarmid['kode_jabatan'] == 8 && $daftarmid['created_by'] == [3651, 3659])){
            foreach($getmid as $g){
                $datamid = $this->midyearisi->update($id, [
                    'midyear_achv'      => $g['midyear_achv'],
                    'midyear_achv_score'=> $g['midyear_achv_score'],
                    'midyear_achv_total'=> $g['midyear_achv_total']
                ]);
            }
        }
    
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
            'approval_kasie_midyear'     => 1,
            'approval_kasie_midyear'      => 1,
            'approval_date_kasie_midyear'=> date('Y-m-d'),
            'approved_kasie_by_mid'      => session()->get('nama')
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
            'approval_presdir_midyear'     => 1,
            'approval_presdir_midyear'      => 1,
            'approval_date_presdir_midyear'=> date('Y-m-d'),
            'approved_presdir_by_mid'      => session()->get('nama')
        ]);

        $daftarmid = $this->ippModel->find($id);
        $getmid = $this->midyearisi->getIsi($id);
        if ($daftarmid['kode_jabatan'] == 2){
            foreach($getmid as $g){
                $datamid = $this->midyearisi->update($id, [
                    'midyear_achv'      => $g['midyear_achv'],
                    'midyear_achv_score'=> $g['midyear_achv_score'],
                    'midyear_achv_total'=> $g['midyear_achv_total']
                ]);
            }
        }
    
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
            'approval_bod_midyear'     => 1,
            'approval_bod_midyear'      => 1,
            'approval_date_bod_midyear'=> date('Y-m-d'),
            'approved_bod_by_mid'      => session()->get('nama')
        ]);

        $daftarmid = $this->ippModel->find($id);
        $getmid = $this->midyearisi->getIsi($id);
        if ($daftarmid['kode_jabatan'] == 3){
            foreach($getmid as $g){
                $datamid = $this->midyearisi->update($id, [
                    'midyear_achv'      => $g['midyear_achv'],
                    'midyear_achv_score'=> $g['midyear_achv_score'],
                    'midyear_achv_total'=> $g['midyear_achv_total']
                ]);
            }
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'BoD approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
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
        $dompdf->stream('IPP '. session()->get('nama') .'.pdf', ['Attachment' => 0]);
    }

    public function unsubmit() {
        $id = $this->request->getVar('id');
        $data = $this->ippModel->find($id);
    
        if ($data['is_submitted'] == 1) {
            $this->ippModel->set([
                'is_submitted'                  => 0,
                'approval_bod_midyear'          => NULL,
                'approval_bod_midyear'          => NULL,
                'approval_presdir_midyear'      => NULL,
                'approval_presdir_midyearyear'  => NULL,
                'approval_kadiv_midyear'        => NULL,
                'approval_kadiv_midyear'        => NULL,
                'approval_kadept_midyear'       => NULL,
                'approval_kadept_midyear'       => NULL,
                'approval_kasie_midyear'        => NULL,
                'approval_kasie_midyearyear'    => NULL
            ])->where(['id'=> $id])->update();
        }
    
        $msg = [
            'sukses' => true,
            'message' => 'Data has been unsubmitted.'
        ];
    
        return $this->response->setJSON($msg);
    }  
}