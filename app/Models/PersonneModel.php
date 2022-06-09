<?php namespace App\Models;

use CodeIgniter\Model;

/**
 * PersonneModel
 * @package App\Models
 */
class PersonneModel extends Model
{
    protected $table = 'personne';

    protected $allowedFields = ['id', 'nom', 'prenom', 'mail', 'motdepasse', 'idSaadList', 'account_type'];

    public function getPersonnes($id = false)
    {
        if ($id) {
            return $this->where('id', $id)->first();
        }
        return $this->findAll();
    }

    public function delete_line($id)
    {

        $this->where("id",$id)
            ->delete();
    }
}