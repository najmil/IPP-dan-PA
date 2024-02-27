<?php

namespace App\Controllers;
use App\Models\IppModel;
use App\Models\LoginModel;
use App\Models\IsiModel;
use App\Models\MidyearModel;
use App\Models\OneyearModel;
use App\Models\ProcsumMainModel;
use App\Models\StrongWeakMainModel;
use App\Models\LogModel;
use App\Models\PeriodeModel;
use Dompdf\Dompdf;
use Config\Paths;

class DaftarIpp extends BaseController
{
    public function __construct(){
        $this->ippModel  = new IppModel();
        $this->isiModel  = new IsiModel();      
        $this->midyearisi= new MidyearModel();  
        $this->oneyearisi= new OneyearModel();  
        $this->logModel  = new LogModel();  
        $this->strongweakmain= new StrongWeakMainModel();  
        $this->procsummain= new ProcsumMainModel();  
        $this->periodeModel = new PeriodeModel();     
    }

    public function index() {
        $ippData = $this->ippModel->orderBy('created_at', 'DESC')->getIppByDepartmentAndDivision();
        $ehs = $this->ippModel->getDataByDepartment(30);
        $mtc = $this->ippModel->getDataByDepartment(29);
        $mkt = $this->ippModel->getDataByDepartment(23);
        $fincont = $this->ippModel->getDataByDepartment(22);
        $mis = $this->ippModel->getDataByDepartment(24);
        $hr = $this->ippModel->getDataByDepartment(20);
        $procurement = $this->ippModel->getDataByDepartment(21);
        $productsatu = $this->ippModel->getDataByDepartment(31);
        $productdua = $this->ippModel->getDataByDepartment(32);
        $ppic = $this->ippModel->getDataByDepartment(33);
        $spv = $this->ippModel->getDataByDepartment(34);
        $producteng = $this->ippModel->getDataByDepartment(28);
        $processeng = $this->ippModel->getDataByDepartment(26);
        $isd = $this->ippModel->getDataByDepartment(27);
        // dd($isd);
        $qa = $this->ippModel->getDataByDepartment(25);

        $plantserv = $this->ippModel->getDataByDivision(4);
        $fin = $this->ippModel->getDataByDivision(2);
        $adm = $this->ippModel->getDataByDivision(1);
        $plant = $this->ippModel->getDataByDivision(5);
        $eng = $this->ippModel->getDataByDivision(3);

        $mainData = $this->ippModel->findAll();
        $periodeIPP = $this->periodeModel->getLatestIPPeriode();
        $periodeIPPMid = $this->periodeModel->getLatestMidPeriode();
        $periodeIPPOne = $this->periodeModel->getLatestOnePeriode();
        $ippPeriode = false;
        $editIppMid = false;
        $editIppOne = false;
        $currentDate = date('Y-m-d H:i:s');
        $filteredIppData = null;
        $content = $this->request->getVar('content');
        $contentdept = $this->request->getVar('contentdept');
        // dd($content);
        
        $filteredIppData = array_filter($ippData, function ($row) {
            return $row['is_submitted_ipp'] == 1 || $row['is_submitted_ipp_mid'] == 1 || $row['is_submitted_ipp_one'] == 1;
        });
        
        // By Division
        if(session()->get('npk') == 0){
            if ($content == 'plantserv') {
                $data = [
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $plantserv,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $fin,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $adm,
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
            } elseif ($content == 'plant') {
                $data = [
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $plant, 
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $eng,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $isd,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $ehs,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $mtc,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $mkt,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $fincont,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $mis, 
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $hr,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $procurement,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $productsatu,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $productdua,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $ppic,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $spv,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $qa,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $producteng,
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
                    'tittle' => 'Daftar IPP Karyawan',
                    'daftaripp'=> $processeng,
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
                'tittle' => 'Daftar IPP Karyawan',
                'daftaripp'=> $filteredIppData,
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

        return view('daftaripp/index', $data);
    }

    public function detail($id){
        $mainData = $this->ippModel->find($id);
        $periode  = $mainData['periode'];
        // dd($periode);
    
        if ($mainData) {
            $created_by = $mainData['created_by'];
            $nama = $mainData['nama'];
        } else {
            $created_by = null;
            $nama = null;
        }

        $is_approved_before = false;
        $is_approved = false;
        if (session()->get('kode_jabatan') == 3) {
            if ($mainData['kode_jabatan'] == 8 || ($mainData['kode_jabatan'] == 4&& $mainData['id_department'] != 27)){
                $is_approved_before = $mainData['approval_kasie'];
            } elseif ($mainData['kode_jabatan'] == 4 && $mainData['id_department'] == 27) {
                $is_approved_before = true;
            }
            // dd($mainData['id_department']);
            $is_approved = empty($mainData['approval_kadept']);
        } elseif (session()->get('kode_jabatan') == 2) {
            if(($mainData['kode_jabatan'] == 4 && $mainData['id_department'] != 27) || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])){
                $is_approved_before = $mainData['approval_kadept'];
            }
            $is_approved = empty($mainData['approval_kadiv']);
        } elseif (session()->get('kode_jabatan') == 1) {
            if(($mainData['kode_jabatan'] == 3 && $mainData['id_department'] != 27) || ($mainData['kode_jabatan'] == 4 && $mainData['id_department'] == 27)){
                $is_approved_before = $mainData['approval_kadiv'];
            } elseif ($mainData['kode_jabatan'] == 3 && $mainData['id_department'] == 27){
                $is_approved_before = true;
            }
            $is_approved = empty($mainData['approval_bod']);
        } elseif (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
            $is_approved_before = $mainData['approval_bod'];
            $is_approved = empty($mainData['approval_presdir']);
        } elseif (session()->get('kode_jabatan') == 4){
            $is_approved = empty($mainData['approval_kasie']);
            $is_approved_before = true;
        }
        // dd($is_approved_before);
    
        $data = [
            'tittle'     => 'Detail IPP Karyawan',
            'daftaripp'  => $this->isiModel->getIsi($id),
            'ippmain'    => $this->ippModel->getIppByDepartmentAndDivision(),
            'id_main'    => $id,
            'created_by' => $created_by,
            'nama'       => $nama,
            'is_approved'=> $is_approved,
            'mainData'   => $mainData,
            'is_approved_before'=> $is_approved_before,
            'periode'    => $periode,
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
    
        return view('daftaripp/detail', $data);
    }

    public function save_data(){
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
                    'weight' => $row['weight'],
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
                        'record_id' => $id_main,
                        'data_changes' => json_encode([
                            'old_data' => $oldData,
                            'new_data' => [
                                'program' => $program,
                                'weight' => $weight,
                                'midyear' => $midyear,
                                'oneyear' => $oneyear,
                                'duedate' => $duedate
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
                            'old_data' => null,
                            'new_data' => [
                                'program' => $data['program'],
                                'weight' => $data['weight'],
                                'midyear' => $data['midyear'],
                                'oneyear' => $data['oneyear'],
                                'duedate' => $data['duedate']
                            ]]),
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
                    'action' => 'delete',
                    'table_name' => 'isi_ipp',
                    'record_id' => $id_main,
                    'data_changes' => json_encode(['deleted_data' => $deletedRow]),
                    'by' => session()->get('nama')
                ];
    
                $this->logModel->insert($logData);
            } else {
                $msg = [
                    'sukses' => false,
                    'message' => 'Data not found or could not be deleted.'
                ];
            }
            return $this->response->setJSON($msg);
        }
    }    

    public function approveKadept($id) {
        if (session()->get('kode_jabatan') != 3) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_kadept'     => 1,
            'is_approved_kadept'  => 1,
            'approval_date_kadept'=> date('Y-m-d'),
            'approved_kadept_by'  => session()->get('nama')
        ]);

        $daftaripp = $this->ippModel->find($id);

        $getipp = $this->isiModel->getIsi($id);
        foreach($getipp as $g){
            $dataipp = [
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'midyear'     => $g['midyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            $dataippone = [
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'oneyear'     => $g['oneyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            if ($daftaripp['kode_jabatan'] == 8){
                $this->midyearisi->insert($dataipp);
                $this->oneyearisi->insert($dataippone);
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
            'approval_kadiv'     => 1,
            'is_approved_kadiv'  => 1,
            'approval_date_kadiv'=> date('Y-m-d'),
            'approved_kadiv_by'  => session()->get('nama')
        ]);

        $daftaripp = $this->ippModel->find($id);

        $getipp = $this->isiModel->getIsi($id);
        foreach($getipp as $g){
            $dataipp =[
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'midyear'     => $g['midyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            $dataippone = [
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'oneyear'     => $g['oneyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            if ($daftaripp['kode_jabatan'] == 4){
                $this->midyearisi->insert($dataipp);
                $this->oneyearisi->insert($dataippone);
            }
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadiv approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }
    
    public function approveKasie($id) {
        if (session()->get('kode_jabatan') != 4) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_kasie'     => 1,
            'is_approved_kasie'  => 1,
            'approval_date_kasie'=> date('Y-m-d'),
            'approved_kasie_by'  => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kasie approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approvePresdir($id) {
        if (session()->get('kode_jabatan') != 0) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->ippModel->update($id, [
            'approval_presdir'     => 1,
            'is_approved_presdir'  => 1,
            'approval_date_presdir'=> date('Y-m-d'),
            'approved_presdir_by'  => session()->get('nama')
        ]);

        $daftaripp = $this->ippModel->find($id);

        $getipp = $this->isiModel->getIsi($id);
        foreach($getipp as $g){
            $dataipp =[
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'midyear'     => $g['midyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            $dataippone = [
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'oneyear'     => $g['oneyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            if ($daftaripp['kode_jabatan'] == 2){
                $this->midyearisi->insert($dataipp);
                $this->oneyearisi->insert($dataippone);
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
            'approval_bod'     => 1,
            'is_approved_bod'  => 1,
            'approval_date_bod'=> date('Y-m-d'),
            'approved_bod_by'  => session()->get('nama')
        ]);
        $daftaripp = $this->ippModel->find($id);

        $getipp = $this->isiModel->getIsi($id);
        foreach($getipp as $g){
            $dataipp =[
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'midyear'     => $g['midyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            $dataippone = [
                'id_main'     => $g['id_main'],
                'program'     => $g['program'],
                'weight'      => $g['weight'],
                'oneyear'     => $g['oneyear'],
                'duedate'     => $g['duedate'],
                'is_submitted'=> 0
            ];
            if ($daftaripp['kode_jabatan'] == 3){
                $this->midyearisi->insert($dataipp);
                $this->oneyearisi->insert($dataippone);
            }
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'BoD approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

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
            'userNama'      => $nama,
            'userNpk'       => $npk,
            'kode_jabatan'  => $mainData['kode_jabatan'],
            'approval'      => $approval,
            'date_submitted'=> $date_submitted,
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
    
        if ($data['is_submitted_ipp'] == 1) {
            $this->ippModel->set([
                'is_submitted_ipp'      => 0,
                'approval_bod'          => NULL,
                'is_approved_bod'       => NULL,
                'approval_presdir'      => NULL,
                'is_approved_presdir'   => NULL,
                'approval_kadiv'        => NULL,
                'is_approved_kadiv'     => NULL,
                'approval_kadept'       => NULL,
                'is_approved_kadept'    => NULL,
                'approval_kasie'        => NULL,
                'is_approved_kasie'     => NULL,
                'is_submitted_ipp'      => NULL
            ])->where(['id'=> $id])->update();
        }
        if ($data['is_submitted_ipp_mid'] == 1) {
            $this->ippModel->set([
                'is_submitted_ipp_mid'  => 0,
                'approval_bod'          => NULL,
                'is_approved_bod'       => NULL,
                'approval_presdir'      => NULL,
                'is_approved_presdir'   => NULL,
                'approval_kadiv'        => NULL,
                'is_approved_kadiv'     => NULL,
                'approval_kadept'       => NULL,
                'is_approved_kadept'    => NULL,
                'approval_kasie'        => NULL,
                'is_approved_kasie'     => NULL,
                'is_submitted_ipp'      => NULL
            ])->where(['id'=> $id])->update();
        }
        if ($data['is_submitted_ipp_one'] == 1) {
            $this->ippModel->set([
                'is_submitted_ipp_one'  => 0,
                'approval_bod'          => NULL,
                'is_approved_bod'       => NULL,
                'approval_presdir'      => NULL,
                'is_approved_presdir'   => NULL,
                'approval_kadiv'        => NULL,
                'is_approved_kadiv'     => NULL,
                'approval_kadept'       => NULL,
                'is_approved_kadept'    => NULL,
                'approval_kasie'        => NULL,
                'is_approved_kasie'     => NULL,
                'is_submitted_ipp'      => NULL
            ])->where(['id'=> $id])->update();
        }
    
        $msg = [
            'sukses' => true,
            'message' => 'Data has been unsubmitted.'
        ];
    
        return $this->response->setJSON($msg);
    }    
}