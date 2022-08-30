<?php namespace App\Models;

use CodeIgniter\Database\BaseResult;
use CodeIgniter\Model;
use ReflectionException;

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
    public function getSaads(): ?array
    {
        return $this->findAll();
    }

    /**
     * Récupère la saad correspondant à l'id passée en paramètre
     * @param false $id - id de la saad à récupérer
     * @return array|null - Retourne la saad correspondant à l'id passée en paramètre
     */
    public function getSaadById($id): ?array
    {
        return $this->where('id', $id)->first();
    }

    /**
     * Cette fonction permet de modifier le saad dont l'id est passé en paramètre avec les données passées, elles aussi, en paramètre
     * @param $id - id de la saad à modifier
     * @param $data
     * @throws ReflectionException
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
     * Cette fonction permet de récupérer le nom de l'image du saad par son ID
     * @param $id
     * @return mixed
     */
    public function getImageById($id)
    {

        $saad = $this->where('id', $id)->first();
        return $saad['image'];
    }

    /**
     * Cette fonction permet de supprimer l'image du saad voulu du serveur
     * @param $id
     * @return void
     */
    public function deleteImage($id)
    {

        $this->where("id", $id);
        $image = $this->getImageById($id);
        $path = getcwd() . "\images\logosaads\\" . $image;


        unlink($path);

    }

    /**
     * Cette fonction récupère les saads dont l'id est présent dans la liste passée en paramètre
     * @param array $ids - liste d'id de saads à récupérer
     * @return array
     */
    public function getSaadsByIds(array $ids): array
    {
        return $this->whereIn('id', $ids)->findAll();
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
     * Redéfinition de la fonction save pour retourner l'identifiant de la saad que l'on enregistre
     * @param $data
     * @return bool|BaseResult|int|object|string
     * @throws ReflectionException
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
    public function getAllSaadsId(): array
    {
        $list = $this->findAll();
        return array_column($list, 'id');
    }

    /**
     * Fonction permettant de récupérer tous les id de saads de la base de données pour lesquels l'un des champs correspond à la chaine de caractère passée en paramètre
     * @param $mainSearch string - chaine de caractère à rechercher dans les champs de la base de données
     */
    public function getSaadIdsFilteredByMainSearch($mainSearch): array
    {
        $list = $this->findAll();
        $ids = array_column($list, 'id');
        $filteredIds = [];
        foreach ($ids as $id) {
            $saad = $this->where('id', $id)->first();
            $mainSearch = $this->stripAccents($mainSearch);
            $nom = $this->stripAccents($saad['nom']);
            if (stripos(trim(strtolower($nom)), trim(strtolower($mainSearch))) !== false) {
                $filteredIds[] = $id;
            }
        }
        return $filteredIds;
    }

    /**
     * Supprime les accents d'une chaine de caractère
     * @param $chaine
     * @return string
     */
    private function stripAccents($chaine): string
    {
        return str_replace(
            ['À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'à', 'á', 'â', 'ã', 'ä', 'å', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ð', 'ò', 'ó', 'ô', 'õ', 'ö', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ'],
            ['A', 'A', 'A', 'A', 'A', 'A', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 'a', 'a', 'a', 'a', 'a', 'a', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y'],
            $chaine
        );
    }
}