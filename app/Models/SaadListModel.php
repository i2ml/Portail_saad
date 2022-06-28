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

}