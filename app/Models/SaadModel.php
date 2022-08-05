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
     * Récupère toutes les saads 
     * @return array|null - Retourne un tableau contenant les saads
     */
    public function getSaads()
    {
        return $this->findAll();
    }

    /**
     * récupère la saad correspondant à l'id passée en paramètre
     * @param false $id - id de la saad à récupérer
     * @return object|null - Retourne la saad correspondant à l'id passée en paramètre
     */
    public function getSaadbyid($id)
    {
        return $this->where('id', $id)->first();
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
     * @param $id number L'id du saad à supprimer
     */
    public function deleteLine($id)
    {

        $this->where("id", $id)
            ->delete();

    }

    /**
     * cette fonction permet de récupérer le nom de l'image du saad par son ID
     * @param $id
     * @return mixed
     */
    public function getImageById($id){

        $saad = $this->where('id',$id)->first();
        return $saad['image'];
    }

    /**
     * Cette fonction permet de supprimer l'image du saad voulu du serveur
     * @param $id
     * @return void
     */
    public function deleteImage($id){

        $this->where("id",$id);
        $image = $this->getImageById($id);
        $path = getcwd()."\images\logosaads\\".$image;


        unlink($path);

    }

    /**
     * Cette fonction récupère les saads dont l'id est présent dans la liste passée en paramètre
     * @param array|null $getSaadIdsFromPersonId
     * @return array
     */
    public function getSaadsByIds(?array $getSaadIdsFromPersonId): array
    {
        return $this->whereIn('id', $getSaadIdsFromPersonId)->findAll();
    }

    /**
     * Fonction permettant de récupérer une image grace a l'id d'un saad
     * @param $id
     * @return mixed
     */
    public function getImgById($id)
    {
        $saad = $this->where("id, $id")->first();
        return $saad['image'];
    }

    /**
     * redefinition de la fonction save pour retourner l'identifiant de la saad que l'on enregistre
     * @param $data
     * @return bool|\CodeIgniter\Database\BaseResult|int|object|string
     * @throws \ReflectionException
     */
    public function saveSaad($data)
    {
        if (empty($data)) {
            return true;
        }
        if ($this->shouldUpdate($data)) {
            $response = $this->update($this->getIdValue($data), $data);
        } else {
            $response = $this->insert($data, true);
        }
        return $response;
    }

    /**
     * Fonction permettant de récupérer tous les id de saads de la base de données
     * @return array
     */
    public function getAllSaadsId(){
        $list = $this->findAll();
        return array_column($list, 'id');
    }
}