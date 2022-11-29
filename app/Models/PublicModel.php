<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * publicModel
 * @package App\Models
 */
class PublicModel extends Model
{
    protected $table='public';

    protected $allowedFields=['id','nom'];

    /**
     * Fonction permettant de récupérer un tableau contenant tous les publics existants
     * @return array
     */
    public function getPublics(){
        return $this->findAll();
    }

}