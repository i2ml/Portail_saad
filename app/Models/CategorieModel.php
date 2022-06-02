<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * categorieModel
 * @package App\Models
 */
class CategorieModel extends Model
{
    protected $table='categorie';

    protected $allowedFields=['id','nom','tarif'];

}