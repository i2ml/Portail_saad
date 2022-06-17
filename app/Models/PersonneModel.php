<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * PersonneModel
 * @package App\Models
 */
class PersonneModel extends Model
{
    protected $table = 'personne';

    protected $allowedFields = ['id', 'nom', 'prenom', 'mail', 'motdepasse', 'idSaadList', 'accountType'];

    /**
     * Cette fonction permet de récupérer une personne ou l'ensemble des personnes présentent en bdd
     * @param false $id l'id de la personne que l'on cherche
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
    public function deleteLine($id)
    {

        $this->where("id",$id)
            ->delete();
    }

    /**
     * Cette fonction permet de passer un gérant de saad administrateur
     * @param $id du gérant que l'on veut upgrade
     * @throws \ReflectionException
     */
    public function upgrade($id)
    {
        $this->update($id,['accountType' => SUPER_ADMIN]);
    }

    /**
     * Cette fonction permet de passer un admin en gérant de saad
     * @param $id de l'admin que l'on veut downgrade
     * @throws \ReflectionException
     */
    public function downgrade($id)
    {
        $this->update($id,['accountType' => SAAD_MANAGER]);
    }
}