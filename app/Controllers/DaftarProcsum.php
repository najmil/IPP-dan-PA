<?php

namespace App\Controllers;
use App\Models\ProcsumModel;
use App\Models\ProcsumMainModel;
use App\Models\StrongweakMainModel;
use App\Models\IsiModel;
use App\Models\IppModel;
use App\Models\MidyearModel;
use App\Models\LogModel;
use Dompdf\Dompdf;
use Config\Paths;

class DaftarProcsum extends BaseController
{
    public function __construct(){
        $this->procsummodel= new ProcsumModel();
        $this->procsummain = new ProcsumMainModel();    
        $this->strongweakmain = new StrongweakMainModel();    
        $this->ippModel    = new IppModel();  
        $this->isiModel    = new IsiModel(); 
        $this->midyearisi  = new MidyearModel();  
        $this->logModel    = new LogModel(); 
    }

    public function index(){
        $mainData = $this->procsummain->getProcsumByDepartmentAndDivision();
        $ehs = $this->procsummain->getDataByDepartment(1);
        $mtc = $this->procsummain->getDataByDepartment(6);
        $mkt = $this->procsummain->getDataByDepartment(7);
        $fincont = $this->procsummain->getDataByDepartment(2);
        $mis = $this->procsummain->getDataByDepartment(8);
        $hr = $this->procsummain->getDataByDepartment(3, 4);
        $procurement = $this->procsummain->getDataByDepartment(11);
        $productsatu = $this->procsummain->getDataByDepartment(13);
        $productdua = $this->procsummain->getDataByDepartment(14);
        $ppic = $this->procsummain->getDataByDepartment(9);
        $spv = $this->procsummain->getDataByDepartment(16);
        $producteng = $this->procsummain->getDataByDepartment(12);
        $processeng = $this->procsummain->getDataByDepartment(10);
        $isd = $this->procsummain->getDataByDepartment(5);
        $qa = $this->procsummain->getDataByDepartment(15);

        $plantserv = $this->procsummain->getDataByDivision(4);
        $fin = $this->procsummain->getDataByDivision(2);
        $adm = $this->procsummain->getDataByDivision(1);
        $plant = $this->procsummain->getDataByDivision(5);
        $eng = $this->procsummain->getDataByDivision(3);
        $content = $this->request->getVar('content');
        // dd($content);
        $contentdept = $this->request->getVar('contentdept');

        $filteredProcsumData = array_filter($mainData, function ($row) {
            return $row['is_submitted_midyear'] == 1;
        });
        // dd($filteredProcsumData);

        
        if(session()->get('npk') == 0){
            if ($content == 'plantserv') {
                $data = [
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $plantserv,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $fin,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $adm,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $plant, 
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $eng,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $isd,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $ehs,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $mtc,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $mkt,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $fincont,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $mis, 
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $hr,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $procurement,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $productsatu,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $productdua,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $ppic,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $spv,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $qa,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $producteng,
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
                    'tittle' => 'Daftar Process And Summary Karyawan',
                    'daftarprocsum'=> $processeng,
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
                'tittle' => 'Daftar Process And Summary Karyawan',
                'daftarprocsum'=> $mainData,
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
                'countPendingPlantSSw' => $this->procsummain->getPendingPlantSProc(),
                'countPendingAdmSw' => $this->procsummain->getPendingAdmProc(),
                'countPendingFinSw' => $this->procsummain->getPendingFinProc(),
                'countPendingPlantSw' => $this->procsummain->getPendingPlantProc(),
                'countPendingEngSw' => $this->procsummain->getPendingEngProc(),
                'countPendingIsdSw' => $this->procsummain->getPendingIsdProc(),
            ];
        }

        // $data = [
        //     'tittle' => 'Data Process Summary Karyawan',
        //     'daftarprocsum' => $procData
        // ];

        return view('daftarprocsum/index', $data);
    }

    public function detail($id) {
        $procData = $this->procsummain->getProcsumByDepartmentAndDivision();
        $mainData = $this->procsummain->find($id);
        $npk_user = $mainData['created_by'];
        $savedData = $this->procsummodel->getSavedData($id);
        $procsumDetail = $this->procsummodel->getIsi($id);
        $validation = \Config\Services::validation();
        $user = session()->get('npk');
        $kode_jabatan = $mainData['kode_jabatan'];
        // dd($kode_jabatan);
        $sum_midyear_total = $this->midyearisi->callTotalScore($id);
        $sum_oneyear_total = $this->midyearisi->callTotalScoreOne($id);
        $periode = $mainData['periode'];
        $dataproc         = $this->procsummodel->getIsi($id);

        // if (strpos($periode, 'One Year') !== false) {
        //     return redirect()->to(base_url("daftarprocsum/detail_one/{$id}"));
        // }

        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        $isWithinMidPeriode = null;
        $isWithinOnePeriode = null;
        // dd($periodeMid);

        $currentDate = date('Y-m-d H:i:s');
        if ($periodeMid !== null) {
            $isWithinMidPeriode = ($currentDate >= $periodeMid['start_period'] && $currentDate <= $periodeMid['end_period']);
            // dd($isWithinMidPeriode);
        } elseif ($periodeOne !== null) {
            $isWithinOnePeriode = ($currentDate >= $periodeOne['start_period'] && $currentDate <= $periodeOne['end_period']);
        } else {
            $isWithinMidPeriode = false;
            $isWithinOnePeriode = false;
        }

        $is_approved_before = null;
        $is_approved = null;
        if($isWithinMidPeriode){
            if (session()->get('kode_jabatan') == 3) {
                if($mainData['kode_jabatan'] == 8 && $mainData['created_by'] != [3651, 3659]){
                    $is_approved_before = !$mainData['is_approved_kasie'];
                }
                $is_approved = $mainData['is_approved_kadept'];
            } elseif (session()->get('kode_jabatan') == 2) {
                if($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])){
                    $is_approved_before = !$mainData['is_approved_kadept'];
                }
                $is_approved = $mainData['is_approved_kadiv'];
            } elseif (session()->get('kode_jabatan') == 1) {
                if($mainData['kode_jabatan'] == 3){
                    $is_approved_before = !$mainData['is_approved_kadiv'];
                }
                $is_approved = $mainData['is_approved_bod'];
                // dd($is_approved);
            } elseif (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                $is_approved_before = !$mainData['is_approved_bod'];
                $is_approved = !$mainData['is_approved_presdir'];
            } elseif (session()->get('kode_jabatan') == 4){
                $is_approved = !$mainData['is_approved_kasie'];
                $is_approved_before = true;
            }
        } elseif($isWithinOnePeriode){
            if (session()->get('kode_jabatan') == 3) {
                if($mainData['kode_jabatan'] == 8 && $mainData['created_by'] != [3651, 3659]){
                    $is_approved_before = !$mainData['is_approved_kasie_oneyear'];
                }
                $is_approved = $mainData['is_approved_kadept_oneyear'];
            } elseif (session()->get('kode_jabatan') == 2) {
                if($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])){
                    $is_approved_before = !$mainData['is_approved_kadept_oneyear'];
                }
                $is_approved = $mainData['is_approved_kadiv_oneyear'];
            } elseif (session()->get('kode_jabatan') == 1) {
                if($mainData['kode_jabatan'] == 3){
                    $is_approved_before = !$mainData['is_approved_kadiv_oneyear'];
                }
                $is_approved = $mainData['is_approved_bod_oneyear'];
                // dd($is_approved);
            } elseif (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                $is_approved_before = !$mainData['is_approved_bod_oneyear'];
                $is_approved = !$mainData['is_approved_presdir_oneyear'];
            } elseif (session()->get('kode_jabatan') == 4){
                $is_approved = !$mainData['is_approved_kasie_oneyear'];
                $is_approved_before = true;
            }
        }
        // dd($is_approved);
    
        $data = [
            'tittle'           => 'Detail Process Summary Karyawan (Mid Year)',
            'procsum'          => $savedData, 
            'id_procsum_main'  => $id,
            'npk_user'         => $npk_user,
            'validation'       => $validation,
            'periode'          => $periode,
            'sum_midyear_total'=> $sum_midyear_total,
            'sum_oneyear_total'=> $sum_oneyear_total,
            'kode_jabatan'     => $kode_jabatan,
            'is_approved'      => $is_approved,
            'is_approved_before'=> $is_approved_before,
            'is_submitted'     => $procsumDetail[0]['is_submitted_midyear'],
            'is_submitted_oneyear' => $procsumDetail[0]['is_submitted_oneyear'],
            'daftarprocsum'    => $mainData,
            'is_saved_oneyear' => isset($dataproc[0]['is_saved_oneyear']) ? $dataproc[0]['is_saved_oneyear'] : null,
            'data'             => $dataproc,

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

            'countPendingPMid' => $this->procsummain->getDataPendingMid(),
            'countPendingPlantSProc' => $this->procsummain->getPendingPlantSProc(),
            'countPendingAdmProc' => $this->procsummain->getPendingAdmProc(),
            'countPendingFinProc' => $this->procsummain->getPendingFinProc(),
            'countPendingPlantProc' => $this->procsummain->getPendingPlantProc(),
            'countPendingEngProc' => $this->procsummain->getPendingEngProc(),
            'countPendingIsdProc' => $this->procsummain->getPendingIsdProc()
        ];
        // dd($data);

        return view('daftarprocsum/detail', $data); 
    }

    public function approveKadept($id) {
        if (session()->get('kode_jabatan') != 3) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_kadept_midyear'     => 1,
            'is_approved_kadept'          => 1,
            'approval_date_kadept_midyear'=> date('Y-m-d'),
            'approved_kadept_by'          => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadept approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approveKadeptOne($id) {
        if (session()->get('kode_jabatan') != 3) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_kadept_oneyear'     => 1,
            'is_approved_kadept_oneyear'  => 1,
            'approval_date_kadept_oneyear'=> date('Y-m-d'),
            'kadept_by_oneyear'           => session()->get('nama')
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
    
        $result = $this->procsummain->update($id, [
            'approval_kadiv_midyear'     => 1,
            'is_approved_kadiv'          => 1,
            'approval_date_kadiv_midyear'=> date('Y-m-d'),
            'approved_kadiv_by'          => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadiv approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approveKadivOne($id) {
        if (session()->get('kode_jabatan') != 2) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_kadiv_oneyear'     => 1,
            'is_approved_kadiv_oneyear'  => 1,
            'approval_date_kadiv_oneyear'=> date('Y-m-d'),
            'kadiv_by_oneyear'          => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadiv approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadiv.');
        }
    }
    
    public function approveKasie($id) {
        if (session()->get('kode_jabatan') != 4) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_kasie_midyear'     => 1,
            'is_approved_kasie'          => 1,
            'approval_date_kasie_midyear'=> date('Y-m-d'),
            'approved_kasie_by'          => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kasie approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approveKasieOne($id) {
        if (session()->get('kode_jabatan') != 4) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_kasie_oneyear'     => 1,
            'is_approved_kasie_oneyear'  => 1,
            'approval_date_kasie_oneyear'=> date('Y-m-d'),
            'kasie_by_oneyear'          => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Kasie approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kasie.');
        }
    }

    public function approvePresdir($id) {
        if (session()->get('kode_jabatan') != 0) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_presdir_midyear'     => 1,
            'is_approved_presdir'          => 1,
            'approval_date_presdir_midyear'=> date('Y-m-d'),
            'approved_presdir_by'          => session()->get('name')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Presdir approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approvePresdirOne($id) {
        if (session()->get('kode_jabatan') != 0) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_presdir_oneyear'     => 1,
            'is_approved_presdir_oneyear'  => 1,
            'approval_date_presdir_oneyear'=> date('Y-m-d'),
            'presdir_by_oneyear'          => session()->get('name')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'Presdir approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Presdir.');
        }
    }

    public function approveBod($id) {
        if (session()->get('kode_jabatan') != 1) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_bod_midyear'     => 1,
            'is_approved_bod'          => 1,
            'approval_date_bod_midyear'=> date('Y-m-d'),
            'approved_bod_by'          => session()->get('name')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'BoD approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve BoD.');
        }
    }

    public function approveBodOne($id) {
        if (session()->get('kode_jabatan') != 1) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        $result = $this->procsummain->update($id, [
            'approval_bod_oneyear'     => 1,
            'is_approved_bod_oneyear'  => 1,
            'approval_date_bod_oneyear'=> date('Y-m-d'),
            'bod_by_oneyear'          => session()->get('nama')
        ]);
    
        if ($result) {
            return redirect()->back()->with('success', 'BoD approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve BoD.');
        }
    }

    public function save_edit(){
        $id = $this->request->getVar('id');
        $id_procsum_main = $this->request->getVar('id_procsum_main');
        $plan_mid = $this->request->getVar('plan_mid');
        $do_mid = $this->request->getVar('do_mid');
        // dd($id);
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
                    'midyear_value' => $midyear_value
                ])->where(['id_procsum_main' => $id_procsum_main])->update();
                // dd($id);

                if($isValueChanged){
                    $logData = [
                        'action' => 'Update (Mid Year)',
                        'table_name' => 'procsum (mid year)',
                        'record_id' => $id_procsum_main,
                        'data_changes' => json_encode([
                            'old_data' => [
                                'Plan'                      => $oldData['plan_mid'],
                                'Do'                        => $oldData['do_mid'],
                                'Check'                     => $oldData['check_mid'],
                                'Action'                    => $oldData['act_mid'],
                                'Teamwork'                  => $oldData['teamwork_mid'],
                                'Customer Focus'            => $oldData['cust_mid'],
                                'Passion For Excellence'    => $oldData['passion_mid'],
                                'Getting Commitment on IPP' => $oldData['gc_mid'],
                                'Delegating'                => $oldData['delegating_mid'],
                                'Couching and Counseling'   => $oldData['couch_mid'],
                                'Developing Subordinate'    => $oldData['develop_mid'],
                                'Result'                    => $oldData['result_mid'],
                                'PDCA and Values'           => $oldData['pdca_mid'],
                                'People Management'         => $oldData['pm_mid'],
                                'Mid Year Value'            => $oldData['midyear_value']
                            ],
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
                    'oneyear_value' => $oneyear_value
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
                                'Plan'                      => $plan_one,
                                'Do'                        => $do_one,
                                'Check'                     => $check_one,
                                'Action'                    => $act_one,
                                'Teamwork'                  => $teamwork_one,
                                'Customer Focus'            => $cust_one,
                                'Passion For Excellence'    => $passion_one,
                                'Getting Commitment on IPP' => $gc_one,
                                'Delegating'                => $delegating_one,
                                'Couching and Counseling'   => $couch_one,
                                'Developing Subordinate'    => $develop_one,
                                'Result'                    => $result_one,
                                'PDCA and Values'           => $pdca_one,
                                'People Management'         => $pm_one,
                                'One Year Value'            => $oneyear_value
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

    public function generatePdf($id){
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

        
        // if (!empty($approval['date_submitted_ipp'])) {
        //     $date_submitted = $approval['date_submitted_ipp'];
        // } elseif (!empty($approval['date_submitted_ipp_mid'])) {
        //     $date_submitted = $approval['date_submitted_ipp_mid'];
        // } elseif (!empty($approval['date_submitted_ipp_one'])) {
        //     $date_submitted = $approval['date_submitted_ipp_one'];
        // } else {
        //     $date_submitted = 'Date not available';
        // }

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

    public function unsubmit() {
        $id = $this->request->getVar('id');
        $data = $this->procsummain->find($id);
    
        $this->procsummain->set([
            'is_submitted_midyear'       => 0,
            'approval_bod_midyear'       => 0,
            'is_approved_bod'            => 0,
            'approval_presdir_midyear'   => 0,
            'is_approved_presdi r'       => 0,
            'approval_kadiv_midyear'     => 0,
            'is_approved_kadiv'          => 0,
            'approval_kadept_midyear'    => 0,
            'is_approved_kadept '        => 0,
            'approval_kasie_midyear'     => 0,
            'is_approved_kasie'          => 0
        ])->where(['id'=> $id])->update();

        $this->procsummodel->set([
            'is_submitted_midyear'  => 0,
        ])->where(['id_procsum_main'=> $id])->update();
    
        $msg = [
            'sukses' => true,
            'message' => 'Data has been unsubmitted.'
        ];
    
        return $this->response->setJSON($msg);
    } 

    public function unsubmit_one() {
        $id = $this->request->getVar('id');
        $data = $this->procsummain->find($id);
    
        $this->procsummain->set([
            'is_submitted_oneyear'       => 0,
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

        $this->procsummodel->set([
            'is_submitted_oneyear'  => 0,
        ])->where(['id_procsum_main'=> $id])->update();
    
        $msg = [
            'sukses' => true,
            'message' => 'Data has been unsubmitted.'
        ];
    
        return $this->response->setJSON($msg);
    } 
}