<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * SaadListModel
 * @package App\Models
 */
class SaadListModel extends Model
{
    protected $table = 'saad_list';

    protected $allowedFields = ['idPersonne','idSaad'];

}