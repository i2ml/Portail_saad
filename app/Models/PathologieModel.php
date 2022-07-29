<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * pathologieModel
 * @package App\Models
 */
class PathologieModel extends Model
{
    protected $table='pathologie';

    protected $allowedFields=['id','nom'];

    /**
     * Fonction retournant un tableau contenant toutes les pathologies
     * @return array
     */
    public function getPathologies(){
        return $this->findAll();
    }

}