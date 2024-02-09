<?php

namespace App\Models;

use CodeIgniter\Model;

class PeriodeModel extends Model{
    protected $table = 'periode';
    protected $primaryKey = 'id';
    protected $allowedFields = ['created_at', 'updated_at', 'name', 'start_period', 'end_period', 'start_periode_midyear', 'end_periode_midyear', 'start_periode_oneyear', 'end_periode_oneyear'];
    protected $useTimestamps = true;

    public function getLatestIPPeriode() {
        $currentYear = date('Y');
        $periodeName = "Periode IPP " . $currentYear;
        $currentDate = date('Y-m-d H:i:s');

        return $this->where('name', $periodeName)
                    ->where('start_period <=', $currentDate)
                    ->where('end_period >=', $currentDate)
                    ->first();
    }  

    public function getLatestIPPeriodeNull() {
        $currentYear = date('Y');
        $periodeName = "Periode IPP " . $currentYear;
        $currentDate = date('Y-m-d H:i:s');

        return $this->where('name', $periodeName)
                    ->first();
    }  
    
    public function getLatestMidPeriode() {
        $currentYear = date('Y');
        $periodeName = "Periode Mid Year " . $currentYear;
        $currentDate = date('Y-m-d H:i:s');
        
        return $this->where('name', $periodeName)
                    ->where('start_period <=', $currentDate)
                    ->where('end_period >=', $currentDate)
                    ->first();
    }

    public function getLatestMidPeriodeNull() {
        $currentYear = date('Y');
        $periodeName = "Periode Mid Year " . $currentYear;
        
        return $this->where('name', $periodeName)
                    ->first();
    }

    public function getLatestOnePeriodeNull() {
        $currentYear = date('Y');
        $periodeName = "Periode One Year " . $currentYear;
        
        return $this->where('name', $periodeName)
                    ->first();
    }

    public function getLatestOnePeriode() {
        $currentYear = date('Y');
        $periodeName = "Periode One Year " . $currentYear;
        $currentDate = date('Y-m-d H:i:s');
        
        return $this->where('name', $periodeName)
                    ->where('start_period <=', $currentDate)
                    ->where('end_period >=', $currentDate)
                    ->first();
    }  
}
