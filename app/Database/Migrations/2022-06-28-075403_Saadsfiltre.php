<?php

namespace App\Database\Migrations;

use CodeIgniter\Database\Migration;

class Saadsfiltre extends Migration
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
        ]);
        $this->forge->addKey('id', true);
        $this->forge->createTable('public');
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
        $this->forge->createTable('pathologie');
        $this->forge->addField([
            'idSaad' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'idPublic' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addForeignKey('idSaad', 'saads', 'id');
        $this->forge->addForeignKey('idPublic', 'public', 'id');
        $this->forge->addKey(['idSaad', 'idPublic'], true);
        $this->forge->createTable('cibler');
        $this->forge->addField([
            'idSaad' => [
                'type' => 'INT',
                'constraint' => 11,
                'unsigned' => true,
            ],
            'idPathologie' => [
                'type' => 'INT',
                'constraint' => 11,
            ]
        ]);
        $this->forge->addForeignKey('idSaad', 'saads', 'id');
        $this->forge->addForeignKey('idPathologie', 'pathologie', 'id');
        $this->forge->addKey(['idSaad', 'idPathologie'], true);
        $this->forge->createTable('specialiser');
    }

    public function down()
    {
        $this->forge->dropTable('public');
        $this->forge->dropTable('pathologie');
        $this->forge->dropTable('specialiser');
        $this->forge->dropTable('cibler');
    }
}
