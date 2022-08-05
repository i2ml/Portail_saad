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

    /**
     * Supprime tous les liens entre une saad et ses publics
     * @param $idSaad
     */
    public function deleteAll($idSaad){
        $this->where('idSaad', $idSaad)->delete();
    }

    /**
     * Retourne l'identifiant de tous les publics cibles du saad dont l'id est passé en parametre
     * @param $id
     * @return array
     */
    public function getPublicsIdByIdSaad($id){
        $list = $this->where("idSaad", $id)->findAll();
        return array_column($list, 'idPublic');
    }

    /**
     * Fonction permettant de récupérer tous les id saads traitant la liste de publics passés en paramteres
     * @param $idPublic
     * @return array
     */
    public function getSaadsIdByIdPublic($idPublic){
        $list = $this->whereIn("idPublic", $idPublic)->findAll();
        return array_column($list, 'idSaad');
    }

    /**
     * Modifie les liens entre saad et ses publics
     * @param $public
     * @param $id
     * @throws \ReflectionException
     */
    public function modifCibler($public, $id){
        $this->deleteAll($id);
        $this->saveAll($public, $id);
    }
}