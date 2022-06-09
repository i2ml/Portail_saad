<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * PersonneModel
 * @package App\Models
 */
class PersonneModel extends Model
{
    protected $table = 'personne';

    protected $allowedFields = ['id', 'nom', 'prenom', 'mail', 'motdepasse', 'idSaadList', 'account_type'];

    /**
     * Cette fonction permet de récupérer une personne ou l'ensemble des personnes présentent en bdd
     * @param false $id l'id de la personne que l'on chercher
     * @return array|object|null soit toutes les personnes de la bdd soit la personne avec l'id passer en param
     */
    public function getPersonnes($id = false)
    {
        if ($id) {
            return $this->where('id', $id)->first();
        }
        return $this->findAll();
    }

    /**
     * Cette fonction permet de supprimer la personne dont l'id est passé en param
     * @param $id l'id de la personne à supprimer
     */
    public function delete_line($id)
    {

        $this->where("id",$id)
            ->delete();
    }
}