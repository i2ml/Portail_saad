<?php

namespace App\Models;

use CodeIgniter\Model;

class SpecialiserModel extends Model
{
    protected $table='specialiser';

    protected $allowedFields=['idSaad','idPathologie'];

    public function saveAll($allIDPathologie, $idSaad){
        foreach ($allIDPathologie as $idPathologie){
            $this->insert(
                ['idSaad' => $idSaad,
                    'idPathologie' => $idPathologie]
            );
        }
    }
}