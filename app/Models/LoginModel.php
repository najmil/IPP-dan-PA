<?php

namespace App\Models;

use CodeIgniter\Model;

class LoginModel extends Model{

    protected $table            = 'users';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $allowedFields    = ['npk', 'username', 'nama', 'password', 'kode_jabatan', 'id_division', 'id_department', 'id_section', 'division', 'department', 'section'];
    protected $useTimestamps    = false;

    // public function login($username, $password) {
    //     $user = $this->where('username', $username)->first();
    
    //     if ($user && password_verify($password, $user['password'])) {
    
    //         // Menyimpan informasi tambahan dalam sesi
    //         $sessionData = [
    //             'npk' => $user['npk'],
    //             'nama' => $user['nama'],
    //             'kode_jabatan' => $user['kode_jabatan'],
    //             'id_division' => $user['id_division'],
    //             'id_department' => $user['id_department'],
    //             'id_section' => $user['id_section']
    //         ];
    
    //         session()->set($sessionData);
    
    //         return true;
    //     }
    
    //     return false;
    // }
    
}

?>