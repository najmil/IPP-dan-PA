<?php

namespace App\Controllers;
use App\Models\StrongweakModel;
use App\Models\StrongWeakMainModel;
use App\Models\ProcsumMainModel;
use App\Models\IppModel;
use App\Models\IsiModel;
use App\Models\LogModel;
use Dompdf\Dompdf;
use Config\Paths;

class DaftarStrong extends BaseController
{
    public function __construct(){
        $this->strongweakmodel = new StrongweakModel();
        $this->strongweakmain = new StrongWeakMainModel();    
        $this->procsummain = new ProcsumMainModel();    
        $this->ippmodel = new IppModel();    
        $this->ippModel = new IppModel();    
        $this->logModel = new LogModel();    
    }

    public function index(){
        $mainData = $this->strongweakmain->orderBy('created_at', 'DESC')->getStrongweakByDepartmentAndDivision();
        $ehs = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(30);
        $mtc = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(29);
        $mkt = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(23);
        $fincont = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(22);
        $mis = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(24);
        $hr = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(20);
        $procurement = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(21);
        $productsatu = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(31);
        $productdua = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(32);
        $ppic = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(33);
        $spv = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(34);
        $producteng = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(28);
        $processeng = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(10);
        $isd = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(5);
        $qa = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDepartment(15);

        $plantserv = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDivision(4);
        $fin = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDivision(2);
        $adm = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDivision(1);
        $plant = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDivision(5);
        $eng = $this->strongweakmain->orderBy('created_at', 'DESC')->getDataByDivision(3);
        $content = $this->request->getVar('content');
        // dd($content);
        $contentdept = $this->request->getVar('contentdept');
        
        $filteredStrongweakData = array_filter($mainData, function ($row) {
            return $row['is_submitted'] == 1;
        });
        
        $user = session()->get('npk');
        if(session()->get('npk') == 0){
            if ($content == 'plantserv') {
                $data = [
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $plantserv,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $fin,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $adm,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $plant, 
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $eng,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $isd,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $ehs,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $mtc,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $mkt,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $fincont,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $mis, 
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $hr,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $procurement,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $productsatu,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $productdua,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $ppic,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $spv,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $qa,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $producteng,
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
                    'tittle' => 'Daftar Strength and Weakness Karyawan',
                    'daftarstrong'=> $processeng,
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
                'tittle' => 'Daftar Strength and Weakness Karyawan',
                'daftarstrong'=> $mainData,
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
        }
        
        return view('daftarstrong/index', $data);
    }

    public function detail($id){
        $strongweakDetail = $this->strongweakmodel->getIsi($id);
        $mainData = $this->strongweakmain->find($id);
        $periode = $mainData['periode'];
        $validation = \Config\Services::validation();
        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        $isWithinMidPeriode = null;
        $isWithinOnePeriode = null;
        $content = $this->request->getVar('content');
        $contentdept = $this->request->getVar('contentdept');

        $ehs = $this->strongweakmain->getDataByDepartment(15);
        $mtc = $this->strongweakmain->getDataByDepartment(29);
        $mkt = $this->strongweakmain->getDataByDepartment(23);
        $fincont = $this->strongweakmain->getDataByDepartment(6);
        $mis = $this->strongweakmain->getDataByDepartment(24);
        $hr = $this->strongweakmain->getDataByDepartment(20);
        $procurement = $this->strongweakmain->getDataByDepartment(21);
        $productsatu = $this->strongweakmain->getDataByDepartment(31);
        $productdua = $this->strongweakmain->getDataByDepartment(32);
        $ppic = $this->strongweakmain->getDataByDepartment(33);
        $spv = $this->strongweakmain->getDataByDepartment(34);
        // $qa = $this->strongweakmain->getDataByDepartment(); BELUM ADA DATANYA
        $producteng = $this->strongweakmain->getDataByDepartment(28);
        $processeng = $this->strongweakmain->getDataByDepartment(26);

        $plantserv = $this->strongweakmain->getDataByDivision(4);
        $fin = $this->strongweakmain->getDataByDivision(2);
        $adm = $this->strongweakmain->getDataByDivision(1);
        $plant = $this->strongweakmain->getDataByDivision(5);
        $eng = $this->strongweakmain->getDataByDivision(3);
        $isd = $this->strongweakmain->getDataByDepartment(5);

        if (strpos($periode, 'One Year') !== false) {
            return redirect()->to(base_url("daftarstrong/detail_one/{$id}"));
        }

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
                    $is_approved_before = !$mainData['approval_kasie'];
                }
                $is_approved = $mainData['approval_kadept'];
                // dd($is_approved);
            } elseif (session()->get('kode_jabatan') == 2) {
                if($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])){
                    $is_approved_before = !$mainData['approval_kadept'];
                }
                $is_approved = $mainData['approval_kadiv'];
            } elseif (session()->get('kode_jabatan') == 1) {
                if($mainData['kode_jabatan'] == 3 || ($mainData['kode_jabatan'] == 4 && $mainData['id_department'] == 5)){
                    $is_approved_before = !$mainData['approval_kadiv'];
                }
                $is_approved = $mainData['approval_bod'];
            } elseif (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                $is_approved_before = !$mainData['approval_bod'];
                $is_approved = !$mainData['approval_presdir'];
            } elseif (session()->get('kode_jabatan') == 4){
                $is_approved = !$mainData['approval_kasie'];
                $is_approved_before = true;
            }
        } elseif($isWithinOnePeriode){
            if (session()->get('kode_jabatan') == 3) {
                if($mainData['kode_jabatan'] == 8 && $mainData['created_by'] != [3651, 3659]){
                    $is_approved_before = !$mainData['approval_kasie_oneyear'];
                }
                $is_approved = $mainData['approval_kadept_oneyear'];
            } elseif (session()->get('kode_jabatan') == 2) {
                if($mainData['kode_jabatan'] == 4 || ($mainData['kode_jabatan'] == 8 && $mainData['created_by'] == [3651, 3659])){
                    $is_approved_before = !$mainData['approval_kadept_oneyear'];
                }
                $is_approved = $mainData['approval_kadiv_oneyear'];
            } elseif (session()->get('kode_jabatan') == 1) {
                if($mainData['kode_jabatan'] == 3 || ($mainData['kode_jabatan'] == 4 && $mainData['id_department'] == 5)){
                    $is_approved_before = !$mainData['approval_kadiv_oneyear'];
                }
                $is_approved = $mainData['approval_bod_oneyear'];
            } elseif (session()->get('kode_jabatan') == 0 && session()->get('npk') == 4280) {
                $is_approved_before = !$mainData['approval_bod_oneyear'];
                $is_approved = !$mainData['approval_presdir_oneyear'];
            } elseif (session()->get('kode_jabatan') == 4){
                $is_approved = !$mainData['approval_kasie_oneyear'];
                $is_approved_before = true;
            }
        }

        
        $data = [
            'tittle'             => 'Detail Strength and Weakness',
            'id_strongweak_main' => $id,
            'strongweak'         => $this->strongweakmodel->getSavedData($id),
            'strongweakmain'     => $this->strongweakmain->find($id),
            'validation'         => $validation,
            'mainData'           => $mainData,
            'is_submitted'       => $strongweakDetail[0]['is_submitted'],
            'is_submitted_one'   => $strongweakDetail[0]['is_submitted_one'],
            'is_approved'        => $is_approved,
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

        return view('daftarstrong/detail', $data);
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
        $isValueChanged = false;

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
                'note_mid'                 => $note_mid
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

        $row = $this->strongweakmodel->getSavedData($id_strongweak_main);
        $isValueChanged = false;
        // dd($id_strongweak_main);
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

    public function approveKadept($id) {
        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        $isWithinMidPeriode = null;
        $isWithinOnePeriode = null;

        // if (strpos($periode, 'One Year') !== false) {
        //     return redirect()->to(base_url("daftarstrong/detail_one/{$id}"));
        // }

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

        if (session()->get('kode_jabatan') != 3) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }
    
        if($isWithinMidPeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_kadept_strongweak' => 1,
                'approval_date_kadept_strongweak' => date('Y-m-d'),
                'approved_kadept_by' => session()->get('nama')
            ]);
        } elseif ($isWithinOnePeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_kadept_oneyear' => 1,
                'approval_date_kadept_oneyear' => date('Y-m-d'),
                'kadept_by_oneyear' => session()->get('nama')
            ]);
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadept approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }
    
    public function approveKadiv($id) {
        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        $isWithinMidPeriode = null;
        $isWithinOnePeriode = null;

        if (session()->get('kode_jabatan') != 2) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }

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
    
        if($isWithinMidPeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_kadiv_strongweak' => 1,
                'approval_date_kadiv_strongweak' => date('Y-m-d'),
                'approved_kadiv_by' => session()->get('nama')
            ]);
        } elseif ($isWithinOnePeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_kadiv_oneyear' => 1,
                'approval_date_kadiv_oneyear' => date('Y-m-d'),
                'kadiv_by_oneyear' => session()->get('nama')
            ]);
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'Kadiv approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }
    
    public function approveKasie($id) {
        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        $isWithinMidPeriode = null;
        $isWithinOnePeriode = null;

        if (session()->get('kode_jabatan') != 4) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }

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
    
        if($isWithinMidPeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_kasie_strongweak' => 1,
                'approval_date_kasie_strongweak' => date('Y-m-d'),
                'approved_kasie_by' => session()->get('nama')
            ]);
        }  elseif ($isWithinOnePeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_kasie_oneyear' => 1,
                'approval_date_kasie_oneyear' => date('Y-m-d'),
                'kasie_by_oneyear' => session()->get('nama')
            ]);
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'Kasie approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approvePresdir($id) {
        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        $isWithinMidPeriode = null;
        $isWithinOnePeriode = null;

        if (session()->get('kode_jabatan') != 0) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }

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
    
        if($isWithinMidPeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_presdir_strongweak' => 1,
                'approval_date_presdir_strongweak' => date('Y-m-d'),
                'approved_presdir_by' => session()->get('nama')
            ]);
        } elseif ($isWithinOnePeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_presdir_oneyear' => 1,
                'approval_date_presdir_oneyear' => date('Y-m-d'),
                'presdir_by_oneyear' => session()->get('nama')
            ]);
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'Presdir approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
    }

    public function approveBod($id) {
        $periodeModel = new \App\Models\PeriodeModel();
        $periodeMid = $periodeModel->getLatestMidPeriode();
        $periodeOne = $periodeModel->getLatestOnePeriode();
        $isWithinMidPeriode = null;
        $isWithinOnePeriode = null;

        if (session()->get('kode_jabatan') != 1) {
            return redirect()->back()->with('error', 'You do not have permission to approve.');
        }

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
    
        if($isWithinMidPeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_bod_strongweak' => 1,
                'approval_date_bod_strongweak' => date('Y-m-d'),
                'approved_bod_by' => session()->get('nama')
            ]);
        } elseif ($isWithinOnePeriode){
            $result = $this->strongweakmain->update($id, [
                'approval_bod_oneyear' => 1,
                'approval_date_bod_oneyear' => date('Y-m-d'),
                'bod_by_oneyear' => session()->get('nama')
            ]);
        }
    
        if ($result) {
            return redirect()->back()->with('success', 'BoD approval successful.');
        } else {
            return redirect()->back()->with('error', 'Failed to approve Kadept.');
        }
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

    public function unsubmit() {
        $id = $this->request->getVar('id');
        $data = $this->strongweakmain->find($id);
    
        $this->strongweakmain->set([
            'is_submitted'               => 0,
            'approval_bod_strongweak'    => NULL,
            'approval_presdir_strongweak'=> NULL,
            'approval_kadiv_strongweak'  => NULL,
            'approval_kadept_strongweak' => NULL,
            'approval_kasie_strongweak'  => NULL
        ])->where(['id'=> $id])->update();

        $this->strongweakmodel->set([
            'is_submitted'               => 0,
        ])->where(['id_strongweak_main'=> $id])->update();
    
        $msg = [
            'sukses' => true,
            'message' => 'Data has been unsubmitted.'
        ];
    
        return $this->response->setJSON($msg);
    } 

    public function unsubmit_one() {
        $id = $this->request->getVar('id');
        $data = $this->strongweakmain->find($id);
    
        $this->strongweakmain->set([
            'is_submitted_one'           => 0,
            'approval_bod_oneyear'       => 0,
            'approval_presdir_oneyear'   => 0,
            'approval_kadiv_oneyear'     => 0,
            'approval_kadept_oneyear'    => 0,
            'approval_kasie_oneyear'     => 0,
        ])->where(['id'=> $id])->update();

        $this->strongweakmodel->set([
            'is_submitted_one'               => 0,
        ])->where(['id_strongweak_main'=> $id])->update();
    
        $msg = [
            'sukses' => true,
            'message' => 'Data has been unsubmitted.'
        ];
    
        return $this->response->setJSON($msg);
    } 
}