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

    public function getPublics(){
        return $this->findAll();
    }

}