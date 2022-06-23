<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * SaadModel
 * @package App\Models
 */
class SaadModel extends Model
{
    protected $table = 'saads';

    protected $allowedFields = ['id', 'nom', 'tel', 'mail', 'site', 'adresse', 'siret_siren', 'finess', 'image', 'idCategorie'];


    /**
     * Récupère toutes les saads si aucun id n'est passé en paramètre, sinon récupère la saad correspondant à l'id passée en paramètre
     * @param false $id - id de la saad à récupérer
     * @return array|object|null - Retourne un tableau contenant les saads si aucun id n'est passé en paramètre, sinon retourne la saad correspondant à l'id passée en paramètre
     */
    public function getSaads($id = false)
    {
        $db = db_connect();
        $builder = $db->table('saads');
        $query = $id ? $builder
            ->select('*')
            ->where('id', $id)
            ->get() : $builder
            ->select('*')
            ->get();
        return $query->getResultArray();
    }

    /**
     * Cette fonction permet de modifier le saad dont l'id est passé en paramètre avec les données passées, elles aussi, en paramètre
     * @param $id - id de la saad à modifier
     * @param $data
     * @throws \ReflectionException
     */
    public function modifSaads($id, $data)
    {
        $this->update($id, $data);
    }

    /**
     * Cette fonction permet de supprimer le saad dont l'id est passé en param
     * @param $id l'id du saad à supprimer
     */
    public function deleteLine($id)
    {

        $this->where("id", $id)
            ->delete();
    }
}