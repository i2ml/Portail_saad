<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * codePostalModel
 * @package App\Models
 */
class CodePostalModel extends Model
{
    protected $table='code_postal';

    protected $allowedFields=['id','idSecteur'];

}