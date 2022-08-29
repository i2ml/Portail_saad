<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * SecteurModel
 * @package App\Models
 */
class SecteurModel extends Model
{
    protected $table = 'secteur';

    protected $allowedFields = ['id', 'nom'];

    /**
     * Cette fonction permet de récupérer l'ensemble des secteurs présentent en bdd
     * @return array
     */
    public function getSecteur(): array
    {
        return $this->findAll();
    }

    /**
     * Cette fonction permet de récupérer des secteurs à partir d'une id de saad
     * @param array $ids
     * @return array Les secteurs correspondants aux ids passés en param
     */
    public function getSecteursByIds(array $ids): array
    {
        return $this->whereIn('id', $ids)->findAll();
    }
}