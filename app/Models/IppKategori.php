<?php

namespace App\Models;

use CodeIgniter\Model;

class IppKategori extends Model{
    protected $table = "ipp_kategori";
    protected $primaryKey = "id";
    protected $allowedFields = ['created_at', 'nama', 'updated_at'];

}
?>