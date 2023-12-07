<?php

namespace App\Models;

use CodeIgniter\Model;

class IsiPeopleModel extends Model{
    protected $table = "isi_ipp_people";
    protected $primaryKey = "id";
    protected $allowedFields = ['id_main', 'program', 'weight', 'midyear', 'oneyear', 'duedate'];

    public function getIsi(){
        $builder = $this->db->table('isi_ipp');
        $builder->join('main', 'main.id = isi_ipp.id_main');
        $query = $builder->get();
        
        return $query->getResult();
    }

    // public function getIsi($id = false){
    //     // $this->db->from('isi_ipp');
    //     // $this->db->join('main', 'main.id = isi_ipp.id_main');
    //     if($id == false){
    //         return $this->findAll();
    //     }
        
    //     return $this->where(['id'])->first();
    // }
}

?>