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

    public function getPathologies(){
        return $this->findAll();
    }

}