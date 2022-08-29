<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * SaadListModel
 * @package App\Models
 */
class SaadListModel extends Model
{
    protected $table = 'saad_list';

    protected $allowedFields = ['idPersonne', 'idSaad'];

    /**
     * Cette fonction permet de récupérer les liens entre une personne et un saad
     * @return array|object|null
     */
    public function getSaadList(): array
    {
        return $this->findAll();
    }

    /**
     * Cette fonction permet de récupérer la liste des id des saads liés à une personne
     * @param $id number L'id de la personne dont on veut récupérer la liste des saads
     * @return array|object|null
     */
    public function getSaadIdsFromPersonId($id): array
    {
        $list = $this->where('idPersonne', $id)->findAll();
        return array_column($list, 'idSaad');

    }

    /**
     * Cette fonction permet de récupérer la liste des id de personnes qui sont liés à un saad
     * @param $id number - L'id du saad dont on veut récupérer la liste des personnes
     * @return array|null
     */
    public function getPersonIdsFromSaadId($id): array
    {
        $list = $this->where('idSaad', $id)->findAll();
        return array_column($list, 'idPersonne');
    }

    /**
     * @param $idPersonne number - L'id de la personne dont on veut supprimer les liens avec les saads
     */
    public function deleteAllLinks($idPersonne)
    {
        $this->where('idPersonne', $idPersonne)->delete();
    }

    /**
     * Cette fonction permet de vérifier si un saad est lié à un utilisateur
     * @param $idSaad l'id du saad
     * @param $idUser L'id de l'utilisateur
     * @return bool True si le saad est lié à l'utilisateur, false sinon
     */
    public function isSaadLinkedToUser($idSaad, $idUser): bool
    {
        $list = $this->where('idSaad', $idSaad)->where('idPersonne', $idUser)->findAll();
        return count($list) > 0;
    }
}