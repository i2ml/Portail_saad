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
     * Cette fonction permet de récupérer l'ensemble des personnes présentent en bdd sans leurs mots de pass
     * @return array|null soit toutes les personnes de la bdd
     */
    public function getPersonnes()
    {
        return $this
            ->select('id, nom, prenom, mail, accountType')
            ->get()
            ->getResultArray();
        
    }

    /**
     * Cette fonction permet de récupérer le mdp de la personne correpondant à l'id passée en parametre
     * @param $id l'identifiant de la personne demandée
     * @return la ligne de l'utilisateur dont l'id est passée en param dont le champs mot de passe
     */
    public function checkPass($mail, $varp)
    {
        $chk = $this->where('mail', $mail)->first();

        if ($chk) {
            $pass = $chk['motdepasse'];
            $authenticatePassword = password_verify($varp, $pass);
            return $authenticatePassword;
            
        } else {
            return False;
        }            
    }

    /**
     * Cette fonction permet de récupérer une personne en bdd identifiée par son mail $mail en param
     * @param $mail l'identifiant de la personne demandée
     * @return object|null  la ligne de la bdd correspondant à l'id passée en param sans le mdp
     */
    public function getPersonnebymail($mail)
    {
        return $this
            ->select('id, nom, prenom, mail, accountType')
            ->where('mail', $mail)
            ->first();
    }

    /**
     * Cette fonction permet de récupérer une personne en bdd identifiée par son id $id en param
     * @param $id l'identifiant de la personne demandée
     * @return object|null  la ligne de la bdd correspondant à l'id passée en param sans le mdp
     */
    public function getPersonnebyid($id)
    {
        return $this
            ->select('id, nom, prenom, mail, accountType')
            ->where('id', $id)
            ->first();
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
     * Permet de changer le mdp de la personne dont le mail est passé en parametre
     * @param $email
     * @param $password
     * @throws ReflectionException
     */
    public function changePassword($email, $password){
        $id = $this->getPersonnesIdFromEmail($email);
        $this->update($id, ['motdepasse'=>$password]);
    }

    /**
     * Permet de changer le mdp de la personne dont l'id est passé en parametre
     * @param $id
     * @param $password
     * @throws ReflectionException
     */
    public function changePasswordWithId($id, $password){
        $this->update($id, ['motdepasse'=>$password]);
    }

    /**
     * Retourne l'id de la personne dont le mail est passé en param
     * @param $email
     * @return mixed l'id de la personne
     */
    private function getPersonnesIdFromEmail($email)
    {
        $user = $this->where('mail',$email)->first();
        return $user['id'];
    }
}