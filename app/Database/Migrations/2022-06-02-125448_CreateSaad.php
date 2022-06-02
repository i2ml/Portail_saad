<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class CreateSaad extends Migration
{
    public function up()
    {
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tarif' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('categorie');
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('secteur');
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'tel' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'mail' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'site' => [
                'type' => 'VARCHAR',
                'constraint' => '150',
            ],
            'adresse' => [
                'type' => 'VARCHAR',
                'constraint' => '300',
            ],
            'siret_siren' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'finess' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'image' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'idCategorie' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addKey('id', true);
        $this->forge->addForeignKey('idCategorie', 'categorie', 'id');
        $this->forge->createTable('saads');
        $this->forge->addField([
            'idSaad' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'idSecteur' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addForeignKey('idSaad', 'saads', 'id');
        $this->forge->addForeignKey('idSecteur', 'secteur', 'id');
        $this->forge->addKey(['idSaad', 'idSecteur'], true);
        $this->forge->createTable('agir');
        $this->forge->addField(['id' => [
            'type' => 'INT',
            'constraint' => 11,
            'unsigned' => true,
        ],
            'idSecteur' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addForeignKey('idSecteur', 'secteur', 'id');
        $this->forge->addKey('id', true);
        $this->forge->createTable('code_postal');
        $this->forge->addField([
            'id' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
                'auto_increment' => true,
            ],
            'nom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'prenom' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'mail' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'motdepasse' => [
                'type' => 'VARCHAR',
                'constraint' => '100',
            ],
            'idSaad' => [
                'type' => 'INT',
                'constraint' => 11,
            ],
        ]);
        $this->forge->addForeignKey('idSaad', 'saads', 'id');
        $this->forge->addKey('id', true);
        $this->forge->createTable('personne');
    }

    public function down()
    {
        $this->forge->dropTable('saads');
        $this->forge->dropTable('agir');
        $this->forge->dropTable('code_postal');
        $this->forge->dropTable('secteur');
        $this->forge->dropTable('categorie');
        $this->forge->dropTable('personne');
    }
}
