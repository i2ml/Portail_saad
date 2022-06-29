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
     * @param $id l'id du saad à supprimer
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
}