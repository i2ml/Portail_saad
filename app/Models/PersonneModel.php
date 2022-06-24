<?php namespace App\Models;

use CodeIgniter\Model;
use ReflectionException;

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
     * Transforme un tableau d'id de personne en un tableau de nom et prénom
     * @param $idPersonnes array tableau d'id de personne
     * @return array de nom et prénom
     */
    public function getPersonnesNameFromId(array $idPersonnes): array
    {
        // check if $idPersonnes is an array and not empty
        if (!is_array($idPersonnes) || empty($idPersonnes)) {
            return [];
        }
        // get all personnes that are in the array
        $personnes = $this->whereIn('id', $idPersonnes)->get()->getResultArray();
        $names = [];
        foreach ($personnes as $personne) {
            $names[] = $personne['nom'] . ' ' . $personne['prenom'];
        }
        return $names;
    }

    /**
     * Cette fonction permet de supprimer la personne dont l'id est passé en param
     * @param $id l'id de la personne à supprimer
     */
    public function deleteLine($id)
    {

        $this->where("id", $id)
            ->delete();
    }

    /**
     * Cette fonction permet de passer un gérant de saad administrateur
     * @param $id number id du gérant que l'on veut upgrade
     * @throws ReflectionException
     */
    public function upgrade($id)
    {
        $this->update($id, ['accountType' => SUPER_ADMIN]);
    }

    /**
     * Cette fonction permet de passer un admin en gérant de saad
     * @param $id number l'admin que l'on veut downgrade
     * @throws ReflectionException
     */
    public function downgrade($id)
    {
        $this->update($id, ['accountType' => SAAD_MANAGER]);
    }

    /**
     * @param $email
     * @param $password
     * @throws ReflectionException
     */
    public function changePassword($email, $password){
        $id = $this->getPersonnesIdFromEmail($email);
        $this->update($id, ['motdepasse'=>$password]);
    }

    /**
     * @param $email
     * @return mixed
     */
    private function getPersonnesIdFromEmail($email)
    {
        $user = $this->where('mail',$email)->first();
        return $user['id'];
    }
}