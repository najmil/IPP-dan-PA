<?php

namespace App\Models;

use CodeIgniter\Model;

class MidyearLogModel extends Model
{
    protected $table = 'midyear_log';
    protected $primaryKey = 'id';
    protected $allowedFields = ['action', 'table_name', 'record_id', 'data_changes', 'by'];
    protected $useTimestamps = true;
    protected $createdField  = 'created_at';
    protected $updatedField  = null;

    public function getLogEntries($limit = null){
        if ($limit !== null) {
            return $this->orderBy('created_at', 'desc')->findAll($limit);
        } else {
            return $this->orderBy('created_at', 'desc')->findAll();
        }
    }

    public function getLogEntriesByTableNameAndRecordId($tableName, $recordId, $limit = null){
        if ($limit !== null) {
            return $this->where('table_name', $tableName)
                        ->where('record_id', $recordId)
                        ->orderBy('created_at', 'desc')
                        ->findAll($limit);
        } else {
            return $this->where('table_name', $tableName)
                        ->where('record_id', $recordId)
                        ->orderBy('created_at', 'desc')
                        ->findAll();
        }
    }

}
