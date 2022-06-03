<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Adminupdate extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'idSaad' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'idPersonne' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        $this->forge->addKey('idSaad', true);
        $this->forge->addKey('idPersonne', true);
        $this->forge->createTable('saad_list');
        //move data from the personne table to the saad_list table
        $this->db->query("INSERT INTO saad_list (idSaad, idPersonne) SELECT id, idSaad FROM personne");
        $this->forge->dropColumn('personne', 'idSaad');
        $this->forge->addColumn('personne', [
            'accountType' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
        ]);
        //by default the user with the smallest id is a super admin
        $this->db->query("UPDATE personne SET accountType = 1 WHERE id = (SELECT MIN(id) FROM personne)");
        //all the other users are saads managers
        $this->db->query("UPDATE personne SET accountType = 2 WHERE id != (SELECT MIN(id) FROM personne)");
    }

    public function down()
    {
        $this->forge->addColumn('personne', ['idSaad' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
        ]]);
        //this will keep only one idSaad per personne /!\
        $this->db->query("UPDATE personne SET idSaad = (SELECT id FROM saad_list WHERE idPersonne = personne.id)");
        $this->forge->dropTable('saad_list');
        $this->forge->dropColumn('personne', 'accountType');
    }
}
