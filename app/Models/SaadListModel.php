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
     * Cette fonction permet de récupérer la liste des id de personnes qui sont liés à un saad
     * @param $id number du saad que l'on veut récupérer
     * @return array|object|null
     */
    public function getPersonnes($id): array
    {
        $saadlist = $this->where('idSaad', $id)->findAll();
        //on récupère les id de personnes
        $idPersonnes = [];
        foreach ($saadlist as $saad) {
            $idPersonnes[] = $saad['idPersonne'];
        }
        return $idPersonnes;
    }

}