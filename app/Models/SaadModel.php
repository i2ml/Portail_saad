<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * SaadModel
 * @package App\Models
 */
class SaadModel extends Model
{
    protected $table='saads';

    protected $allowedFields=['id','nom', 'tel', 'mail', 'site', 'adresse', 'siret_siren', 'finess', 'image', 'idCategorie'];

    /**
     * Récupère toutes les saads si aucun id n'est passé en paramètre, sinon récupère la saad correspondant à l'id passée en paramètre
     * @param false $id id de la saad à récupérer
     * @return array|object|null - Retourne un tableau contenant les saads si aucun id n'est passé en paramètre, sinon retourne la saad correspondant à l'id passée en paramètre
     */
    public function getSaads($id=false)
    {
        if ($id === false)
        {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }

}