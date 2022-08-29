<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * agirModel
 * @package App\Models
 */
class AgirModel extends Model
{
    protected $table='agir';

    protected $allowedFields=['idSaad','idSecteur'];

    /**
     * Méthode qui permet de récupérer les ids des secteurs qui sont liés à un saad
     * @param $id
     * @return array
     */
    public function getSecteurIdsFromSaadId($id): array
    {
        $list = $this->where("idSaad", $id)->findAll();
        return array_column($list, 'idSecteur');
    }

    /**
     * @param $id
     * @return array
     */
    public function getSaadsIdsFromSecteurId($id): array
    {
        $list = $this->where("idSecteur", $id)->findAll();
        return array_column($list, 'idSaad');
    }

    /**
     * Cette fonction supprime les liens entre un saad et ses secteurs
     * @param $idSaad
     */
    public function deleteAllLinks($idSaad)
    {
        $this->where("idSaad", $idSaad)->delete();
    }
}