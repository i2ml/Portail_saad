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

    /**
     * Supprime tous les liens entre une saad et ses pathologies
     * @param $idSaad
     */
    public function deleteAll($idSaad){
        $this->where('idSaad', $idSaad)->delete();
    }

    /**
     * Retourne l'identifiant de toutes les pathologies cibles du saad dont l'id est passé en parametre
     * @param $id
     * @return array
     */
    public function getPathologiesIdByIdSaad($id){
        $list = $this->where("idSaad", $id)->findAll();
        return array_column($list, 'idPathologie');
    }

    /**
     * Modifie les liens entre saad et ses pathologies
     * @param $pathologie
     * @param $id
     * @throws \ReflectionException
     */
    public function modifSpecialiser($pathologie, $id){
        $this->deleteAll($id);
        $this->saveAll($pathologie, $id);
    }
}