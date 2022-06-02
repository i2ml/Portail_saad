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

}