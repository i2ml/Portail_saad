<?php

namespace App\Models;

use CodeIgniter\Model;

class CiblerModel extends Model
{
    protected $table='cibler';

    protected $allowedFields=['idSaad','idPublic'];

    public function getPathologies(){
        return $this->findAll();
    }

    public function saveAll($allIDPublic, $idSaad){
        foreach ($allIDPublic as $idPublic){
            $this->insert(
                ['idSaad' => $idSaad,
                'idPublic' => $idPublic]
            );
        }
    }
}