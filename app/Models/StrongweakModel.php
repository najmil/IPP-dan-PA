<?php

namespace App\Models;

use CodeIgniter\Model;

class StrongweakModel extends Model
{
    protected $table = 'strongweak';
    protected $primaryKey = 'id';
    protected $allowedFields = ['id_strongweak_main', 'is_submitted', 'is_submitted_one', 'strong_mid', 'weak_mid', 'strong_one', 'weak_one', 'note_mid', 'note_one', 'alc_mid', 'sub_alc_mid', 'technical_mid', 'strong_mid_alc', 'technical_value_mid', 'weak_alc_mid', 'weak_sub_alc_mid', 'weak_technical_mid', 'weak_mid_alc', 'weak_technical_value_mid', 'alc_one', 'sub_alc_one', 'technical_one', 'strong_one_alc', 'technical_value_one', 'weak_alc_one', 'weak_sub_alc_one', 'weak_technical_one', 'weak_one_alc', 'weak_technical_value_one', 'is_saved_oneyear', 'is_saved_midyear'];

    public function getIsi($id_strongweak_main = null){
        if ($id_strongweak_main === null) {
            return $this->findAll();
        } else {
            $result = $this->select('strongweak.*, strongweak_main.id AS id_strongweak_main')
                ->join('strongweak_main', 'strongweak_main.id = strongweak.id_strongweak_main')
                ->where(['strongweak.id_strongweak_main' => $id_strongweak_main])
                ->findAll();

            return $result ? $result : [];
        }
    }

    public function getSavedData($id) {
        return $this->where('id_strongweak_main', $id)->first();
    }

}
