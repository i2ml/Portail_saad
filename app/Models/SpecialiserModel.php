<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model de la table specialiser
 */
class SpecialiserModel extends Model
{
    protected $table='specialiser';

    protected $allowedFields=['idSaad','idPathologie'];

    /**
     * Méthode qui permet d'enregistrer tous les couples de clefs passé en param.
     * Permet de lier un saad à plusieurs pathologies
     * @param $allIDPathologie
     * @param $idSaad
     * @throws \ReflectionException
     */
    public function saveAll($allIDPathologie, $idSaad){
        foreach ($allIDPathologie as $idPathologie){
            $this->insert(
                ['idSaad' => $idSaad,
                    'idPathologie' => $idPathologie]
            );
        }
    }
}