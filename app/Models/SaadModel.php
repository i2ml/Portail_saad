<?php namespace App\Models;

use CodeIgniter\Model;

class SaadModel extends Model
{
    protected $table='saads';

    protected $allowedFields=['id','nom', 'tel', 'mail', 'site', 'adresse', 'siret_siren', 'finess', 'image', 'idCategorie'];


    public function getSaads($id=false)
    {
        if ($id === false)
        {
            return $this->findAll();
        }

        return $this->asArray()
            ->where(['id' => $id])
            ->first();
    }

}