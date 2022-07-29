<?php

namespace App\Models;

use CodeIgniter\Model;

/**
 * Model de la table Cibler
 */
class CiblerModel extends Model
{
    protected $table='cibler';

    protected $allowedFields=['idSaad','idPublic'];

    /**
     * Méthode qui permet d'enregistrer tous les couples de clefs passé en param.
     * Permet de lier un saad à plusieurs pathologies
     * @param $allIDPathologie
     * @param $idSaad
     * @throws \ReflectionException
     */
    public function saveAll($allIDPublic, $idSaad){
        foreach ($allIDPublic as $idPublic){
            $this->insert(
                ['idSaad' => $idSaad,
                'idPublic' => $idPublic]
            );
        }
    }
}